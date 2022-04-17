<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Note;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class NoteController extends Controller
{

    public function __construct()
    {
        $this->nav = [
            ['url' => route('Test.Main'), 'name' => Lang::get('Test.Menu.Top')],
            ['url' => route('Test.Note.All'), 'name' => Lang::get('Note.Menu.Top')],
            ['url' => route('Article.Main'), 'name' => Lang::get('Article.Menu.Top')],
            ['url' => route('Game'), 'name' => Lang::get('Game.Menu.Top')],
        ];
    }

    public function index(): string
    {
        $title = Lang::get(Helper::getActionName());
        $notes = $this->getNotes();

        return view('note-index', [
            'title' => $title,
            'models' => $notes,
            'nav' => $this->nav,
        ]);
    }

    public function create(): string
    {
        $title = Lang::get(Helper::getActionName());
        $note = new Note();

        return view('note-create', [
            'title' => $title,
            'note' => $note,
            'nav' => $this->nav,
        ]);
    }

    public function store(NoteRequest $request): RedirectResponse
    {
        $note = new Note();

        $note->name = $request->input('name');
        $note->content = $request->input('content');

        $note->save();

        return redirect()->route('Test.Note.View', [
            'id' => $note->id,
        ]);
    }

    public function read(int $id): string
    {
        $note = Note::find($id);

        return view('note-view', [
            'title' => $note->name,
            'note' => $note,
            'nav' => $this->nav,
        ]);
    }

    public function update(int $id): string
    {
        $title = Lang::get(Helper::getActionName());
        $note = Note::find($id);

        return view('note-create', [
            'title' => $title . ' - ' . $note->name,
            'note' => $note,
            'nav' => $this->nav,
        ]);
    }

    public function delete(int $id): string
    {
        $note = Note::find($id);
        $note->delete();

        return Helper::getActionName();
    }

    public function search(Request $request)
    {
        $string = $request->get('search') ?? $request->query->get('query') ?? '';
        $title = Lang::get(Helper::getActionName());
        $notes = $this->getNotes($string);

        return view('note-index', [
            'title' => $title,
            'models' => $notes,
            'nav' => $this->nav,
            'string' => $string,
        ]);
    }

    private function getNotes(string $search = '')
    {
        $model = new Note();
        $perPage = 10;

        if ($search) {
            $model = $model->search($search);
        }

        return $model->paginate($perPage);
    }
}
