<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Note;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Lang;

class NoteController extends Controller
{
    public function index(): string
    {
        $title = Lang::get(Helper::getActionName());
        $notes = $this->getNotes();

        return view('notes.index', [
            'title' => $title,
            'models' => $notes,
            'nav' => $this->nav,
        ]);
    }

    public function create(): string
    {
        $title = Lang::get(Helper::getActionName());
        $note = new Note();

        return view('notes.create', [
            'title' => $title,
            'note' => $note,
            'nav' => $this->nav,
        ]);
    }

    public function store(NoteRequest $request): RedirectResponse
    {
        $note = new Note();

        $data = $request->input();
        $saved = $note->fill($data)->save();

        if ($saved) {
            return redirect()
                ->route('test.notes.show', $note->id)
                ->with(['success' => Lang::get('Note.Message.Saved')]);
        } else {
            return back()
                ->withErrors(['msg' => Lang::get('Note.Message.Error')])
                ->withInput();
        }
    }

    public function show(int $id): string
    {
        $note = Note::find($id);

        return view('notes.view', [
            'title' => $note->name,
            'note' => $note,
            'nav' => $this->nav,
        ]);
    }

    public function edit(int $id): string
    {
        $title = Lang::get(Helper::getActionName());
        $note = Note::find($id);

        return view('notes.create', [
            'title' => $title . ' - ' . $note->name,
            'note' => $note,
            'nav' => $this->nav,
        ]);
    }

    public function destroy(int $id): string
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

        return view('note.index', [
            'title' => $title,
            'models' => $notes,
            'nav' => $this->nav,
            'string' => $string,
        ]);
    }

    private function getNotes(string $search = ''): LengthAwarePaginator
    {
        $model = new Note();
        $perPage = 10;

        if ($search) {
            $model = $model->search($search);
        }

        return $model->paginate($perPage);
    }
}
