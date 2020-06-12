<?php

namespace App\Services;

interface BaseServiceInterface
{
    public function all();

    public function create(array $input);

    public function find($input);

    public function update($id, array $input);

    public function destroy($id);
}
