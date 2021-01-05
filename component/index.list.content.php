<?php
/**
 * 暂时没用上
 *
 */
?>


<?php /* 说说 */
if (($this->fields->thumb) && ($this->fields->thumbStyle == 'shuos')): ?>
    <article class="post-list contt blockimg shuobg">
        <div class="ad-container">
            <div class="entry-meta">
                <a href="<?php $this->author->permalink(); ?>"><img src="<?php ParseAvatar($this->author->mail); ?>" class="avatar photo " style="margin: 5px 10px 5px 0;" height="30" width="30" alt=""><?php $this->author->screenName(); ?></a>
                <span class="separator">/</span>
                <span class="separ_v"><?php echo allviewnum($this->author->uid); ?></span></div>
            <div class="ad-image feaimg">
                <a class="block-fea" href="<?php $this->permalink(); ?>" style="background-image: url('<?php echo GetLazyLoad(); ?>');" data-bg="<?php GetRandomThumbnail($this); ?>"></a>
                <div class="entyr-icon"><?php echo '' . imgNums($this->content) . ''; ?></div>
            </div>
            <header class="entry-header">
                <span class="entry-title">
                    <a href="<?php $this->permalink(); ?>"><?php $this->title() ?></a></span>
            </header>
            <div class="entry-summary">
                <p><?php if ($this->fields->desc): ?><?php $this->fields->desc(); ?><?php else : ?><?php $this->excerpt(80, '...'); ?><?php endif; ?></p>
            </div>
        </div>
    </article>
<?php /* 三图 */ elseif ($this->fields->thumbStyle == 'MultiThumb'): ?>
    <article class="post-list contt featured">
        <div class="featured-container">
            <header class="entry-header featitle">
                <span class="entry-title">
                    <a href="<?php $this->permalink(); ?>"><?php listdeng($this); ?><?php if (timeZone($this->date->timeStamp)) echo '<span class="badge arc_v2">最新</span>'; ?><?php $this->title() ?></a>
                </span>
            </header>
            <div class="entry-meta fea-meta">
                <a href="<?php $this->author->permalink(); ?>"><img src="<?php ParseAvatar($this->author->mail); ?>" class="avatar photo " style="margin: 5px 10px 5px 0;" height="30" width="30" alt=""><?php $this->author->screenName(); ?></a>
                <span class="separator">/</span>
                <?php $this->category(',', true, 'none'); ?> <span class="separator">/</span>
                <time datetime="<?php $this->date('Y-m-d'); ?>"><?php echo formatTime($this->created); ?></time>
                <span class="separator">/</span><?php Postviews($this); ?>阅读
            </div>
            <div class="rowimg">
                <?php $thumbs = showThumbnail($this, 3);?>
                <?php for ($j = 0; $j < 3; $j++):?>
                <div class="col-4">
                    <div class="feaimg">
                        <?php if ($thumbs[$j]): ?>
                            <a class="feaimg-content scrollLoading" title="<?php $this->title() ?>" href="<?php $this->permalink() ?>" data-bg="<?php echo $thumbs[$j]; ?>" style="background-image: url('<?php echo GetLazyLoad();?>')"></a>
                                <div class="entyr-icon"><?php echo '' . imgNums($this->content) . ''; ?></div>
                        <?php else: ?>
                            <a class="feaimg-content" title="<?php $this->title() ?>" href="<?php $this->permalink() ?>"
                               style="background-image: url(<?php $this->options->themeUrl('assets/img/thumbs/other_thumbnail.png'); ?>);"></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            <div class="entry-summary feasum">
                <p><?php if ($this->fields->desc): ?><?php $this->fields->desc(); ?><?php else : ?><?php $this->excerpt(80, '...'); ?><?php endif; ?></p>
            </div>
        </div>
    </article>
