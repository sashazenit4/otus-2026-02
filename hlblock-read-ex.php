<?php

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;

/**
 * @var \CMain $APPLICATION
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Пример чтения из hlblock');

Loader::includeModule('highloadblock');

$hlblockCode = 'PantoneColors';
// HighloadBlockTable::getById(2)
$hlblockInfo = HighloadBlockTable::getList([
    'filter' => [
        '=NAME' => $hlblockCode,
    ],
])->fetch();

$hlblockEntity = HighloadBlockTable::compileEntity($hlblockInfo);

$hlblockClassName = '\PantoneColorsTable'; //$hlblockEntity->getDataClass();

$whiteColorInfos = $hlblockClassName::getList([
    // 'filter' => [
    //     '=UF_HEX_CODE' => '000000',
    // ],
])->fetchCollection();

foreach ($whiteColorInfos as $whiteColorInfo) {
    echo $whiteColorInfo?->getUfName() . '<br>';
    echo $whiteColorInfo?->getUfActiveFrom()?->format('d.m.Y H:I:s') . '<br>';
    $colorCode = $whiteColorInfo?->get('UF_HEX_CODE');

    echo "<div style='
    background-color: #{$colorCode};
        width: 50px;
        height: 50px;
    '></div>";
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
