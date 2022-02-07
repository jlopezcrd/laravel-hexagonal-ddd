<?php
declare(strict_types = 1);

namespace Developez\Shared\Domain;

class Query
{
    private $and;
    private $or;

    public function __construct(array $filterAnd = [], array $filterOr = [])
    {
        $this->and = $filterAnd;
        $this->or  = $filterOr;
        //dd($this);
    }

    public function hasAnd()
    {
        return count($this->and) > 0;
    }

    public function hasOr()
    {
        return count($this->or) > 0;
    }

    public function valueAnd()
    {
        return $this->and;
        $query = [];

        foreach($this->and as $key => $value) {
            $query[] = [$key, $value];
        }

        return $query;
        return $this->value;
    }

    public function valueOr()
    {
        $query = [];

        foreach($this->or as $key => $value) {
            $query[] = [$key, 'LIKE', $value, 'or'];
        }

        return $query;
        return $this->value;
    }
}
