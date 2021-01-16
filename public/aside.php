<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;


?>

<div class="j-aside">
    <?php if ($this->options->JAuthorStatus !== 'off') : ?>
        <?php if ($this->is('index')): ?>
        <?php /* 登录了 */ if ($this->user->hasLogin()): ?>
        <div class="aside aside-user">
            <div class="user">
                <img class="lazyload" src="<?php ParseAvatar($this->user->mail); ?>" height="80" width="80" alt=""/>
                <a href="<?php echo getUserPermalink($this->user->uid); ?>"><?php $this->user->screenName();autvip($this->user->mail); ?></a>
                <!-- 座右铭 -->
                <div class="p j-aside-motto"></div>
            </div>
            <div class="webinfo">
                <div class="item" title="累计文章数">
                    <span class="num"><?php echo allpostnum($this->user->uid, 1); ?></span>
                    <span>文章数</span>
                </div>
                <div class="item" title="累计评论数">
                    <span class="num"><?php echo commentnum($this->user->uid); ?></span>
                    <span>评论量</span>
                </div>
            </div>
            <?php $this->widget('Widget_Contents_Post_Recent_User@aside565', 'pageSize=' . $this->options->JAuthorStatus . '&uid=' . $this->user->uid)->to($hot);?>
            <?php if ($hot->have()) : ?>
                <ul class="articles">
                    <?php while ($hot->next()) : ?>
                        <li title="<?php $hot->title(); ?>">
                            <a href="<?php $hot->permalink(); ?>"><?php $hot->title(); ?></a>
                            <svg t="1599802830077" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <path d="M448.12 320.331a30.118 30.118 0 0 1-42.616-42.586L552.568 130.68a213.685 213.685 0 0 1 302.2 0l38.552 38.551a213.685 213.685 0 0 1 0 302.2L746.255 618.497a30.118 30.118 0 0 1-42.586-42.616l147.034-147.035a153.45 153.45 0 0 0 0-217.028l-38.55-38.55a153.45 153.45 0 0 0-216.998 0L448.12 320.33zM575.88 703.67a30.118 30.118 0 0 1 42.616 42.586L471.432 893.32a213.685 213.685 0 0 1-302.2 0l-38.552-38.551a213.685 213.685 0 0 1 0-302.2l147.065-147.065a30.118 30.118 0 0 1 42.586 42.616L173.297 595.125a153.45 153.45 0 0 0 0 217.027l38.55 38.551a153.45 153.45 0 0 0 216.998 0L575.88 703.64z m-234.256-63.88L639.79 341.624a30.118 30.118 0 0 1 42.587 42.587L384.21 682.376a30.118 30.118 0 0 1-42.587-42.587z" p-id="7351"></path>
                            </svg>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>
        <?php else:?>
            <div class="aside aside-user">
                <div class="user">
                    <img class="lazyload" src="<?php $this->options->JAuthorAvatar ? $this->options->JAuthorAvatar() : ParseAvatar($this->author->mail); ?>" width="80" height="80" alt=""/>
                    <?php if ($this->options->JAuthorLink) : ?>
                        <a href="<?php $this->options->JAuthorLink(); ?>"><?php $this->author->screenName();autvip($this->author->mail); ?></a>
                    <?php else : ?>
                        <a href="<?php echo getUserPermalink($this->author->uid); ?>"><?php $this->author->screenName();autvip($this->author->mail); ?></a>
                    <?php endif; ?>
                    <!-- 座右铭 -->
                    <?php if ($this->options->JMotto) : ?>
                        <div class="p j-aside-motto"><?php GetRandomMotto(); ?></div>
                    <?php else : ?>
                        <div class="p j-aside-motto"></div>
                    <?php endif; ?>
                </div>
                <?php global $stat; ?>
                <div class="webinfo">
                    <div class="item" title="累计文章数">
                        <span class="num"><?php echo number_format($stat->publishedPostsNum); ?></span>
                        <span>文章数</span>
                    </div>
                    <div class="item" title="累计评论数">
                        <span class="num"><?php echo number_format($stat->publishedCommentsNum); ?></span>
                        <span>评论量</span>
                    </div>
                </div>
                <?php $this->widget('Widget_Contents_Post_Recent@aside565', 'pageSize=' . $this->options->JAuthorStatus)->to($hot); ?>
                <?php if ($hot->have()) : ?>
                    <ul class="articles">
                        <?php while ($hot->next()) : ?>
                            <li title="<?php $hot->title(); ?>">
                                <a href="<?php $hot->permalink(); ?>"><?php $hot->title(); ?></a>
                                <svg t="1599802830077" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M448.12 320.331a30.118 30.118 0 0 1-42.616-42.586L552.568 130.68a213.685 213.685 0 0 1 302.2 0l38.552 38.551a213.685 213.685 0 0 1 0 302.2L746.255 618.497a30.118 30.118 0 0 1-42.586-42.616l147.034-147.035a153.45 153.45 0 0 0 0-217.028l-38.55-38.55a153.45 153.45 0 0 0-216.998 0L448.12 320.33zM575.88 703.67a30.118 30.118 0 0 1 42.616 42.586L471.432 893.32a213.685 213.685 0 0 1-302.2 0l-38.552-38.551a213.685 213.685 0 0 1 0-302.2l147.065-147.065a30.118 30.118 0 0 1 42.586 42.616L173.297 595.125a153.45 153.45 0 0 0 0 217.027l38.55 38.551a153.45 153.45 0 0 0 216.998 0L575.88 703.64z m-234.256-63.88L639.79 341.624a30.118 30.118 0 0 1 42.587 42.587L384.21 682.376a30.118 30.118 0 0 1-42.587-42.587z" p-id="7351"></path>
                                </svg>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php else:?>
            <div class="aside aside-user">
                <div class="user">
                    <img class="lazyload" src="<?php ParseAvatar($this->author->mail); ?>" width="80" height="80" alt=""/>
                    <a href="<?php echo getUserPermalink($this->author->uid); ?>"><?php $this->author->screenName();autvip($this->author->mail); ?></a>
                    <!-- 座右铭 -->
                    <div class="p j-aside-motto"></div>
                </div>
                <div class="webinfo">
                    <div class="item" title="累计文章数">
                        <span class="num"><?php echo allpostnum($this->author->uid, 1); ?></span>
                        <span>文章数</span>
                    </div>
                    <div class="item" title="累计评论数">
                        <span class="num"><?php echo commentnum($this->author->uid); ?></span>
                        <span>评论量</span>
                    </div>
                </div>
                <?php $this->widget('Widget_Contents_Post_Recent_User@aside565', 'pageSize=' . $this->options->JAuthorStatus . '&uid=' . $this->author->uid)->to($hot);?>
                <?php if ($hot->have()) : ?>
                    <ul class="articles">
                        <?php while ($hot->next()) : ?>
                            <li title="<?php $hot->title(); ?>">
                                <a href="<?php $hot->permalink(); ?>"><?php $hot->title(); ?></a>
                                <svg t="1599802830077" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M448.12 320.331a30.118 30.118 0 0 1-42.616-42.586L552.568 130.68a213.685 213.685 0 0 1 302.2 0l38.552 38.551a213.685 213.685 0 0 1 0 302.2L746.255 618.497a30.118 30.118 0 0 1-42.586-42.616l147.034-147.035a153.45 153.45 0 0 0 0-217.028l-38.55-38.55a153.45 153.45 0 0 0-216.998 0L448.12 320.33zM575.88 703.67a30.118 30.118 0 0 1 42.616 42.586L471.432 893.32a213.685 213.685 0 0 1-302.2 0l-38.552-38.551a213.685 213.685 0 0 1 0-302.2l147.065-147.065a30.118 30.118 0 0 1 42.586 42.616L173.297 595.125a153.45 153.45 0 0 0 0 217.027l38.55 38.551a153.45 153.45 0 0 0 216.998 0L575.88 703.64z m-234.256-63.88L639.79 341.624a30.118 30.118 0 0 1 42.587 42.587L384.21 682.376a30.118 30.118 0 0 1-42.587-42.587z" p-id="7351"></path>
                                </svg>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endif;?>
    <?php endif; ?>
    <!--互动读者-->
    <?php if ($this->options->JactiveUsers and $this->is('index')): ?>
        <section class="aside aside-hunter-authors">
            <h3><i class="icon iconfont icon-follow"></i><span>互动读者</span></h3>
            <div class="hunter-cont">
                <ul class="hunter-authors">
                    <?php $i = exicache('pagemember');
                    if (($this->options->txtopcas == '1') && $i): ?>
                        <?php fosmember(); ?>
                    <?php else: ?>
                        <?php
                        $period = time() - 2592000; // 单位: 秒, 时间范围: 30天
                        $counts = Typecho_Db::get()->fetchAll(Typecho_Db::get()
                            ->select('COUNT(author) AS cnt', 'author', 'max(authorId) authorId', 'max(mail) mail')
                            ->from('table.comments')
                            ->where('created > ?', $period)
                            ->where('status = ?', 'approved')
                            ->where('type = ?', 'comment')
                            ->group('author')
                            ->order('cnt', Typecho_Db::SORT_DESC)
                            ->limit('4')
                        );
                        $mostactive = '';
                        $viphonor = stcdn(Helper::options()->themeUrl('assets/img/authen.svg','Typecho-Joe-Theme'));
                        foreach ($counts as $count) {
                            $imgUrl = ParseAvatar($count['mail'],1);
                            if ($count['authorId'] == '0') {
                                $c_url = '<li><div class="item"><div class="hunter-avatar"><div class="vatar"><img class="lazyload" src="' . $imgUrl . '" width="45" height="45" alt="avatar"></div></div><div class="item-main"><div>' . $count['author'] . '';
                            } else {
                                $c_url = '<li><div class="item"><div class="hunter-avatar"><a href="' . $this->options->siteUrl . 'index.php/author/' . $count['authorId'] . '" ><div class="vatar"><img class="lazyload" src="' . $imgUrl . '" width="45" height="45" alt="avatar"><img class="va_v_honor" src="' . $viphonor . '" title="认证用户" alt="认证用户"></div></a></div><div class="item-main">' . $count['author'] . '';
                            }
                            echo '' . $c_url . '';
                            autvip($count['mail']);
                            $allpostnum = allpostnum($count['authorId']);
                            echo ' <h4>评论 ' . $count['cnt'] . ' 次 | <i>'.$allpostnum.'</i>';
                            echo ' </h4></div></div></li>';
                        } ?>
                    <?php endif; ?>
                </ul>
            </div>
        </section>
    <?php endif; ?>
    <!-- 广告1 -->
    <?php if ($this->options->JADContent1) : ?>
        <?php
        $adContent1 = $this->options->JADContent1;
        $adContent1Counts = explode("||", $adContent1);
        ?>
    <div class="aside Ad">
        <h3><i class="icon iconfont icon-ad"></i><span><?php echo $adContent1Counts[0] ?></span></h3>
        <a class="aside aside-ad" rel="external nofollow" href="<?php echo $adContent1Counts[2]?$adContent1Counts[2]:'#' ?>">
            <img class="lazyload" src="<?php echo $adContent1Counts[1] ?>" width="250" height="250" alt="">
        </a>
    </div>
    <?php endif; ?>

    <!-- 自定义 -->
    <?php if ($this->options->JAsideCustom) : ?>
        <div class="aside aside-custom">
            <?php $this->options->JAsideCustom(); ?>
        </div>
    <?php endif; ?>

    <!-- ip信息 -->
    <?php if ($this->options->JAsideVisitor) : ?>
        <div class="aside aside-visitor">
            <img class="lazyload" src="<?php echo GetLazyLoad() ?>" data-src="<?php $this->options->JAsideVisitor() ?>" alt="IP信息" width="250" height="250">
        </div>
    <?php endif; ?>

    <!-- 人生倒计时 -->
    <?php if ($this->options->JCountDownStatus === "on") : ?>
        <div class="aside aside-count">
            <h3>人生倒计时</h3>
            <div class="content">
                <div class="item" id="dayProgress">
                    <div class="title">今日已经过去<span></span>小时</div>
                    <div class="progress">
                        <div class="progress-bar">
                            <div class="progress-inner progress-inner-1"></div>
                        </div>
                        <div class="progress-percentage"></div>
                    </div>
                </div>
                <div class="item" id="weekProgress">
                    <div class="title">这周已经过去<span></span>天</div>
                    <div class="progress">
                        <div class="progress-bar">
                            <div class="progress-inner progress-inner-2"></div>
                        </div>
                        <div class="progress-percentage"></div>
                    </div>
                </div>
                <div class="item" id="monthProgress">
                    <div class="title">本月已经过去<span></span>天</div>
                    <div class="progress">
                        <div class="progress-bar">
                            <div class="progress-inner progress-inner-3"></div>
                        </div>
                        <div class="progress-percentage"></div>
                    </div>
                </div>
                <div class="item" id="yearProgress">
                    <div class="title">今年已经过去<span></span>个月</div>
                    <div class="progress">
                        <div class="progress-bar">
                            <div class="progress-inner progress-inner-4"></div>
                        </div>
                        <div class="progress-percentage"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- 天气 -->
    <?php if ($this->options->JWetherKey) : ?>
        <div class="aside aside-wether">
            <h3>今日天气</h3>
            <div class="content" title="今日天气">
                <div class="loading">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 30" xml:space="preserve">
                        <rect x="0" y="13" width="4" height="5" fill="#333">
                            <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                            <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                        </rect>
                        <rect x="10" y="13" width="4" height="5" fill="#333">
                            <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                            <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                        </rect>
                        <rect x="20" y="13" width="4" height="5" fill="#333">
                            <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                            <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                        </rect>
                    </svg>
                </div>
                <div id="weather-v2-plugin-standard"></div>
            </div>
        </div>
    <?php endif; ?>

    <!-- 热门文章 -->
    <?php if ($this->options->JAsideHotNumber !== 'off') : ?>
        <div class="aside aside-hot">
            <h3><i class="icon iconfont icon-comment"></i><span>热门文章</span></h3>
            <?php $this->widget('Widget_Post_hot@asidehot@hot', 'pageSize=' . $this->options->JAsideHotNumber)->to($hot); ?>
            <?php if ($hot->have()) : ?>
                <ul>
                    <?php $i = 1; ?>
                    <?php while ($hot->next()) : ?>
                        <li>
                            <a href="<?php $hot->permalink(); ?>" title="<?php $hot->title(); ?>">
                                <img class="lazyload" src="<?php echo GetLazyLoad() ?>" data-src="<?php GetRandomThumbnail($hot); ?>" width="220" height="130" alt="">
                                <div class="info">
                                    <p><?php $hot->title(); ?></p>
                                    <span><?php GetPostViews($hot); ?> 阅读 - <?php $hot->date('m/d'); ?></span>
                                </div>
                                <div class="tip"><?php echo $i; ?></div>
                            </a>
                        </li>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <p class="empty">暂无内容</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- 最新回复 -->
    <?php if ($this->options->JAsideReplyStatus !== 'off') : ?>
        <div class="aside aside-reply">
            <h3><i class="icon iconfont icon-yuyin"></i><span>最新回复</span></h3>
            <?php $this->widget('Widget_Comments_Recent@ok88', 'ignoreAuthor=true&pageSize=5')->to($comments); ?>
            <?php if ($comments->have()) : ?>
                <ol class="list" id="asideReply">
                    <?php while ($comments->next()) : ?>
                        <li>
                            <div class="user">
                                <a href="<?php if ($comments->authorId > 0 ) $authorlink=getUserPermalink($comments->authorId);else $authorlink='#'; _e($authorlink);?>"><img src="<?php ParseAvatar($comments->mail); ?>" width="50" height="50" alt=""></a>
                                <div class="info">
                                    <div class="name"><a href="<?php _e($authorlink);?>"><?php $comments->author(false); ?></a></div>
                                    <span><?php $comments->date('Y-m-d'); ?></span>
                                </div>
                            </div>
                            <div class="reply">
                                <a title="<?php $comments->excerpt(); ?>" href="<?php $comments->permalink(); ?>"><?php echo ParseReply($comments->content); ?></a>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ol>
            <?php else : ?>
                <p class="empty">暂无回复</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- 微博热搜 -->
    <?php if ($this->options->JRanking !== 'off') : ?>
        <?php
        $ranking = $this->options->JRanking;
        $rankingStr = explode("$", $ranking);
        ?>
        <div class="aside aside-ranking">
            <h3><i class="icon iconfont icon-paihangbang"></i><span><?php echo $rankingStr[0] ?></span></h3>
            <ul class="list">
                <?php
                $result = GetRequest("https://the.top/v1/" . $rankingStr[1] . "/1/20", "get");
                $res = json_decode($result, true);
                if ($res['code'] === 0) {
                    for ($i = 0; $i < count($res['data']); $i++) {
                        if ($i < 9) {
                            echo
                                "<li title=" . $res['data'][$i]['title'] . ">
                                    <span>" . ($i + 1) . "</span>
                                    <a target='_blank' rel='noopener' href=" . $res['data'][$i]['url'] . ">" . $res['data'][$i]['title'] . "</a>
                                </li>";
                        }
                    }
                } else {
                    echo "<li>获取失败！</li>";
                }
                ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- 广告2 -->
    <?php if ($this->options->JADContent2) : ?>
        <?php
        $adContent2 = $this->options->JADContent2;
        $adContent2Counts = explode("||", $adContent2);
        ?>
    <div class="aside Ad">
        <h3><i class="icon iconfont icon-ad"></i><span><?php echo $adContent1Counts[0] ?></span></h3>
        <a class="aside aside-ad" rel="external nofollow" href="<?php echo $adContent2Counts[2]?$adContent1Counts[2]:'#' ?>" title="广告">
            <img src="<?php echo $adContent2Counts[1] ?>" width="250" height="250" alt="">
            <div class="j-ad">广告</div>
        </a>
    </div>
    <?php endif; ?>

    <!-- 云标签 -->
    <?php if ($this->options->J3DTagStatus === 'on') : ?>
        <div class="aside aside-cloud">
            <h3><i class="icon iconfont icon-Tag"></i><span>标签云</span></h3>
            <?php $this->widget('Widget_Metas_Tag_Cloud', array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true, 'limit' => 50))->to($tags); ?>
            <?php if ($tags->have()) : ?>
                <div class="cloud" id="cloud"></div>
                <ul id="cloudList">
                    <?php while ($tags->next()) : ?>
                        <li data-url="<?php $tags->permalink(); ?>" data-label="<?php $tags->name(); ?>"></li>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <p class="empty">暂无标签</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>