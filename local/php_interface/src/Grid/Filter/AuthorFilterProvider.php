<?php

namespace Otus\Grid\Filter;

final class AuthorFilterProvider implements FilterProviderInterface
{
    public function getFilterFields(): array
    {
        return [
            ['id' => 'LAST_NAME', 'name' => 'Фамилия', 'type' => 'string', 'default' => true],
            ['id' => 'FIRST_NAME', 'name' => 'Имя', 'type' => 'string', 'default' => true],
        ];
    }

    public function prepareFilter(array $filterData): array
    {
        $filter = [];

        if (!empty($filterData['FIND'])) {
            $filter[] = [
                'LOGIC' => 'OR',
                '%LAST_NAME' => $filterData['FIND'],
                '%FIRST_NAME' => $filterData['FIND'],
            ];
        }

        if (!empty($filterData['LAST_NAME'])) {
            $filter['%LAST_NAME'] = $filterData['LAST_NAME'];
        }

        if (!empty($filterData['FIRST_NAME'])) {
            $filter['%FIRST_NAME'] = $filterData['FIRST_NAME'];
        }

        return $filter;
    }
}
