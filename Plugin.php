<?php

/**
 * V1.1版本为最终版作者姜部提供更新，欢迎各路大神修改，请标注原作者信息
 * 使用本插件请先在您的服务器上为php安装redis扩展，执行本插件将会自动为您的typecho配置redis，如果您网站有任何更新操作请在后台页面右上角点击刷新缓存。
 *
 * @package HelloRedis
 * @author Angboo
 * @version 1.1.0
 * @link http://www.aecode.cn
 */
class HelloRedis_Plugin implements Typecho_Plugin_Interface {

    public static function activate() {
        Typecho_Plugin::factory('admin/menu.php')->navBar = array(__CLASS__, 'PluginNav');
        self::install();
    }

    public static function deactivate() {
        self::uninstall();
    }

    public static function config(Typecho_Widget_Helper_Form $form) {
        $arrayFile = array(
            'index' => __TYPECHO_ROOT_DIR__ . '/index.php',
            'index_origin' => __TYPECHO_ROOT_DIR__ . '/index_origin.php',
            'host' => __TYPECHO_ROOT_DIR__ . '/Credis/host.php',
            'Sentinel' => __TYPECHO_ROOT_DIR__ . '/Credis/Sentinel.php',
            'phpunit' => __TYPECHO_ROOT_DIR__ . '/Credis/phpunit.xml',
            'composer' => __TYPECHO_ROOT_DIR__ . '/Credis/composer.json',
            'Cluster' => __TYPECHO_ROOT_DIR__ . '/Credis/Cluster.php',
            'Client' => __TYPECHO_ROOT_DIR__ . '/Credis/Client.php');
        $isOk = true;
        foreach ($arrayFile as &$filename) {
            if (file_exists($filename)) {
                echo $filename = array_keys($arrayFile, $filename)[0] . '--√<br/>';
            } else {
                echo $filename = array_keys($arrayFile, $filename)[0] . '--×<br/>';
                $isOk = false;
            }
        }
        echo '<hr/>';
        echo $isOk ? '您的redis可以正常使用' : '你的redis缺少文件，详情如上，请检查插件目录完整后，重新启用';
        $authorSite = new Typecho_Widget_Helper_Form_Element_Text('Github', NULL, 'https://github.com/61409108/HelloRedis', _t('Github网址'), _t('本版已为终版，欢迎各路大神修改提交修改版'));
        $form->addInput($authorSite->addRule('required', _t('请不要随意修改')));
    }

    public static function personalConfig(Typecho_Widget_Helper_Form $form) {
        
    }

    public static function PluginNav() {
        echo '<a href="' . Helper::options()->siteUrl . '?debug=true&userkey=typecho&action=purgeall' . '" target="_self">清除缓存</a>';
    }

    public static function install() {
        include 'FileUtil.php';
        $file = __TYPECHO_ROOT_DIR__ . __TYPECHO_PLUGIN_DIR__ . '/HelloRedis/install/';
        $newfile = __TYPECHO_ROOT_DIR__;
        $fu = new FileUtil();
        return $fu->copyDir($file, $newfile, true);
    }

    public static function uninstall() {
        include 'FileUtil.php';
        $file = __TYPECHO_ROOT_DIR__ . __TYPECHO_PLUGIN_DIR__ . '/HelloRedis/install/';
        $newfile = __TYPECHO_ROOT_DIR__;
        $fu = new FileUtil();
        return $fu->unlinkDir($newfile . '/Credis') && $fu->moveFile($newfile . '/index_origin.php', $newfile . '/index.php', true) && $fu->unlinkFile($newfile . '/index_origin.php');
    }

}
