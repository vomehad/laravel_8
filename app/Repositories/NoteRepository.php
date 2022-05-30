<?php

namespace App\Repositories;

use App\Dto\SelectedDto;
use App\Helpers\NameHelper;
use App\Interfaces\DtoInterface;
use App\Interfaces\InheritInterface;
use App\Interfaces\RepositoryInterface;
use App\Models\Category;
use App\Models\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class NoteRepository extends BaseRepository implements RepositoryInterface, InheritInterface
{
    private Note $noteModel;
    private Category $categoryModel;

    public function __construct(Note $noteModel, Category $categoryModel)
    {
        $this->noteModel = $noteModel;
        $this->categoryModel = $categoryModel;
    }

    public function getAll(int $perPage = 10, string $search = ''): LengthAwarePaginator
    {
        $note = $this->noteModel;

        if ($search) {
            $note = $this->noteModel->search($search);
        }

        return $note->paginate($perPage);
    }

    public function getOne(int $id): ?Model
    {
        return $this->noteModel
            ->with('category')
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();
    }

    public function add(): array
    {
        $notes = $this->noteModel->where(['active' => true])->get();
        $categories = $this->categoryModel->where(['active' => true])->get();

        return [$this->noteModel, $notes, $categories];
    }

    public function create(DtoInterface $dto): ?int
    {
        $note = $this->setFields($this->noteModel, $dto);

        $saved = $note->save();

        $note->category()->sync($dto->category);

        return $saved ? $note->id : null;
    }

    public function edit(int $id): array
    {
        $note = $this->noteModel->with('parentNote')
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();
        $categories = $this->categoryModel
            ->where(['active' => true])
            ->get()
            ->keyBy('id');

        $selected = new SelectedDto();
        $selected->noteId = $note->parentNote->id ?? null;
        $selected->categories = $note->category
                ->keyBy('id')
                ->map(function ($item) {
                    return $item->id;
                }) ?? null;

        return [$note, $categories, $selected];
    }

    public function update(DtoInterface $dto): ?int
    {
        $note = $this->noteModel->findOrNew($dto->id);

        $note = $this->setFields($note, $dto);

        $updated = $note->update();

        $note->category()->sync($dto->category);

        return $updated ? $note->id : null;
    }

    public function getChildren(int $id)/*: ?Model*/
    {
        return $this->noteModel
            ->where(['parent_id' => $id])
            ->get();
    }

    public function remove(int $id): string
    {
        /** @var Note $note */
        $note = $this->noteModel->find($id);
        $note->delete();

        return NameHelper::getActionName();
    }

    public function restore(int $id): string
    {
        $note = $this->noteModel->withTrashed()->find($id);
//        $note = $this->noteModel->onlyTrashed()->find($id);
        $note->restore();

        return NameHelper::getActionName();
    }

    private function setFields(Note $note, DtoInterface $dto): Note
    {
        foreach ($dto as $prop => $value) {
            if ($dto->$prop) {
                if (is_array($dto->$prop)) {
                    continue;
                }
                $note->$prop = $value;
            }
        }

        return $note;
    }
}
