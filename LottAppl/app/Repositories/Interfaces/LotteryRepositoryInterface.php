<?php

namespace App\Repositories\Interfaces;
use App\Lottery;
interface LotteryRepositoryInterface
{
    public function getAll();

    public function findById($id);

    public function store($attribute);

    public function update($id, array $attribute);

    public function delete($id);

    public function crawl($attribute);

    public function fromCSV($file);

}