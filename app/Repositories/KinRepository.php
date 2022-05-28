<?php

namespace App\Repositories;

use App\Dto\KinDto;
use App\Interfaces\RepositoryInterface;
use App\Models\Kin;
use Illuminate\Support\Str;

class KinRepository extends BaseRepository implements RepositoryInterface
{
    private Kin $model;

    public function __construct(Kin $model)
    {
        $this->model = $model;
    }

    public function getAll(int $perPage = 10)
    {
        $kins = $this->model->paginate($perPage);

        return $kins;
    }

    public function add(): Kin
    {
        return $this->model;
    }

    public function create($dto): int
    {
        $kin = $this->setFields($this->model, $dto);
        $kin->slug = Str::slug($kin->name);
        $kin->generation = 1;
        $kin->created_by = 1;

        $kin->save();

        return $kin->id;
    }

    private function setFields(Kin $kin, KinDto $dto): Kin
    {
        foreach ($dto as $prop => $value) {
            if ($dto->$prop) {
                $kin->$prop = $value;
            }
        }

        return $kin;
    }

    public function getOne(int $id)
    {
        return $this->model
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();
    }

    public function edit(int $id)
    {
        // TODO: Implement edit() method.
    }

    public function update($dto)
    {
        // TODO: Implement update() method.
    }

    public function getChildren(int $id)
    {
        // TODO: Implement getChildren() method.
    }
}
