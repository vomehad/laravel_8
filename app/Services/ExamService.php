<?php

namespace App\Services;

use App\Interfaces\DtoInterface;

class ExamService
{
    public function splitWordByChars(DtoInterface $dto): string
    {
        $split = '';

        for ($char = 0; $char < mb_strlen($dto->wordSplit); $char++) {
            $split .= mb_substr($dto->wordSplit, $char, 1) . ' ';
        }

        return $split;
    }

    public function textWithReplacedDates(DtoInterface $dto)
    {
        $pattern = '/(\d{2})\.(\d{2})\.(\d{4})/';
        $replacement = '$1.$3.$2';

        return preg_replace($pattern, $replacement, $dto->text);
    }
}
