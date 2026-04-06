<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$p = \Bitrix\Main\PhoneNumber\Parser::getInstance();

$r = $p->parse('8                            (995) 113-80-18                   ');
var_dump($r->getNationalPrefix());
var_dump($r->getNationalNumber());

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
