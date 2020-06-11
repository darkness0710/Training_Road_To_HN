<?php

namespace App\Repositories\Interfaces;
use App\Lottery;
interface LotteryRepositoryInterface
{
    public function all();

    public function find($attribute);

    public function create($attribute);

    public function massCreate($attributes);

    public function update($id, array $attribute);

    public function destroy($id);

    public function search ($input);
    
    // public function crawl($attribute);

    // public function fileUpload($file);

}