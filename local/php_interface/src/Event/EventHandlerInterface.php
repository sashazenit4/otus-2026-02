<?php

namespace Otus\Event;

/**
 * Implementing classes must be called by pattern 
 * (IblockCode+EventHandler), for example: 
 * NewsEventHandler, CatalogEventHandler, etc.
 */
interface EventHandlerInterface
{
    public function onBeforeAdd(array $fields): array;
    public function onBeforeUpdate(array $fields): array;
    public function onBeforeDelete(array $fields): array;
}
