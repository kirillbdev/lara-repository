<?php

namespace Kirillbdev\LaraRepository;


use Illuminate\Database\Eloquent\Model;

class FilterBuilder
{
    private $_model;
    private $_filter;

    private function __construct($model, $filter = null)
    {
        if (!isset($model))
            throw new \InvalidArgumentException('Could not find model class in your repository.
                                                Declare your model class using:
                                                protected $model = your_model_class_name');

        $this->_model = new $model();

        if (!$this->_model instanceof Model)
            throw new \InvalidArgumentException('Your model class not extends Illuminate\Database\Eloquent\Model');

        $this->_filter = $filter;
    }

    public static function build($model, $filter = null)
    {
        $filterBuilder = new FilterBuilder($model, $filter);

        if (is_null($filter))
            return $filterBuilder->_model;

        $result = $filterBuilder->_model;
        foreach ($filterBuilder->_filter->getActions() as $action)
        {
            $result = call_user_func_array(
                [$result, $action->getName()],
                $action->getParams()
            );
        }
        return $result;
    }
}