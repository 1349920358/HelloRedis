<?php
require __TYPECHO_ROOT_DIR__ . __TYPECHO_PLUGIN_DIR__ . '/HelloRedis/FileUtil.php';
class HelloRedis_Action extends Typecho_Widget implements Widget_Interface_Do
{
    public function doImport()
    {
        $file = __TYPECHO_ROOT_DIR__ . __TYPECHO_PLUGIN_DIR__ . '/HelloRedis/install/';
        $newfile = __TYPECHO_ROOT_DIR__;
        //必须有写入权限
        $fu = new FileUtil();
        $fu->copyDir($file, $newfile, true);
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
        $error = "";
        foreach ($arrayFile as &$filename) {
            if (file_exists($filename)) {
                $filename = array_keys($arrayFile, $filename)[0] . '--yes';
            } else {
                $filename = array_keys($arrayFile, $filename)[0] . '--no';
                $isOk = false;
            }
        }
        foreach ($arrayFile as &$state) {
            $error = $error . $state;
        }
        if ($isOk) {
            $this->widget('Widget_Notice')->set(_t("配置完成"), NULL, 'success');
            $this->response->goBack();
        } else {
            $this->widget('Widget_Notice')->set(_t($error . "如上所示部分文件未配置成功"), NULL, 'success');
            $this->response->goBack();
        }
    }
    public function action()
    {
        $this->widget('Widget_User')->pass('administrator');
        $this->on($this->request->isPost())->doImport();
    }
}
