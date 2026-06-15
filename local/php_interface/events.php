<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\Diag\Debug;

$eventManager = EventManager::getInstance();

/**
 * OnBeforeAdd
 * OnAfterAdd
 * OnBeforeUpdate
 * OnAfterUpdate
 * OnBeforeDelete
 */
$eventManager->addEventHandler('highloadblock', 'PantoneColorsOnBeforeAdd', [
    '\Otus\Hlblock\Event',
    'onBeforeElementAdd'
]); // во 2 аргументе пишите класс ORM, конктенируя в конце названия события

$eventManager->addEventHandler('iblock', 'OnBeforeIblockElementAdd', function (array &$fields) {
    $handler = \Otus\Event\EventHandlerFactory::create(null);
    $fields = $handler?->onBeforeAdd($fields) ?? $fields;
    $handler = \Otus\Event\EventHandlerFactory::create($fields['IBLOCK_ID']);
    $fields = $handler?->onBeforeAdd($fields) ?? $fields;

    return $fields;
});
