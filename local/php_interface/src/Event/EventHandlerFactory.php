<?php

namespace Otus\Event;

use Otus\Helper;
use Bitrix\Main\Diag\Debug;

class EventHandlerFactory
{
    public static function create(?int $iblockId): ?EventHandlerInterface
    {
        $iblockCode = Helper::getIblockCodeById($iblockId);
        if ($iblockCode === null) {
            return new AllIblockEventHandler();
        }

        $iblockCode = str_replace('_', '', $iblockCode);
        $iblockCode = str_replace('.', '', $iblockCode);
        $iblockCode = str_replace(',', '', $iblockCode);
        $iblockCode = str_replace(';', '', $iblockCode);
        $iblockCode = str_replace('/', '', $iblockCode);
        $className = __NAMESPACE__ . '\\' . $iblockCode . 'EventHandler';
        Debug::dumpToFile($className);
        if (class_exists($className)) {
            return new $className();
        }

        return null;
    }
}
