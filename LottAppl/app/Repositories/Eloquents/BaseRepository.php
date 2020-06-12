<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('date', 'DESC')->simplePaginate(7);
    }

    public function find($attribute)
    {
        return $this->model->findOrFail($attribute);
    }

    public function create($attribute)
    {
        $lott = $this->model->create(
            ['date' =>  formatDateDB($attribute['date'])],
            ['result' => $attribute['result']]
        );
        return $lott;
    }

    public function update($id, array $attribute)
    {
        $lott = $this->model->update(
            ['date' =>  formatDateDB($attribute['date'])],
            ['result' => $attribute['result']]
        );
        return $lott;
    }

    public function destroy($id)
    {
        $this->model->find($id)->delete();
        return true;
    }
}
