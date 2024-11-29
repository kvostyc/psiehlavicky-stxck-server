<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

interface BaseServiceInterface
{
    public function create(iterable $data);
    public function update(Model $model, array $data): ?Model;
    public function get(int $id);
    public function getList(): iterable;
    public function getListWithRelations(array $relations): iterable;
    public function getListPaginated(int $perPage = 10): iterable;
    public function delete(Model $model): bool;
}