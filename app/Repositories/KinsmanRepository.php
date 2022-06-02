<?php

namespace App\Repositories;

use App\Dto\SelectedDto;
use App\Interfaces\DtoInterface;
use App\Interfaces\InheritInterface;
use App\Interfaces\RepositoryInterface;
use App\Models\Kin;
use App\Models\Kinsman;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class KinsmanRepository extends BaseRepository implements RepositoryInterface, InheritInterface
{
    private Kinsman $kinsmanModel;
    private Kin $kinModel;

    public function __construct(Kinsman $kinsmanModel, Kin $kinModel)
    {
        $this->kinsmanModel = $kinsmanModel;
        $this->kinModel = $kinModel;
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
            $kinsmans = $kinsmans->filters()->defaultSort(Arr::get($options, 'defaultSort'));
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
        $kinsman = $this->setFields($this->kinsmanModel, $dto);

        $saved = $kinsman->save();

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
        $kinsman = $this->kinsmanModel->findOrNew($dto->id);

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
        // TODO: Implement remove() method.
    }

    public function restore(int $id): string
    {
        // TODO: Implement restore() method.
    }

    private function setFields(Kinsman $kinsman, DtoInterface $dto): Kinsman
    {
        foreach ($dto as $prop => $value) {
            if ($dto->$prop) {
                $kinsman->$prop = $value;
            }
        }

        return $kinsman;
    }
}
