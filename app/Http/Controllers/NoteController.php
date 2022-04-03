<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function __construct()
    {
        $this->nav = [
            ['url' => route('Test.Main.Page'), 'name' => 'Testing page'],
            ['url' => route('Test.Note.All'), 'name' => trans('notes')],
            ['url' => route('Game'), 'name' => trans("welcome")],
        ];
    }

    public function index(): string
    {
        $notes = Note::all();

        return view('note-index', [
            'title' => 'notes',
            'notes' => $notes,
            'nav' => $this->nav,
        ]);
    }

    public function create(): string
    {
        $note = new Note();

        return view('note-create', [
            'title' => 'create note',
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

    public function update(int $id, NoteRequest $request): string
    {
        $note = Note::find($id);

        $note->name = $request->input('name');
        $note->content = $request->input('content');

        $note->save();

        return view('note-create', [
            'title' => 'Update - ' . $note->name,
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
