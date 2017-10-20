<?php

namespace Kirillbdev\LaraRepository\Contracts;

use Kirillbdev\LaraRepository\Filter;

interface IRepository
{
    /**
     * Select data from database.
     *
     * @param \Kirillbdev\LaraRepository\Filter $filter
     * @param array $columns
     * @return array, \Illuminate\Database\Eloquent\Model if single or null if empty
     */
    public function select(Filter $filter, $columns = ['*']);

    /**
     * Create new record.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function create($attributes = []);

    /**
     * Update records.
     *
     * @param \Kirillbdev\LaraRepository\Filter $filter
     * @param array $values
     * @return int
     */
    public function update(Filter $filter, array $values);

    /**
     * Delete records.
     *
     * @param \Kirillbdev\LaraRepository\Filter $filter
     * @return mixed
     */
    public function delete(Filter $filter);

    /**
     * Select first record from database.
     *
     * @param \Kirillbdev\LaraRepository\Filter $filter
     * @param array $columns
     * @return array, \Illuminate\Database\Eloquent\Model or null if empty
     */
    public function first(Filter $filter, $columns = ['*']);

    /**
     * Select last record from database.
     *
     * @param \Kirillbdev\LaraRepository\Filter $filter
     * @param array $columns
     * @return array, \Illuminate\Database\Eloquent\Model or null if empty
     */
    public function last(Filter $filter, $columns = ['*']);
}