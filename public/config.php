<?php $this->need('component/footer.navmobi.php'); ?>
<script>document.addEventListener('lazybeforeunveil', function(e){let bg = e.target.getAttribute('data-bg');if(bg){e.target.style.backgroundImage = 'url(' + bg + ')';}});</script>
<script src="https://cdn.jsdelivr.net/gh/aFarkas/lazysizes@5.3.0/lazysizes.min.js" async=""></script>
<script src="https://cdn.jsdelivr.net/npm/pjax@0.2.8/pjax.min.js"></script>
<!-- 音乐播放器 -->
<?php if ($this->options->JPlayer && !isMobile()) : ?>
    <meting-js id="<?php $this->options->JPlayer(); ?>" lrc-type="1" server="netease" storage-name="meting" theme="#ebebeb" autoplay type="playlist" fixed="true" list-olded="true"></meting-js>
    <script src="https://cdn.jsdelivr.net/npm/aplayer@1.10.1/dist/APlayer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/meting@2.0.1/dist/Meting.min.js"></script>
<?php endif; ?>

<?php $this->footer(); ?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.qrcode@1.0.3/jquery.qrcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/draggabilly@2.3.0/dist/draggabilly.pkgd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/wowjs@1.1.3/dist/wow.min.js"></script>

<!-- 代码高亮 -->
<?php if ($this->options->JCodeColor !== 'off') : ?>
    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.2.1/build/highlight.min.js"></script>
<?php endif; ?>

<!-- 天气 -->
<?php if ($this->options->JWetherKey) : ?>
    <script src="https://apip.weatherdt.com/standard/static/js/weather-standard-common.js"></script>
<?php endif; ?>

<!-- 页面加载 -->
<?php if ($this->options->JPageLoading !== "off") : ?>
    <script src="https://cdn.jsdelivr.net/npm/fakeloader@1.0.0/fakeLoader.min.js"></script>
<?php endif; ?>

<!-- 平滑滚动 -->
<script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/library/SmoothScroll/SmoothScroll.min.js"></script>

<!-- 弹窗提示 -->
<script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/library/joe.toast/joe.toast.min.js"></script>

<!-- 画图 -->
<script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/library/sketchpad/sketchpad.min.js"></script>

<!-- 鱼群跳跃 -->
<?php if ($this->options->JFishStatus !== "off") : ?>
    <script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/assets/js/fish.min.js"></script>
<?php endif; ?>

<!-- 3dtag -->
<!--<script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/library/3DTag/3DTag.min.js" defer></script>-->
<!-- 目录树(合并到了主函数) -->
<!--<script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/assets/js/jfloor.min.js"></script>-->
<script src="https://cdn.bootcdn.net/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

<script src="<?php $this->options->themeUrl('assets/js/OwO.min.js?v=' . JoeVersion()); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/joe.config.min.js?v=' . JoeVersion()); ?>"></script>

    <!-- 鼠标点击特效 -->
<?php if ($this->options->JCursorEffects !== 'off') : ?>
    <script src="<?php $this->options->themeUrl('assets/cursor/' . $this->options->JCursorEffects); ?>"></script>
<?php endif; ?>

<script>
    /* 刷新 评论 cookie */
    <?php if(!$this->user->hasLogin()){ ?>
    function getCookie(name){
        const strcookie = document.cookie;//获取cookie字符串
        const arrcookie = strcookie.split("; ");//分割
        //遍历匹配
        for (let i = 0; i < arrcookie.length; i++) {
            const arr = arrcookie[i].split("=");
            if (arr[0] === name){
                return unescape(decodeURI(arr[1]));
            }
        }
        return "";
    }
    function adduser(){
        let nick = document.getElementById('comment-nick')
        let mail = document.getElementById('comment-mail')
        let url = document.getElementById('comment-url')
        if (nick) nick.value = getCookie(window.JOE_CONFIG.COOKIE_PREFIX+'__typecho_remember_author');
        if (mail) mail.value = getCookie(window.JOE_CONFIG.COOKIE_PREFIX+'__typecho_remember_mail');
        if (url) url.value = getCookie(window.JOE_CONFIG.COOKIE_PREFIX+'__typecho_remember_url');
    }
    adduser();
    <?php } ?>
    /* 自定义JS */
    <?php $this->options->JCustomScript() ?>

    const pjax = new Pjax({
        elements:'a[href^="<?php Helper::options()->siteUrl()?>"]:not([target="_blank"]):not([no-pjax]):not(form):not([data-fancybox]):not([rel="nofollow"]),form[data-pjax]',
        selectors: ["head title","head meta[name='description']","head link[rel='alternate']","#joe_config","#post_top_title","#pjax-container"],
    });
    function pjax_send(){
        NProgress.start()
        typeof adduser != 'undefined' && adduser()
    }
    function pjax_init(){
        window.JoeInstance.pjax_complete()
        NProgress.done()
    }
    document.addEventListener('pjax:send', pjax_send)
    document.addEventListener("pjax:complete", pjax_init)
</script>

<?php $this->options->JCustomBodyEnd() ?>
<?php try{$tpOptions = Helper::options()->plugin('TpCache');}catch (Typecho_Plugin_Exception $e){$tpOptions=NULL;};if ($this->is('post') and $tpOptions->enable_gcache =='1'){?>
    <script>$(function(){if (PCID) $.post('/',{postview:PCID},function (res) {})})</script>
<?php } ?>
