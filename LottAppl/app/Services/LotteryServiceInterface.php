<?php

namespace App\Services;

interface LotteryServiceInterface
{
    public function all();

    public function create(array $input);

    public function find($input);

    public function update($id, array $input);
    
    public function destroy($id);

    public function crawl(array $input);

    public function fileUpload($file);
}
