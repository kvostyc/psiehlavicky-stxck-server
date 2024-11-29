<?php

namespace App\Models\Base;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseService implements BaseServiceInterface
{
    protected ?string $model;

    public function create(iterable $data): ?Model
    {
        return $this->model::create($data);
    }

    public function update(Model $model, array $data): ?Model
    {
        $model = $this->get($model->id);

        if ($model) {
            $model->update($data);
        }

        return $model;
    }

    public function get(int $id): ?Model
    {
        return $this->model::find($id);
    }

    public function getOrCreate(?int $id, array $data = []): Model
    {
        return $id ? $this->get($id) : $this->create($data);
    }

    public function getList(): iterable
    {
        return $this->model::all();
    }

    public function getListWithRelations(array $relations): Collection
    {
        return $this->model::with($relations)->get();
    }

    public function getListPaginated(int $perPage = 10, int $offset = 0): iterable
    {
        return $this->model::paginate($perPage);
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function query(): Builder
    {
        return $this->model::query();
    }
}
