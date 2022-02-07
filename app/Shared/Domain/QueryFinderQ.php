<?php
declare(strict_types = 1);

namespace Developez\Shared\Domain;

class QueryFinderQ
{
    private $filterAnd = [];
    private $filterOr  = [];

    public function __construct(array $filter)
    {
        //dd($filter);
        $filterAnd = $filter['and'] ?? [];
        $filterOr  = $filter['or'] ?? [];

        foreach($filterAnd as $f) {
            [$key, $value] = explode('=', $f);
            $this->filterAnd[$key] = $value;
        }

        foreach($filterOr as $f) {
            [$key, $value] = explode('=', $f);
            $this->filterOr[$key] = $value;
        }
    }

    public function filterAnd(): array
    {
        return $this->filterAnd;
    }

    public function filterOr(): array
    {
        return $this->filterOr;
    }
}
