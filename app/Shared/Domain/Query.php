<?php

declare(strict_types = 1);

namespace Developez\Shared\Domain;

final class Query
{
    private $and;
    private $or;

    public function __construct(array $filterAnd = [], array $filterOr = [])
    {
        $this->and = $filterAnd;
        $this->or = $filterOr;
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
        /*$query = [];

        foreach($this->and as $key => $value) {
            $query[] = [$key, $value];
        }

        return $query;*/
    }

    public function valueOr()
    {
        $query = [];

        foreach ($this->or as $key => $value) {
            $value = ltrim($value, '[');
            $value = rtrim($value, ']');
            $value = explode(",", $value);

            foreach ($value as $explode) {
                $query[] = [$key, 'LIKE', $explode, 'or'];
            }
        }

        return $query;
    }
}
