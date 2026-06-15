<?php

namespace Otus\Grid\Row;

use Bitrix\Main\ORM\Query\Result;

interface RowFormatterInterface
{
    public function format(Result $result): array;
}
