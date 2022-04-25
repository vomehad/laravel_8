<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class CategoryController extends Controller
{
    public function index()
    {
        $title = Lang::get(Helper::getActionName());
        $categories = Category::where(['is_active' => true])
            ->where(['is_deleted' => false])
            ->paginate();

        return view('category.index', [
            'title' => $title,
            'models' => $categories,
            'nav' => $this->nav,
        ]);
    }

    public function create()
    {
        $title = Lang::get(Helper::getActionName());
        $category = new Category();

        return view('category.create', [
            'title' => $title,
            'model' => $category,
            'nav' => $this->nav,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $category = $request->id ? Category::find($request->id) : new Category();

        $category->name = $request->input('name');

        $category->save();

        return redirect()->route('Test.Category.View', [
            'id' => $category->id,
        ]);
    }

    public function show(int $id): string
    {
        $category = Category::find($id);

        return view('category.view', [
            'title' => $category->name,
            'model' => $category,
            'nav' => $this->nav,
        ]);
    }

    public function edit(int $id)
    {
        $title = Lang::get(Helper::getActionName());
        $category = Category::find($id);

        return view('category.create', [
            'title' => $title,
            'model' => $category,
            'nav' => $this->nav,
        ]);
    }

    public function destroy(int $id): string
    {
        $category = Category::find($id);
        $category->delete();

        return Helper::getActionName();
    }
}
