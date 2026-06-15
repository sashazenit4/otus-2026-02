<?php

namespace Otus\Grid\View;

use Otus\Grid\Action\BookGridActionFactory;
use Otus\Grid\Filter\BookFilterProvider;
use Otus\Grid\Filter\FilterProviderInterface;
use Otus\Grid\Header\BookHeaderProvider;
use Otus\Grid\Header\HeaderProviderInterface;
use Otus\Grid\Row\BookRowFormatter;
use Otus\Grid\Row\RowFormatterInterface;

final class BookGridViewFactory implements GridViewFactoryInterface
{
    public function createHeaderProvider(): HeaderProviderInterface
    {
        return new BookHeaderProvider();
    }

    public function createFilterProvider(): FilterProviderInterface
    {
        return new BookFilterProvider();
    }

    public function createRowFormatter(): RowFormatterInterface
    {
        return new BookRowFormatter(new BookGridActionFactory());
    }
}
