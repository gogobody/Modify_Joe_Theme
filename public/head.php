<meta charset="utf-8" />
<meta name="renderer" content="webkit" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<meta itemprop="image" content="<?php echo GetQQSharePic($this); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=6.0, minimum-scale=1.0, shrink-to-fit=no, viewport-fit=cover">
<?php echo Utils::exportDNSPrefetch(); ?>
<!-- IE浏览器跳出 -->
<script>
    /* 判断是否是ie浏览器 */
    function detectIE(){var ua=window.navigator.userAgent;var msie=ua.indexOf("MSIE ");if(msie>0){return parseInt(ua.substring(msie+5,ua.indexOf(".",msie)),10)}var trident=ua.indexOf("Trident/");if(trident>0){var rv=ua.indexOf("rv:");return parseInt(ua.substring(rv+3,ua.indexOf(".",rv)),10)}var edge=ua.indexOf("Edge/");if(edge>0){return parseInt(ua.substring(edge+5,ua.indexOf(".",edge)),10)}return false}if(detectIE()!==false){alert("当前站点不支持IE浏览器，请切换其他浏览器！");location.href="https://baidu.com"};
</script>
<!-- favicon图标 -->
<link rel="shortcut icon" href="<?php echo $this->options->JFavicon ? $this->options->JFavicon : 'https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/assets/img/favicon.ico'; ?>" />
<!-- Typecho自有函数 -->
<?php if($this->is("post") and ($this->fields->keywords || $this->fields->desc)):?>
<?php $this->header('keywords='.$this->fields->keywords.'&description='.$this->fields->desc)?>
<?php else:?>
<?php $this->header(); ?>
<?php endif;?>
<!-- 网站标题 -->
<title>
    <?php if ($this->_currentPage > 1) echo '第 ' . $this->_currentPage . ' 页 - '; ?>
    <?php $this->archiveTitle(
        array(
            'category' => '分类 %s 下的文章',
            'search' => '包含关键字 %s 的文章', 'tag' =>  '标签 %s 下的文章', 'author' => '%s 发布的文章'
        ),
        '',
        ' - '
    ); ?>
    <?php $this->options->title(); ?>
</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap-grid.min.css" media="all"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.7.2/animate.min.css" media="all">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.2.1/build/styles/<?php echo $this->options->JCodeColor ?>.min.css" media="all">
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/joe.min.css'); ?>" media="all"/>
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/joe.responsive.min.css'); ?>" media="all"/>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/gogobody/Modify_Joe_Theme/assets/css/OwO.min.css" media="print" onload="this.media='all'; this.onload=null;"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/library/joe.toast/joe.toast.min.css" media="print" onload="this.media='all'; this.onload=null;"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" media="print" onload="this.media='all'; this.onload=null;"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aplayer@1.10.1/dist/APlayer.min.css" media="print" onload="this.media='all'; this.onload=null;"/>
<link href="https://cdn.bootcdn.net/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet" media="print" onload="this.media='all'; this.onload=null;">

<style>
    :root {
        --theme:#4770db,
        --element: #409eff;
        cursor: <?php echo $this->options->JCursorType !== 'off' ? 'url(' . THEME_URL . '\/assets\/cur\/' . $this->options->JCursorType . '), auto' : 'auto' ?>;
        --classA: #dcdfe6;
        --classB: #e4e7ed;
        --classC: #ebeef5;
        --classD: #f2f6fc;
        --main: #303133;
        --routine: #606266;
        --minor: #6e7075;
        --seat: #c0c4cc;
        --success: #67c23a;
        --warning: #e6a23c;
        --danger: #f56c6c;
        --info: #909399;
        --radius-pc: <?php echo $this->options->JRadiusPC ?>;
        --radius-wap: <?php echo $this->options->JRadiusWap ?>;
        --text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
        --box-shadow: 0PX 0PX 20PX -5PX RGBA(158, 158, 158, 0.22);
        --background: #f1f5f8;
        --swiper-theme-color: #fff !important;
    }
</style>

