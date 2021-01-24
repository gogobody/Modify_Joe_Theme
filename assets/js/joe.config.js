// 定义 全局 函数
const query = document.querySelector.bind(document);
const queryAll = document.querySelectorAll.bind(document);
const fromId = document.getElementById.bind(document);
const fromClass = document.getElementsByClassName.bind(document);
const fromTag = document.getElementsByTagName.bind(document);

class JoeUtils{
    constructor() {
    }
    /* URL 添加或者替换参数 */
    static changeURLArg(url,arg,arg_val){
        let pattern=arg+'=([^&]*)';
        let replaceText=arg+'='+arg_val;
        if(url.match(pattern)){
            let tmp='/('+ arg+'=)([^&]*)/gi';
            tmp=url.replace(eval(tmp),replaceText);
            return tmp;
        }else{
            if(url.match('[\?]')){
                return url+'&'+replaceText;
            }else{
                return url+'?'+replaceText;
            }
        }
    }
}
/**
 * @desc 一个轮播插件
 * @author Mxsyx (zsimline@163.com)
 * @version 1.0.0
 */
class Lb {
    constructor(options) {
        this.lbBox = document.getElementById(options.id);
        this.lbItems = this.lbBox.querySelectorAll('.lb-item');
        this.lbSigns = this.lbBox.querySelectorAll('.lb-sign li');
        this.lbCtrlL = this.lbBox.querySelectorAll('.lb-ctrl')[0];
        this.lbCtrlR = this.lbBox.querySelectorAll('.lb-ctrl')[1];

        // 当前图片索引
        this.curIndex = 0;
        // 轮播盒内图片数量
        this.numItems = this.lbItems.length;

        // 是否可以滑动
        this.status = true;

        // 轮播速度
        this.speed = options.speed || 600;
        // 等待延时
        this.delay = options.delay || 3000;

        // 轮播方向
        this.direction = options.direction || 'left';

        // 是否监听键盘事件
        this.moniterKeyEvent = options.moniterKeyEvent || false;
        // 是否监听屏幕滑动事件
        this.moniterTouchEvent = options.moniterTouchEvent || false;

        this.handleEvents();
        this.setTransition();
    }

    // 开始轮播
    start() {
        const event = {
            srcElement: this.direction === 'left' ? this.lbCtrlR : this.lbCtrlL
        };
        const clickCtrl = this.clickCtrl.bind(this);

        // 每隔一段时间模拟点击控件
        this.interval = setInterval(clickCtrl, this.delay, event);
    }

    // 暂停轮播
    pause() {
        clearInterval(this.interval);
    }

    /**
     * 设置轮播图片的过渡属性
     * 在文件头内增加一个样式标签
     * 标签内包含轮播图的过渡属性
     */
    setTransition() {
        const styleElement = document.createElement('style');
        document.head.appendChild(styleElement);
        const styleRule = `.lb-item {transition: left ${this.speed}ms ease-in-out}`
        styleElement.sheet.insertRule(styleRule, 0);
    }

    // 处理点击控件事件
    clickCtrl(event) {
        if (!this.status) return;
        this.status = false;
        let fromIndex,toIndex,direction
        if (event.srcElement === this.lbCtrlR) {
            fromIndex = this.curIndex,
                toIndex = (this.curIndex + 1) % this.numItems,
                direction = 'left';
        } else {
            fromIndex = this.curIndex;
            toIndex = (this.curIndex + this.numItems - 1) % this.numItems,
                direction = 'right';
        }
        this.slide(fromIndex, toIndex, direction);
        this.curIndex = toIndex;
    }

    // 处理点击标志事件
    clickSign(event) {
        if (!this.status) return;
        this.status = false;
        const fromIndex = this.curIndex;
        const toIndex = parseInt(event.srcElement.getAttribute('slide-to'));
        const direction = fromIndex < toIndex ? 'left' : 'right';
        this.slide(fromIndex, toIndex, direction);
        this.curIndex = toIndex;
    }

    // 处理滑动屏幕事件
    touchScreen(event) {
        if (event.type === 'touchstart') {
            this.startX = event.touches[0].pageX;
            this.startY = event.touches[0].pageY;
        } else {  // touchend
            this.endX = event.changedTouches[0].pageX;
            this.endY = event.changedTouches[0].pageY;

            // 计算滑动方向的角度
            const dx = this.endX - this.startX
            const dy = this.startY - this.endY;
            const angle = Math.abs(Math.atan2(dy, dx) * 180 / Math.PI);

            // 滑动距离太短
            if (Math.abs(dx) < 10 || Math.abs(dy) < 10) return ;

            if (angle >= 0 && angle <= 45) {
                // 向右侧滑动屏幕，模拟点击左控件
                this.lbCtrlL.click();
            } else if (angle >= 135 && angle <= 180) {
                // 向左侧滑动屏幕，模拟点击右控件
                this.lbCtrlR.click();
            }
        }
    }

    // 处理键盘按下事件
    keyDown(event) {
        if (event && event.keyCode === 37) {
            this.lbCtrlL.click();
        } else if (event && event.keyCode === 39) {
            this.lbCtrlR.click();
        }
    }

    // 处理各类事件
    handleEvents() {
        // 鼠标移动到轮播盒上时继续轮播
        this.lbBox.addEventListener('mouseleave', this.start.bind(this), {passive: true});
        // 鼠标从轮播盒上移开时暂停轮播
        this.lbBox.addEventListener('mouseover', this.pause.bind(this), {passive: true});

        // 点击左侧控件向右滑动图片
        this.lbCtrlL.addEventListener('click', this.clickCtrl.bind(this));
        // 点击右侧控件向左滑动图片
        this.lbCtrlR.addEventListener('click', this.clickCtrl.bind(this));

        // 点击轮播标志后滑动到对应的图片
        for (let i = 0; i < this.lbSigns.length; i++) {
            this.lbSigns[i].setAttribute('slide-to', i);
            this.lbSigns[i].addEventListener('click', this.clickSign.bind(this));
        }

        // 监听键盘事件
        if (this.moniterKeyEvent) {
            document.addEventListener('keydown', this.keyDown.bind(this));
        }

        // 监听屏幕滑动事件
        if (this.moniterTouchEvent) {
            this.lbBox.addEventListener('touchstart', this.touchScreen.bind(this), {passive: true});
            this.lbBox.addEventListener('touchend', this.touchScreen.bind(this), {passive: true});
        }
    }

    /**
     * 滑动图片
     * @param {number} fromIndex
     * @param {number} toIndex
     * @param {string} direction
     */
    slide(fromIndex, toIndex, direction) {
        let fromClass,toClass
        if (direction === 'left') {
            this.lbItems[toIndex].className = "lb-item next";
            fromClass = 'lb-item active left',
                toClass = 'lb-item next left';
        } else {
            this.lbItems[toIndex].className = "lb-item prev";
            fromClass = 'lb-item active right',
                toClass = 'lb-item prev right';
        }
        this.lbSigns[fromIndex].className = "";
        this.lbSigns[toIndex].className = "active";

        setTimeout((() => {
            this.lbItems[fromIndex].className = fromClass;
            this.lbItems[toIndex].className = toClass;
        }).bind(this), 50);

        setTimeout((() => {
            this.lbItems[fromIndex].className = 'lb-item';
            this.lbItems[toIndex].className = 'lb-item active';
            this.status = true;  // 设置为可以滑动
        }).bind(this), this.speed + 50);
    }
}

/**
 * localStorage 包装
 */
class JStorage {
    constructor(name){
        this.name = 'storage';
    }
    //设置缓存
    setItem(params){
        let obj = {
            name:'',
            value:'',
            expires:"",
            startTime:new Date().getTime().toString().substr(0,10) //记录何时将值存入缓存，秒级
        }
        let options = {};
        //将obj和传进来的params合并
        Object.assign(options,obj,params);
        if(options.expires){
            //如果options.expires设置了的话
            //以options.name为key，options为值放进去
            localStorage.setItem(options.name,JSON.stringify(options));
        }else{
            //如果options.expires没有设置，就判断一下value的类型
            let type = Object.prototype.toString.call(options.value);
            //如果value是对象或者数组对象的类型，就先用JSON.stringify转一下，再存进去
            if(type === '[object Object]'){
                options.value = JSON.stringify(options.value);
            }
            else if(type === '[object Array]'){
                options.value = JSON.stringify(options.value);
            }
            localStorage.setItem(options.name,options.value);
        }
    }
    //拿到缓存
    getItem(name){
        let item = localStorage.getItem(name);
        //先将拿到的试着进行json转为对象的形式
        try{
            item = JSON.parse(item);
        }catch(error){
            //如果不行就不是json的字符串，就直接返回
            return item;
        }
        //如果有startTime的值，说明设置了失效时间
        if(item.startTime){
            let date = new Date().getTime().toString().substr(0,10);
            //何时将值取出减去刚存入的时间，与item.expires比较，如果大于就是过期了，如果小于或等于就还没过期
            if(date - item.startTime > item.expires){
                //缓存过期，清除缓存，返回false
                localStorage.removeItem(name);
                return false;
            }else{
                //缓存未过期，返回值
                return item.value;
            }
        }else{
            //如果没有设置失效时间，直接返回值
            return item;
        }
    }
    //移出缓存
    removeItem(name){
        localStorage.removeItem(name);
    }
    //移出全部缓存
    clear(){
        localStorage.clear();
    }
}

