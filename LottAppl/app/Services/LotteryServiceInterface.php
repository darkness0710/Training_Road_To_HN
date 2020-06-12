<?php

namespace App\Services;

interface LotteryServiceInterface
{
    public function crawl(array $input);

    public function fileUpload($file);
}
