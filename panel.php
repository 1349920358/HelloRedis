<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
include 'header.php';
include 'menu.php';
$arrayFile =array(
    'index'=>__TYPECHO_ROOT_DIR__.__TYPECHO_PLUGIN_DIR__.'/HelloRedis/install/index.php',
    'index_origin'=>__TYPECHO_ROOT_DIR__.__TYPECHO_PLUGIN_DIR__.'/HelloRedis/install/index_origin.php',
    'host'=>__TYPECHO_ROOT_DIR__.__TYPECHO_PLUGIN_DIR__.'/HelloRedis/install/Credis/host.php',
    'Sentinel'=>__TYPECHO_ROOT_DIR__.__TYPECHO_PLUGIN_DIR__.'/HelloRedis/install/Credis/Sentinel.php',
    'phpunit'=>__TYPECHO_ROOT_DIR__.__TYPECHO_PLUGIN_DIR__.'/HelloRedis/install/Credis/phpunit.xml',
    'composer'=>__TYPECHO_ROOT_DIR__.__TYPECHO_PLUGIN_DIR__.'/HelloRedis/install/Credis/composer.json',
    'Cluster'=>__TYPECHO_ROOT_DIR__.__TYPECHO_PLUGIN_DIR__.'/HelloRedis/install/Credis/Cluster.php',
    'Client'=>__TYPECHO_ROOT_DIR__.__TYPECHO_PLUGIN_DIR__.'/HelloRedis/install/Credis/Client.php'
);
$isOk=true;
foreach ($arrayFile as &$filename) {
    if (file_exists($filename)) {
        $filename=array_keys($arrayFile,$filename)[0].'--yes';
    } else {
        $filename=array_keys($arrayFile,$filename)[0].'--no';
        $isOk=false;
    }
}

?>
<div class="main">
    <div class="body body-950">
        <center><?php include 'page-title.php'; ?></center>
        <div class="container typecho-page-main">
            <div class="column-22 start-02">
                <div class="message success typecho-radius-topleft typecho-radius-topright typecho-radius-bottomleft typecho-radius-bottomright">
                    <form action="<?php $options->index('/action/HelloRedis'); ?>" method="post">
                    <blockquote>
                        <ul>
                            <center><strong>您的配置如下</strong><hr><br><br>
                                <?php
                                foreach ($arrayFile as &$state) {
                                    echo ' <li><strong>'.$state.'</strong></li>';
                                }
                                if($isOk){
                                    echo '<input type="submit" value="准备就绪,点击配置"></input>';
                                }else{
                                    echo '由部分配置文件被删除或修改，请登陆<a href="http://www.aecode.cn"></a>重新下载插件';
                                }
                                ?>
                                <br><br><hr><a href="<?php Typecho_Common::url('options-plugin.php?config=HelloRedis', $options->adminUrl); ?>">修改配置点这里</center>
                        </ul>
                    </blockquote>
                    </form>
                    <br />
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'copyright.php';
include 'common-js.php';
include 'footer.php';
?>
