<?php

/**
 * 导航
 *
 * @package custom
 *
 **/

?>

<?php $this->need('public/prevent.php'); ?>
<?php $this->need('public/defend.php'); ?>

<?php
if (isset($_POST['agree'])) {
    if ($_POST['agree'] == $this->cid) {
        exit(agree($this->cid));
    }
    exit('error');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->need('public/head.php'); ?>
</head>

<body>
<?php $this->options->JCustomBodyStart() ?>

<section id="joe">
    <!-- 头部 -->
    <?php $this->need('public/header.php'); ?>


    <!-- 主体 -->
    <section class="container j-index j-navigation">
        <section class="j-adaption">
            <div class="main">
                <div class="d-flex flex-row">
                    <!--s导航-->
                    <div class="nav-sidebar">
                        <nav class="nav">
                            <span class="nav-title">站点导航</span>
                            <ul class="nav-list">
                                <li class="nav-list-item active"><a href="#div-1" class="nav-item active">
                                            <i class="icon iconfont icon-zan"></i> 最多点赞</a></li>
                                <li class="nav-list-item"><a href="#div-2" class="nav-item"><i
                                                class="icon iconfont icon-icon_huaban2"></i> 一周热门</a></li>
                                <li class="nav-list-item"><a href="#div-3" class="nav-item"><i
                                                class="icon iconfont icon-chaoji"></i> 30天热门</a></li>
                                <li class="nav-list-item"><a href="#div-4" class="nav-item"><i
                                                class="icon iconfont icon-fangke"></i> 用户访客</a></li>
                                <li class="nav-list-item"><a href="#div-5" class="nav-item"><i
                                                class="icon iconfont icon-biaoqian"></i> 标签导航</a></li>
                            </ul>

                            <span class="nav-title">关于我们</span>
                            <ul class="nav-list">
                                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                                <?php while ($pages->next()): ?>
                                    <li class="nav-list-item"><a href="<?php $pages->permalink(); ?>" class="nav-item">
                                            <i class="icon iconfont icon-shouye1"></i> <?php $pages->title(); ?>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                                <!--<li class="nav-list-item"><a href="" class="nav-item"><i class="icon iconfont icon-shouye1"></i>  联系我们</a></li>
                                <li class="nav-list-item"><a href="" class="nav-item"><i class="icon iconfont icon-shouye1"></i>  用户协议</a></li>
                                <li class="nav-list-item"><a href="" class="nav-item"><i class="icon iconfont icon-shouye1"></i> 免责声明</a></li> -->
                            </ul>


                        </nav>

                    </div>
                    <!--e导航-->
                    <div class="nav-main">

                        <div class="navlists">

                            <!--点赞排行榜-->
                            <div id="div-1" class="mod-column column-nav resource">
                                    <div class="mod-column-head">
                                        <div class="mod-column-title">点赞排行榜</div>
                                    </div>
                                    <div class="big-mod-column-body">
                                        <ul class="mod-list modnews row">
                                            <?php
                                            $html = null;
                                            $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                                ->select()
                                                ->from('table.contents')
                                                ->where('type = ?', 'post')
                                                ->where('status = ?', 'publish')
                                                ->order('agree', Typecho_Db::SORT_DESC)
                                                ->limit('12')
                                            );
                                            foreach ($counts as $count) {
                                                $ji = null;
                                                $this->widget('Widget_Archive@hots' . $count['cid'], 'pageSize=1&type=post', 'cid=' . $count['cid'])->to($ji);

                                                $likes = $count['agree'];
                                                $created = date('m-d', $ji->created);
                                                $avatar_url = ParseAvatar($ji->author->mail, 1);
                                                $img_url = stcdn(GetRandomThumbnail($ji,1));
                                                if ($ji->fields->video) {
                                                    $stico = '<i class="icon iconfont icon-bofang"></i>';
                                                } else {
                                                    $stico = imgNums($ji->content);
                                                }
                                                $html = $html . '<li class="mod-list-item col-md-3 col-xs-6 col-sm-6 col-6"><div class="feaimg"><a href="' . $ji->permalink . '"><img class="lazyload" src="'.GetLazyLoad().'" data-original="'.$img_url.'"></a><div class="kan-icon">' . $stico . '</div></div><div class="meta"><div class="modnews-title"><a href="' . $ji->permalink . '">' . $ji->title . '</a></div><div class="info"> <img src="' . $avatar_url . '" class="avatar"><span class="scname">' . $ji->author->screenName . '</span><span class="info_r">' . $likes . '人点赞</span></div></div></li>';
                                            }
                                            echo $html;
                                            ?>

                                        </ul>
                                    </div>
                                </div>
                            <!--点赞排行榜-->


                            <!--一周热门-->
                            <div id="div-2" class="mod-column column-nav resource">
                                <div class="mod-column-head">
                                    <div class="mod-column-title">一周热门</div>
                                </div>
                                <div class="big-mod-column-body">
                                    <ul class="mod-list modnews row">
                                        <?php
                                        $period = time() - 604800; // 单位: 秒, 时间范围: 30天
                                        $html = null;
                                        $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                            ->select()
                                            ->from('table.contents')
                                            ->where('created > ?', $period)
                                            ->where('type = ?', 'post')
                                            ->where('status = ?', 'publish')
                                            ->order('views', Typecho_Db::SORT_DESC)
                                            ->limit('12')
                                        );
                                        foreach ($counts as $count) {
                                            $this->widget('Widget_Archive@hots' . $count['cid'], 'pageSize=1&type=post', 'cid=' . $count['cid'])->to($ji);

                                            $created = date('m-d', $ji->created);
                                            $avatar_url = ParseAvatar($ji->author->mail, 1);
                                            $img_url = stcdn(GetRandomThumbnail($ji,1));
                                            if ($ji->fields->video) {
                                                $stico = '<i class="icon iconfont icon-bofang"></i>';
                                            } else {
                                                $stico = imgNums($ji->content);
                                            }
                                            $html = $html . '<li class="mod-list-item col-md-3 col-xs-6 col-sm-6 col-6"><div class="feaimg"><a href="' . $ji->permalink . '"><img class="lazyload" src="'.GetLazyLoad().'" data-original="'.$img_url.'"></a><div class="kan-icon">' . $stico . '</div></div><div class="meta"><div class="modnews-title"><a href="' . $ji->permalink . '">' . $ji->title . '</a></div><div class="info"><img src="' . $avatar_url . '" class="avatar"><span class="scname">' . $ji->author->screenName . '</span><span class="info_r">' . $created . ' </span></div></div></li>';
                                        }
                                        echo $html;
                                        ?>

                                    </ul>
                                </div>
                            </div>
                            <!--一周热门-->

                            <!--30天热门-->
                            <div id="div-3" class="mod-column column-nav resource">
                                <div class="mod-column-head">
                                    <div class="mod-column-title">30天热门</div>
                                </div>
                                <div class="big-mod-column-body">
                                    <ul class="mod-list modnews row">

                                        <?php
                                        $period = time() - 2592000; // 单位: 秒, 时间范围: 30天
                                        $htmls = null;
                                        $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                            ->select()
                                            ->from('table.contents')
                                            ->where('created > ?', $period)
                                            ->where('type = ?', 'post')
                                            ->where('status = ?', 'publish')
                                            ->order('views', Typecho_Db::SORT_DESC)
                                            ->limit('12')
                                        );
                                        foreach ($counts as $count) {
                                            $jis = null;
                                            $this->widget('Widget_Archive@hotss' . $count['cid'], 'pageSize=1&type=post', 'cid=' . $count['cid'])->to($jis);
                                            $views = $count['views'];
                                            $created = date('m-d', $jis->created);
                                            $img_url = stcdn(GetRandomThumbnail($jis,1));
                                            if ($jis->fields->video) {
                                                $stico = '<i class="icon iconfont icon-bofang"></i>';
                                            } else {
                                                $stico = imgNums($jis->content);
                                            }
                                            $avatar_url = ParseAvatar($jis->author->mail, 1);
                                            $htmls = $htmls . '<li class="mod-list-item col-md-3 col-xs-6 col-sm-6 col-6"><div class="feaimg"><a href="' . $jis->permalink . '"><img class="lazyload" src="'.GetLazyLoad().'" data-original="'.$img_url.'"></a><div class="kan-icon">' . $stico . '</div></div><div class="meta"><div class="modnews-title"><a href="' . $jis->permalink . '">' . $jis->title . '</a></div><div class="info"> <img src="' . $avatar_url . '" class="avatar"><span class="scname">' . $jis->author->screenName . '</span><span class="info_r">' . $views . ' 阅读</span></div></div></li>';
                                        }
                                        echo $htmls;
                                        ?>

                                    </ul>
                                </div>
                            </div>
                            <!--用户访客-->
                            <div id="div-4" class="mod-column column-nav">
                                <div class="mod-column-head">
                                    <div class="mod-column-title">用户访客</div>
                                </div>
                                <div class="mod-column-body">
                                    <ul class="mod-list row">
                                        <?php
                                        $period = time() - 999592000; // 時段: 30 天, 單位: 秒
                                        $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                                            ->select('COUNT(author) AS cnt', 'author', 'authorId', 'mail')
                                            ->from('table.comments')
                                            ->where('created > ?', $period)
                                            ->where('status = ?', 'approved')
                                            ->where('type = ?', 'comment')
                                            ->group('author,authorId,mail')
                                            ->order('cnt', Typecho_Db::SORT_DESC)
                                            ->limit('30')
                                        );
                                        $mostactive = '';
                                        $default_avatar = $this->options->themeUrl('assets/img/default_avatar.png','Typecho-Joe-Theme');
                                        foreach ($counts as $count) {
                                            $avatar_url = ParseAvatar($count['mail'], 1);
                                            if ($count['authorId'] == '0') {
                                                $c_url = '<li class="mod-list-item col-md-3 col-xs-6 col-sm-6 col-6"><a href="' . $this->options->siteUrl . '" target="_blank" >
                                                                <div class="product-image">
                                                                    <img class="lazyload" data-original="' . $avatar_url . '" src="' . $default_avatar . '">
                                                                </div>
                                                                <div class="product-content">
                                                                    <div class="product-title">' . $count['author'] . '</div>';
                                            } else {
                                                $c_url = '<li class="mod-list-item col-md-3 col-xs-6 col-sm-6 col-6"><a href="'. getUserPermalink($count['authorId']) . '" target="_blank" >
                                                                <div class="product-image">
                                                                    <img class="lazyload" data-original="' . $avatar_url . '" src="' . $default_avatar . '">
                                                                </div>
                                                                <div class="product-content">
                                                                    <div class="product-title">' . $count['author'] . '<span class="autlv aut-4 vs">V</span></div>';
                                            }
                                            echo '' . $c_url . '';
                                            echo ' <div class="product-desc">评论 ' . $count['cnt'] . ' 次  ';

                                            echo ' </div></div></a></li>';

                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>


                            <!--标签导航s-->
                            <div id="div-5" class="mod-column column-nav">
                                <div class="mod-column-head">
                                    <div class="mod-column-title">标签导航</div>
                                </div>
                                <div class="mod-column-body">
                                    <ul class="joe-tags">
                                        <?php $this->widget('Widget_Metas_Tag_Cloud', array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true, 'limit' => 65))->to($taglist); ?>
                                        <?php while ($taglist->next()): ?>
                                            <li><a href="<?php $taglist->permalink(); ?>"
                                                   title="<?php $taglist->name(); ?>">#<?php $taglist->name(); ?></a>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                            </div>
                            <!--标签导航e-->


                            <div id="div-6" class="mod-column column-nav"><?php $this->need('public/comment.php'); ?></div>


                        </div>

                        <!--导航结束-->
                    </div>
                </div>
            </div>
<!--            --><?php //$this->need('public/comment.php'); ?>
        </section>
    </section>
    <!-- 尾部 -->
    <?php $this->need('public/footer.php'); ?>
</section>


<!-- 配置文件 -->
<?php $this->need('public/config.php'); ?>
</body>


</html>