<?php

namespace Otus\Grid\Row;

use Bitrix\Main\ORM\Query\Result;
use Otus\Grid\Action\GridRowActionFactoryInterface;

final class BookRowFormatter implements RowFormatterInterface
{
    public function __construct(
        private readonly GridRowActionFactoryInterface $actionFactory,
    ) {
    }

    public function format(Result $result): array
    {
        $gridList = [];
        $groupedBooks = [];

        while ($book = $result->fetch()) {
            $bookId = $book['ID'];

            if (!isset($groupedBooks[$bookId])) {
                $groupedBooks[$bookId] = [
                    'ID' => $book['ID'],
                    'TITLE' => $book['TITLE'],
                    'YEAR' => $book['YEAR'],
                    'PAGES' => $book['PAGES'],
                    'PUBLISH_DATE' => $book['PUBLISH_DATE'],
                    'AUTHORS' => [],
                ];
            }

            if ($book['AUTHOR_ID']) {
                $groupedBooks[$bookId]['AUTHORS'][] = implode(' ', array_filter([
                    $book['AUTHOR_LAST_NAME'],
                    $book['AUTHOR_FIRST_NAME'],
                    $book['AUTHOR_SECOND_NAME'],
                ]));
            }
        }

        foreach ($groupedBooks as $book) {
            $rowData = [
                'ID' => $book['ID'],
                'TITLE' => $book['TITLE'],
                'YEAR' => $book['YEAR'],
                'PAGES' => $book['PAGES'],
                'AUTHORS' => implode(', ', $book['AUTHORS']),
                'PUBLISH_DATE' => $book['PUBLISH_DATE']?->format('d.m.Y'),
            ];

            $gridList[] = [
                'data' => $rowData,
                'actions' => $this->actionFactory->createActions($book),
            ];
        }

        return $gridList;
    }
}
