<?php


class JoeUtils
{
    /**
     * 判断插件是否可用（存在且已激活）
     * @param $name
     * @return bool
     */
    public static function hasPlugin($name)
    {
        $plugins = Typecho_Plugin::export();
        $plugins = $plugins['activated'];
        return is_array($plugins) && array_key_exists($name, $plugins);
    }
    public static function genPermalink($type,$value){
        //生成静态链接 example
//        $value = [
//            "type" => 'tag',
//            "slug" => 'shihi'
//        ];
//        $type = $value['type'];
//        $tmpSlug = $value['slug'];
        $value['slug'] = urlencode($value['slug']);

        return Typecho_Router::url($type, $value, Helper::options()->index);
    }
}