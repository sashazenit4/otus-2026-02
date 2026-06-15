<?php

namespace Otus\Event;

class ClientsS1EventHandler implements EventHandlerInterface
{
    public function onBeforeAdd(array $fields): array
    {
        $fields['NAME'] = 'Клиенты S1 ' . $fields['NAME'];
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
