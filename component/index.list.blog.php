<?php /* 说说 */
if (($this->fields->thumb) && ($this->fields->thumbStyle == 'shuos')): ?>
    <article class="article-list shuobg sticky <?php echo isMobile() ? ($this->options->JWapAnimation ? 'wow ' . $this->options->JWapAnimation : '') : ($this->options->JPCAnimation ? 'wow ' . $this->options->JPCAnimation : ''); ?>">
        <section class="entry-box">
            <div class="meta">
                <section class="item">
                    <a href="<?php $this->author->permalink(); ?>"><img src="<?php ParseAvatar($this->author->mail); ?>" width="50" height="50" alt=""/><?php $this->author(); ?></a>
                </section>
                <section class="item">
                    <span class="separ_v"><?php echo allviewnum($this->author->uid); ?></span>
                </section>
            </div>
            <section class="title" title="<?php $this->title() ?>"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
            </section>
            <a class="summary" href="<?php $this->permalink() ?>"><?php $this->excerpt(500) ?></a>
        </section>
        <a class="picture-box" href="<?php $this->permalink() ?>" title="<?php $this->title() ?>">
            <img alt="" class="lazyload" src="<?php echo GetLazyLoad() ?>" data-src="<?php GetRandomThumbnail($this); ?>" width="300" height="200">
            <span><?php $this->date('Y-m-d'); ?></span>
            <svg t="1608364969286" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1025" width="200" height="200"><path d="M544 661.333a32 32 0 0 1-64 0V362.667a32 32 0 0 1 64 0v298.666z m160 0a32 32 0 0 1-64 0V490.667a32 32 0 0 1 64 0v170.666z m-320 0a32 32 0 0 1-64 0V448a32 32 0 0 1 64 0v213.333zM202.667 138.667h618.666c64.8 0 117.334 52.533 117.334 117.333v512c0 64.8-52.534 117.333-117.334 117.333H202.667c-64.8 0-117.334-52.533-117.334-117.333V256c0-64.8 52.534-117.333 117.334-117.333z m0 64A53.333 53.333 0 0 0 149.333 256v512a53.333 53.333 0 0 0 53.334 53.333h618.666A53.333 53.333 0 0 0 874.667 768V256a53.333 53.333 0 0 0-53.334-53.333H202.667z" p-id="1026"></path></svg>
            <div class="xs-title">
                <p><?php $this->title() ?></p>
            </div>
        </a>
    </article>
