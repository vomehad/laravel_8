<?php

namespace App\Orchid\Layouts\Note;

use App\Models\Note;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class NoteLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'notes';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', __('Note.Label.Name'))
                ->render(function(Note $note) {
                    return Link::make($note->name)->route('platform.note.edit', $note->id);
                })->sort(),

            TD::make('content', __('Note.Label.Content'))
                ->render(function (Note $note) {
                    return preg_replace('/^(.{40})(.*)/', '$1...', $note->content);
                })->sort(),

            TD::make('active', __('Note.Label.Active'))
                ->render(function(Note $note) {
                return Switcher::make()->sendTrueOrFalse()->value($note->active)->disabled(true);
            }),

            TD::make('parent_id', __('Note.Label.Parent'))
                ->render(function(Note $note) {
                    $parentId = $note->parentNote->id ?? null;

                    if ($parentId) {
                        return Link::make($note->parentNote->name)
                            ->route('platform.note.edit', ['note' => $note->parentNote->id]);
                    }

                    return null;
                }),

            TD::make('updated_at', __('Note.Label.Updated')),
            TD::make('created_at', __('Note.Label.Created')),

        ];
    }
}
