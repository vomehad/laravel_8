<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function create(NoteRequest $request): string
    {
        $note = new Note();
        $note->name = $request->input('name');
        $note->content = $request->input('content');

        $note->save();

        return view('note');
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
