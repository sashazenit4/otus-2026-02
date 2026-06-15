<?php

namespace Otus\Grid\Filter;

use Bitrix\Main\Localization\Loc;

final class BookFilterProvider implements FilterProviderInterface
{
    public function getFilterFields(): array
    {
        return [
            ['id' => 'TITLE', 'name' => Loc::getMessage('BOOK_GRID_BOOK_TITLE_LABEL'), 'type' => 'string', 'default' => true],
            ['id' => 'YEAR', 'name' => Loc::getMessage('BOOK_GRID_BOOK_PUBLISHING_YEAR_LABEL'), 'type' => 'number', 'default' => true],
            ['id' => 'PUBLISH_DATE', 'name' => Loc::getMessage('BOOK_GRID_BOOK_PUBLISHING_DATE_LABEL'), 'type' => 'date', 'default' => true],
        ];
    }

    public function prepareFilter(array $filterData): array
    {
        $filter = [];

        if (!empty($filterData['FIND'])) {
            $filter['%TITLE'] = $filterData['FIND'];
        }

        if (!empty($filterData['TITLE'])) {
            $filter['%TITLE'] = $filterData['TITLE'];
        }

        if (!empty($filterData['YEAR_from'])) {
            $filter['>=YEAR'] = $filterData['YEAR_from'];
        }

        if (!empty($filterData['YEAR_to'])) {
            $filter['<=YEAR'] = $filterData['YEAR_to'];
        }

        if (!empty($filterData['PUBLISH_DATE_from'])) {
            $filter['>=PUBLISH_DATE'] = $filterData['PUBLISH_DATE_from'];
        }

        if (!empty($filterData['PUBLISH_DATE_to'])) {
            $filter['<=PUBLISH_DATE'] = $filterData['PUBLISH_DATE_to'];
        }

        return $filter;
    }
}
