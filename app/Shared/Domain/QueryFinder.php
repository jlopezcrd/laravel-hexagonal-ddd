<?php
declare(strict_types = 1);

namespace Developez\Shared\Domain;

class QueryFinder
{
    private $filterAnd = [];
    private $filterOr  = [];

    public function __construct(array $filter)
    {
        if(count($filter) === 1) {
            $this->filterOr = $filter['or'];
            return;
        }

        $this->initFilter($filter);
    }

    public function filterAnd(): array
    {
        return $this->filterAnd;
    }

    public function filterOr(): array
    {
        return $this->filterOr;
    }

    private function initFilter(array $filter): void
    {
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

        //dd($this);
    }
}
