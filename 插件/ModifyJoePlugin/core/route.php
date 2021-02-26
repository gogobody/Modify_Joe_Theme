<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require_once 'handler/handler.php';

class JRoute{


    // 添加新的 Page
    public static function handleInit($archive,$select)
    {}

    public static function handle($type,$archive,$select){
        switch ($type){
            case 'resources':
            case 'resources_page':
                Widget_CustomHandler::handleResourcesPage($archive, $select);
                break;

            case 'hotposts':
            case 'hotposts_page':
                Widget_CustomHandler::handleHotPostsPage($archive, $select);
                break;
        }

        return true; // 不输出文章 // 查看源码
    }
}


