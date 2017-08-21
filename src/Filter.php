<?php

namespace Kirillbdev\LaraRepository;


class Filter
{
    private $_actions = [];

    private $_allowCommands = [
        [
            'name' => 'where',
            'priority' => 1,
        ],
        [
            'name' => 'orWhere',
            'priority' => 1,
        ],
        [
            'name' => 'with',
            'priority' => 0,
        ],
        [
            'name' => 'orderBy',
            'priority' => 1,
        ],
        [
            'name' => 'take',
            'priority' => 1,
        ],
        [
            'name' => 'has',
            'priority' => 1,
        ],
        [
            'name' => 'whereHas',
            'priority' => 1,
        ],
        [
            'name' => 'first',
            'priority' => 2,
        ],
    ];

    public function __call($name , $arguments)
    {
        foreach ($this->_allowCommands as $command)
        {
            if ($name == $command['name'])
            {
                $this->_actions[] = new Action($name, $arguments, $command['priority']);
                break;
            }
        }
        return $this;
    }

    public function findById($id)
    {
        return $this->where('id', '=', $id)->first();
    }

    public function last($orderColumn = 'id')
    {
        return $this->orderBy($orderColumn, 'DESC')->first();
    }

    public function getActions()
    {
        $this->_sortActions();
        return $this->_actions;
    }

    private function _sortActions()
    {
        usort($this->_actions, function ($a, $b) {
            $pA = $a->getPriority();
            $pB = $b->getPriority();
            if ($pA == $pB)
                return 0;
            return $pA > $pB ? 1 : -1;
        });
    }
}