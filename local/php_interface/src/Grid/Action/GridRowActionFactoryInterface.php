<?php

namespace Otus\Grid\Action;

interface GridRowActionFactoryInterface
{
    public function createActions(array $row): array;
}
