<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function all();

    public function find($attribute);

    public function create($attribute);

    public function update($id, array $attribute);

    public function destroy($id);
}