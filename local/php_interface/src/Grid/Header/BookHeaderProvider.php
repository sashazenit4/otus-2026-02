<?php

namespace Otus\Grid\Header;

use Bitrix\Main\Localization\Loc;

final class BookHeaderProvider implements HeaderProviderInterface
{
    public function getHeaders(): array
    {
        return [
            ['id' => 'ID', 'name' => 'ID', 'sort' => 'ID', 'default' => true],
            ['id' => 'TITLE', 'name' => Loc::getMessage('BOOK_GRID_BOOK_TITLE_LABEL'), 'sort' => 'TITLE', 'default' => true],
            ['id' => 'YEAR', 'name' => Loc::getMessage('BOOK_GRID_BOOK_PUBLISHING_YEAR_LABEL'), 'sort' => 'YEAR', 'default' => true],
            ['id' => 'PAGES', 'name' => Loc::getMessage('BOOK_GRID_BOOK_PAGES_LABEL'), 'sort' => 'PAGES', 'default' => true],
            ['id' => 'AUTHORS', 'name' => Loc::getMessage('BOOK_GRID_BOOK_AUTHORS_LABEL'), 'default' => true],
            ['id' => 'PUBLISH_DATE', 'name' => Loc::getMessage('BOOK_GRID_BOOK_PUBLISHING_DATE_LABEL'), 'sort' => 'PUBLISH_DATE', 'default' => true],
        ];
    }
}