<?php /* 三图 */ elseif (($this->fields->thumbStyle == 'MultiThumb')): ?>
    <article class="article-list mthumb sticky <?php echo isMobile() ? ($this->options->JWapAnimation ? 'wow ' . $this->options->JWapAnimation : '') : ($this->options->JPCAnimation ? 'wow ' . $this->options->JPCAnimation : ''); ?>">
        <section class="entry-box">
            <header class="tlr-header header">
                <span class="title">
                    <a href="<?php $this->permalink(); ?>"><?php listdeng($this); ?><?php if (timeZone($this->date->timeStamp)) echo '<span class="badge arc_v2">最新</span>'; ?>
                        <?php $this->title() ?>
                    </a>
                </span>
            </header>
            <section class="meta lr-padding">
                <?php if (!empty($this->options->JSummaryMeta) && in_array('author', $this->options->JSummaryMeta)) : ?>
                    <section class="item">
                        <a href="<?php $this->author->permalink(); ?>"><img alt="" src="<?php ParseAvatar($this->author->mail); ?>" width="50" height="50"/><?php $this->author(); ?></a>
                    </section>
                <?php endif; ?>
                <?php if (!empty($this->options->JSummaryMeta) && in_array('cate', $this->options->JSummaryMeta)) : ?>
                    <section class="item">
                        <?php $this->category(',', '%s', '未分类'); ?>
                    </section>
                <?php endif; ?>
                <?php if (!empty($this->options->JSummaryMeta) && in_array('time', $this->options->JSummaryMeta)) : ?>
                    <section class="item">
                        <?php echo formatTime($this->created); ?>
                    </section>
                <?php endif; ?>
                <?php if (!empty($this->options->JSummaryMeta) && in_array('read', $this->options->JSummaryMeta)) : ?>
                    <section class="item">
                        <?php GetPostViews($this) ?> 阅读
                    </section>
                <?php endif; ?>
                <?php if (!empty($this->options->JSummaryMeta) && in_array('comment', $this->options->JSummaryMeta)) : ?>
                    <section class="item">
                        <?php $this->commentsNum('%d'); ?> 评论
                    </section>
                <?php endif; ?>
            </section>
            <div class="imgrow">
                <?php $thumbs = showThumbnail($this, 3);?>
                <?php for ($j = 0; $j < 3; $j++):?>
                <div class="feaimg">
                    <a class="" title="<?php $this->title() ?>"
                       href="<?php $this->permalink() ?>">
                        <img alt="" class="lazyload" src="<?php echo GetLazyLoad() ?>" data-src="<?php echo stcdn($thumbs[$j]); ?>" width="150" height="150">
                    </a>
                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path d="M903.93077753 107.30625876H115.78633587C64.57261118 107.30625876 22.58166006 149.81138495 22.58166006 201.02510964v624.26547214c0 51.7240923 41.99095114 93.71694641 93.71694641 93.7169464h788.14444164c51.7202834 0 93.71694641-41.99285557 93.71694642-93.7169464v-624.26547214c-0.51227057-51.21372469-43.01739676-93.71885088-94.229217-93.71885088zM115.78633587 171.8333054h788.65671224c16.385041 0 29.70407483 13.31522639 29.70407484 29.70407482v390.22828696l-173.60830179-189.48107072c-12.80486025-13.82749697-30.21634542-21.50774542-48.14010264-19.97093513-17.92375723 1.02073227-34.82106734 10.75387344-46.60138495 26.11437327l-172.58185762 239.1598896-87.06123767-85.52061846c-12.28878076-11.78222353-27.65308802-17.92375723-44.03812902-17.92375577-16.3907529 0.50846167-31.75506163 7.67644101-43.52966736 20.48129978L86.59453164 821.70468765V202.04965083c-1.02454117-17.41529409 12.80486025-30.73052046 29.19180423-30.21634543zM903.93077753 855.50692718H141.90642105l222.25496164-245.81940722 87.0593347 86.03669649c12.80105134 12.80676323 30.21253651 18.95020139 47.11555999 17.4172 17.40958218-1.53871621 33.79652618-11.26614404 45.06267018-26.11818071l172.58376063-238.64762047 216.11152349 236.08817198 2.05098681-1.54062067v142.87778132c0.50846167 16.3907529-13.31522639 29.70597929-30.21444096 29.70597928z m0 0" p-id="1916"></path>
                        <path d="M318.07226687 509.82713538c79.88945091 0 144.41649754-65.03741277 144.41649754-144.41649753 0-79.37718032-64.52704663-144.92495923-144.41649754-144.92495922-79.89135536 0-144.41649754 64.52704663-144.41649756 144.41268862 0 79.89135536 64.52514218 144.92876814 144.41649756 144.92876813z m0-225.3266807c44.55230407 0 80.91208763 36.36168802 80.91208762 80.91018317 0 44.55611297-35.84751297 81.43007159-80.91208762 81.43007012-45.06838356 0-80.91589654-36.35978356-80.91589508-80.91589507 0-44.55611297 36.87205415-81.42435823 80.91589508-81.42435822z m0 0" p-id="1917"></path>
                    </svg>
                </div>
                <?php endfor; ?>

            </div>
            <a class="summary lr-padding" href="<?php $this->permalink() ?>">
                <p><?php $this->excerpt(80, '...'); ?></p>
            </a>
        </section>
    </article>
