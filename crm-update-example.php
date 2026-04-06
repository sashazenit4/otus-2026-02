<?php

use Bitrix\Crm\Service\Container;
use Bitrix\Main\Loader;
// use Bitrix\Crm\Model\Dynamic\TypeTable; - тут можно получить ИД смарта по его коду или названию без хардкода (b_crm_dynamic_type)

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Пример обновления контакта');

Loader::includeModule('crm');
$contactFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Contact); // Получение фабрики для сущности с ИД 3

$contactItem = $contactFactory->getItem(9); // Опционально можно сразу передать значения в виде массива, где ключ - поле, а значение и есть значение

$contactItem->set('LAST_NAME', 'Холин');
// $contactItem->save();
$updateOperation = $contactFactory->getUpdateOperation($contactItem);
// $addOperation->disableAllChecks(); Отключит все проверки
// $addOperation->enableBizProc(); Включит запуск бизнес-процессов
$updateResult = $updateOperation->launch();

echo sprintf('Обновлён контакт с ID %d', $contactItem->getId());

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
