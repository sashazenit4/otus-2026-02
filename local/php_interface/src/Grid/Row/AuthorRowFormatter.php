<?php

namespace Otus\Grid\Row;

use Bitrix\Main\ORM\Query\Result;

final class AuthorRowFormatter implements RowFormatterInterface
{
    public function format(Result $result): array
    {
        $gridList = [];

        while ($author = $result->fetch()) {
            $gridList[] = [
                'data' => [
                    'ID' => $author['ID'],
                    'LAST_NAME' => $author['LAST_NAME'],
                    'FIRST_NAME' => $author['FIRST_NAME'],
                    'SECOND_NAME' => $author['SECOND_NAME'],
                ],
                'actions' => [],
            ];
        }

        return $gridList;
    }
}
