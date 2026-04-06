<?php

use Bitrix\Crm\Service\Container;
use Bitrix\Main\Loader;
// use Bitrix\Crm\Model\Dynamic\TypeTable; - тут можно получить ИД смарта по его коду или названию без хардкода (b_crm_dynamic_type)

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Пример создания контакта');

Loader::includeModule('crm');
$contactFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Contact); // Получение фабрики для сущности с ИД 3

$newContactItem = $contactFactory->createItem(); // Опционально можно сразу передать значения в виде массива, где ключ - поле, а значение и есть значение

// $newContactItem->set('UF_CRM_INN', '771618967942');
$newContactItem->setUfCrmInn('771618967942');
$newContactItem->setName('Александр');
$newContactItem->setLastName('Александр');

// $newContactItem->save();
$addOperation = $contactFactory->getAddOperation($newContactItem);
// $addOperation->disableAllChecks(); Отключит все проверки
// $addOperation->enableBizProc(); Включит запуск бизнес-процессов
$addResult = $addOperation->launch();

echo sprintf('Создан контакт с ID %d', $newContactItem->getId());

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
