<?php

namespace App\Services;

use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Services\BaseServiceInterface;

abstract class BaseService implements BaseServiceInterface
{

    protected $_originalRepo;

    public function setOriginalRepository($originalRepository)
    {
        $this->_originalRepo = $originalRepository;
    }

    public function getOriginalRepository()
    {
        return $this->_originalRepo;
    }

    public function all()
    {
        return $this->getOriginalRepository()->all();
    }

    public function create(array $input)
    {
        return $this->getOriginalRepository()->create($input);
    }

    public function find($input)
    {
        return $this->getOriginalRepository()->find($input);
    }

    public function update($id, array $input)
    {
        return $this->getOriginalRepository()->update($id, $input);
    }

    public function destroy($id)
    {
        return $this->getOriginalRepository()->destroy($id);
    }
}
