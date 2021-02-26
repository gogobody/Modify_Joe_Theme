<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * Modify Joe Theme Plugin
 * 
 * @package Modify Joe Theme Plugin
 * @author gogobody
 * @version 1.0.0
 * @link http://typecho.org
 */
require_once 'core/route.php';
//require_once(__DIR__ . DIRECTORY_SEPARATOR . "utils/utils.php");


class ModifyJoePlugin_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {

        // API register
        // /action/whosurdaddy
        Helper::addRoute('jsonp_', '/whosurdaddy/[type]', 'ModifyJoePlugin_Action');
        Helper::addAction('whosurdaddy', 'ModifyJoePlugin_Action');
        // 路由注册
        // 资源专区
        Helper::addRoute('resources', '/resources', 'Widget_Archive@resources', 'render');
        Helper::addRoute('resources_page', '/resources/[page:digital]/', 'Widget_Archive@resources_page', 'render');
        // 热门文章
        Helper::addRoute('hotposts', '/hot/posts', 'Widget_Archive@hotposts', 'render');
        Helper::addRoute('hotposts_page', '/hot/posts/[page:digital]/', 'Widget_Archive@hotposts_page', 'render');
        // 页面注册
        Typecho_Plugin::factory('Widget_Archive')->handleInit_1000 = array('ModifyJoePlugin_Plugin','handleInit');
        Typecho_Plugin::factory('Widget_Archive')->handle_1000 = array('ModifyJoePlugin_Plugin','handle');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){
        Helper::removeRoute('resources');
        Helper::removeRoute('resources_page');
        Helper::removeRoute('jsonp_');
        Helper::removeAction('whosurdaddy');

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

    // 添加新的 Page
    public static function handleInit($archive,$select)
    {}

    public static function handle($type,$archive,$select)
    {
        return JRoute::handle($type,$archive,$select);
    }
}
