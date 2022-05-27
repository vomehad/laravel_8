<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleRepository extends BaseRepository
{
    public function getArticlesList(string $search = '', $perPage = 8): LengthAwarePaginator
    {
        $model = new Article();

        if ($search) {
            $model = $model->search($search);
        }

        return $model->paginate($perPage);
    }
}
