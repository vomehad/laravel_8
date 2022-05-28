<?php

namespace App\Dto;

use Illuminate\Database\Eloquent\Model;

class SelectedDto
{
    public $fatherId;
    public $motherId;
    public $kinId;

    public function setFromModel(Model $model)
    {

        return $this;
    }
}
