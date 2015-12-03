<?php
// smartyの設定ファイル読み込み
require_once(__DIR__ . "/smarty/CustomSmarty.class.php");

$name = "okutani";

$obj = new StdClass();
$obj->hello = "こんにちは！";

$smarty = new CustomSmarty();
$smarty->setSmartyParams(
    array(
        "name" => $name,
        "obj"  => $obj
    ),
    array(
        "index.tpl"
    )
);