<?php /* 大图 */ elseif ($this->fields->thumbStyle == 'bigThumb'): ?>
    <article class="post-list contt featured">
        <div class="featured-container">
            <header class="entry-header featitle">
                <span class="entry-title">
                    <a href="<?php $this->permalink(); ?>"><?php listdeng($this); ?><?php if (timeZone($this->date->timeStamp)) echo '<span class="badge arc_v2">最新</span>'; ?><?php $this->title() ?></a></span>
            </header>
            <div class="entry-meta fea-meta">
                <a href="<?php $this->author->permalink(); ?>"><img src="<?php ParseAvatar($this->author->mail); ?>" class="avatar photo " style="margin: 5px 10px 5px 0;" height="30" width="30" alt=""><?php $this->author->screenName(); ?></a>
                <span class="separator">/</span>
                <?php $this->category(',', true, 'none'); ?> <span class="separator">/</span>
                <time datetime="<?php $this->date('Y-m-d'); ?>"><?php echo formatTime($this->created); ?></time>
                <span class="separator">/</span><?php Postviews($this); ?>阅读
            </div>
            <div class="feaimg fea-21x9">
                <a class="feaimg-content scrollLoading" title="<?php $this->title() ?>" href="<?php $this->permalink() ?>" data-bg="<?php GetRandomThumbnail($this); ?>" style="background-image: url('<?php echo GetLazyLoad();?>')"></a>
                <div class="entyr-icon"><?php echo '' . imgNums($this->content) . ''; ?></div>
            </div>
            <div class="entry-summary feasum">
                <p><?php if ($this->fields->desc): ?><?php $this->fields->desc(); ?><?php else : ?><?php $this->excerpt(80, '...'); ?><?php endif; ?></p>
            </div>
        </div>
    </article>
