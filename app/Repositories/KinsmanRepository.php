<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Kin;
use App\Models\Kinsman;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class KinsmanRepository extends BaseRepository
{
    /*private Kinsman $model;

    public function __construct(Kinsman $model)
    {
        $this->model = $model;
    }*/

    public function getAll(int $perPage = 10)
    {
        $kinsman = app(Kinsman::class);

        return $kinsman->paginate($perPage);
    }

    public function add(): array
    {
        $kinsman = app(Kinsman::class);
        $fathers = $kinsman->where(['gender' => 'male'])
            ->get()
            ->keyBy('id');
        $mothers = $kinsman->where(['gender' => 'female'])
            ->get()
            ->keyBy('id');
        $kins = app(Kin::class)->where(['active' => true])
            ->get()
            ->keyBy('id');

        return [$kinsman, $fathers, $mothers, $kins];
    }

    public function create($dto)
    {
        $kinsman = app(Kinsman::class);

        $kinsman = $this->setFields($kinsman, $dto);

        $kinsman->save();

        return $kinsman->id;
    }

    public function edit(int $id): array
    {
        $model = app(Kinsman::class);

        $kinsman = $model->where(['id' => $id])->first();
        $fathers = $model->where(['gender' => 'male'])
            ->get()
            ->keyBy('id');
        $mothers = $model->where(['gender' => 'female'])
            ->get()
            ->keyBy('id');
        $kins = app(Kin::class)->where(['active' => true])
            ->get()
            ->keyBy('id');

        return [$kinsman, $fathers, $mothers, $kins];
    }

    public function update($dto)
    {
        $kinsman = app(Kinsman::class)->findOrNew($dto->id);

        $kinsman = $this->setFields($kinsman, $dto);

        $kinsman->update();

        return $kinsman->id;
    }

    public function getOne(int $id)
    {
        $kinsman = app(Kinsman::class)
            ->with([
                'father' => function ($query) {
                    $query->where(['gender' => 'male']);
                },
                'mother' => function ($query) {
                    $query->where(['gender' => 'female']);
                },
                'kin'
            ])
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();

        return $kinsman;
    }

    public function getChildren(int $id)
    {
        $kinsmans = app(Kinsman::class)
            ->orWhere(['father_id' => $id])
            ->orWhere(['mother_id' => $id])
            ->get();

        return $kinsmans;
    }

    private function setFields($kinsman, $dto)
    {
        foreach ($dto as $prop => $value) {
            if ($dto->$prop) {
                $kinsman->$prop = $value;
            }
        }

        return $kinsman;
    }
}
