<?php

namespace Kirillbdev\LaraRepository;

use Illuminate\Support\Facades\DB;

abstract class Repository
{
    protected $model;

    public function get(Filter $filter = null, $columns = ['*'])
    {
        $filterResult = FilterBuilder::build($this->model, $filter);

        if (is_null($filterResult))
            return null;

        if ($filterResult instanceof $this->model)
            if (count($filterResult->getAttributes()) > 0)
                return $filterResult;

        $result = $filterResult->get($columns);

        if (count($result) == 0)
            return null;

        return $result->all();
    }

    public function create($attributes = [])
    {
        return ($this->model)::create($attributes);
    }

    public function update(Filter $filter, array $attributes = [], array $options = [])
    {
        $filterResult = FilterBuilder::build($this->model, $filter);
        if (!is_null($filterResult))
            return $filterResult->update($attributes, $options);
        return false;
    }

    public function delete(Filter $filter)
    {
        $filterResult = FilterBuilder::build($this->model, $filter);
        if (!is_null($filterResult))
            return $filterResult->delete();
        return false;
    }

    public function transaction($callback)
    {
        return DB::transaction($callback);
    }
}