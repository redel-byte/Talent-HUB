<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function findById(int $id);
    public function findAll();
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function findBy(string $column, $value);
    public function findByMultiple(string $column, array $values);
    public function paginate(int $page = 1, int $limit = 10, array $conditions = []);
    public function count(array $conditions = []);
}
