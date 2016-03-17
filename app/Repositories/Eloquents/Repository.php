<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryInterface
{
    protected $model;
    protected $modelName;
    public function __construct($modelName)
    {
        $this->modelName = $modelName;
        $this->makeModel();
    }
    protected function makeModel()
    {
        return $this->model = new $this->modelName;
    }
    public function findOrFail($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }
    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }
    public function create($data)
    {
        return $this->model->create($data);
    }
    public function update($id, $data)
    {
        $model = $this->findOrFail($id);
        $model->update($data);
        return $model;
    }
    public function delete($id)
    {
        return $this->findOrFail($id)->delete();
    }
    public function paginate($numberOfPages, $columns = ['*'], $pageNumber = 'page')
    {
        return $this->model->paginate($numberOfPages, $columns, $pageNumber);
    }
}