<?php /* 大图 */ elseif (($this->fields->thumbStyle == 'bigThumb')): ?>
    <article class="article-list bthumb sticky <?php echo isMobile() ? ($this->options->JWapAnimation ? 'wow ' . $this->options->JWapAnimation : '') : ($this->options->JPCAnimation ? 'wow ' . $this->options->JPCAnimation : ''); ?>">
        <section class="entry-box">
            <header class="header tlr-header">
                <span class="title">
                    <a href="<?php $this->permalink(); ?>"><?php listdeng($this); ?><?php if (timeZone($this->date->timeStamp)) echo '<span class="badge arc_v2">最新</span>'; ?>
                        <?php $this->title() ?>
                    </a>
                </span>
            </header>
            <section class="lr-padding meta">
                <?php if (!empty($this->options->JSummaryMeta) && in_array('author', $this->options->JSummaryMeta)) : ?>
                    <section class="item">
                        <a href="<?php $this->author->permalink(); ?>"><img alt="" src="<?php ParseAvatar($this->author->mail); ?>" width="50" height="50"/><?php $this->author(); ?></a>
                    </section>
                <?php endif; ?>
                <?php if (!empty($this->options->JSummaryMeta) && in_array('cate', $this->options->JSummaryMeta)) : ?>
                    <section class="item">
                        <?php $this->category(',', '%s', '未分类'); ?>
                    </section>
                <?php endif; ?>
                <?php if (!empty($this->options->JSummaryMeta) && in_array('time', $this->options->JSummaryMeta)) : ?>
                    <section class="item">
                        <?php echo formatTime($this->created); ?>
                    </section>
                <?php endif; ?>
                <?php if (!empty($this->options->JSummaryMeta) && in_array('read', $this->options->JSummaryMeta)) : ?>
                    <section class="item">
                        <?php GetPostViews($this) ?> 阅读
                    </section>
                <?php endif; ?>
                <?php if (!empty($this->options->JSummaryMeta) && in_array('comment', $this->options->JSummaryMeta)) : ?>
                    <section class="item"><?php $this->commentsNum('%d'); ?> 评论</section>
                <?php endif; ?>
            </section>
            <div class="imgrow">
                <div class="feaimg">
                    <a href="<?php $this->permalink(); ?>" title="<?php $this->title() ?>">
                        <img class="lazyload" src="<?php echo GetLazyLoad() ?>" data-src="<?php $this->fields->thumb ? _e($this->fields->thumb):GetRandomThumbnail($this); ?>" alt="">
                    </a>
                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path d="M903.93077753 107.30625876H115.78633587C64.57261118 107.30625876 22.58166006 149.81138495 22.58166006 201.02510964v624.26547214c0 51.7240923 41.99095114 93.71694641 93.71694641 93.7169464h788.14444164c51.7202834 0 93.71694641-41.99285557 93.71694642-93.7169464v-624.26547214c-0.51227057-51.21372469-43.01739676-93.71885088-94.229217-93.71885088zM115.78633587 171.8333054h788.65671224c16.385041 0 29.70407483 13.31522639 29.70407484 29.70407482v390.22828696l-173.60830179-189.48107072c-12.80486025-13.82749697-30.21634542-21.50774542-48.14010264-19.97093513-17.92375723 1.02073227-34.82106734 10.75387344-46.60138495 26.11437327l-172.58185762 239.1598896-87.06123767-85.52061846c-12.28878076-11.78222353-27.65308802-17.92375723-44.03812902-17.92375577-16.3907529 0.50846167-31.75506163 7.67644101-43.52966736 20.48129978L86.59453164 821.70468765V202.04965083c-1.02454117-17.41529409 12.80486025-30.73052046 29.19180423-30.21634543zM903.93077753 855.50692718H141.90642105l222.25496164-245.81940722 87.0593347 86.03669649c12.80105134 12.80676323 30.21253651 18.95020139 47.11555999 17.4172 17.40958218-1.53871621 33.79652618-11.26614404 45.06267018-26.11818071l172.58376063-238.64762047 216.11152349 236.08817198 2.05098681-1.54062067v142.87778132c0.50846167 16.3907529-13.31522639 29.70597929-30.21444096 29.70597928z m0 0" p-id="1916"></path>
                        <path d="M318.07226687 509.82713538c79.88945091 0 144.41649754-65.03741277 144.41649754-144.41649753 0-79.37718032-64.52704663-144.92495923-144.41649754-144.92495922-79.89135536 0-144.41649754 64.52704663-144.41649756 144.41268862 0 79.89135536 64.52514218 144.92876814 144.41649756 144.92876813z m0-225.3266807c44.55230407 0 80.91208763 36.36168802 80.91208762 80.91018317 0 44.55611297-35.84751297 81.43007159-80.91208762 81.43007012-45.06838356 0-80.91589654-36.35978356-80.91589508-80.91589507 0-44.55611297 36.87205415-81.42435823 80.91589508-81.42435822z m0 0" p-id="1917"></path>
                    </svg>
                </div>
            </div>
            <a class="lr-padding summary" href="<?php $this->permalink() ?>">
                <p><?php $this->excerpt(80, '...'); ?></p>
            </a>
        </section>
    </article>
