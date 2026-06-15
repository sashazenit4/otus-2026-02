<?php

namespace Otus\Event;

class AllIblockEventHandler implements EventHandlerInterface
{
    public function onBeforeAdd(array $fields): array
    {
        $fields['NAME'] = $fields['NAME'] . ' ' . (new \Bitrix\Main\Type\DateTime())->add('-2 days')->format('d.m.Y');
        return $fields;
    }

    public function onBeforeUpdate(array $fields): array
    {
        return $fields;
    }

    public function onBeforeDelete(array $fields): array
    {
        return $fields;
    }
}
