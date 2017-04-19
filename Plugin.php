<?php
/**
 * 使用本插件请先在您的服务器上为php安装redis扩展，执行本插件将会自动为您的typecho配置redis，如果您网站有任何更新操作请在后台页面右上角点击刷新缓存，请不要随意修改本插件内容，转载请注明版权
 *
 * @package HelloRedis
 * @author Angboo
 * @version 1.0.0
 * @link http://www.aecode.cn
 */
class HelloRedis_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法
     *
     * @access public
     * @return void
     */
    public static function activate()
    {
        Helper::addPanel(1, 'HelloRedis/panel.php', _t('HelloRedis'), _t('Redis|让typecho飞起来'), 'administrator');
        Helper::addAction('HelloRedis', 'HelloRedis_Action');
        Typecho_Plugin::factory('admin/menu.php')->navBar = array(__CLASS__, 'PluginNav');
    }

    /**
     * 禁用插件方法
     *
     * @static
     * @access public
     * @return void
     */
    public static function deactivate(){
        Helper::removePanel(1, 'HelloRedis/panel.php');
      	Helper::removeAction('HelloRedis');
    }

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /**
     * 插件实现方法
     *
     * @access public
     * @return void
     */
    public static function PluginNav()
    {
        echo '<a href="'.Helper::options()->siteUrl.'?debug=true&userkey=typecho&action=purgeall'.'" target="_self">清除缓存</a>';
    }
}