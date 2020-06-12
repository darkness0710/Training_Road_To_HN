<?php

namespace App\Repositories\Interfaces;

interface LotteryRepositoryInterface
{

    public function massCreate($attributes);

    public function search ($input);
    
    // public function crawl($attribute);

    // public function fileUpload($file);

}