<?php
/**
 * 手机底部列表菜单
 */
if (!Helper::options()->JMobiset) return;
//$settings = Helper::options()->JNavmobi;
$all = Typecho_Plugin::export();
$loginUrl = $this->options->loginUrl;

if (array_key_exists('TePass', $all['activated'])){
    if ($this->user->hasLogin()) $loginUrl = $this->options->index.'/admin/extending.php?panel=TePass/theme/ucenter/profile.php';
    else $loginUrl = $this->options->index.'/tepass/signin';
}
?>
<nav class="navigation-tab">
<!--    --><?php
//    $navtops_list = array();
//    if (strpos($settings,'||')) {
//        //解析关键词数组
//        $kwsets = array_filter(preg_split("/(\r|\n|\r\n)/",$settings));
//        foreach ($kwsets as $kwset) {
//            $navtops_list[] = explode('||',trim($kwset));
//        }
//    }
//    ?>
    <div class="navigation-tab-item"><a href="<?php echo $this->options->index ?>" target="_self"><span class="navigation-tab__icon"><i class="iconfont icon-iconfont icon-zhuye"></i></span></a></div>
    <div class="navigation-tab-item"><a href="<?php echo $loginUrl ?>" target="_blank" rel="noopener"><span class="navigation-tab__icon"><i class="iconfont icon-iconfont icon-denglu"></i></span></a></div>
    <div class="navigation-tab-item <?php if ($this->is('page')) _e('active'); ?>" id="load_mobinav"><a href="<?php echo $this->options->JNavigation ?>" target="_self"><span class="navigation-tab__icon"><i class="iconfont icon-iconfont icon-paihangbang"></i></span></a></div>
    <div class="navigation-tab-item" id="mob_goTop"><div><span class="navigation-tab__icon"><i class="iconfont icon-iconfont icon-gotop"></i></span></div></div>
    <div class="navigation-tab-overlay"></div>
</nav>
