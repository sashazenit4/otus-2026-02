<?php

namespace Otus\Grid\Filter;

interface FilterProviderInterface
{
    public function getFilterFields(): array;

    public function prepareFilter(array $filterData): array;
}
