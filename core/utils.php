<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * Utils.php
 * Author     : gogobody
 * Date       : 2020/12/21
 * Version    :
 * Description: 主题的一些工具方法
 */

class Utils{
    /**
     * 云存储选项
     * @param array $options 后台选项设置
     * @param bool $isLocal 是否是本地服务器图片
     * @param String $cdnType 云服务商类型
     * @param int $width 目标图片的宽度
     * @param int $height 目标图片的高度
     * @param string $location 是文章的图片post还是别的，如首页头图index
     * @return string
     */
    public static function getImageAddOn($options,$isLocal = false,$cdnType = null, $width = 0, $height = 0,$location
    = "index"){
        $addOn = "";//图片后缀
        if (!$isLocal){//不是本地服务器图片
            return $addOn;
        }
        if ($options->JPic2cdn!=""){//开启了镜像存储的功能

            if ($cdnType == null){//如果参数中没有cdnType，这里会进行获取cdn类型
                $cdnArray = explode("||",$options->JPic2cdn);
                $cdnType = trim($cdnArray[1]);
            }

            if (@in_array('0',$options->JCloudOptions)){//启用了图片处理
                if ($cdnType == "ALIOSS" ){
                    $addOn .= "?";//分隔符
                } else if($cdnType == "UPYUN"){//阿里云和又拍云
                    $addOn .= "!";//分隔符
                }else if ($cdnType == "QINIU"){//七牛云
                    $addOn .= "?";//分隔符
                }else if ($cdnType == "QCLOUD"){
                    $addOn .= "?imageMogr2";
                }
                if ($location == "post"){//为文章中的图片增加自定义后缀
                    $addOn .= trim($options->JImagePostSuffix);
                }
                if (!($width == 0 && $height == 0)){
                    if ($height == 0){//根据宽度尺寸进行缩放
                        if ($cdnType == "UPYUN"){
                            $addOn .= "/fw/$width";
                        }else if ($cdnType == "ALIOSS"){//阿里云
                            $addOn .= "x-oss-process=image/resize,w_$width";
                        }else if ($cdnType == "QINIU"){//七牛云
                            $addOn .=  "/imageView2/2/w/$width?imageslim";
                        }else if ($cdnType == "QCLOUD"){//腾讯云
                            $addOn .=  "/scrop/".$width."x";
                        }
                    }else if ($width === 0){//根据高度尺寸进行缩放
                        if ($cdnType == "UPYUN"){
                            $addOn .= "/fh/$height";
                        }else if ($cdnType == "ALIOSS"){
                            $addOn .= "x-oss-process=image/resize,h_$height";
                        }else if ($cdnType == "QINIU"){//七牛云
                            $addOn .=  "/imageView2/2/h/$height";
                        }else if ($cdnType == "QCLOUD"){//腾讯云
                            $addOn .=  "/scrop/x".$height;
                        }
                    }else{//按照固定的宽高进行缩放
                        if ($cdnType == "UPYUN"){
                            $addOn .= "/fwfh/".$width."x".$height;
                        }else if ($cdnType == "ALIOSS"){
                            $addOn .= "x-oss-process=image/resize,m_lfit,h_".$height.",w_".$width;
                        }else if ($cdnType == "QINIU"){//七牛云
                            $addOn .=  "/imageView2/2/w/".$width."/h/".$height;
                        }else if ($cdnType == "QCLOUD"){//腾讯云
                            $addOn .=  "/scrop/".$width."x".$height;
                        }
                    }
                }
                //todo:添加图片质量参数

                //添加图片无损压缩参数
                if ($cdnType == "UPYUN"){
                    $addOn .= "/compress/true";
                }else if ($cdnType == "ALIOSS"){

                }else if ($cdnType == "QINIU"){//七牛云
                    $addOn .=  "?imageslim";
                }
            }
        }
        return $addOn;
    }

}