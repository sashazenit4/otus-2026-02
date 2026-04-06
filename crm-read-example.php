<?php

use Bitrix\Crm\Service\Container;
use Bitrix\Main\Loader;
// use Bitrix\Crm\Model\Dynamic\TypeTable; - тут можно получить ИД смарта по его коду или названию без хардкода (b_crm_dynamic_type)

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Пример чтения элементов смарт-процесса');

Loader::includeModule('crm');
$domainProlongationFactory = Container::getInstance()->getFactory(1038); // Получение фабрики для сущности с ИД 1038

$parentDealFieldCode = 'PARENT_ID_' . \CCrmOwnerType::Deal;
$items = $domainProlongationFactory->getItems([
    'filter' => [$parentDealFieldCode => 7], // фильтрация по роодительской сделке
    'select' => ['ID', 'TITLE', $parentDealFieldCode],
]);

foreach ($items as $item) {
    var_dump($item->getData());
}

// echo ($domainProlongationFactory->getItem(1))->getTitle(); Чтение 1 элемент по его ИД


require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
