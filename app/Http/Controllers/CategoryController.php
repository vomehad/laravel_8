<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Category;
use Illuminate\Support\Facades\Lang;

class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function list()
    {
        $title = Lang::get(Helper::getActionName());
        $categories = Category::where(['is_active' => true])
            ->where(['is_deleted' => false])
            ->paginate();

        return view('category-index', [
            'title' => $title,
            'models' => $categories,
            'nav' => $this->nav,
        ]);
    }
}
