<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function getAll();

    public function getOne(int $id);

    public function add();

    public function create($dto);

    public function edit(int $id);

    public function update($dto);

    public function getChildren(int $id);
}
