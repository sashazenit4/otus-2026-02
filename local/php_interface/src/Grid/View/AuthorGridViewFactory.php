<?php

namespace Otus\Grid\View;

use Otus\Grid\Filter\AuthorFilterProvider;
use Otus\Grid\Filter\FilterProviderInterface;
use Otus\Grid\Header\AuthorHeaderProvider;
use Otus\Grid\Header\HeaderProviderInterface;
use Otus\Grid\Row\AuthorRowFormatter;
use Otus\Grid\Row\RowFormatterInterface;

final class AuthorGridViewFactory implements GridViewFactoryInterface
{
    public function createHeaderProvider(): HeaderProviderInterface
    {
        return new AuthorHeaderProvider();
    }

    public function createFilterProvider(): FilterProviderInterface
    {
        return new AuthorFilterProvider();
    }

    public function createRowFormatter(): RowFormatterInterface
    {
        return new AuthorRowFormatter();
    }
}
