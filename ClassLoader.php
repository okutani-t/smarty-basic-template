<?php

/**
 * 全てのクラスを自動で読み込むクラス
 * directoriesに追加したいディレクトリを足していく
 *
 * @author okutani
 */
class ClassLoader
{
    // class ファイルがあるディレクトリのリスト
    private static $dirs;

    /**
     * クラスが見つからなかった場合呼び出されるメソッド
     * spl_autoload_registerでこのメソッドを登録しておく
     *
     * @param string $class 名前空間など含んだクラス名
     * @return bool 成功すればtrue
     */
    public static function loadClass($class)
    {
        foreach (self::directories() as $directory) {
            // 名前空間や疑似名前空間をここでパース
            $file_name = "{$directory}/{$class}.class.php";

            if (is_file($file_name)) {
                require $file_name;

                return true;
            }
        }
    }

    /**
     * ディレクトリのリストを返す
     * @return array フルパスのリスト
     */
    private static function directories()
    {
        if (empty(self::$dirs)) {
            $base = __DIR__;
            self::$dirs =
             array(
                // ここに読み込んでほしいディレクトリを足していく
                // /smartyを指定しないとSmarty.class.phpが読み込めない
                $base . '/smarty',
                $base . '/vendor/class',
            );
        }

        return self::$dirs;
    }

}

// 実行
spl_autoload_register(array('ClassLoader', 'loadClass'));
