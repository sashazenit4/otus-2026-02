<?php

use Bitrix\Crm\Service\Container;
use Bitrix\Main\Loader;
// use Bitrix\Crm\Model\Dynamic\TypeTable; - тут можно получить ИД смарта по его коду или названию без хардкода (b_crm_dynamic_type)

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Пример чтения элементов сделки');

Loader::includeModule('crm');
$dealFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal); // Получение фабрики для сущности с ИД 2

// $dealFactory->getItemsFilteredByPermissions([]); Тоже, что и ниже, но с учётом прав текущего пользователя
// echo $dealFactory->getItemsCountFilteredByPermissions(['ID' => 7]); К-во элементов по переданному фильтру
$items = $dealFactory->getItems([
    // 'filter' => ['ID' => 7], // фильтрация по роодительской сделке
    // 'select' => ['ID', 'TITLE'],
]);

foreach ($items as $item) {
    dump($item->getData()); // Получение всех полей 7 сделки (только те, что в select будут не равны NULL)
    // dump($item->get('OPPORTUNITY')); // Получение поля сумма валюта 7 сделки
    // dump($item->getOpportunity()); // Получение поля сумма валюта 7 сделки
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
