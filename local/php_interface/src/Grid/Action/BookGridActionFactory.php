<?php

namespace Otus\Grid\Action;

use Bitrix\Main\Localization\Loc;

final class BookGridActionFactory implements GridRowActionFactoryInterface
{
    public function __construct(
        private readonly string $adminHost = 'http://otus-02.localhost',
        private readonly string $tableName = 'aholin_book',
    ) {
    }

    public function createActions(array $row): array
    {
        $bookId = (int) $row['ID'];
        $bookTitle = (string) ($row['TITLE'] ?? '');

        return [
            $this->createOpenAction($bookId, $bookTitle),
            $this->createDeleteViaComponentAction($bookId),
            $this->createDeleteViaAjaxAction($bookId),
        ];
    }

    private function createOpenAction(int $bookId, string $bookTitle): array
    {
        $url = sprintf(
            "%s/bitrix/admin/perfmon_row_edit.php?lang=ru&table_name=%s&pk%%5BID%%5D=%d",
            $this->adminHost,
            $this->tableName,
            $bookId,
        );

        return [
            'onclick' => sprintf("window.open('%s')", $url),
            'text' => Loc::getMessage('BOOK_GRID_OPEN_BOOK', [
                '#BOOK_NAME#' => $bookTitle,
            ]),
            'default' => true,
        ];
    }

    private function createDeleteViaComponentAction(int $bookId): array
    {
        return [
            'onclick' => sprintf('BX.Otus.BookGrid.deleteBook(%d)', $bookId),
            'text' => Loc::getMessage('BOOK_GRID_DELETE'),
            'default' => true,
        ];
    }

    private function createDeleteViaAjaxAction(int $bookId): array
    {
        return [
            'onclick' => sprintf('BX.Otus.BookGrid.deleteBookViaAjax(%d)', $bookId),
            'text' => Loc::getMessage('BOOK_GRID_DELETE') . ' через AJAX',
            'default' => true,
        ];
    }
}
