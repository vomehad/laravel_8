<?php

namespace App\Repositories;

use App\Interfaces\DtoInterface;
use App\Interfaces\RepositoryInterface;
use App\Models\Life;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LifeRepository extends BaseRepository implements RepositoryInterface
{
    private Life $model;

    public function __construct(Life $model)
    {
        $this->model = $model;
    }

    public function getAll(int $perPage = 10): LengthAwarePaginator
    {
        $kins = $this->model->paginate($perPage);

        return $kins;
    }

    public function add(): array
    {
        return [$this->model];
    }

    public function create(DtoInterface $dto): int
    {
        $kin = $this->setFields($this->model, $dto);
        $kin->slug = Str::slug($kin->name);
        $kin->generation = 1;
        $kin->created_by = 1;

        $kin->save();

        return $kin->id;
    }

    public function getOne(int $id): ?Model
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

    public function update(DtoInterface $dto): ?int
    {
        // TODO: Implement update() method.
    }

    public function getChildren(int $id)
    {
        // TODO: Implement getChildren() method.
    }

    public function remove(int $id): string
    {
        // TODO: Implement remove() method.
    }

    public function restore(int $id): string
    {
        // TODO: Implement restore() method.
    }

    private function setFields(Life $kin, DtoInterface $dto): ?Model
    {
        foreach ($dto as $prop => $value) {
            if ($dto->$prop) {
                $kin->$prop = $value;
            }
        }

        return $kin;
    }
}