(() => {
    class Joe {
        constructor(options) {
            options = {
                reloadTime: options.reloadTime || 1500
            };
            this.base_url = '/whosurdaddy';
            this.options = options;
            this.video_page = 0;
            this.video_canLoad = true;
            this.wallpaper_page = 0;
            this.wallpaper_cid = '';
            this.global_item = {
                Jheader: query("header.j-header"),
                body: $('body'),
                above: $("header .above"),
                above_nav : $(".above .above-nav"),
                below : $("header .below"),
                color_mode_toggle_btn : $(".js-promo-color-modes-toggle"),
                j_nav_link : $("nav.nav.j-nav a.link")
            };
            this.global_var = {};
            this.init();
        }
        pjax_complete(){
            /* 解除全局绑定事件 */
            $(window).unbind('scroll')
            $(document).unbind('click')
            /* 重新初始化必要事件 */
            this.init()

            this.reinit_head_title() // 恢复title
            jQuery('[data-fancybox="gallery"]').fancybox(); // 重载fancybox
        }
        global_init(){
            /* 解决移动端 hover 问题*/
            $(document).on('touchstart', e => {});
            /* 关闭FancyBox的hash模式 */
            $.fancybox.defaults.hash = false;
            this.init_header();
            this.init_index_titles()
            /* 暗夜模式 */
            this.init_prefer_color_scheme();
            /* 初始化页面的hash值跳转 */
            this.init_url_hash();
            /* 初始化标题 */
            this.init_document_title();
            /* 初始化进度条 */
            this.init_document_progress();
            /* 初始化懒加载 */
            this.init_lazy_load();
            /* 鼠标右键 */
            this.init_document_contextmenu();
            /* 初始化主题色 */
            this.init_document_theme();
            /* 初始化返回顶部 */
            this.init_back_top();
            /* 初始化代码防偷 */
            this.init_document_console();
            /* 初始化天气 */
            this.init_document_weather();
            /* 初始化加载更多 */
            this.init_load_more();
            /* 初始化轮播图 */
            this.init_document_swiper();
            /* 初始化侧边栏人生倒计时 */
            this.init_life_time();
            /* 初始化侧边栏评论 */
            this.init_aside_reply();
            /* 初始化下拉框按钮 */
            this.init_drop_down();
            /* 初始化侧边栏相关 */
            this.init_aside_config();
            /* 初始化登录注册验证 */
            this.init_sign_verify();
            /* 初始化分页的hash值 */
            this.init_pagination_hash();
            /* 初始化移动端搜索按钮点击事件 */
            this.init_wap_search_click();
            /* 初始化搜索框验证 */
            this.init_search_verify();
            /* 初始化移动端搜索标签云 */
            this.init_wap_cloud();
            /* 初始化移动端搜索按钮点击事件 */
            this.init_wap_search();
            /* 初始化移动端侧边栏点击事件 */
            this.init_wap_sidebar();
            /* 初始化动画 */
            this.init_wow();
            /* 初始化tabs */
            this.init_j_tabs();
            /* 初始化collapse */
            this.init_j_collapse();
            /* 初始化底部 mobinav */
            this.init_mobinav()
        }
        post_init(){
            /* 打赏btn初始化 */
            this.reward_init();
            /* 顶部自动隐藏 */
            this.init_head_title();
            /* 初始化代码高亮 */
            this.init_high_light();
            /* 初始化文章内容 */
            this.init_markdown();
            /* 初始化解析 */
            this.init_document_analysis();
            /* 初始化owo标签 */
            this.init_owo();
            /* 初始化回复可见按钮 */
            this.init_replay_see();
            /* 初始化画板功能 */
            this.init_draw();
            /* 初始化赞赏按钮 */
            this.init_admire();
            /* 初始化点赞按钮 */
            this.init_thumbs_up();
            /* 初始化文章生成二维码 */
            this.init_share_code();
            /* 初始化复制按钮 */
            this.init_copy();
            /* 初始化朗读功能 */
            this.init_synth();
            /* 初始化typecho评论 */
            this.init_typecho_comment();
            /* 初始化百度收录 */
            this.init_baidu_collect();
            /* 初始化打字机效果 */
            this.init_typing();
            /* 初始化目录树点击事件 */
            this.init_floor_click();
            /* 初始化回复列表内容 */
            this.init_replay_content();
            /* 初始化评论 */
            this.init_comment();
            /* 初始化密码访问验证 */
            this.init_protect_verify();
            /* 初始化评论提交 */
            this.init_comment_submit();
            /* 初始化评论点赞 */
            this.init_comment_like();
            /* 初始化动态回复 */
            this.init_dynamic_reply();
            /* 初始化视频册 */
            this.init_video_album();
            /* 初始化目录线条 */
            this.init_jfloor();
        }
        page_init(){
            this.post_init()
            /* 初始化 navigation 页面 */
            this.init_navigation();
            /* 初始化归档下拉 */
            this.init_file_toggle();
            /* 初始化留言板 */
            this.init_leaving();
            /* 初始化微语发布 */
            this.init_dynamic_verify();
            /* 初始化视频分类列表 */
            this.init_video_list_type();
            /* 初始化视频列表 */
            this.init_video_list();
            /* 初始化视频搜索 */
            this.init_video_search();
            /* 初始化滚动加载更多视频 */
            this.init_load_more_video();
            /* 初始化加载详情 */
            this.init_video_detail();
            /* 初始化壁纸页 */
            this.init_wallpaper();
            /* 初始化虎牙页 */
            this.init_huya_type();
            /* 初始化虎牙跳转 */
            this.init_huya_skip();
            /* 初始化虎牙分页 */
            this.init_huya_pagination()
        }
        init() {
            /* 初始化图片懒加载 */
            this.global_init()
            if (window.JOE_CONFIG.ARCHIVE === "post"){
                this.post_init()
            }else if(window.JOE_CONFIG.ARCHIVE === "resources"){
                this.init_resource_page()
            }else {
                this.page_init()
            }
        }

        /**
         * reInit func
         */
        reinit_head_title(){
            let post_title = $("#post_top_title")
            post_title.addClass("post_no")
            this.global_item.above.stop(true).show()
            this.global_item.above.css("height","auto")
            this.global_item.above_nav.stop(true).removeClass("post_no")
            this.global_item.below.stop(true).show()
        }
        /* 格式化url参数 */
        changeURLArg(url, arg, arg_val) {
            var pattern = arg + '=([^&]*)';
            var replaceText = arg + '=' + arg_val;
            if (url.match(pattern)) {
                var tmp = '/(' + arg + '=)([^&]*)/gi';
                tmp = url.replace(eval(tmp), replaceText);
                return tmp;
            } else {
                if (url.match('[?]')) {
                    return url + '&' + replaceText;
                } else {
                    return url + '?' + replaceText;
                }
            }
        }
        init_header(){
            this.global_item.j_nav_link.unbind('click').bind('click',function (e) {
                $(this).siblings().removeClass('active')
                $(this).addClass('active')
            })
        }
        init_index_titles(){
            let titles = $('.index-title .titles h2 a')
            if (titles.length === 0 ) return
            titles.unbind('click').bind('click',function (e) {
                e.preventDefault()
                e.stopPropagation()
                let p = $(this).parent()
                p.siblings().removeClass('active')
                p.addClass('active')
                let article_container = $('.j-index-article.article')
                article_container.html('<div style="text-align: center"><img alt="loading" width="50px" height="auto" src="https://cdn.jsdelivr.net/gh/gogobody/Modify_Joe_Theme@4.8.2/assets/img/loading.svg"></div>')
                let href = $(this).attr('href')
                if(href){
                    $.get(href,{},function (res) {
                        let posts_list = $('.j-index-article.article',res)
                        if (posts_list.length > 0){
                            article_container.html(posts_list)
                        }
                    })
                }
            })
        }
        /* 初始化侧栏 */
        init_aside(){
            // load ranking
            if (document.querySelector('.aside.aside-ranking')){
                $.getJSON(`https://the.top/v1/${window.JOE_CONFIG.RANKING_API}/1/9`,{},function (res) {
                    if (res.code === 0){
                        let data = res.data
                        let rank_ele = $('.aside.aside-ranking')
                        rank_ele.find('h3 span').text(window.JOE_CONFIG.RANKING_TITLE)
                        let html_str = ''
                        data.forEach((ele,index)=>{
                            html_str += `<li title="${ele.title}"><span>${index + 1}</span><a target='_blank' rel='noopener' href="${ele.url}">${ele.title}</a></li>`
                        })
                        rank_ele.children('ul.list').html(html_str)
                    }
                })
            }
        }
        /* 打赏btn初始化 */
        reward_init(){
            if (!document.querySelector("#div_reward")){
                let item_reward = document.querySelector(".handle .item-reward")
                if(item_reward!==null){
                    item_reward.style.display="none"
                }
            }
        }
        /* 初始化页面的hash值跳转 */
        init_url_hash() {
            let p = new URLSearchParams(location.search);
            if (p.get('jscroll') && $('#' + p.get('jscroll')).length > 0) {
                let timer = setTimeout(() => {
                    window.scroll({
                        top: $('#' + p.get('jscroll')).offset().top - ($('.j-header').height() + 20),
                        behavior: 'smooth'
                    });
                    clearTimeout(timer);
                }, 300);
            }
        }

        /* 初始化网站切换标题 */
        init_document_title() {
            if (window.JOE_CONFIG.DOCUMENT_TITLE === '' || window.JOE_CONFIG.IS_MOBILE === 'on') return;
            const DOCUMENT_TITLE = document.title;
            $(document).on('visibilitychange', function () {
                if (document.visibilityState === 'hidden') {
                    document.title = window.JOE_CONFIG.DOCUMENT_TITLE;
                } else {
                    document.title = DOCUMENT_TITLE;
                }
            });
        }

        /* 初始化进度条 */
        init_document_progress() {
            if (window.JOE_CONFIG.DOCUMENT_PROGRESS === 'off') return;
            let calcProgress = () => {
                let scrollTop = $(window).scrollTop();
                let documentHeight = $(document).height();
                let windowHeight = $(window).height();
                let progress = parseInt((scrollTop / (documentHeight - windowHeight)) * 100);
                if (progress < 0) progress = 0;
                if (progress > 100) progress = 100;
                $('#progress').css('width', progress + '%');
            };
            calcProgress();
            $(window).on('scroll', () => calcProgress());
        }

        /* 鼠标右键 */
        init_document_contextmenu() {
            if (window.JOE_CONFIG.DOCUMENT_CONTEXTMENU === 'off' || window.JOE_CONFIG.IS_MOBILE === 'on') return;
            $(document).on('contextmenu', () => false);
        }

        /* 初始化主题色 */
        init_document_theme() {
            let themeColor = "#4770db"
            if (window.JOE_CONFIG.DOCUMENT_GLOBAL_THEME === '') {
                $('body').css('--theme', themeColor);
            } else {
                $('body').css('--theme', window.JOE_CONFIG.DOCUMENT_GLOBAL_THEME);
            }
        }

        /* 初始化返回顶部 */
        init_back_top() {
            if (window.JOE_CONFIG.DOCUMENT_BACK_TOP === 'off') return;
            let isShowBackTop = () => {
                if ($(window).scrollTop() > 500) {
                    $('#backToTop').addClass('active');
                } else {
                    $('#backToTop').removeClass('active');
                }
            };
            isShowBackTop();
            $(window).on('scroll', () => isShowBackTop());
            $('#backToTop').unbind('click').bind('click', () => {
                window.scroll({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }


        /* 初始化代码高亮 */
        init_high_light() {
            if (window.JOE_CONFIG.DOCUMENT_HIGHT_LIGHT === 'off') return;
            hljs.initHighlighting.called = false;
            hljs.initHighlighting();
        }

        /* 初始化代码防偷 */
        init_document_console() {
            if (window.JOE_CONFIG.DOCUMENT_CONSOLE === 'off') return;
            function endebug(off, code) {
                if (!off) {
                    !(function (e) {
                        function n(e) {
                            function n() {
                                return u;
                            }
                            function o() {
                                window.Firebug && window.Firebug.chrome && window.Firebug.chrome.isInitialized ? t('on') : ((a = 'off'), console.log(d), console.clear(), t(a));
                            }
                            function t(e) {
                                u !== e && ((u = e), 'function' == typeof c.onchange && c.onchange(e));
                            }
                            function r() {
                                l || ((l = !0), window.removeEventListener('resize', o), clearInterval(f));
                            }
                            'function' == typeof e &&
                                (e = {
                                    onchange: e
                                });
                            var i = (e = e || {}).delay || 500,
                                c = {};
                            c.onchange = e.onchange;
                            var a,
                                d = new Image();
                            d.__defineGetter__('id', function () {
                                a = 'on';
                            });
                            var u = 'unknown';
                            c.getStatus = n;
                            var f = setInterval(o, i);
                            window.addEventListener('resize', o);
                            var l;
                            return (c.free = r), c;
                        }
                        var o = o || {};
                        (o.create = n),
                            'function' == typeof define
                                ? (define.amd || define.cmd) &&
                                  define(function () {
                                      return o;
                                  })
                                : 'undefined' != typeof module && module.exports
                                ? (module.exports = o)
                                : (window.jdetects = o);
                    })(),
                        jdetects.create(function (e) {
                            var a = 0;
                            var n = setInterval(function () {
                                if ('on' === e) {
                                    setTimeout(function () {
                                        if (a === 0) {
                                            a = 1;
                                            setTimeout(code);
                                        }
                                    }, 200);
                                }
                            }, 100);
                        });
                }
            }
            endebug(false, function () {
                window.location.href = window.JOE_CONFIG.THEME_URL + '/console.html';
            });
        }

        /* 初始化天气 */
        init_document_weather() {
            if (window.JOE_CONFIG.DOCUMENT_WEATHER_KEY === '') return;
            window.WIDGET = {
                CONFIG: {
                    layout: 2,
                    width: '220',
                    height: '270',
                    background: window.JOE_CONFIG.DOCUMENT_WEATHER_TYPE === 'auto' ? 1 : 2,
                    dataColor: window.JOE_CONFIG.DOCUMENT_WEATHER_TYPE === 'auto' ? 'ffffff' : '303133',
                    key: window.JOE_CONFIG.DOCUMENT_WEATHER_KEY
                }
            };
            let timer = setTimeout(() => {
                $('.aside-wether .loading').addClass('active');
                clearTimeout(timer);
            }, 1000);
        }

        /* 初始化加载更多 */
        init_load_more() {
            if (window.JOE_CONFIG.DOCUMENT_LOAD_MORE !== 'ajax') return;
            let _this = this;
            let jloadmore_a = $('.j-loadmore a')
            jloadmore_a.attr('data-href', jloadmore_a.attr('href'));
            jloadmore_a.removeAttr('href');
            jloadmore_a.unbind('click').bind('click', function () {
                if ($(this).attr('disabled')) return;
                $(this).html('loading...');
                $(this).attr('disabled', true);
                let url = $(this).attr('data-href');
                if (!url) return;
                $.ajax({
                    url: url,
                    type: 'get',
                    success: data => {
                        $(this).removeAttr('disabled');
                        $(this).html('查看更多');
                        let list
                        if(window.JOE_CONFIG.ARCHIVE === "resources"){
                            list = $(data).find('.article .posts-wrapper>.post');
                            $('.article .posts-wrapper').append(list);
                        }else{
                            list = $(data).find('.article-list:not(.sticky)');
                            $('.j-index-article.article').append(list);
                        }
                        if (list.length > 0){
                            window.scroll({
                                top: $(list).first().offset().top - ($('.j-header').height() + 20),
                                behavior: 'smooth'
                            });
                        }

                        let newURL = $(data).find('.j-loadmore a').attr('href');
                        if (newURL) {
                            $(this).attr('data-href', newURL);
                        } else {
                            $('.j-loadmore').remove();
                        }
                        // _this.init_lazy_load();
                    }
                });
            });
        }

        /* 初始化轮播图 */
        init_document_swiper() {
            if (window.JOE_CONFIG.DOCUMENT_SWIPER === 'off') return;
            const options = {
                id: 'lb-1',              // 轮播盒ID
                speed: 1000,              // 轮播速度(ms)
                delay: 5000,             // 轮播延迟(ms)
                direction: 'left',       // 图片滑动方向
                moniterKeyEvent: true,   // 是否监听键盘事件
                moniterTouchEvent: true  // 是否监听屏幕滑动事件
            }
            if (!document.querySelector('#lb-1')) return;
            const lb = new Lb(options);
            lb.pause();
        }

        /* 初始化解析 */
        init_document_analysis() {
            if ($('#j-video').length === 0) return;
            let j_dplayer = $('#j-dplayer')
            let jv_li = $('#j-video .episodes ul li')
            j_dplayer.attr('src', j_dplayer.attr('data-src') + jv_li.first().attr('data-url'));
            jv_li.first().addClass('active');
            $('#j-video .player-box .title span').html('正在播放：' + $('#j-video .episodes ul li span').first().html());
            jv_li.unbind('click').bind('click', function () {
                jv_li.removeClass('active');
                $(this).addClass('active');
                j_dplayer.attr('src', j_dplayer.attr('data-src') + $(this).attr('data-url'));
                $('#j-video .player-box .title span').html('正在播放：' + $(this).find('span').html());
            });
        }

        /* 初始化owo标签 */
        init_owo() {
            if ($('#OwO_Container').length === 0) return;
            new OwO({
                logo: 'OωO表情',
                container: document.getElementsByClassName('OwO')[0],
                target: document.getElementsByClassName('OwO-textarea')[0],
                api: window.JOE_CONFIG.THEME_URL + '/OwO.json',
                position: 'down',
                width: '100%',
                maxHeight: '250px'
            });

            $(document).bind('click', function () {
                $('.OwO').removeClass('OwO-open');
            });
        }
        /* 初始化回复可见按钮 */
        init_replay_see() {
            $('.need-reply span').unbind('click').bind('click', function () {
                let id = $(this).attr('data-href');
                window.scrollTo({
                    top: $('#' + id).offset().top - ($('.j-header').height() + 20),
                    behavior: 'smooth'
                });
            });
        }
        /* 初始化画板功能 */
        init_draw() {
            if ($('#draw').length === 0) return;
            window.sketchpad = new Sketchpad({
                element: '#draw',
                height: 300,
                penSize: 5,
                color: '303133'
            });
            $('#commentTypeContent .undo').unbind('click').bind('click', function () {
                window.sketchpad.undo();
            });
            $('#commentTypeContent .animate').unbind('click').bind('click', function () {
                window.sketchpad.animate(10);
            });
            $('#commentTypeContent .canvas ul li').unbind('click').bind('click', function () {
                window.sketchpad.penSize = $(this).attr('data-line');
                $('#commentTypeContent .canvas ul li').removeClass('active');
                $(this).addClass('active');
            });
            $('#commentTypeContent .canvas ol li').unbind('click').bind('click', function () {
                window.sketchpad.color = $(this).attr('data-color');
                $('#commentTypeContent .canvas ol li').removeClass('active');
                $(this).addClass('active');
            });
        }

        /* 初始化赞赏按钮 */
        init_admire() {
            $('#j-admire').unbind('click').bind('click', function () {
                $('.j-admire-modal').addClass('active');
                $('body').css('overflow', 'hidden');
            });
            $('.j-admire-modal .close').unbind('click').bind('click', function () {
                $('.j-admire-modal').removeClass('active');
                $('body').css('overflow', '');
            });
        }

        /* 初始化点赞按钮 */
        init_thumbs_up() {
            $('#j-thumbs-up').unbind('click').bind('click', function () {
                if ($(this).attr('disabled')) {
                    return $.toast({
                        type: 'warning',
                        message: '本篇文章您已经赞过~'
                    });
                }
                $(this).find("span").html("loading...")
                $.ajax({
                    type: 'post',
                    url: $(this).attr('data-url'),
                    data: 'agree=' + $(this).attr('data-cid'),
                    timeout: 30000,
                    cache: false,
                    success: function (data) {
                        let reg = /\d/;
                        if (reg.test(data)) $('#j-thumbs-up span').html('赞 · ' + data.trim());
                        $.toast({
                            type: 'success',
                            message: '感谢您的点赞！'
                        });
                        $('#j-thumbs-up').attr('disabled', 'disabled');
                    }
                });
            });
        }

        /* 初始化文章生成二维码 */
        init_share_code() {
            let sharecode = $('#j-share-code')
            if (sharecode.length === 0) return;
            sharecode.qrcode({
                render: 'canvas',
                width: 90,
                height: 90,
                text: encodeURI(window.location.href),
                background: '#ffffff',
                foreground: '#000000',
                correctLevel: 0
            });
        }

        /* 初始化复制按钮 */
        init_copy() {
            let c_input = $('#copyInput')
            $('.j-copy').unbind('click').bind('click', function (e) {
                e.preventDefault();
                $('body').append(`<input id="copyInput" value="${$(this).attr('data-copy')}"/>`);
                c_input.select();
                document.execCommand('copy');
                $.toast({
                    type: 'success',
                    message: '已复制到剪切板中~'
                });
                c_input.remove();
            });
        }

        /* 初始化朗读功能 */
        init_synth() {
            let v_read = $('#read')
            if (!window.speechSynthesis) return v_read.remove();
            v_read.unbind('click').bind('click', function () {
                const synth = window.speechSynthesis;
                const msg = new SpeechSynthesisUtterance();
                if ($(this).find('span').html() === '朗读') {
                    msg.lang = 'zh-CN';
                    msg.text = $('#markdown').text();
                    synth.speak(msg);
                    $(this).find('span').html('停止朗读');
                } else {
                    synth.cancel(msg);
                    $(this).find('span').html('朗读');
                }
            });
        }

        /* 初始化typecho评论 */
        init_typecho_comment() {
            window.TypechoComment = {
                dom: function (id) {
                    return document.getElementById(id);
                },
                create: function (tag, attr) {
                    var el = document.createElement(tag);
                    for (var key in attr) {
                        el.setAttribute(key, attr[key]);
                    }
                    return el;
                },
                reply: function (cid, coid) {
                    var comment = this.dom(cid),
                        parent = comment.parentNode,
                        response = this.dom($('.j-comment').attr('data-respondid')),
                        input = this.dom('comment-parent'),
                        form = 'form' === response.tagName ? response : response.getElementsByTagName('form')[0],
                        textarea = response.getElementsByTagName('textarea')[0];
                    if (null == input) {
                        input = this.create('input', {
                            type: 'hidden',
                            name: 'parent',
                            id: 'comment-parent'
                        });
                        form.appendChild(input);
                    }
                    input.setAttribute('value', coid);
                    if (null == this.dom('comment-form-place-holder')) {
                        var holder = this.create('div', {
                            id: 'comment-form-place-holder'
                        });
                        response.parentNode.insertBefore(holder, response);
                    }
                    if ($(comment).find(response).length === 0) {
                        comment.appendChild(response);
                    }
                    this.dom('cancel-comment-reply-link').style.display = '';
                    if (null != textarea && 'text' === textarea.name) {
                        window.scroll({
                            top: $('#li-' + cid).offset().top - ($('.j-header').height() + 20),
                            behavior: 'smooth'
                        });
                    }
                    return false;
                },
                cancelReply: function () {
                    var response = this.dom($('.j-comment').attr('data-respondid')),
                        holder = this.dom('comment-form-place-holder'),
                        input = this.dom('comment-parent');
                    if (null != input) {
                        input.parentNode.removeChild(input);
                    }
                    if (null == holder) {
                        return true;
                    }
                    this.dom('cancel-comment-reply-link').style.display = 'none';
                    holder.parentNode.insertBefore(response, holder);
                    window.scroll({
                        top: $('#comments').offset().top - ($('.j-header').height() + 20),
                        behavior: 'smooth'
                    });
                    return false;
                }
            };
        }

        /* 初始化文章内的链接为新窗口打开 */
        init_markdown() {
            /* 设置a标签为新窗口打开 */
            $('#markdown a:not(a[no-target])').attr({
                target: '_blank'
            });

            /* 增加预览功能 */
            $('#markdown img:not(img.owo)').each(function () {
                let element = document.createElement('a');
                $(element).attr('data-fancybox', 'gallery');
                $(element).attr('href', $(this).attr('data-src') || $(this).attr('src'));
                $(this).wrap(element);
            });
            let code_hljs = $('code.hljs')
            code_hljs.parent().addClass('hljs-pre');
            code_hljs.each(function () {
                $(this).html('<ol><li>' + $(this).html().replace(/\n/g, '\n</li><li>') + '\n</li></ol>');
            });
        }

        /* 初始化百度收录 */
        init_baidu_collect() {
            let baidu = $('#baiduIncluded')
            if (baidu.length === 0) return;
            $.ajax({
                url: window.JOE_CONFIG.THEME_URL + '/baiduRecord.php?url=' + encodeURI(window.location.href),
                method: 'get',
                success(res) {
                    if (!res.success) {
                        baidu.html('查询失败');
                        baidu.css('color', '#f56c6c');
                    } else if (res.data.baidu === '未收录') {
                        if (window.JOE_CONFIG.DOCUMENT_BAIDU_TOKEN === '') {
                            baidu.html(`<a target="_blank" rel="noopener" href="https://ziyuan.baidu.com/linksubmit/url?sitename=${encodeURI(window.location.href)}">未收录，去提交</a>`);
                        } else {
                            $.ajax({
                                url: window.JOE_CONFIG.THEME_URL + '/baiduPush.php?urls=' + encodeURI(window.location.href),
                                method: 'get',
                                dataType: 'json',
                                data: {
                                    token: window.JOE_CONFIG.DOCUMENT_BAIDU_TOKEN,
                                    domain: window.location.hostname
                                },
                                success: res => {
                                    let obj = {
                                        'site error': '站点未验证！',
                                        'empty content': '内容为空！',
                                        'only 2000 urls are allowed once': '超过限制！',
                                        'over quota': '今日提交已上限'
                                    };
                                    if (res.success) {
                                        baidu.css('color', '#3bca72');
                                        baidu.html('推送成功');
                                    } else {
                                        baidu.css('color', '#e6a23c');
                                        if (res.error === 401) {
                                            baidu.html('Token错误！');
                                        } else if (res.error === 400) {
                                            baidu.html(obj[res.message] || '未知错误');
                                        } else if (res.error === 404) {
                                            baidu.html('地址错误！');
                                        } else {
                                            baidu.html('服务异常！');
                                        }
                                    }
                                }
                            });
                        }
                    } else {
                        baidu.html('百度已收录');
                        baidu.css('color', '#3bca72');
                    }
                }
            });
        }

        /* 初始化打字机效果 */
        init_typing() {
            $('.j-typing').each(function (index, item) {
                $(item).show();
                $(item).css('opacity', 1);
                let htmlStr = $(item).html();
                let timer = null;
                let i = 0;
                let typing = () => {
                    if (i <= htmlStr.length) {
                        $(item).html(htmlStr.slice(0, i++) + '_');
                        timer = setTimeout(typing, 100);
                    } else {
                        $(item).html(htmlStr);
                        clearTimeout(timer);
                    }
                };
                typing();
            });
        }

        /* 初始化侧边栏人生倒计时 */
        init_life_time() {
            function getAsideLifeTime() {
                /* 当前时间戳 */
                let nowDate = +new Date();
                /* 今天开始时间戳 */
                let todayStartDate = new Date(new Date().toLocaleDateString()).getTime();
                /* 今天已经过去的时间 */
                let todayPassHours = (nowDate - todayStartDate) / 1000 / 60 / 60;
                /* 今天已经过去的时间比 */
                let todayPassHoursPercent = (todayPassHours / 24) * 100;
                $('#dayProgress .title span').html(parseInt(todayPassHours));
                $('#dayProgress .progress .progress-inner').css('width', parseInt(todayPassHoursPercent) + '%');
                $('#dayProgress .progress .progress-percentage').html(parseInt(todayPassHoursPercent) + '%');
                /* 当前周几 */
                let weeks = {
                    0: 7,
                    1: 1,
                    2: 2,
                    3: 3,
                    4: 4,
                    5: 5,
                    6: 6
                };
                let weekDay = weeks[new Date().getDay()];
                let weekDayPassPercent = (weekDay / 7) * 100;
                $('#weekProgress .title span').html(weekDay);
                $('#weekProgress .progress .progress-inner').css('width', parseInt(weekDayPassPercent) + '%');
                $('#weekProgress .progress .progress-percentage').html(parseInt(weekDayPassPercent) + '%');
                let year = new Date().getFullYear();
                let date = new Date().getDate();
                let month = new Date().getMonth() + 1;
                let monthAll = new Date(year, month, 0).getDate();
                let monthPassPercent = (date / monthAll) * 100;
                $('#monthProgress .title span').html(date);
                $('#monthProgress .progress .progress-inner').css('width', parseInt(monthPassPercent) + '%');
                $('#monthProgress .progress .progress-percentage').html(parseInt(monthPassPercent) + '%');
                let yearPass = (month / 12) * 100;
                $('#yearProgress .title span').html(month);
                $('#yearProgress .progress .progress-inner').css('width', parseInt(yearPass) + '%');
                $('#yearProgress .progress .progress-percentage').html(parseInt(yearPass) + '%');
            }
            getAsideLifeTime();
            setInterval(() => {
                getAsideLifeTime();
            }, 1000);
        }

        /* 初始化侧边栏评论 */
        init_aside_reply() {
            $('#asideReply a').each(function (i, item) {
                let str = $(item).html();
                if (/\{!\{.*/.test(str)) {
                    $(item).html('# 图片回复');
                } else {
                    $(item).html(str);
                }
                $(item).css('display', '-webkit-box');
                if (!$(item).attr('href').includes('#')) return;
                $(item).attr('href', $(item).attr('href').replace('#', '?jscroll='));
            });
        }

        /* 初始化归档下拉 */
        init_file_toggle() {
            let jf_panel = $('.j-file .panel')
            jf_panel.first().next().slideToggle(0);
            jf_panel.unbind('click').bind('click', function () {
                let next = $(this).next();
                next.slideToggle(200);
                $('.j-file .panel-body').not(next).slideUp();
            });
        }

        /* 初始化目录树点击事件 */
        init_floor_click() {
            if (window.JOE_CONFIG.IS_MOBILE === 'on') return;
            $('.j-floor a').unbind('click').bind('click', function (e) {
                e.preventDefault();
                window.scroll({
                    top: $($(this).attr('data-href')).offset().top - ($('.j-header').height() + 20),
                    behavior: 'smooth'
                });
            });
        }

        /* 初始化下拉框按钮 */
        init_drop_down() {
            $('.j-drop').unbind('click').bind('click', function (e) {
                e.stopPropagation();
                if ($(this).siblings('.j-dropdown').hasClass('active')) {
                    $(this).siblings('.j-dropdown').removeClass('active');
                } else {
                    $('.j-dropdown').removeClass('active');
                    $(this).siblings('.j-dropdown').addClass('active');
                }
            });
            $(document).bind('click', e => $('.j-dropdown').removeClass('active'));
            $('.j-dropdown[stop-propagation]').unbind('click').bind('click', function (e) {
                e.stopPropagation();
            });
        }

        /* 初始化侧边栏相关 */
        init_aside_config() {
            let j_aside = $('.j-aside')
            let j_header = $('.j-header')
            let asideWidth = j_aside.width();
            if (asideWidth > 0) {
                $('.j-stretch').addClass('active');
                j_aside.css('width', asideWidth);
            }
            $('.j-aside .aside')
                .last()
                .css('top', j_header.height() + 20);
            $('.j-floor .contain').css('top', j_header.height() + 20);
            let j_stretch_c = $('.j-stretch .contain')
            j_stretch_c.css('top', j_header.height() + 20);
            j_stretch_c.unbind('click').bind('click', function () {
                /* 设置侧边栏宽度 */
                if (j_aside.width() === 0) {
                    j_aside.css('width', asideWidth);
                    j_aside.css('overflow', '');
                } else {
                    j_aside.css('width', 0);
                    j_aside.css('overflow', 'hidden');
                }
                $("#commentType button[data-type='text']").click();
            });
            this.init_aside()
        }

        /* 初始化登录注册验证 */
        init_sign_verify() {
            $('#loginForm').off('submit').on('submit', function (e) {
                if ($('#loginForm .username').val().trim() === '') {
                    e.preventDefault();
                    return $.toast({
                        type: 'warning',
                        message: '请输入用户名！'
                    });
                }
                if ($('#loginForm .password').val().trim() === '') {
                    e.preventDefault();
                    return $.toast({
                        type: 'warning',
                        message: '请输入密码！'
                    });
                }
            });
            $('#registerForm').off('submit').on('submit', function (e) {
                if ($('#registerForm .username').val().trim() === '') {
                    e.preventDefault();
                    return $.toast({
                        type: 'warning',
                        message: '请输入用户名！'
                    });
                }
                if ($('#registerForm .mail').val().trim() === '') {
                    e.preventDefault();
                    return $.toast({
                        type: 'warning',
                        message: '请输入邮箱！'
                    });
                }
                if (!/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test($('#registerForm .mail').val())) {
                    e.preventDefault();
                    return $.toast({
                        type: 'warning',
                        message: '请输入正确的邮箱！'
                    });
                }
            });
        }

        /* 初始化分页的hash值 */
        init_pagination_hash() {
            $('.j-pagination a').each((i, item) => {
                if (!$(item).attr('href')) return;
                if (!$(item).attr('href').includes('#')) return;
                $(item).attr('href', $(item).attr('href').replace('#', '?jscroll='));
            });
        }

        /* 初始化回复列表内容 */
        init_replay_content() {
            $('.replyContent p').each(function (i, item) {
                let str = $(item).html();
                if (!/\{!\{.*\}!\}/.test(str)) return;
                str = str.replace(/{!{/, '').replace(/}!}/, '');
                $(item).html('<img class="canvas" src="' + str + '" />');
            });
            $('.replyContent').show();
        }

        /* 初始化评论 */
        init_comment() {
            $('#commentType button').unbind('click').bind('click', function () {
                $('#commentType button').removeClass('active');
                $(this).addClass('active');
                let c_canvas = $('#commentTypeContent .canvas')
                if ($(this).attr('data-type') === 'canvas') {
                    // 禁止乱画
                    $.getJSON(window.JOE_CONFIG.THEME_URL+'/assets/json/sketchpad.json',{},function (res) {
                        window.sketchpad.strokes = res.strokes
                        window.sketchpad.animate(10)
                    })
                    // end
                    $('#draw').prop('width', $('#commentTypeContent').width());
                    $('#commentTypeContent textarea').hide();
                    c_canvas.show();
                    c_canvas.attr('data-type', 'canvas');
                } else {
                    $('#commentTypeContent textarea').show();
                    c_canvas.hide();
                    c_canvas.attr('data-type', 'text');
                }
            });
            $('.comment-list .meta a').unbind('click').bind('click', function () {
                $('#draw').prop('width', $('#commentTypeContent').width());
            });
            $('#cancel-comment-reply-link').unbind('click').bind('click', function () {
                $('#draw').prop('width', $('#commentTypeContent').width());
            });
        }

        /* 初始化留言板 */
        init_leaving() {
            let zIndex = 100;
            function random(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }
            $('#j-leaving li').each(function (i, item) {
                $(item)
                    .find('.body .content p')
                    .each(function (_i, _item) {
                        let str = $(_item).html();
                        if (!/\{!\{.*\}!\}/.test(str)) return;
                        str = str.replace(/{!{/, '').replace(/}!}/, '');
                        $(_item).html('<img class="canvas" src="' + str + '" />');
                    });
                $(item).css({
                    'z-index': random(1, 99),
                    'background-color': `rgba(${random(0, 255)}, ${random(0, 255)}, ${random(0, 255)}, ${random(0.8, 1)})`,
                    top: parseInt(Math.random() * ($('#j-leaving').height() - $(item).height()), 10),
                    left: parseInt(Math.random() * ($('#j-leaving').width() - $(item).width()), 10),
                    display: 'flex'
                });
                $(item).draggabilly({ containment: true });
                $(item).on('dragStart', function (e) {
                    zIndex++;
                    $(item).css('z-index', zIndex);
                });
            });
        }

        /* 初始化移动端搜索按钮点击事件 */
        init_wap_search_click() {
            $('.j-search-toggle').unbind('click').bind('click', function () {
                $(this).toggleClass('active');
                if ($(this).hasClass('active')) {
                    $('.j-nav').hide();
                    $('.j-search').css('display', 'flex');
                } else {
                    $('.j-nav').css('display', 'flex');
                    $('.j-search').hide();
                }
            });
        }

        /* 初始化搜索框验证 */
        init_search_verify() {
            $('.j-search').off('submit').on('submit', function (e) {
                if ($('.j-search input').val().trim() === '') {
                    e.preventDefault();
                    return $.toast({
                        type: 'warning',
                        message: '请输入搜索内容！'
                    });
                }
            });
        }

        /* 初始化密码访问验证 */
        init_protect_verify() {
            let _this = this;
            let j_protec = $('#j-protected')
            j_protec.off('submit').on('submit', e => {
                e.preventDefault();
                if (j_protec.find('.pass').val() === '') {
                    return $.toast({
                        type: 'info',
                        message: '请输入访问密码！'
                    });
                }
                let url = j_protec.attr('action');
                $.ajax({
                    url: url,
                    method: 'post',
                    datatype: 'text',
                    data: {
                        protectPassword: j_protec.find('.pass').val(),
                        cid: j_protec.find('.cid').val()
                    },
                    success: res => {
                        let arr = [],
                            str = '';
                        arr = $(res).contents();
                        Array.from(arr).forEach(_ => {
                            if (_.parentNode.className === 'container') str = _;
                        });
                        if (!/TypechoJoeTheme/.test(res)) {
                            $.toast({
                                type: 'warning',
                                message: str.textContent || ''
                            });
                        } else {
                            let url = location.href;
                            url = _this.changeURLArg(url, 'jscroll', 'comments');
                            $.toast({
                                type: 'success',
                                message: '密码正确，即将刷新本页！'
                            });
                            setTimeout(function () {
                                pjax.loadUrl(url)
                            }, _this.options.reloadTime);
                        }
                    }
                });
            });
        }

        /* 初始化微语发布 */
        init_dynamic_verify() {
            let _this = this;
            $('#j-dynamic-form').off('submit').on('submit', function (e) {
                e.preventDefault();
                let btn = $("#j-dynamic-form .form-foot button")
                if ($('#j-dynamic-form-text').val().trim() === '') {
                    return $.toast({
                        type: 'info',
                        message: '请输入发表内容！'
                    });
                }
                if ($(this).attr('data-disabled')) return;
                $(this).attr('data-disabled', true);
                btn.text("发表中...")
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'post',
                    data: $(this).serializeArray(),
                    success: res => {
                        let arr = [],
                            str = '';
                        arr = $(res).contents();
                        Array.from(arr).forEach(_ => {
                            if (_.parentNode.className === 'container') str = _;
                        });
                        if (!/TypechoJoeTheme/.test(res)) {
                            $.toast({
                                type: 'warning',
                                message: str.textContent || ''
                            });
                            $('#j-dynamic-form-text').val('')
                            $(this).removeAttr('data-disabled');
                        } else {
                            let url = location.href;
                            url = _this.changeURLArg(url, 'jscroll', 'comments');
                            $.toast({
                                type: 'success',
                                message: '发表成功！'
                            });
                            setTimeout(function () {
                                pjax.loadUrl(url)
                            }, _this.options.reloadTime);
                        }
                        btn.text("立即发表")
                    },
                    error:res =>{
                        btn.text("立即发表")
                    }
                });
            });
        }

        /* 初始化评论提交 */
        init_comment_submit() {
            let _this = this;
            $('#comment-form').off('submit').on('submit', function (e) {
                e.preventDefault();
                if ($('#comment-nick').val().trim() === '') {
                    return $.toast({
                        type: 'warning',
                        message: '请输入您的昵称！'
                    });
                }
                if (!/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test($('#comment-mail').val())) {
                    return $.toast({
                        type: 'warning',
                        message: '请输入正确的邮箱！'
                    });
                }
                let commen_con = $('#comment-content')
                if ($('#commentTypeContent .canvas').attr('data-type') === 'canvas') {
                    return $.toast({
                        type: 'warning',
                        message: '管理员禁止画图~'
                    });
                    // let url = $('#draw')[0].toDataURL('image/webp', 0.1);
                    // commen_con.val('{!{' + url + '}!} ');
                }
                if (commen_con.val().trim() === '') {
                    return $.toast({
                        type: 'warning',
                        message: '请输入评论内容！'
                    });
                }
                if ($(this).attr('data-disabled')) return;
                $(this).attr('data-disabled', true);
                $(this).find("button[type='submit']").html('请等待...')
                let c_btn = $(".comment-btn")
                c_btn.text('评论中..')
                // console.log($(this).attr('action'))
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'post',
                    data: $(this).serializeArray(),
                    success: res => {
                        let arr = [],
                            str = '';
                        arr = $(res).contents();
                        Array.from(arr).forEach(_ => {
                            if (_.parentNode.className === 'container') str = _;
                        });
                        if (!/TypechoJoeTheme/.test(res)) {
                            $.toast({
                                type: 'warning',
                                message: str.textContent || ''
                            });
                            $(this).removeAttr('data-disabled');
                            commen_con.val('')
                            $(this).find("button[type='submit']").html('发表评论')
                        } else {
                            let url = location.href;
                            url = _this.changeURLArg(url, 'jscroll', 'comments');
                            $.toast({
                                type: 'success',
                                message: '发送成功，即将刷新本页！'
                            });
                            setTimeout(function () {
                                pjax.loadUrl(url)
                            }, _this.options.reloadTime);
                        }
                        c_btn.text('发表评论')
                    },
                    error:res=>{
                        console.log($(res))
                        $.toast({
                            type: 'warning',
                            message: '发生未知错误'
                        });
                        $(this).removeAttr('data-disabled');
                        commen_con.val('')
                        c_btn.text('发表评论')
                    }
                });

            });
        }

        /* 初始化移动端搜索标签云 */
        init_wap_cloud() {
            let random = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min;
            $('#search-cloud a').each((i, item) => {
                $(item).css('background', `rgba(${random(0, 255)}, ${random(0, 255)}, ${random(0, 255)}, ${random(0.8, 1)})`);
            });
        }

        /* 初始化移动端搜索点击事件 */
        init_wap_search() {
            $('.search-toggle-xs').unbind('click').bind('click', function () {
                $('.j-slide').removeClass('active');
                $('.j-sidebar-xs').removeClass('active');
                let js_down_xs = $('.j-search-down-xs')
                js_down_xs.toggleClass('active');
                if (js_down_xs.hasClass('active')) {
                    $('body').css('overflow', 'hidden');
                    $('.j-header').css('box-shadow', 'none');
                } else {
                    $('body').css('overflow', '');
                    $('.j-header').css('box-shadow', '');
                }
            });
            $('.j-search-down-xs .mask').unbind('click').bind('click', function () {
                $('.j-search-down-xs').removeClass('active');
                $('body').css('overflow', '');
                $('.j-header').css('box-shadow', '');
            });
        }

        /* 初始化移动端侧边栏点击事件 */
        init_wap_sidebar() {
            let that = this
            $('.j-slide').unbind('click').bind('click', function (e) {
                $('.j-search-down-xs').removeClass('active');
                that.global_item.body.css('overflow', '');
                $('.j-header').css('box-shadow', '');
                $(this).toggleClass('active');
                $('.j-sidebar-xs').toggleClass('active');
                if ($(this).hasClass('active')) {
                    that.global_item.body.css('overflow', 'hidden');
                } else {
                    that.global_item.body.css('overflow', '');
                }
            });
            $('.j-sidebar-xs .mask').unbind('click').bind('click', function () {
                $('.j-slide').removeClass('active');
                $('.j-sidebar-xs').removeClass('active');
                that.global_item.body.css('overflow', '');
            });

            $('.j-sidebar-xs .item ul li a').unbind('click').bind('click',function (ev) {
                let c = $(this);
                c.parent().siblings(".active").toggleClass("active")
                if(c.next().is("ul")){
                    if (c.parent().toggleClass("active") && ev.preventDefault())
                    return false;
                }else {
                    $('.j-slide').removeClass('active');
                    $('.j-sidebar-xs').removeClass('active');
                    that.global_item.body.css('overflow', '');
                }
            })
        }

        /* 初始化动画 */
        init_wow() {
            if (window.JOE_CONFIG.IS_MOBILE === 'on' && window.JOE_CONFIG.DOCUMENT_WAP_ANIMATION === 'off') return;
            if (window.JOE_CONFIG.IS_MOBILE === 'off' && window.JOE_CONFIG.DOCUMENT_PC_ANIMATION === 'off') return;
            var wow = new WOW({
                boxClass: 'wow',
                animateClass: 'animated',
                offset: 0,
                mobile: true,
                live: true,
                scrollContainer: null
            });
            wow.init();
        }

        /* 初始化视频分类列表 */
        init_video_list_type() {
            if ($('#j-video-type').length === 0) return;
            if (window.JOE_CONFIG.VIDEO_LIST_API === '')
                return $.toast({
                    type: 'warning',
                    message: '苹果CMS API未填写！'
                });
            $('.j-video-load-1').show();
            $.ajax({
                url: window.JOE_CONFIG.VIDEO_LIST_API,
                method: 'get',
                data: {
                    ac: 'list',
                    at: 'json'
                },
                dataType: 'json',
                success: res => {
                    if (res.code !== 1)
                        return $.toast({
                            type: 'warning',
                            message: '获取列表失败！'
                        });
                    $('.j-video-load-1').hide();
                    let htmlStr = '<li class="active">全部</li>';
                    let arr = window.JOE_CONFIG.VIDEO_LIST_SHIELD.split('||');
                    let shieldArr = arr.map(_ => _.trim());
                    res.class.forEach(_ => {
                        if (!shieldArr.some(item => item === _.type_name)) htmlStr += `<li data-id="${_.type_id}">${_.type_name}</li>`;
                    });
                    $('#j-video-type').html(htmlStr);
                }
            });
            let _this = this;
            $('#j-video-type li').unbind('click').bind('click',function () {
                $(this).addClass('active').siblings().removeClass('active');
                _this.video_page = 0;
                $('#j-video-list').html('');
                _this.init_video_list($(this).attr('data-id'));
            })
        }

        /* 加载视频列表 */
        init_video_list(t, wd) {
            if ($('#j-video-list').length === 0) return;
            let _this = this;
            if (!_this.video_canLoad) return;
            _this.video_canLoad = false;
            _this.video_page += 1;
            $('.j-video-load-2').show();
            $.ajax({
                url: window.JOE_CONFIG.VIDEO_LIST_API,
                method: 'get',
                data: {
                    pg: _this.video_page,
                    ac: 'videolist',
                    at: 'json',
                    t,
                    wd
                },
                dataType: 'json',
                success: res => {
                    if (res.code !== 1) return;
                    $('.j-video-load-2').hide();
                    let href
                    if(window.location.href.match("[\?]")){
                        href = window.location.href + '&vod_id='
                    }else{
                        href = window.location.href + '?vod_id='
                    }
                    res.list.forEach(_ => {
                        $('#j-video-list').append(`
                                <li>
                                    <a href="${href + _.vod_id}">
                                        <img class="lazyload" src="${window.JOE_CONFIG.DOCUMENT_LAZY_LOAD}" data-src="${_.vod_pic}">
                                        <h2>${_.vod_name}</h2>
                                        ${_.vod_year && _.vod_year !== 0 ? '<i>' + _.vod_year + '</i>' : ''}
                                    </a>
                                </li>
                            `);
                    });
                    // _this.init_lazy_load();
                    _this.video_canLoad = true;
                }
            });
        }

        /* 初始化视频搜索 */
        init_video_search() {
            let _this = this;
            $('#j-video-search button').unbind('click').bind('click', function () {
                if ($('#j-video-search input').val().trim() === '') {
                    return $.toast({
                        type: 'info',
                        message: '请输入内容！'
                    });
                }
                _this.video_page = 0;
                $('#j-video-list').html('');
                _this.init_video_list(null, $('#j-video-search input').val());
            });
        }

        /* 初始化加载更多视频 */
        init_load_more_video() {
            let jvideo_list = $('#j-video-list')
            if (jvideo_list.length === 0) return;
            let _this = this;
            $(window).on('scroll', function () {
                let scrollTop = $(window).scrollTop();
                let windowHeight = $(window).height();
                let videoListHeight = jvideo_list.offset().top + jvideo_list.height();
                if (scrollTop + windowHeight >= videoListHeight) {
                    _this.init_video_list();
                }
            });
        }

        /* 初始化视频详情 */
        init_video_detail() {
            let p = new URLSearchParams(window.location.search);
            let ids = p.get('vod_id');
            if (!ids) return;
            $('.j-video-load-3').show();
            $.ajax({
                url: window.JOE_CONFIG.VIDEO_LIST_API,
                method: 'get',
                data: {
                    ac: 'detail',
                    at: 'json',
                    ids
                },
                dataType: 'json',
                success: res => {
                    if (res.code !== 1 || res.list.length !== 1)
                        return $.toast({
                            type: 'warning',
                            message: '数据获取失败！'
                        });
                    $('.j-video-load-3').hide();
                    let item = res.list[0];
                    /* 详情 */
                    $('#j-video-info').html(`
						<div class="image">
							<img class="lazyload" src="${window.JOE_CONFIG.DOCUMENT_LAZY_LOAD}" alt="${item.vod_name}" data-src="${item.vod_pic}" title="${item.vod_name}">
							${item.vod_year && item.vod_year !== 0 ? '<i>' + item.vod_year + '</i>' : ''}
						</div>
						<dl>
							<dt>${item.vod_name + (item.vod_remarks ? ' - ' + item.vod_remarks : '')}</dt>
							<dd>
								<span>类型：</span>
								<span>${item.vod_class || '未知'}</span>
							</dd>
							<dd>
								<span>主演：</span>
								<span>${item.vod_actor || '未知'}</span>
							</dd>
							<dd>
								<span>导演：</span>
								<span>${item.vod_director || '未知'}</span>
							</dd>
							<dd>
								<span>简介：</span>
								<span>${item.vod_content ? item.vod_content : item.vod_blurb}</span>
							</dd>
						</dl>
					`);
                    // this.init_lazy_load();

                    /* 播放源 */
                    let playFromArr = item.vod_play_from.split('$$$');
                    let playUrlArr = item.vod_play_url.split('$$$');
                    let maps = new Map();
                    playFromArr.forEach((item, index) => {
                        maps.set(item, playUrlArr[index] || []);
                    });
                    function parseObj(str) {
                        let arr = str.split('$');
                        return {
                            name: arr[0] || '',
                            link: arr[1] || ''
                        };
                    }
                    for (var [key, value] of maps) {
                        let arr = value.split('#');
                        let str = '';
                        arr.forEach(item => {
                            str += `
								<li data-link="${parseObj(item).link}">${parseObj(item).name}</li>
							`;
                        });
                        $('#j-video-play').append(`
							<div class="video-list-play">
								<div class="title">源：${key}</div>
								<ul class="list-item">
									${str}
								</ul>
							</div>
						`);
                    }
                    /* 如果没填写解析，则直接中断 */
                    let jv_player = $('#j-video-player iframe')
                    if (!jv_player.attr('data-src') || jv_player.attr('data-src') === '') return;
                    /* 点击切换播放源 */
                    $('.video-list-play .list-item li').unbind('click').bind('click', function () {
                        $('.video-list-play .list-item li').removeClass('active');
                        $(this).addClass('active');
                        jv_player.attr('src', jv_player.attr('data-src') + $(this).attr('data-link'));
                        sessionStorage.setItem('playUrl', $(this).attr('data-link'));
                    });
                    /* 判断是否至少有一项 */
                    let firstLi = $('#j-video-play .video-list-play:first-child .list-item li:first-child');
                    if (firstLi.length === 0) return;
                    /* 刷新页面 */
                    if (sessionStorage.getItem('playUrl')) {
                        let flag = null;
                        $('.video-list-play .list-item li').each((i, item) => {
                            if ($(item).attr('data-link') === sessionStorage.getItem('playUrl')) {
                                $(item).addClass('active');
                                flag = true;
                            }
                        });
                        if (flag === true) {
                            jv_player.attr('src', jv_player.attr('data-src') + sessionStorage.getItem('playUrl'));
                        } else {
                            jv_player.attr('src', jv_player.attr('data-src') + firstLi.attr('data-link'));
                            firstLi.addClass('active');
                        }
                    } else {
                        jv_player.attr('src', jv_player.attr('data-src') + firstLi.attr('data-link'));
                        firstLi.addClass('active');
                    }
                    $('#j-video-player-title').html('正在播放：' + item.vod_name);
                }
            });
        }

        /* 初始化tabs */
        init_j_tabs() {
            $('.j-tabs .nav span').unbind('click').bind('click', function () {
                let panel = $(this).attr('data-panel');
                $(this).addClass('active').siblings().removeClass('active');
                $(this).parents('.j-tabs').find('.content div').hide();
                $(this)
                    .parents('.j-tabs')
                    .find('.content div[data-panel=' + panel + ']')
                    .show();
            });
        }

        /* 初始化collapse */
        init_j_collapse() {
            $('.j-collapse .collapse-head').unbind('click').bind('click', function () {
                let next = $(this).next();
                next.slideToggle(200);
                $('.j-collapse .collapse-body').not(next).slideUp();
            });
        }

        /* 初始化评论点赞 */
        init_comment_like() {
            $('.j-comment-like').unbind('click').bind('click', function () {
                if ($(this).hasClass('active'))
                    return $.toast({
                        type: 'warning',
                        message: '本条评论您已经赞过~'
                    });
                $.ajax({
                    url: window.location.href,
                    type: 'post',
                    data: 'likeup=' + $(this).attr('data-coid'),
                    timeout: 30000,
                    cache: false,
                    success: res => {
                        let reg = /\d/;
                        if (reg.test(res)) $(this).find('span').html(res.trim());
                        $.toast({
                            type: 'success',
                            message: '点赞成功！'
                        });
                        $(this).addClass('active');
                    }
                });
            });
        }

        /* 初始化动态页面回复 */
        init_dynamic_reply() {
            let _this = this;
            let j_d_reply = $('.j-dynamic-reply')
            /* 页面点击关闭所有回复 */
            $(document).on('click', () => j_d_reply.hide());

            /* 点击评论按钮显示隐藏评论区域 */
            $('.j-comment-reply').unbind('click').bind('click', function (e) {
                e.stopPropagation();
                $(this).parents('li').find('.j-dynamic-reply').toggle();
            });

            /* 阻止事件传播 */
            j_d_reply.unbind('click').bind('click', e => e.stopPropagation());

            j_d_reply.off('submit').on('submit', function (e) {
                e.preventDefault();
                if ($(this).find("input[name='author']").val().trim() === '') {
                    return $.toast({
                        type: 'warning',
                        message: '请输入您的昵称！'
                    });
                }
                if (!/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test($(this).find("input[name='mail']").val())) {
                    return $.toast({
                        type: 'warning',
                        message: '请输入正确的邮箱！'
                    });
                }
                let test_area = $(this).find("textarea[name='text']")
                if (test_area.val().trim() === '') {
                    return $.toast({
                        type: 'warning',
                        message: '请输入回复内容！'
                    });
                }
                if ($(this).attr('data-disabled')) return;
                $(this).attr('data-disabled', true);
                $.ajax({
                    url: $('.j-comment-url').val(),
                    type: 'post',
                    data: $(this).serializeArray(),
                    success: res => {
                        let arr = [],
                            str = '';
                        arr = $(res).contents();
                        Array.from(arr).forEach(_ => {
                            if (_.parentNode.className === 'container') str = _;
                        });
                        if (!/TypechoJoeTheme/.test(res)) {
                            $.toast({
                                type: 'warning',
                                message: str.textContent || ''
                            });
                            test_area.val('')
                            $(this).removeAttr('data-disabled');
                        } else {
                            let url = location.href;
                            url = _this.changeURLArg(url, 'jscroll', 'comments');
                            $.toast({
                                type: 'success',
                                message: '发送成功，即将刷新本页！'
                            });
                            setTimeout(function () {
                                pjax.loadUrl(url)
                            }, _this.options.reloadTime);
                        }
                    }
                });
            });
        }

        /* 初始化视频册 */
        init_video_album() {
            function GetVideoPoster(url, frame = 1, scale = 1, definition = 0.5) {
                let video = document.createElement('VIDEO');
                video.setAttribute('src', url);
                video.crossOrigin = '*';
                video.currentTime = frame;
                return new Promise((resolve, reject) => {
                    video.addEventListener('loadeddata', () => {
                        let canvas = document.createElement('canvas');
                        canvas.width = video.videoWidth * scale;
                        canvas.height = video.videoHeight * scale;
                        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                        resolve(canvas.toDataURL('image/webp', definition));
                    });
                });
            }
            $('.j-short-video .inner').each((i, item) => {
                let poster = $(item).attr('data-poster');
                let src = $(item).attr('data-src');
                /* 如果传入字符串图片，则直接显示字符串图片 */
                if (isNaN(poster)) {
                    $(item).css('background-image', 'url(' + poster + ')');
                } else {
                    /* 否则抓取视频帧 */
                    GetVideoPoster(src, poster).then(res => {
                        $(item).css('background-image', 'url(' + res + ')');
                    });
                }
                $(item).unbind('click').bind('click', function () {
                    $('body').css('overflow', 'hidden');
                    $('.j-video-preview').addClass('active');
                    $('.j-video-preview iframe').attr('src', window.JOE_CONFIG.THEME_URL + '/player.php?url=' + src);
                });
            });
            $(".j-video-preview .close").unbind('click').bind('click', function() {
                $('body').css('overflow', '')
                $('.j-video-preview').removeClass('active');
            })
        }
        /* 初始化壁纸分类 */
        init_wallpaper() {
            if ($('#wallpaper-type').length === 0) return;
            $.ajax({
                url: window.JOE_CONFIG.THEME_URL + '/wallpaperApi.php?cid=360tags',
                method: 'get',
                dataType: 'json',
                success: res => {
                    if (res.errno !== '0')
                        return $.toast({
                            type: 'warning',
                            message: '接口异常，请联系开发者！'
                        });
                    $('.j-wallpaper-load-1').hide();
                    let str = '<li data-cid="360new" class="active">最新壁纸</li>';
                    res.data.forEach(_ => {
                        str += `<li data-cid="${_.id}">${_.name}</li>`;
                    });
                    $('#wallpaper-type').html(str);
                    $('#wallpaper-type li').first().click();
                }
            });
            let _this = this;
            $(document).on('click', '#wallpaper-type li', function () {
                $(this).addClass('active').siblings().removeClass('active');
                _this.wallpaper_page = 0;
                _this.wallpaper_cid = $(this).attr('data-cid');
                $('#wallpaper-list').html('');
                _this.init_wallpaper_list();
            });
            $('#wallpaper-load').unbind('click').bind('click', function () {
                _this.wallpaper_page += 1;
                _this.init_wallpaper_list();
            });
        }

        init_wallpaper_list() {
            let _this = this;
            $('.j-wallpaper-load-2').show();
            $.ajax({
                url: window.JOE_CONFIG.THEME_URL + '/wallpaperApi.php',
                data: {
                    cid: _this.wallpaper_cid,
                    start: _this.wallpaper_page * 20,
                    count: 20
                },
                method: 'get',
                dataType: 'json',
                success: res => {
                    $('.j-wallpaper-load-2').hide();
                    if (res.total !== 0) {
                        res.data.forEach(_ => {
                            $('#wallpaper-list').append(`
                                <a class="item" data-fancybox="gallery" href="${_.url}">
                                    <img class="lazyload" src="${window.JOE_CONFIG.DOCUMENT_LAZY_LOAD}" data-src="${_.img_1024_768}" />
                                </a>
                            `);
                        });
                        _this.init_lazy_load();
                    } else {
                        $('#wallpaper-load').remove();
                    }
                }
            });
        }
        /* 初始化虎牙页 */
        init_huya_type() {
            if ($('.huya-list-type').length === 0) return;
            let _this = this;
            $('.huya-list-type .list ul li').unbind('click').bind('click', function () {
                window.location.href = _this.changeURLArg(window.location.href, 'vid', $(this).attr('data-vid'));
            });
        }

        /* 初始化虎牙跳转 */
        init_huya_skip() {
            if ($('.huya-list-go-play').length === 0) return;
            let _this = this;
            $('.huya-list-go-play').unbind('click').bind('click', function () {
                let href = _this.changeURLArg(window.location.href, 'play', $(this).attr('data-href'));
                href = _this.changeURLArg(href, 'title', $(this).attr('data-title'));
                window.open(href);
            });
        }

        /* 初始化虎牙分页 */
        init_huya_pagination() {
            if($(".huya-list-pagination").length === 0) return
            let _this = this;
            $(".huya-list-pagination li").on("click", function() {
                let href = window.location.href
                href = _this.changeURLArg(href, 'pg', $(this).attr('data-pg'));
                window.location.href = href
            })
        }
        /* 初始化图片懒加载 */
        init_lazy_load() {
            //add simple support for background images:
            jQuery('[data-fancybox="gallery"]').fancybox(); // 重载fancybox
        }
        /* 暗夜模式 */
        init_prefer_color_scheme(){
            // 切换按钮
            function set_mode_toggle(e) {
                let t = !0, mode = "dark";
                "true" === e.getAttribute("aria-checked") && (t = !1 , mode = "light")
                    e.setAttribute("aria-checked", String(t))
                change_mode(mode);
            }
            // 改变模式 并设置 cookie
            function change_mode(e) {
                const t = document.querySelector("html[data-color-mode]");
                if (e === "dark") document.cookie = "night=1;path=/";
                else document.cookie = "night=0;path=/"
                t && t.setAttribute("data-color-mode", e)
                return true
            }
            // 获取当前模式
            function get_user_scheme_mode() {
                const e = document.querySelector("html[data-color-mode]");
                if (!e)
                    return;
                const t = e.getAttribute("data-color-mode");
                return "auto" === t ? function() {
                    if (get_sys_scheme_mode("dark"))
                        return "dark";
                    if (get_sys_scheme_mode("light"))
                        return "light";
                }() : t
            }
            // 获取系统模式 先判断 cookie 在获取系统的
            function get_sys_scheme_mode(e) {
                let night = document.cookie.replace(/(?:(?:^|.*;\s*)night\s*\=\s*([^;]*).*$)|^.*$/, "$1")
                if (night){
                    if(night === '0'){
                        return false
                    }else if(night === '1'){
                        return true
                    }
                }else
                return window.matchMedia && window.matchMedia(`(prefers-color-scheme: ${e})`).matches
            }
            !async function() {
                const e = document.querySelector(".js-promo-color-modes-toggle");
                if (e && "auto" === function() {
                    const e = document.querySelector("html[data-color-mode]");
                    if (!e)
                        return;
                    return e.getAttribute("data-color-mode")
                }()) {
                    "dark" === get_user_scheme_mode() && change_mode('dark') && e.setAttribute("aria-checked", "true")
                }
            }()
            !async function() {
                document.querySelector(".js-color-mode-settings") && window.history.replaceState({}, document.title, document.URL.split("?")[0])
            }()
            // 添加点击事件

            if(this.global_item.color_mode_toggle_btn){
                this.global_item.color_mode_toggle_btn.unbind('click').bind('click',function (event) {
                    set_mode_toggle(event.currentTarget)
                });
            }
        }
        /*顶部自动隐藏*/
        init_head_title() {
            if (!document.querySelector("#post_top_title span")){
                return
            }
            let header = this.global_item.Jheader
            let row_above = $(".above")
            let above_nav = $(".above .above-nav")
            let below = $(".below")
            let post_title = $("#post_top_title")
            let canSlideDown = true
            let canSlideUp = true
            let showNav = function(){
                post_title.addClass("post_no")
                above_nav.removeClass("post_no")
                below.slideDown("fast",function (){
                    canSlideDown = true
                })
            }
            let hideNav = function(){
                post_title.removeClass("post_no");
                above_nav.addClass("post_no")
                below.slideUp("normal",function () {
                    canSlideUp = true
                })
            }

            $(document).ready(function() {
                let lastScrollPos = 0
                if(screen.width < 768) {
                    $(window).scroll(function() {
                        let scrollPos = $(window).scrollTop(); //得到滚动的距离
                        if (scrollPos > 395 && scrollPos < 505) return // 防止nav出现触发再次scroll
                        if (scrollPos >= 450) { //比较判断是否fixed
                            if (lastScrollPos > scrollPos && canSlideUp){
                                canSlideDown = false
                                row_above.slideDown("fast",function (){
                                    canSlideDown = true
                                })
                            }
                            else{
                                if (canSlideDown){
                                    canSlideUp = false
                                    row_above.slideUp("normal",function () {
                                        canSlideUp = true
                                    })
                                }
                            }
                        } else {
                            row_above.slideDown("fast",function (){
                                canSlideDown = true
                            })
                        }
                        lastScrollPos = scrollPos
                    })
                }else {
                    let navOffw = header.offsetWidth
                    if (post_title.length > 0 && navOffw > 750) {
                        $(window).scroll(function() {
                            let scrollPos = $(window).scrollTop(); //得到滚动的距离
                            if (scrollPos > 400 && scrollPos < 500) return // 防止nav出现触发再次scroll
                            if (scrollPos >= 450) { //比较判断是否fixed
                                if (lastScrollPos > scrollPos && canSlideUp){ //向上滚动举例超过100
                                    canSlideDown = false
                                    showNav()
                                }
                                else{
                                    if (canSlideDown){
                                        canSlideUp = false
                                        hideNav()
                                    }
                                }
                            } else {
                                showNav()
                            }
                            lastScrollPos = scrollPos
                        })
                    }
                }

            })
        }

        /* 初始化导航 */
        init_navigation(){
            $('#siteNav li.nav-list-item').unbind('click').bind('click', function (e) {
                e.preventDefault();
                $(this).siblings().removeClass('active')
                $(this).addClass('active')
                window.scroll({
                    top: $($(this).children('a').attr('href')).offset().top - ($('.j-header').height() + 20),
                    behavior: 'smooth'
                });
            });
        }
        /* 初始化底部 mobinav */
        init_mobinav(){
            $(".navigation-tab-item").bind('click',function() {
                $(".navigation-tab-item").removeClass("active");
                $(this).addClass("active");
                $(".navigation-tab-overlay").css({
                    left: 25 * $(this).prevAll().length + "%"
                })
            })
            $("#mob_goTop").click(function () {
                $("#backToTop").click()
            })
            let load_mobi = $('#load_mobinav')
            if (load_mobi.hasClass('active')){
                $(".navigation-tab-overlay").css({
                    left: 25 * load_mobi.prevAll().length + "%"
                })
            }
        }
        /* 初始化目录线条 */
        init_jfloor(){
            if ($('#jFloor').length === 0) return false;
            let toc = document.querySelector('#jFloor');
            let tocPath = document.querySelector('#jFloor path');
            let tocItems;
            let TOP_MARGIN = 0,
                BOTTOM_MARGIN = 0;
            let pathLength;
            window.addEventListener('resize', drawPath, false);
            window.addEventListener('scroll', sync, false);
            drawPath();
            function drawPath() {
                tocItems = [].slice.call(toc.querySelectorAll('li'));
                tocItems = tocItems.map(function (item) {
                    let anchor = item.querySelector('a');
                    let target = document.getElementById(anchor.getAttribute('data-href').slice(1));
                    return {
                        listItem: item,
                        anchor: anchor,
                        target: target
                    };
                });
                tocItems = tocItems.filter(function (item) {
                    return !!item.target;
                });
                let path = [];
                let pathIndent;
                tocItems.forEach(function (item, i) {
                    let x = item.anchor.offsetLeft - 5,
                        y = item.anchor.offsetTop,
                        height = item.anchor.offsetHeight;
                    if (i === 0) {
                        path.push('M', x, y, 'L', x, y + height);
                        item.pathStart = 0;
                    } else {
                        if (pathIndent !== x) path.push('L', pathIndent, y);
                        path.push('L', x, y);
                        tocPath.setAttribute('d', path.join(' '));
                        item.pathStart = tocPath.getTotalLength() || 0;
                        path.push('L', x, y + height);
                    }
                    // console.log(i,x,y,pathIndent,path)
                    pathIndent = x;
                    tocPath.setAttribute('d', path.join(' '));
                    item.pathEnd = tocPath.getTotalLength();
                });
                pathLength = tocPath.getTotalLength();
                /* 如果有问题就将下面删除 */
                sync();
            }
            function sync() {
                let windowHeight = window.innerHeight;
                let pathStart = pathLength,
                    pathEnd = 0;
                let visibleItems = 0;
                tocItems.forEach(function (item) {
                    let targetBounds = item.target.getBoundingClientRect();
                    if (targetBounds.bottom > windowHeight * TOP_MARGIN && targetBounds.top < windowHeight * (1 - BOTTOM_MARGIN)) {
                        pathStart = Math.min(item.pathStart, pathStart);
                        pathEnd = Math.max(item.pathEnd, pathEnd);
                        visibleItems += 1;
                        item.listItem.classList.add('visible');
                    } else {
                        item.listItem.classList.remove('visible');
                    }
                });
                if (visibleItems > 0 && pathStart < pathEnd) {
                    tocPath.setAttribute('stroke-dashoffset', '1');
                    tocPath.setAttribute('stroke-dasharray', '1, ' + pathStart + ', ' + (pathEnd - pathStart) + ', ' + pathLength);
                    tocPath.setAttribute('opacity', 1);
                } else {
                    tocPath.setAttribute('opacity', 0);
                }
            }
        }

        /* resources page event init */
        init_resource_page(){
            let category,tag,price,order = null;

            function queryHtml(){
                $.ajax({
                    url:window.location.href,
                    method:'get',
                    data:{
                        'category':category,
                        'tag':tag,
                        'price':price,
                        'order':order
                    },
                    success:function (res) {
                        let res_content = $(".row.posts-wrapper", res).html()
                        $(".row.posts-wrapper").html(res_content)
                    }
                })
            }
            $(".filter-tag.category li a").unbind('click').bind('click',function (e) {
                e.preventDefault()
                category = $(this).data("mid")
                if($(this).hasClass('on')){
                    category = null
                }
                queryHtml()
                $(this).toggleClass('on')
                $(".term-bar .term-title").text($(this).text())
                $(this).parent().siblings('li').find('a').removeClass('on')
            })
            $(".filter-tag.tag li a").unbind('click').bind('click',function (e) {
                e.preventDefault()
                tag = $(this).data("mid")
                if($(this).hasClass('on')){
                    tag = null
                }
                queryHtml()
                $(this).toggleClass('on')
                $(this).parent().siblings('li').find('a').removeClass('on')
            })
            $(".filter-tag.price li a").unbind('click').bind('click',function (e) {
                e.preventDefault()
                price = $(this).data("price")
                queryHtml()
                $(this).addClass('on')
                $(this).parent().siblings('li').find('a').removeClass('on')
            })
            $(".filter-tag.order li a").unbind('click').bind('click',function (e) {
                e.preventDefault()
                order = $(this).data("order")
                queryHtml()
                $(this).addClass('on')
                $(this).parent().siblings('li').find('a').removeClass('on')
            })
        }
    }
    if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
        module.exports = Joe;
    } else {
        window.Joe = Joe;
    }
})();
window.JoeInstance = new Joe({});


