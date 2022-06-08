<?php

namespace App\Orchid\Presenters;

use App\Models\Kinsman;
use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Personable;
use Orchid\Screen\Contracts\Searchable;
use Orchid\Support\Presenter;

class KinsmanPresenter extends Presenter implements Searchable, Personable
{
    /** @var Kinsman $entity */
    public $entity;

    public function perSearchShow(): int
    {
        return 3;
    }

    public function searchQuery(string $query = null): Builder
    {
        return $this->entity->search($query);
    }

    public function label(): string
    {
        return 'Kinsman';
    }

    public function title(): string
    {
        $name = $this->entity->name;
        $name .= ' ' . $this->entity->middle_name;

        return $name;
    }

    public function subTitle(): string
    {
        return $this->entity->kin->name ?? '';
    }

    public function url(): string
    {
        return route('platform.kinsman.edit', $this->entity->id);
    }

    public function image(): ?string
    {
        $image = $this->entity->attachment()->first() ?? null;

        if (!$image) {
            $name = $this->entity->gender === 'male' ? 'man' : 'woman';

            return "/storage/img/{$name}.jpg";
        }

        return $image->url();
    }

    public function gender(): string
    {
        $genders = [
            'male' => __('Kinsman.Select.Male'),
            'female' => __('Kinsman.Select.Female'),
        ];

        return $genders[$this->entity->gender];
    }

    public function color(bool $all = false)
    {
        $colors = [
            'none' => 'silver',
            'mozhaev' => 'chartreuse',
            'kalinin' => 'plum',
            'aleksandrov' => 'gold',
            'getmanstkii' => 'magenta',
            'braginec' => 'khaki',
            'pukalyak' => 'coral',
            'kulbakov' => 'lime',
            'moroz' => 'cyan',
//            'wheat',
//            'yellow',
//            'plum',
        ];

        if ($all) {
            return $colors;
        }

        $key = $this->entity->kin->slug ?? 'none';

        return $colors[$key];
    }
}
