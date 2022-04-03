<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function __construct()
    {
        $this->nav = [
            ['url' => route('Test.Main'), 'name' => 'Testing page'],
            ['url' => route('Test.Notes'), 'name' => trans('notes')],
            ['url' => route('Game'), 'name' => trans("welcome")],
        ];
    }

    public function index()
    {
        $notes = Note::all();

        return view('note-index', [
            'title' => 'notes',
            'notes' => $notes,
            'nav' => $this->nav,
        ]);
    }

    public function create(NoteRequest $request): string
    {
        $note = new Note();
        $note->name = $request->input('name');
        $note->content = $request->input('content');

        $note->save();

        return view('note', [
            'title' => 'create note',
            'note' => $note,
            'nav' => $this->nav,
        ]);
    }

    public function read(Request $request): string
    {
        $note = Note::where($request->input('id'));

        return view('note', [
            'note' => $note,
        ]);
    }

    public function update(NoteRequest $request): string
    {
        $note = Note::where($request->input('id'));

        $note->name = $request->input('name');
        $note->content = $request->input('content');

        $note->save();

        return view('note', [
            'note' => $note,
        ]);
    }

    public function delete(Request $request): string
    {
        $note = Note::where($request->input('id'));
        $note->delete();

        return view('note');
    }
}
