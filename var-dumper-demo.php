<?php

use Otus\Helper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

global $APPLICATION;
$APPLICATION->SetTitle('Демонстрация работы Вра дампера');

dump((object) [
    'DoDo PIZZA' => '+74953334422',
    'Ya.Taxi' => '+74959999999',
]);

$iblockCode = 'clients_s1';
dump([
    'iblockId' => Helper::getIblockIdByCode($iblockCode),
    'iblockCode' => $iblockCode,
]);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
