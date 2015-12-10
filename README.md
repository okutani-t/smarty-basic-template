# SMARTY BASIC TEMPLATE

smartyを使うときに使うテンプレート

直でsmartyを配置しているので古くなったら置き換えなければいけない→comporser検討

↓参考↓

[[PHP] Smartyの導入手順まとめ | vdeep](http://vdeep.net/php-smarty)

## 使い方

配置してtemplatesとindex.phpを書き換えていけばOK

以下index.php

```php
<?php
// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/CustomSmarty.class.php");

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
));
```

index.tpl

```html
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Smartyテスト</title>
</head>
<body>
  #{* ここはコメントです *}#
  やあ、#{$obj->hello}# #{$name}#
</body>
</html>

```

このようにobjもまんま渡せる

CustomSmartyでSmartyクラスを継承して定義している

>→smartyディレクトリに直で置いてしまったのでそこらへんどうにかしないといけない

ClassLoader.phpで設置したクラス読み込み→hogehoge.class.phpの形しか読み込まないため注意

>ClassLoader.phpに直でクラスまでのディレクトリのパスを書かなければいけない

以下例:

```php
private static function directories()
{
    if (empty(self::$dirs)) {
        $base = __DIR__;
        self::$dirs =
         array(
            // ここに読み込んでほしいディレクトリを足していく
            // /smartyを指定しないとSmarty.class.phpが読み込めない
            $base . "/smarty",
            $base . "/vendor/class",
        );
    }

    return self::$dirs;
}
```

author: okutani
