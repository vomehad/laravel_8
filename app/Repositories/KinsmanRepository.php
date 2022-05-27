<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Kin;
use App\Models\Kinsman;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class KinsmanRepository extends BaseRepository
{
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
            ->keyBy('id')
            ->toArray();
        $mothers = $kinsman->where(['gender' => 'female'])
            ->get()
            ->keyBy('id')
            ->toArray();
        $kins = app(Kin::class)->where(['active' => true])
            ->get()
            ->keyBy('id')
            ->toArray();

        return [$kinsman, $fathers, $mothers, $kins];
    }

    public function save($dto)
    {
        $kinsman = app(Kinsman::class)->findOrNew($dto->id);

        $kinsman->fill($dto);
        if ($dto->father) {
            $kinsman->father_id = $dto->father;
        }
        if ($dto->mother) {
            $kinsman->mother_id = $dto->mother;
        }
        if ($dto->kin_id) {
            $kinsman->kin_id = $dto->kin;
        }

        $kinsman->save();

        return $kinsman->id;
    }
}
