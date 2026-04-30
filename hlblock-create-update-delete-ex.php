<?php

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Type\DateTime;

/**
 * @var \CMain $APPLICATION
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Пример создания элемента hlblock');

Loader::includeModule('highloadblock');

$hlblockCode = 'PantoneColors';

$hlblockInfo = HighloadBlockTable::getList([
    'filter' => [
        '=NAME' => $hlblockCode,
    ],
])->fetch();

$hlblockEntity = HighloadBlockTable::compileEntity($hlblockInfo);

$hlblockClassName = $hlblockEntity->getDataClass();

$data = [
    [
        'UF_NAME' => 'Жёлтый',
        'UF_ACTIVE_FROM' => (new DateTime())->add('-50 days'),
        'UF_XML_ID' => \CUtil::translit('Жёлтый', 'ru'),
        'UF_TAGS' => [
            'Потрясный жёлтый',
            'Как у пчёл',
        ],
        'UF_HEX_CODE' => 'fffb00'
    ],
    [
        'UF_NAME' => 'Зелёный',
        'UF_ACTIVE_FROM' => (new DateTime())->add('+30 days'),
        'UF_XML_ID' => \CUtil::translit('Зелёный', 'ru'),
        'UF_TAGS' => [
            'Потрясный зелёный',
            'Будто ёлку увидал',
        ],
        'UF_HEX_CODE' => '338347'
    ],
];

$hlblockClassName::addMulti($data, true);

$hlblockClassName::update(1, ['UF_XML_ID' => \CUtil::translit('Чёрный', 'ru')]);
$hlblockClassName::delete(11);
$hlblockClassName::delete(12);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
