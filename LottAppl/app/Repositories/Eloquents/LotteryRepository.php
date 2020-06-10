<?php

namespace App\Repositories\Eloquents;

use App\Lottery;
use App\Repositories\Interfaces\LotteryRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use simplehtmldom\HtmlWeb;

class LotteryRepository implements LotteryRepositoryInterface
{

    private $model;

    public function __construct(Lottery $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->orderBy('date', 'DESC')->simplePaginate(7);
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function store($attribute)
    {
        // $attribute->validate([
        //     'date' => 'required',
        //     'result' => 'required'
        // ]);
        $this->model->updateOrCreate(
            ['date' =>  formatDateDB($attribute['date'])],
            ['result' => $attribute['result']]
        );
    }
    public function update($id, array $attribute)
    {
        $this->model->updateOrCreate(
            ['date' =>  formatDateDB($attribute['date'])],
            ['result' => $attribute['result']]
        );
    }

    public function delete($id)
    {
        $this->findById($id)->delete();
        return true;
    }
    public function crawl($attribute)
    {
        $from = $attribute['from'];
        $to = $attribute['to'];
        if ($from < $to) {
            $period = CarbonPeriod::create($from, $to);
        } else {
            $period = CarbonPeriod::create($to, $from);
        }
        foreach ($period as $date) {
            $url = 'https://xoso.com.vn/xsmb-' . $date->format('d-m-Y') . '.html';
            $html = (new HtmlWeb())->load($url);
            $this->model->updateOrCreate(
                ['date' =>  formatDateDB($date)],
                ['result' => $html->find('span#mb_prizeDB_item0', 0)->plaintext],
            );
            $html->clear();
            unset($html);
        }
    }

    public function fromCSV($file)
    {
        //file details
        $filename = $file->getClientOriginalName();
        $createdTime = Carbon::now('Asia/Ho_Chi_Minh');
        $location = 'uploads';
        $file->move($location, $filename);              // move file to its path to read
        $filepath = public_path($location . "/" . $filename);
        $file = fopen($filepath, "r");                 // Reading file
        $importData_arr = array();
        $i = 0; //starting row to read 
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
            $num = count($filedata); //count row number
            if ($i == 0) {
                $i++; //skip row 0 because it's column name
                continue;
            }
            for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c]; //import row into array of import data
            }
            $i++;
        }
        fclose($file);
        foreach ($importData_arr as $importData) {
            $this->model->updateOrCreate(
                ['date' => formatDateDB($importData[0])],
                [
                    'result' => $importData[1],
                    'created_at' => $createdTime,
                    'updated_at' => $createdTime
                ]
            );
        }
    }
}
