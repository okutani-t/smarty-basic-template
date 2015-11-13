<?php
// Smartyの読み込み
require_once(__DIR__ . '/Autoloader.php');
// 自作クラスの読み込み
require_once(dirname(__DIR__) . '/ClassLoader.php');

/**
 * Smartyクラスを拡張して独自機能をつけたクラス
 *
 * @access public
 * @author okutani
 */
class CustomSmarty extends Smarty
{
    function __construct(){
        parent::__construct();

        $this->setLeftDelimiter('#{');
        $this->setRightDelimiter('}#');

        // tplとコンパイルファイルの置き場所を変更できる
        //$this->setCompileDir('./smarty/templates_c/');
        //$this->setTemplateDir('./view/');

        Smarty_Autoloader::register();
    }

    /**
     * assignとdisplayを同時に行う
     *
     * @access public
     * @param array $smartyValues
     * @param array $smartyTpls
     */
    public function setSmartyParams($smartyValues = array(), $smartyTpls = array())
    {
        // 値の格納を行う
        foreach ($smartyValues as $key => $value) {
            $this->assign( $key, $value );
        }
        // テンプレートファイルの読み込み
        foreach ($smartyTpls as $path) {
            $this->display($path);
        }
    }

}
