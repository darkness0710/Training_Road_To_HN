<?php

namespace App\Repositories\Eloquents;

use App\Lottery;
use App\Repositories\Interfaces\LotteryRepositoryInterface;
use Illuminate\Http\Request;

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
        $this->model::updateOrCreate(
            ['date' =>  formatDateDB($attribute['date'])], 
            ['result' => $attribute['result']]
        );
    }

    // public function delete($id)
    // {
    //     $this->getById($id)->delete();

    //     return true;
    // }
}
