<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Note;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\RedirectResponse;
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

        $notes = Note::paginate(20);

        return view('note-index', [
            'title' => $title,
            'notes' => $notes,
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
        $title = Lang::get(Helper::getActionName());

        $note = Note::find($id);

        return view('note-view', [
            'title' => $title . ' - ' . $note->name,
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

    public function delete(int $id): RedirectResponse
    {
        $note = Note::find($id);
        $note->delete();

        return redirect()->route('Test.Note.All');
    }
}
