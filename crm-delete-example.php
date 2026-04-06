<?php

use Bitrix\Crm\Service\Container;
use Bitrix\Main\Loader;
// use Bitrix\Crm\Model\Dynamic\TypeTable; - тут можно получить ИД смарта по его коду или названию без хардкода (b_crm_dynamic_type)

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Пример удаления контакта');

Loader::includeModule('crm');
$contactFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Contact); // Получение фабрики для сущности с ИД 3

$contactItem = $contactFactory->getItem(9); // Опционально можно сразу передать значения в виде массива, где ключ - поле, а значение и есть значение

$contactItem->set('LAST_NAME', 'Холин');
// $contactItem->delete();
$deleteOperation = $contactFactory->getDeleteOperation($contactItem);
// $addOperation->disableAllChecks(); Отключит все проверки
// $addOperation->enableBizProc(); Включит запуск бизнес-процессов
$deleteResult = $deleteOperation->launch();

echo sprintf('Удалён контакт с ID %d', 9);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
