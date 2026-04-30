<?php

namespace Otus\Hlblock;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Entity\Event as OrmEvent;
use Bitrix\Main\Entity\EventResult;

class Event
{
    public static function onBeforeElementAdd(OrmEvent $event): EventResult
    {
        // Включаем отладку для проверки
        Debug::writeToFile('Событие работает', '', '/local/debug.log');

        $fields = $event->getParameter('fields');

        // Проверяем, есть ли поле UF_NAME
        if (isset($fields['UF_NAME'])) {
            $fields['UF_NAME'] = 'COLOR: ' . $fields['UF_NAME'];
            $result = new EventResult(EventResult::SUCCESS);
            $result->modifyFields($fields);
            return $result;
        }

        return new EventResult(EventResult::SUCCESS);
    }
}
