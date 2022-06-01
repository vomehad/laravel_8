<?php

namespace App\Repositories;

use App\Interfaces\DtoInterface;
use App\Interfaces\RepositoryInterface;
use App\Models\Kin;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class KinRepository extends BaseRepository implements RepositoryInterface
{
    private Kin $model;

    public function __construct(Kin $model)
    {
        $this->model = $model;
    }

    public function getAll(array $options = []): LengthAwarePaginator
    {
        $kins = $this->model;

        if (Arr::has($options, 'search')) {
            $kins = $this->model->search(Arr::get($options, 'search'));
        }

        if (Arr::has($options, 'defaultSort')) {
            $kins = $this->model->defaultSort(Arr::get($options, 'defaultSort'));
        }

        return $kins->filters()->paginate(Arr::get($options, 'perPage'));
    }

    public function getOne(int $id): ?Model
    {
        return $this->model
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();
    }

    public function add(): array
    {
        return [$this->model];
    }

    public function create(DtoInterface $dto): ?int
    {
        $kin = $this->setFields($this->model, $dto);
        $kin->slug = Str::slug($kin->name);
        $kin->generation = 1;
        $kin->created_by = $this->setUser();

        $saved = $kin->save();

        return $saved ? $kin->id : null;
    }

    public function edit(int $id): array
    {
        // TODO: Implement edit() method.
    }

    public function update(DtoInterface $dto): ?int
    {
        // TODO: Implement update() method.
    }

    public function remove(int $id): string
    {
        // TODO: Implement remove() method.
    }

    public function restore(int $id): string
    {
        // TODO: Implement restore() method.
    }

    private function setFields(Kin $kin, DtoInterface $dto): Kin
    {
        foreach ($dto as $prop => $value) {
            if ($dto->$prop) {
                $kin->$prop = $value;
            }
        }

        return $kin;
    }

    private function setUser(): ?int
    {
        $user = User::first();

        return $user->id;
    }
}
