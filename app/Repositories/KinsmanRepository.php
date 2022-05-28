<?php

namespace App\Repositories;

use App\Dto\KinsmanDto;
use App\Dto\SelectedDto;
use App\Interfaces\RepositoryInterface;
use App\Models\Kin;
use App\Models\Kinsman;

class KinsmanRepository extends BaseRepository implements RepositoryInterface
{
    private Kinsman $kinsmanModel;
    private Kin $kinModel;

    public function __construct(Kinsman $kinsmanModel, Kin $kinModel)
    {
        $this->kinsmanModel = $kinsmanModel;
        $this->kinModel = $kinModel;
    }

    public function getAll(int $perPage = 10)
    {
        return $this->kinsmanModel->paginate($perPage);
    }

    public function add(): array
    {
        $fathers = $this->kinsmanModel->where(['gender' => 'male'])
            ->get()
            ->keyBy('id');
        $mothers = $this->kinsmanModel->where(['gender' => 'female'])
            ->get()
            ->keyBy('id');
        $kins = $this->kinModel->where(['active' => true])
            ->get()
            ->keyBy('id');

        return [$this->kinsmanModel, $fathers, $mothers, $kins];
    }

    public function create($dto): int
    {
        $kinsman = $this->setFields($this->kinsmanModel, $dto);

        $kinsman->save();

        return $kinsman->id;
    }

    public function edit(int $id): array
    {
        $kinsman = $this->kinsmanModel->where(['id' => $id])->first();
        $fathers = $this->kinsmanModel->where(['gender' => 'male'])
            ->get()
            ->keyBy('id');
        $mothers = $this->kinsmanModel->where(['gender' => 'female'])
            ->get()
            ->keyBy('id');
        $kins = $this->kinModel->where(['active' => true])
            ->get()
            ->keyBy('id');

        $selected = new SelectedDto();
        $selected->fatherId = $kinsman->father->id ?? null;
        $selected->motherId = $kinsman->mother->id ?? null;
        $selected->kinId = $kinsman->kin->id ?? null;

        return [$kinsman, $fathers, $mothers, $kins, $selected];
    }

    public function update($dto): int
    {
        $kinsman = $this->kinsmanModel->findOrNew($dto->id);

        $kinsman = $this->setFields($kinsman, $dto);

        $kinsman->update();

        return $kinsman->id;
    }

    public function getOne(int $id)
    {
        return $this->kinsmanModel
            ->with([
                'father',
                'mother',
                'kin'
            ])
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();
    }

    public function getChildren(int $id)
    {
        return $this->kinsmanModel
            ->orWhere(['father_id' => $id])
            ->orWhere(['mother_id' => $id])
            ->get();
    }

    private function setFields(Kinsman $kinsman, KinsmanDto $dto): Kinsman
    {
        foreach ($dto as $prop => $value) {
            if ($dto->$prop) {
                $kinsman->$prop = $value;
            }
        }

        return $kinsman;
    }
}
