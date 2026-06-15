<?php

namespace Otus\Grid\View;

use Otus\Grid\Filter\FilterProviderInterface;
use Otus\Grid\Header\HeaderProviderInterface;
use Otus\Grid\Row\RowFormatterInterface;

interface GridViewFactoryInterface
{
    public function createHeaderProvider(): HeaderProviderInterface;

    public function createFilterProvider(): FilterProviderInterface;

    public function createRowFormatter(): RowFormatterInterface;
}