<?php else: ?>
    <!--默认图文模式s-->
    <article class="article-list default <?php echo isMobile() ? ($this->options->JWapAnimation ? 'wow ' . $this->options->JWapAnimation : '') : ($this->options->JPCAnimation ? 'wow ' . $this->options->JPCAnimation : ''); ?>">
        <a class="picture-box" href="<?php $this->permalink() ?>" title="<?php $this->title() ?>">
            <img alt="" class="lazyload" src="<?php echo GetLazyLoad() ?>" data-src="<?php GetRandomThumbnail($this); ?>" width="300" height="200">
            <span><?php $this->date('Y-m-d'); ?></span>
            <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <path d="M903.93077753 107.30625876H115.78633587C64.57261118 107.30625876 22.58166006 149.81138495 22.58166006 201.02510964v624.26547214c0 51.7240923 41.99095114 93.71694641 93.71694641 93.7169464h788.14444164c51.7202834 0 93.71694641-41.99285557 93.71694642-93.7169464v-624.26547214c-0.51227057-51.21372469-43.01739676-93.71885088-94.229217-93.71885088zM115.78633587 171.8333054h788.65671224c16.385041 0 29.70407483 13.31522639 29.70407484 29.70407482v390.22828696l-173.60830179-189.48107072c-12.80486025-13.82749697-30.21634542-21.50774542-48.14010264-19.97093513-17.92375723 1.02073227-34.82106734 10.75387344-46.60138495 26.11437327l-172.58185762 239.1598896-87.06123767-85.52061846c-12.28878076-11.78222353-27.65308802-17.92375723-44.03812902-17.92375577-16.3907529 0.50846167-31.75506163 7.67644101-43.52966736 20.48129978L86.59453164 821.70468765V202.04965083c-1.02454117-17.41529409 12.80486025-30.73052046 29.19180423-30.21634543zM903.93077753 855.50692718H141.90642105l222.25496164-245.81940722 87.0593347 86.03669649c12.80105134 12.80676323 30.21253651 18.95020139 47.11555999 17.4172 17.40958218-1.53871621 33.79652618-11.26614404 45.06267018-26.11818071l172.58376063-238.64762047 216.11152349 236.08817198 2.05098681-1.54062067v142.87778132c0.50846167 16.3907529-13.31522639 29.70597929-30.21444096 29.70597928z m0 0" p-id="1916"></path>
                <path d="M318.07226687 509.82713538c79.88945091 0 144.41649754-65.03741277 144.41649754-144.41649753 0-79.37718032-64.52704663-144.92495923-144.41649754-144.92495922-79.89135536 0-144.41649754 64.52704663-144.41649756 144.41268862 0 79.89135536 64.52514218 144.92876814 144.41649756 144.92876813z m0-225.3266807c44.55230407 0 80.91208763 36.36168802 80.91208762 80.91018317 0 44.55611297-35.84751297 81.43007159-80.91208762 81.43007012-45.06838356 0-80.91589654-36.35978356-80.91589508-80.91589507 0-44.55611297 36.87205415-81.42435823 80.91589508-81.42435822z m0 0" p-id="1917"></path>
            </svg>
            <div>
                <p><?php $this->title() ?></p>
            </div>
        </a>
        <section class="entry-box">
            <section class="title" title="<?php $this->title() ?>">
                <a href="<?php $this->permalink() ?>"><?php listdeng($this); ?><?php if (timeZone($this->date->timeStamp)) echo '<span class="badge arc_v2">最新</span>'; ?><span class="text"><?php $this->title() ?></span></a>
            </section>
            <a class="summary" href="<?php $this->permalink() ?>"><?php $this->excerpt(500) ?></a>
            <div class="meta">
                <?php if (!empty($this->options->JSummaryMeta) && in_array('author', $this->options->JSummaryMeta)) : ?>
                    <section class="item author">
                        <a href="<?php $this->author->permalink(); ?>"><img alt="" src="<?php ParseAvatar($this->author->mail); ?>" width="50" height="50"/><?php $this->author(); ?></a>
                    </section>
                <?php endif; ?>
                <?php if (!empty($this->options->JSummaryMeta) && in_array('time', $this->options->JSummaryMeta)) : ?>
                    <section class="item date">
                        <?php $this->date('Y-m-d'); ?>
                    </section>
                <?php endif; ?>
                <?php if (!empty($this->options->JSummaryMeta) && in_array('cate', $this->options->JSummaryMeta)) : ?>
                    <section class="item category">
                        <p><?php $this->category(',', '%s', '未分类'); ?></p>
                    </section>
                <?php endif; ?>
                <section class="item read">
                    <?php $readNum = GetPostViews($this,1);_e($readNum); ?> 阅读
                </section>
                <?php if (!empty($this->options->JSummaryMeta) && in_array('comment', $this->options->JSummaryMeta)) : ?>
                    <section class="item comment"><?php $this->commentsNum('%d'); ?> 评论</section>
                <?php endif; ?>
            </div>
        </section>
    </article>
    <!--默认图文模式e-->

<?php endif; ?>