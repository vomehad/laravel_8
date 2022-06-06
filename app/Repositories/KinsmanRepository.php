<?php

namespace App\Repositories;

use App\Dto\CityDto;
use App\Dto\KinsmanDto;
use App\Dto\LifeDto;
use App\Dto\SelectedDto;
use App\Helpers\NameHelper;
use App\Interfaces\DtoInterface;
use App\Interfaces\InheritInterface;
use App\Interfaces\RepositoryInterface;
use App\Models\Kin;
use App\Models\Kinsman;
use App\Models\Life;
use App\Orchid\Layouts\Kinsman\KinsmanFilterLayout;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class KinsmanRepository extends BaseRepository implements RepositoryInterface, InheritInterface
{
    private Kinsman $kinsmanModel;
    private Kin $kinModel;
    private LifeRepository $lifeRepository;
    private CityRepository $cityRepository;

    public function __construct(
        Kinsman $kinsmanModel,
        Kin $kinModel,
        LifeRepository $lifeRepository,
        CityRepository $cityRepository
    )
    {
        $this->kinsmanModel = $kinsmanModel;
        $this->kinModel = $kinModel;
        $this->lifeRepository = $lifeRepository;
        $this->cityRepository = $cityRepository;
    }

    public function getAll(array $options = []): LengthAwarePaginator
    {
        $kinsmans = $this->kinsmanModel->where(['active' => true]);

        if (Arr::has($options, 'eager')) {
            $kinsmans = $kinsmans->with(['father', 'mother', 'kin']);
        }

        if (Arr::has($options, 'search')) {
            $kinsmans = $kinsmans->search(Arr::get($options, 'search'));
        }

        if (Arr::has($options, 'defaultSort')) {
            $kinsmans = $kinsmans->filters()
                ->filtersApplySelection(KinsmanFilterLayout::class)
                ->defaultSort(Arr::get($options, 'defaultSort'));
        }

        return $kinsmans->paginate(Arr::get($options, 'perPage'));
    }

    public function getOne(int $id): ?Model
    {
        return $this->kinsmanModel
            ->with(['father', 'mother', 'kin'])
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();
    }

    public function add(): array
    {
        $fathers = $this->kinsmanModel
            ->where(['gender' => 'male'])
            ->get()
            ->keyBy('id');
        $mothers = $this->kinsmanModel
            ->where(['gender' => 'female'])
            ->get()
            ->keyBy('id');
        $kins = $this->kinModel
            ->where(['active' => true])
            ->get()
            ->keyBy('id');

        return [$this->kinsmanModel, $fathers, $mothers, $kins];
    }

    public function create(DtoInterface $dto): ?int
    {
        /** @var KinsmanDto $dto */
        $birthDate = $dto->birth_date;
        $endDate = $dto->end_date;
        $native = $dto->native;
        unset($dto->birth_date);
        unset($dto->end_date);
        unset($dto->native);

        $kinsman = $this->setFields($this->kinsmanModel, $dto);
        $saved = $kinsman->save();

        $dto->native = $native;
        $cityId = $this->updateCity($dto);
        unset($dto->native);

        $dto->id = $kinsman->id;
        $dto->birth_date = (string)$birthDate;
        $dto->end_date = (string)$endDate;
        $dto->native_city_id = $cityId;
        $this->updateLife($dto);

        return $saved ? $kinsman->id : null;
    }

    public function edit(int $id): array
    {
        $kinsman = $this->kinsmanModel
            ->where(['id' => $id])
            ->first();
        $fathers = $this->kinsmanModel
            ->where(['gender' => 'male'])
            ->where(['active' => true])
            ->where('id', '!=', $id)
            ->get()
            ->keyBy('id');
        $mothers = $this->kinsmanModel
            ->where(['gender' => 'female'])
            ->where(['active' => true])
            ->where('id', '!=', $id)
            ->get()
            ->keyBy('id');
        $kins = $this->kinModel
            ->where(['active' => true])
            ->get()
            ->keyBy('id');

        $selected = new SelectedDto();
        $selected->fatherId = $kinsman->father->id ?? null;
        $selected->motherId = $kinsman->mother->id ?? null;
        $selected->kinId = $kinsman->kin->id ?? null;

        return [$kinsman, $fathers, $mothers, $kins, $selected];
    }

    public function update(DtoInterface $dto): ?int
    {
        /** @var KinsmanDto $dto */
        $kinsman = $this->kinsmanModel->findOrNew($dto->id);

        $cityId = $this->updateCity($dto);
        $dto->native_city_id = $cityId;
        unset($dto->native);

        $this->updateLife($dto);
        unset($dto->birth_date);
        unset($dto->end_date);
        unset($dto->native_city_id);

        $kinsman = $this->setFields($kinsman, $dto);

        $updated = $kinsman->update();

        return $updated ? $kinsman->id : null;
    }

    public function getChildren(int $id)
    {
        return $this->kinsmanModel
            ->orWhere(['father_id' => $id])
            ->orWhere(['mother_id' => $id])
            ->get();
    }

    public function remove(int $id): string
    {
        /** @var Kinsman $kinsamn */
        $kinsman = $this->kinsmanModel->find($id);
        $kinsman->delete();

        return NameHelper::getActionName();
    }

    public function restore(int $id): string
    {
        $kinsman = $this->kinsmanModel->withTrashed()->find($id);
        $kinsman->restore();

        return NameHelper::getActionName();
    }

    private function setFields(Kinsman $kinsman, DtoInterface $dto): Kinsman
    {
        foreach ($dto as $prop => $value) {
            if ($dto->$prop !== null) {
                $kinsman->$prop = $value;
            }
        }

        return $kinsman;
    }

    private function updateLife(KinsmanDto $kinsmanDto)
    {
        $lifeDto = app(LifeDto::class);
        $lifeDto->kinsman_id = $kinsmanDto->id ?? null;
        $lifeDto->birth_date = (string)$kinsmanDto->birth_date;
        $lifeDto->end_date = $kinsmanDto->end_date;
        $lifeDto->active = true;
        $lifeDto->native_city_id = $kinsmanDto->native_city_id;

        if ($lifeDto->kinsman_id) {
            /** @var Life $life */
            $life = $this->lifeRepository->getOneByKinsmanId($kinsmanDto->id);
        }

        if ($lifeDto->kinsman_id && $life) {
            $lifeDto->id = $life->id;
            $this->lifeRepository->update($lifeDto);
        } else {
            $this->lifeRepository->create($lifeDto);
        }
    }

    private function updateCity(KinsmanDto $kinsmanDto): ?int
    {
        $city = $this->cityRepository->getOneByGeo($kinsmanDto->native);

        if (!$city) {
            $dto = app(CityDto::class);
            $dto->geo = $kinsmanDto->native;
            $dto->active = true;

            $saved = $this->cityRepository->create($dto);
        }

        return $saved ?? $city->id;
    }
}
