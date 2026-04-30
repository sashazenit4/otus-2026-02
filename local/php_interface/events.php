<?php

use Bitrix\Main\EventManager;

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
