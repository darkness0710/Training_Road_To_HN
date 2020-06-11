<?php

namespace App\Services;

use App\Repositories\Interfaces\LotteryRepositoryInterface;
use App\Services\LotteryServiceInterface;
use simplehtmldom\HtmlWeb;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class LotteryService implements LotteryServiceInterface
{
    protected $lotteryRepository;

    public function __construct(LotteryRepositoryInterface $lotteryRepository)
    {
        $this->lotteryRepository = $lotteryRepository;
    }

    public function all()
    {
        return $this->lotteryRepository->all();
    }

    public function create(array $input)
    {
        return $this->lotteryRepository->create($input);
    }

    public function find($input)
    {
        return $this->lotteryRepository->find($input);
    }

    public function update($id, array $input)
    {
        return $this->lotteryRepository->update($id, $input);
    }

    public function destroy($id)
    {
        return $this->lotteryRepository->destroy($id);
    }

    public function search($input)
    {
        return $this->lotteryRepository->search($input);
    }

    public function crawl(array $attribute)
    {
        $from = $attribute['from'];
        $to = $attribute['to'];
        if ($from < $to) {
            $period = CarbonPeriod::create($from, $to);
        } else {
            $period = CarbonPeriod::create($to, $from);
        }
        foreach ($period as $date) {
            $url = config('custom.crawl.url') . $date->format('d-m-Y') . '.html';
            $html = (new HtmlWeb())->load($url);
            $input['date'] = formatDateDB($date);
            $input['result'] = $html->find('span#mb_prizeDB_item0', 0)->plaintext;
            $html->clear();
            unset($html);
            $input_arr[] = $input;
        }
            $this->lotteryRepository->massCreate($input_arr);
    }

    public function fileUpload($file)
    {
        $filename = $file->getClientOriginalName();
        $createdTime = Carbon::now('Asia/Ho_Chi_Minh');
        $location = 'uploads';
        $file->move($location, $filename);              // move file to its path to read
        $filepath = public_path($location . "/" . $filename);
        $file = fopen($filepath, "r");                 // Reading file
        $input_arr = [];
        $i = 0; //starting row to read 
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
            $num = count($filedata); //count row number
            if ($i == 0) {
                $i++; //skip row 0 because it's column name
                continue;
            }
            for ($c = 0; $c < $num; $c++) {
                $input_arr[$i][] = $filedata[$c]; //import row into array of import data
            }
            $i++;
        }
        fclose($file);

        $this->lotteryRepository->massCreate($input_arr);
    }
}