<?php global $stat;Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
<!-- pjax 替换全局配置 -->
<script id="joe_config">
    window.JOE_CONFIG = {
        COOKIE_PREFIX: '<?php echo Typecho_Cookie::getPrefix()?>',
        ARCHIVE:'<?php _e($this->getArchiveType()) ?>',
        ARCHIVE_SLUG:'<?php _e($this->getArchiveSlug());?>',
        STATIC_PATH: '<?php _e(STATIC_PATH);?>',
        INDEX:'<?php echo $this->options->index ?>',
        THEME_URL: '<?php echo THEME_URL ?>',
        RANKING_TITLE:'<?php $ranking_txt = $this->options->JRanking;$ranking_arr = explode("$", $ranking_txt);_e($ranking_arr[0]);?>',
        RANKING_API:'<?php _e($ranking_arr[1]);?>',
        PIC2CDN:'<?php $cdnArray = explode("||", $this->options->JPic2cdn);$cdnUrl = trim($cdnArray[0], " \t\n\r\0\x0B\2F");echo $cdnUrl ? $cdnUrl.'/usr/themes/Typecho-Joe-Theme': THEME_URL ?>',
        /* 网站切换标题 */
        DOCUMENT_TITLE: '<?php $this->options->JDocumentTitle ? $this->options->JDocumentTitle() : null ?>',
        /* 进度条 */
        DOCUMENT_PROGRESS: 'on',
        /* 鼠标右键 */
        DOCUMENT_CONTEXTMENU: '<?php echo $this->options->JContextMenuStatus === 'on' ? 'on' : 'off' ?>',
        /* 主题色 */
        DOCUMENT_GLOBAL_THEME: '<?php $this->options->JGlobalThemeColor() ?>',
        /* 返回顶部 */
        DOCUMENT_BACK_TOP: 'on',
        /* 统计 */
        DOCUMENT_CENSUS: {
            status: '<?php echo $this->options->JCensusStatus === 'on' ? 'on' : 'off' ?>',
            data: [<?php $stat->publishedPagesNum() ?>, <?php $stat->publishedPostsNum() ?>, <?php $stat->publishedCommentsNum() ?>, <?php $stat->categoriesNum() ?>],
        },
        /* 代码高亮 */
        DOCUMENT_HIGHT_LIGHT: '<?php echo $this->options->JCodeColor !== 'off' ? 'on' : 'off' ?>',
        /* 代码防偷 */
        DOCUMENT_CONSOLE: '<?php echo $this->options->JConsoleStatus === 'on' ? 'on' : 'off' ?>',
        /* 天气 */
        DOCUMENT_WEATHER_KEY: '<?php $this->options->JWetherKey() ?>',
        /* 天气显示类型 */
        DOCUMENT_WEATHER_TYPE: '<?php $this->options->JWetherType() ?>',
        /* 点击加载更多 */
        DOCUMENT_LOAD_MORE: '<?php $this->options->JPageStatus() ?>',
        /* 页面加载 */
        DOCUMENT_PAGE_LOADING: '<?php $this->options->JPageLoading() ?>',
        /* 轮播图 */
        DOCUMENT_SWIPER: '<?php echo $this->options->JIndexCarousel ? 'on' : 'off' ?>',
        /* 解析 */
        DOCUMENT_ANALYSIS: '<?php echo $this->options->JAnalysis ? 'on' : 'off' ?>',
        /* 是否是手机 */
        IS_MOBILE: '<?php echo isMobile() ? 'on' : 'off' ?>',
        /* PC端动画 */
        DOCUMENT_PC_ANIMATION: '<?php $this->options->JPCAnimation() ?>',
        /* WAP端动画 */
        DOCUMENT_WAP_ANIMATION: '<?php $this->options->JWapAnimation() ?>',
        DOCUMENT_MOTTO_API: '<?php echo $this->options->JMottoAPI ? $this->options->JMottoAPI : 'https://api.vvhan.com/api/ian' ?>',
        /* 百度收录 */
        DOCUMENT_BAIDU_TOKEN: '<?php echo $this->options->JBaiDuPushToken() ?>',
        /* 懒加载 */
        DOCUMENT_LAZY_LOAD: '<?php echo GetLazyLoad() ?>',
        /* 苹果CMS API */
        VIDEO_LIST_API: '<?php echo $this->options->JVideoListAPI() ?>',
        /* 被屏蔽的分类 */
        VIDEO_LIST_SHIELD: '<?php echo $this->options->JShieldNames() ?>'
    }
</script>

<?php $this->options->JCustomHeadEnd() ?>
<script><?php $this->options->JCustomeCss();?></script>

