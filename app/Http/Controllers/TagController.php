<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class TagController extends Controller
{
    public function index()
    {
        $title = Lang::get(Helper::getActionName());
        $tags = Tag::all();

        return view('tag.index', [
            'title' => $title,
            'models' => $tags,
            'nav' => $this->nav
        ]);
    }

    public function create()
    {
        $title = Lang::get(Helper::getActionName());
        $tag = new Tag();

        return view('tag.create', [
            'title' => $title,
            'model' => $tag,
            'nav' => $this->nav,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $tag = $request->id ? Tag::find($request->id) : new Tag();
        $tag->name = $request->get('name');
        $tag->description = $request->get('description');

        $tag->save();

        return redirect()->route('tags.show', [
            'tag' => $tag->id,
        ]);
    }

    public function show(int $id): string
    {
        $tag = Tag::find($id);

        return view('tag.view', [
            'title' => $tag->name,
            'model' => $tag,
            'nav' => $this->nav,
        ]);
    }

    public function update(int $id): string
    {
        $title = Lang::get(Helper::getActionName());
        $tag = Tag::find($id);

        return view('tag.create', [
            'title' => $title . ' - ' . $tag->name,
            'model' => $tag,
            'nav' => $this->nav,
        ]);
    }

    public function destroy(int $id): string
    {
        $tag = Tag::find($id);
        $tag->delete();

        return Helper::getActionName();
    }
}
