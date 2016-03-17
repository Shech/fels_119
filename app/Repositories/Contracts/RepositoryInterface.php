<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function findOrFail($id, $columns = ['*']);
    public function all($columns = ['*']);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
    public function paginate($numberOfPages, $columns = ['*'], $pageNumber = 'page');
}