<?php else: ?>
    <!--默认图文模式s-->
    <?php if ($this->fields->thumb): ?>
        <article class="post-list contt blockimg">
            <div class="entry-container"><span class="laid_title_l"></span>
                <div class="block-image feaimg">
                    <a id="post_a_<?php $this->cid(); ?>" class="block-fea scrollLoading"
                       data-bg="<?php echo stcdn($this->fields->thumb); ?>"
                       href="<?php if ($this->fields->videourl && ($this->options->ajxplay == '1') && ($this->options->aboutme)): ?>javascript:;fn_conid(<?php $this->cid(); ?>)<?php else : ?><?php $this->permalink(); ?><?php endif; ?>"
                       title="<?php $this->title(); ?>"><?php if ($this->fields->videourl): ?><i
                                class="mask"></i><?php endif; ?>
                        <span class="vodlist_top"><em
                                    class="voddate voddate_year"><?php $this->category(',', false, 'none'); ?></em></span>
                    </a>
                    <?php if ($this->fields->videourl): ?>
                        <div class="entyr-icon ico-p"><i class="icon iconfont icon-icon-test15"></i>
                        </div><?php else : ?>
                        <div class="entyr-icon"><?php echo '' . imgNums($this->content) . ''; ?></div><?php endif; ?>
                </div>
                <header class="entry-header"><span class="entry-title"><a
                                href="<?php $this->permalink() ?>"><?php listdeng($this); ?><?php if (timeZone($this->date->timeStamp)) echo '<span class="badge arc_v2">最新</span>'; ?><?php 
                            $this->title(31, '...') ?></a></span></header>
                <div class="entry-summary ss">
                    <p><?php if ($this->fields->desc): ?><?php $this->fields->desc(); ?><?php else : ?><?php $this->excerpt(80, '...'); ?><?php endif; ?></p>
                </div>
                <div class="entry-meta">
                    <a href="<?php $this->options->siteUrl(); ?><?php if ($this->options->rewrite == 0): ?>index.php/<?php endif; ?>author/<?php $this->author->uid(); ?>"><?php $email = $this->author->mail;
                        $imgUrl = getGravatar($email);
                        echo '<img src="' . $imgUrl . '" srcset="' . $imgUrl . '" class="avatar avatar-140 photo" height="25" width="25" >'; ?><?php $this->author->screenName(); ?></a><span
                            class="separator">/</span><?php $this->category(',', true, 'none'); ?><span
                            class="separator">/</span>
                    <time datetime="<?php $this->date('Y-m-d'); ?>"><?php echo formatTime($this->created); ?></time>
                    <span class="separator">/</span>
                    <?php Postviews($this); ?>阅读
                </div>

            </div><?php if ($this->options->oncosmore == '1'): ?><?php cosmore($this->content); ?><?php endif; ?>

        </article>
    <?php else: ?>
        <article class="post-list contt blockimg">

            <?php if (showThumbnail($this, 0)): ?>
                <div class="entry-container"><span class="laid_title_l"></span>
                <div class="block-image feaimg">
                    <a class="block-fea scrollLoading" data-bg="<?php echo stcdn(showThumbnail($this, 0)); ?>"
                       href="<?php $this->permalink(); ?>"
                       title="<?php $this->title(); ?>"><?php if ($this->fields->videourl): ?><i
                                class="mask"></i><?php endif; ?>
                        <span class="vodlist_top"><em
                                    class="voddate voddate_year"><?php $this->category(',', false, 'none'); ?></em></span>
                    </a>
                    <?php if ($this->fields->videourl): ?>
                        <div class="entyr-icon ico-p"><i class="icon iconfont icon-icon-test15"></i>
                        </div><?php else : ?>
                        <div class="entyr-icon"><?php echo '' . imgNums($this->content) . ''; ?></div><?php endif; ?>
                </div>
                <header class="entry-header"><span class="entry-title"><a
                                href="<?php $this->permalink() ?>"><?php listdeng($this); ?><?php if (timeZone($this->date->timeStamp)) echo '<span class="badge arc_v2">最新</span>'; ?><?php 
                            $this->title(31, '...') ?></a></span></header>
                <div class="entry-summary ss">
                    <p><?php if ($this->fields->desc): ?><?php $this->fields->desc(); ?><?php else : ?><?php $this->excerpt(80, '...'); ?><?php endif; ?></p>
                </div>
                <div class="entry-meta">
                    <a href="<?php $this->options->siteUrl(); ?><?php if ($this->options->rewrite == 0): ?>index.php/<?php endif; ?>author/<?php $this->author->uid(); ?>"><?php $email = $this->author->mail;
                        $imgUrl = getGravatar($email);
                        echo '<img src="' . $imgUrl . '" srcset="' . $imgUrl . '" class="avatar avatar-140 photo" height="25" width="25">'; ?><?php $this->author->screenName(); ?></a><span
                            class="separator">/</span><?php $this->category(',', true, 'none'); ?><span
                            class="separator">/</span>
                    <time datetime="<?php $this->date('Y-m-d'); ?>"><?php echo formatTime($this->created); ?></time>
                    <span class="separator">/</span>
                    <?php Postviews($this); ?>阅读
                </div>
                </div><?php if ($this->options->oncosmore == '1'): ?><?php cosmore($this->content); ?><?php endif; ?>
            <?php else: ?>
                <div class="entry-container" style="padding-left: 0px  !important;">
                    <header class="entry-header"><span class="entry-title"><a
                                    href="<?php $this->permalink() ?>"><?php listdeng($this); ?><?php if (timeZone($this->date->timeStamp)) echo '<span class="badge arc_v2">最新</span>'; ?><?php 
                                $this->title(31, '...') ?></a></span></header>
                    <div class="entry-summary ss">
                        <p><?php if ($this->fields->desc): ?><?php $this->fields->desc(); ?><?php else : ?><?php $this->excerpt(80, '...'); ?><?php endif; ?></p>
                    </div>
                    <div class="entry-meta">
                        <a href="<?php $this->options->siteUrl(); ?><?php if ($this->options->rewrite == 0): ?>index.php/<?php endif; ?>author/<?php $this->author->uid(); ?>"><?php $email = $this->author->mail;
                            $imgUrl = getGravatar($email);
                            echo '<img src="' . $imgUrl . '" srcset="' . $imgUrl . '" class="avatar avatar-140 photo" height="25" width="25">'; ?><?php $this->author->screenName(); ?></a><span
                                class="separator">/</span><?php $this->category(',', true, 'none'); ?><span
                                class="separator">/</span>
                        <time datetime="<?php $this->date('Y-m-d'); ?>"><?php echo formatTime($this->created); ?></time>
                        <span class="separator">/</span>
                        <?php Postviews($this); ?>阅读
                    </div>
                </div>
            <?php endif; ?>
        </article>
    <?php endif; ?>
    <!--默认图文模式e-->

<?php endif; ?>