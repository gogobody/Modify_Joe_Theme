<div class="fakeLoader"></div>
<!-- 该处用于密码、输入框等其他异步判断是否正确使用，请勿修改成其他内容！！！ -->
<div style="display: none;">TypechoJoeTheme</div>

<!-- 跑马灯 -->
<?php if ($this->options->JHorseStatus === 'on' && $this->options->JHeaderStyle === 'default') : ?>
    <div class="j-horse"></div>
<?php endif; ?>

<?php if ($this->options->JHeaderStyle === 'default') : ?>
    <header class="container-fluid j-header j-header-default">
        <section class="above">
            <section class="container">
                <div class="j-slide slide">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="top-bar-title post_no" id="post_top_title"><?php if ($this->is('post')): ?><span><?php $this->title(); ?></span><?php endif; ?></div>
                <div class="above-nav">
                    <!-- 网站 logo -->
                    <h1 class="logo j-hover-music" title="<?php $this->options->title(); ?>">
                        <?php $this->options->title(); ?>
                        <a href="<?php $this->options->siteUrl(); ?>">
                            <img src="<?php echo $this->options->JLogo ? $this->options->JLogo : 'https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/assets/img/logo.png' ?>" alt="logo">
                        </a>
                    </h1>
                    <!-- 链接 -->
                    <nav class="nav j-nav">
                        <a class="link <?php if ($this->is('index')) : ?>active<?php endif; ?>" href="<?php $this->options->siteUrl(); ?>">首页</a>
                        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>

                        <!-- 循环4个之前的 -->
                        <?php $i = 0; ?>
                        <?php while ($pages->next()) : ?>
                            <?php $i++; ?>
                            <?php if ($i <= $this->options->JNavMaxNum) : ?>
                                <a class="link <?php if ($this->is('page', $pages->slug)) : ?>active<?php endif; ?>" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                            <?php endif; ?>
                        <?php endwhile; ?>

                        <?php if ($this->options->JOpenContrib):?>
                        <a class="link" href="<?php _e($this->options->index.'/resources') ?>">资源专区</a>
                        <a class="link" style="color: #f64444" href="/contribute.html"><i style="margin-right: 3px" class="icon iconfont icon-chaoji"></i>成为投稿者</a>
                        <?php endif;?>

                        <!-- 超过4个则显示更多 -->
                        <?php if ($i > $this->options->JNavMaxNum) : ?>
                            <div class="link drops">
                                <div class="j-drop">
                                    <span>更多</span>
                                    <i class="icon iconfont icon-show_more"></i>
                                </div>
                                <nav class="j-dropdown">
                                    <?php $current = 0 ?>
                                    <?php while ($pages->next()) : ?>
                                        <?php $current++; ?>
                                        <?php if ($current > $this->options->JNavMaxNum) : ?>
                                            <a class="<?php if ($this->is('page', $pages->slug)) : ?>active<?php endif; ?>" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </nav>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->options->JCustomNavs) : ?>
                            <div class="link drops">
                                <div class="j-drop">
                                    <span>其他</span>
                                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M825.728 390.144L521.056 702.336 217.152 390.144c-16.576-16.576-43.744-16.576-60.32 0s-16.576 43.744 0 60.32L483.36 778.496c10.56 9.056 23.392 19.616 36.96 17.344 13.568 3.008 27.904-6.784 38.464-17.344L886.08 450.464a42.816 42.816 0 0 0 0-60.32 42.784 42.784 0 0 0-60.352 0z"></path>
                                    </svg>
                                </div>
                                <nav class="j-dropdown">
                                    <?php
                                    $txt = $this->options->JCustomNavs;
                                    $string_arr = explode("\r\n", $txt);
                                    $long = count($string_arr);
                                    for ($i = 0; $i < $long; $i++) {
                                        $title = explode("||", $string_arr[$i])[0];
                                        $url = explode("||", $string_arr[$i])[1];
                                        ?>
                                        <a target="_blank" href="<?php echo $url ?>"><?php echo $title ?></a>
                                    <?php } ?>
                                </nav>
                            </div>
                        <?php endif; ?>
                    </nav>
                </div>
                <!-- 搜索 -->
                <form class="search j-search" method="get" action="<?php $this->options->siteUrl(); ?>">
                    <input maxlength="20" name="s" autocomplete="off" <?php if ($this->is('search')) : ?>value="<?php $this->archiveTitle(' &raquo; ', '', ''); ?>" <?php endif; ?> type="text" placeholder="请输入关键字..." />
                    <button type="submit">Search</button>
                    <span></span>
                </form>
                <!-- 暗黑模式 -->
                <div class="profile-color-modes js-promo-color-modes-banner-profile">
                    <svg aria-hidden="true" height="45" viewBox="0 0 106 60" fill="none" stroke-width="3"
                         stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                        <g class="profile-color-modes-illu-group profile-color-modes-illu-red">
                            <path d="M37.5 58.5V57.5C37.5 49.768 43.768 43.5 51.5 43.5V43.5C59.232 43.5 65.5 49.768 65.5 57.5V58.5"></path>
                        </g>
                        <g class="profile-color-modes-illu-group profile-color-modes-illu-orange">
                            <path d="M104.07 58.5C103.401 55.092 97.7635 54.3869 95.5375 57.489C97.4039 54.6411 99.7685 48.8845 94.6889 46.6592C89.4817 44.378 86.1428 50.1604 85.3786 54.1158C85.9519 50.4768 83.7226 43.294 78.219 44.6737C72.7154 46.0534 72.7793 51.3754 74.4992 55.489C74.169 54.7601 72.4917 53.3567 70.5 52.8196"></path>
                        </g>
                        <g class="profile-color-modes-illu-group profile-color-modes-illu-purple">
                            <path d="M5.51109 58.5V52.5C5.51109 41.4543 14.4654 32.5 25.5111 32.5C31.4845 32.5 36.8464 35.1188 40.5111 39.2709C40.7212 39.5089 40.9258 39.7521 41.1245 40"></path>
                            <path d="M27.511 49.5C29.6777 49.5 28.911 49.5 32.511 49.5"></path>
                            <path d="M27.511 56.5C29.6776 56.5 26.911 56.5 30.511 56.5"></path>
                        </g>
                        <g class="profile-color-modes-illu-group profile-color-modes-illu-green">
                            <circle cx="5.5" cy="12.5" r="4"></circle>
                            <circle cx="18.5" cy="5.5" r="4"></circle>
                            <path d="M18.5 9.5L18.5 27.5"></path>
                            <path d="M18.5 23.5C6 23.5 5.5 23.6064 5.5 16.5"></path>
                        </g>
                        <g class="profile-color-modes-illu-group profile-color-modes-illu-blue">
                            <g class="profile-color-modes-illu-frame">
                                <path d="M40.6983 31.5C40.5387 29.6246 40.6456 28.0199 41.1762 27.2317C42.9939 24.5312 49.7417 26.6027 52.5428 30.2409C54.2551 29.8552 56.0796 29.6619 57.9731 29.6619C59.8169 29.6619 61.5953 29.8452 63.2682 30.211C66.0833 26.5913 72.799 24.5386 74.6117 27.2317C75.6839 28.8246 75.0259 33.7525 73.9345 37.5094C74.2013 37.9848 74.4422 38.4817 74.6555 39"></path>
                            </g>
                            <g class="profile-color-modes-illu-frame">
                                <path d="M41.508 31.5C41.6336 31.2259 41.7672 30.9582 41.9085 30.6968C40.7845 26.9182 40.086 21.8512 41.1762 20.2317C42.9939 17.5312 49.7417 19.6027 52.5428 23.2409C54.2551 22.8552 56.0796 22.6619 57.9731 22.6619C59.8169 22.6619 61.5953 22.8452 63.2682 23.211C66.0833 19.5913 72.799 17.5386 74.6117 20.2317C75.6839 21.8246 75.0259 26.7525 73.9345 30.5094C75.1352 32.6488 75.811 35.2229 75.811 38.2283C75.811 38.49 75.8058 38.7472 75.7957 39"></path>
                                <path d="M49.4996 33V35.6757"></path>
                                <path d="M67.3375 33V35.6757"></path>
                            </g>
                            <g class="profile-color-modes-illu-frame">
                                <path d="M41.508 31.5C41.6336 31.2259 41.7672 30.9582 41.9085 30.6968C40.7845 26.9182 40.086 21.8512 41.1762 20.2317C42.9939 17.5312 49.7417 19.6027 52.5428 23.2409C54.2551 22.8552 56.0796 22.6619 57.9731 22.6619C59.8169 22.6619 61.5953 22.8452 63.2682 23.211C66.0833 19.5913 72.799 17.5386 74.6117 20.2317C75.6839 21.8246 75.0259 26.7525 73.9345 30.5094C75.1352 32.6488 75.811 35.2229 75.811 38.2283C75.811 38.49 75.8058 38.7472 75.7957 39"></path>
                            </g>
                            <g class="profile-color-modes-illu-frame">
                                <path d="M41.508 31.5C41.6336 31.2259 41.7672 30.9582 41.9085 30.6968C40.7845 26.9182 40.086 21.8512 41.1762 20.2317C42.9939 17.5312 49.7417 19.6027 52.5428 23.2409C54.2551 22.8552 56.0796 22.6619 57.9731 22.6619C59.8169 22.6619 61.5953 22.8452 63.2682 23.211C66.0833 19.5913 72.799 17.5386 74.6117 20.2317C75.6839 21.8246 75.0259 26.7525 73.9345 30.5094C75.1352 32.6488 75.811 35.2229 75.811 38.2283C75.811 38.49 75.8058 38.7472 75.7957 39"></path>
                                <path d="M49.4996 33V35.6757"></path>
                                <path d="M67.3375 33V35.6757"></path>
                            </g>
                            <g class="profile-color-modes-illu-frame">
                                <path d="M41.508 31.5C41.6336 31.2259 41.7672 30.9582 41.9085 30.6968C40.7845 26.9182 40.086 21.8512 41.1762 20.2317C42.9939 17.5312 49.7417 19.6027 52.5428 23.2409C54.2551 22.8552 56.0796 22.6619 57.9731 22.6619C59.8169 22.6619 61.5953 22.8452 63.2682 23.211C66.0833 19.5913 72.799 17.5386 74.6117 20.2317C75.6839 21.8246 75.0259 26.7525 73.9345 30.5094C75.1352 32.6488 75.811 35.2229 75.811 38.2283C75.811 38.49 75.8058 38.7472 75.7957 39"></path>
                            </g>
                            <g class="profile-color-modes-illu-frame">
                                <path d="M41.508 31.5C41.6336 31.2259 41.7672 30.9582 41.9085 30.6968C40.7845 26.9182 40.086 21.8512 41.1762 20.2317C42.9939 17.5312 49.7417 19.6027 52.5428 23.2409C54.2551 22.8552 56.0796 22.6619 57.9731 22.6619C59.8169 22.6619 61.5953 22.8452 63.2682 23.211C66.0833 19.5913 72.799 17.5386 74.6117 20.2317C75.6839 21.8246 75.0259 26.7525 73.9345 30.5094C75.1352 32.6488 75.811 35.2229 75.811 38.2283C75.811 38.49 75.8058 38.7472 75.7957 39"></path>
                                <path d="M49.4996 33V35.6757"></path>
                                <path d="M67.3375 33V35.6757"></path>
                            </g>
                            <g class="profile-color-modes-illu-frame">
                                <path d="M73.4999 40.2236C74.9709 38.2049 75.8108 35.5791 75.8108 32.2283C75.8108 29.2229 75.1351 26.6488 73.9344 24.5094C75.0258 20.7525 75.6838 15.8246 74.6116 14.2317C72.7989 11.5386 66.0832 13.5913 63.2681 17.211C61.5952 16.8452 59.8167 16.6619 57.973 16.6619C56.0795 16.6619 54.2549 16.8552 52.5427 17.2409C49.7416 13.6027 42.9938 11.5312 41.176 14.2317C40.0859 15.8512 40.7843 20.9182 41.9084 24.6968C41.003 26.3716 40.4146 28.3065 40.2129 30.5"></path>
                                <path d="M82.9458 30.5471L76.8413 31.657"></path>
                                <path d="M76.2867 34.4319L81.8362 37.7616"></path>
                                <path d="M49.4995 27.8242V30.4999"></path>
                                <path d="M67.3374 27.8242V30.4998"></path>
                            </g>
                            <g class="profile-color-modes-illu-frame">
                                <path d="M45.3697 34.2658C41.8877 32.1376 39.7113 28.6222 39.7113 23.2283C39.7113 20.3101 40.3483 17.7986 41.4845 15.6968C40.3605 11.9182 39.662 6.85125 40.7522 5.23168C42.5699 2.53117 49.3177 4.6027 52.1188 8.24095C53.831 7.85521 55.6556 7.66186 57.5491 7.66186C59.3929 7.66186 61.1713 7.84519 62.8442 8.21095C65.6593 4.59134 72.375 2.5386 74.1877 5.23168C75.2599 6.82461 74.6019 11.7525 73.5105 15.5094C74.7112 17.6488 75.3869 20.2229 75.3869 23.2283C75.3869 28.6222 73.2105 32.1376 69.7285 34.2658C70.8603 35.5363 72.6057 38.3556 73.3076 40"></path>
                                <path d="M49.0747 19.8242V22.4999"></path>
                                <path d="M54.0991 28C54.6651 29.0893 55.7863 30.0812 57.9929 30.0812C59.0642 30.0812 59.8797 29.8461 60.5 29.4788"></path>
                                <path d="M66.9126 19.8242V22.4999"></path>
                                <path d="M33.2533 20.0237L39.0723 22.1767"></path>
                                <path d="M39.1369 25.0058L33.0935 27.3212"></path>
                                <path d="M81.8442 19.022L76.0252 21.1751"></path>
                                <path d="M75.961 24.0041L82.0045 26.3196"></path>
                            </g>
                            <g class="profile-color-modes-illu-frame">
                                <path d="M73.4999 40.2236C74.9709 38.2049 75.8108 35.5791 75.8108 32.2283C75.8108 29.2229 75.1351 26.6488 73.9344 24.5094C75.0258 20.7525 75.6838 15.8246 74.6116 14.2317C72.7989 11.5386 66.0832 13.5913 63.2681 17.211C61.5952 16.8452 59.8167 16.6619 57.973 16.6619C56.0795 16.6619 54.2549 16.8552 52.5427 17.2409C49.7416 13.6027 42.9938 11.5312 41.176 14.2317C40.0859 15.8512 40.7843 20.9182 41.9084 24.6968C41.003 26.3716 40.4146 28.3065 40.2129 30.5"></path>
                                <path d="M82.9458 30.5471L76.8413 31.657"></path>
                                <path d="M76.2867 34.4319L81.8362 37.7616"></path>
                                <path d="M49.4995 27.8242V30.4999"></path>
                                <path d="M67.3374 27.8242V30.4998"></path>
                            </g>
                            <g class="profile-color-modes-illu-frame">
                                <path d="M40.6983 31.5C40.5387 29.6246 40.6456 28.0199 41.1762 27.2317C42.9939 24.5312 49.7417 26.6027 52.5428 30.2409C54.2551 29.8552 56.0796 29.6619 57.9731 29.6619C59.8169 29.6619 61.5953 29.8452 63.2682 30.211C66.0833 26.5913 72.799 24.5386 74.6117 27.2317C75.6839 28.8246 75.0259 33.7525 73.9345 37.5094C74.2013 37.9848 74.4422 38.4817 74.6555 39"></path>
                            </g>
                        </g>
                    </svg>
                    <span class="profile-color-modes-toggle js-promo-color-modes-toggle" role="checkbox"
                          aria-checked="false" aria-label="Toggle dark mode" tabindex="0">
                        <div class="profile-color-modes-toggle-track"></div>
                        <div class="profile-color-modes-toggle-thumb js-promo-color-modes-thumb">
                          <svg style="fill: #ffdf5d; margin: 7px 0 0 7px;" aria-hidden="true"
                               width="14" height="13" viewBox="0 0 14 13" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M4.52208 7.71754C7.5782 7.71754 10.0557 5.24006 10.0557 2.18394C10.0557 1.93498 10.0392 1.68986 10.0074 1.44961C9.95801 1.07727 10.3495 0.771159 10.6474 0.99992C12.1153 2.12716 13.0615 3.89999 13.0615 5.89383C13.0615 9.29958 10.3006 12.0605 6.89485 12.0605C3.95334 12.0605 1.49286 10.001 0.876728 7.24527C0.794841 6.87902 1.23668 6.65289 1.55321 6.85451C2.41106 7.40095 3.4296 7.71754 4.52208 7.71754Z"></path>
                          </svg>
                        </div>
                      </span>
                </div>

                <div class="search-toggle j-search-toggle">
                    <svg t="1605187854542" class="close" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="15933" width="200" height="200">
                        <path d="M578.382 512.5L861.58 795.696c18.745 18.745 18.745 49.137 0 67.883-18.746 18.745-49.138 18.745-67.883 0L510.5 580.382 227.304 863.58c-18.745 18.745-49.137 18.745-67.883 0-18.745-18.746-18.745-49.138 0-67.883L442.618 512.5 159.42 229.304c-18.745-18.745-18.745-49.137 0-67.883 18.746-18.745 49.138-18.745 67.883 0L510.5 444.618 793.696 161.42c18.745-18.745 49.137-18.745 67.883 0 18.745 18.746 18.745 49.138 0 67.883L578.382 512.5z" p-id="15934"></path>
                    </svg>
                    <svg class="open" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path d="M419.61244445 837.17688889c98.53155555 0 191.71555555-33.90577778 266.46755555-96.14222222l269.08444445 269.08444444c7.50933333 7.50933333 17.408 11.264 27.30666666 11.264s19.79733333-3.75466667 27.30666667-11.264c15.13244445-15.13244445 15.13244445-39.59466667 0-54.61333333L740.80711111 686.30755555c136.07822222-163.84 127.43111111-408.12088889-26.05511111-561.6071111-78.848-78.73422222-183.63733333-122.19733333-295.13955555-122.19733334-111.50222222 0-216.29155555 43.46311111-295.13955556 122.19733334-162.70222222 162.70222222-162.70222222 427.46311111 0 590.16533333 78.96177778 78.96177778 183.75111111 122.31111111 295.13955556 122.31111111zM179.2 179.42755555c64.28444445-64.17066667 149.61777778-99.55555555 240.41244445-99.55555555 90.79466667 0 176.24177778 35.38488889 240.41244444 99.55555555 132.55111111 132.55111111 132.55111111 348.38755555 0 480.93866667-64.28444445 64.17066667-149.61777778 99.55555555-240.41244444 99.55555556S243.48444445 724.53688889 179.2 660.36622222C46.64888889 527.70133333 46.64888889 311.97866667 179.2 179.42755555z" fill="#333303" p-id="12018"></path>
                    </svg>
                </div>

                <svg class="search-toggle-xs" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="18925" width="200" height="200">
                    <path d="M1008.190624 932.031321l-236.471871-236.471871a431.153179 431.153179 0 1 0-76.157382 76.157382l236.407873 236.471872a53.758152 53.758152 0 0 0 76.157382 0 53.758152 53.758152 0 0 0 0-76.157383zM107.805575 431.184538a323.636875 323.636875 0 0 1 323.316886-323.380884 323.700873 323.700873 0 0 1 323.380883 323.380884 323.636875 323.636875 0 0 1-323.380883 323.316886 323.636875 323.636875 0 0 1-323.316886-323.316886z" p-id="18926"></path>
                </svg>
            </section>
        </section>

        <section class="below">
            <section class="container">
                <!-- 分类 -->
                <nav class="nav">
                    <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
                    <?php while ($categorys->next()) : ?>
                        <?php if ($categorys->levels === 0) : ?>
                            <?php $children = $categorys->getAllChildren($categorys->mid); ?>
                            <?php if (empty($children)) { ?>
                                <section class="link">
                                    <a class="link <?php if ($this->is('category', $categorys->slug)) : ?>active<?php endif; ?>" href="<?php $categorys->permalink(); ?>"><?php $categorys->name(); ?></a>
                                </section>
                            <?php } else { ?>
                                <section class="link drops">
                                    <a class="link <?php if ($this->is('category', $categorys->slug)) : ?>active<?php endif; ?>" href="<?php $categorys->permalink(); ?>">
                                        <span><?php $categorys->name(); ?></span>
                                        <i class="icon iconfont icon-show_more"></i>
                                    </a>
                                    <nav class="j-dropdown">
                                        <?php foreach ($children as $mid) { ?>
                                            <?php $child = $categorys->getCategory($mid); ?>
                                            <a <?php if ($this->is('category', $child['slug'])) : ?>class="active" <?php endif; ?> href="<?php echo $child['permalink'] ?>" title="<?php echo $child['name']; ?>"><?php echo $child['name']; ?></a>
                                        <?php } ?>
                                    </nav>
                                </section>
                            <?php } ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </nav>
                <!-- 导航 -->
                <?php if ($this->options->JNavigation) : ?>
                <section class="census drops">
                    <a href="<?php _e($this->options->JNavigation);?>">
                        <section class="j-drop">
                            <svg t="1608470802226" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1405" width="200" height="200"><path d="M597.76 283.264C597.76 236.416 559.552 198.4 512.576 198.4c-46.912 0-85.184 38.08-85.184 84.864 0 46.72 38.208 84.864 85.184 84.864C559.552 368.064 597.76 329.984 597.76 283.264zM461.504 283.264c0-28.032 22.848-50.944 51.072-50.944 28.16 0 51.072 22.912 51.072 50.944 0 28.032-22.912 50.88-51.072 50.88C484.352 334.144 461.504 311.296 461.504 283.264zM512.192 785.28l13.184-16.064c9.28-11.264 226.432-277.504 225.664-451.712-0.64-140.544-107.648-254.848-238.528-254.848-131.456 0-238.464 114.368-238.464 254.976 0 174.144 215.68 440.384 224.896 451.584L512.192 785.28zM512.576 96.576c112.256 0 203.904 99.136 204.416 221.056 0.512 138.432-157.44 352.384-204.736 413.312-47.104-61.056-204.096-274.88-204.096-413.376C308.16 195.712 399.872 96.576 512.576 96.576zM1014.144 845.12 882.56 606.72c-11.904-21.632-34.624-35.008-59.392-35.008l-123.2 0c-9.6 0-17.152 7.616-17.152 17.024 0 9.344 7.488 16.896 17.152 16.896l123.2 0c12.224 0 23.616 6.72 29.504 17.408l131.648 238.4c5.76 10.496 5.632 22.912-0.512 33.28-6.208 10.24-16.896 16.448-28.928 16.448L70.336 911.168c-12.032 0-22.848-6.208-28.992-16.448-6.08-10.304-6.336-22.72-0.512-33.28l131.584-238.4c5.888-10.688 17.28-17.408 29.504-17.408l123.328 0c9.344 0 16.96-7.552 16.96-16.896 0-9.344-7.616-17.024-16.96-17.024L201.92 571.712c-24.704 0-47.424 13.376-59.328 35.008l-131.584 238.4c-11.648 20.992-11.264 46.016 1.024 66.752 12.288 20.864 34.112 33.28 58.304 33.28L954.88 945.152c24.192 0 46.08-12.352 58.176-33.28C1025.344 891.136 1025.856 866.112 1014.144 845.12z" p-id="1406"></path></svg>
                            <span>导航</span>
                        </section>
                    </a>
                </section>
                <?php endif;?>
                <!-- 统计 -->
                <?php if ($this->options->JCensusStatus === 'on') : ?>
                    <section class="census drops">
                        <section class="j-drop">
                            <svg t="1603101294607" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2418" width="200" height="200">
                                <path d="M273.5104 565.82656l200.704-209.97632 194.00704 202.98752c1.4848 2.31424 2.46272 4.93568 4.4544 6.9888 15.90784 16.65536 41.65632 16.65536 57.51808 0l222.86848-233.16992c2.5088-1.68448 4.82304-3.62496 6.92224-5.80608 16.256-17.00864 16.256-44.5952 0-61.61408-16.27136-17.01888-42.64448-17.01888-58.9056 0-1.19296 1.28512-1.72544 2.94912-2.76992 4.34176l-195.73248 204.8256-198.0928-207.27808c-0.50176-0.57856-0.67584-1.3312-1.19296-1.88928-16.26112-17.01376-42.63424-17.01376-58.91072 0-1.21344 1.29024-1.70496 2.95424-2.72896 4.34688L215.99744 505.69216c-15.88736 16.6144-15.88736 43.56608 0 60.1344 15.88224 16.66048 41.64608 16.66048 57.51296 0z m704.8448 273.32096H88.70912V144.1024c0-20.20864-15.91808-36.5824-35.584-36.5824s-35.58912 16.37376-35.58912 36.5824v731.63776c0 20.20864 15.9232 36.57216 35.58912 36.57216h925.2352c19.64032 0 35.58912-16.3584 35.58912-36.57216 0.00512-20.1984-15.93856-36.59264-35.59424-36.59264z m0 0" p-id="2419"></path>
                            </svg>
                            <span>统计</span>
                        </section>
                        <nav class="j-dropdown">
<!--                            <section id="census"></section>-->
                            <div class="stats">
                                <ul>
                                    <?php if ($this->options->JSitedate): ?>
                                        <li><?php _e('建站日期：'); ?><?php $this->options->JSitedate(); ?></li>
                                    <?php endif; ?>
                                    <?php global $stat; ?>
                                    <li><?php _e('文章总数：'); ?><?php $stat->publishedPostsNum() ?><?php _e(' 篇'); ?></li>
                                    <li><?php _e('评论总数：'); ?><?php $stat->publishedCommentsNum() ?><?php _e(' 条'); ?></li>
                                    <li><?php _e('分类总数：'); ?><?php $stat->categoriesNum() ?><?php _e(' 个'); ?></li>
                                    <li><?php _e('最后更新：'); ?><?php get_last_update(); ?></li>
                                </ul>
                            </div>
                        </nav>
                    </section>
                <?php endif; ?>

                <?php if ($this->options->JSignStatus === 'on') : ?>
                    <?php if ($this->user->hasLogin()) : ?>
                        <section class="logged drops">
                            <section class="j-drop">
                                <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M256.003012 341.329983c0-141.182993 114.805994-255.997988 255.987988-255.997987 141.182993 0 255.996988 114.814994 255.996988 255.996987 0 141.173993-114.813994 255.996988-255.996988 255.996988S255.994013 482.502976 255.994013 341.329983M979.869977 970.349953c-41.949998-157.139992-152.539993-280.018986-291.409986-337.404984 98.592995-59.902997 164.861992-168.019992 164.861992-291.622986C853.311983 153.128993 700.182991 0 511.983 0s-341.329983 153.128993-341.329983 341.329983c0 123.594994 66.260997 231.709989 164.904992 291.613986C196.680015 690.372966 86.090021 813.20896 44.114023 970.347953a42.649998 42.649998 0 0 0 30.207998 52.171997 42.708998 42.708998 0 0 0 52.256998-30.206998C175.280016 810.00896 333.741009 682.658967 512 682.658967s336.755984 127.357994 385.445981 309.669985a42.579998 42.579998 0 0 0 52.223998 30.207998 42.649998 42.649998 0 0 0 30.206998-52.179997" p-id="5392"></path>
                                </svg>
                                <span><?php $this->user->screenName(); ?></span>
                            </section>
                            <nav class="j-dropdown">
                                <?php if ($this->user->group == 'administrator') : ?>
                                    <a rel="nofollow" target="_balnk" href="<?php $this->options->adminUrl("options-theme.php"); ?>">修改外观</a>
                                <?php endif; ?>
                                <?php if ($this->user->group == 'administrator' || $this->user->group == 'editor' || $this->user->group == 'contributor') : ?>
                                    <a rel="nofollow" target="_balnk" href="<?php $this->options->adminUrl("manage-posts.php"); ?>">管理文章</a>
                                <?php endif; ?>
                                <a rel="nofollow" target="_balnk" href="<?php $this->options->adminUrl(); ?>">进入后台</a>
                                <a rel="nofollow" href="<?php $this->options->logoutUrl(); ?>">退出登录</a>
                            </nav>
                        </section>
                    <?php else : ?>
                        <section class="sign">
                            <?php
                            $all = Typecho_Plugin::export();
                            if (array_key_exists('TePass', $all['activated'])):
                            ?>
                            <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <path d="M256.003012 341.329983c0-141.182993 114.805994-255.997988 255.987988-255.997987 141.182993 0 255.996988 114.814994 255.996988 255.996987 0 141.173993-114.813994 255.996988-255.996988 255.996988S255.994013 482.502976 255.994013 341.329983M979.869977 970.349953c-41.949998-157.139992-152.539993-280.018986-291.409986-337.404984 98.592995-59.902997 164.861992-168.019992 164.861992-291.622986C853.311983 153.128993 700.182991 0 511.983 0s-341.329983 153.128993-341.329983 341.329983c0 123.594994 66.260997 231.709989 164.904992 291.613986C196.680015 690.372966 86.090021 813.20896 44.114023 970.347953a42.649998 42.649998 0 0 0 30.207998 52.171997 42.708998 42.708998 0 0 0 52.256998-30.206998C175.280016 810.00896 333.741009 682.658967 512 682.658967s336.755984 127.357994 385.445981 309.669985a42.579998 42.579998 0 0 0 52.223998 30.207998 42.649998 42.649998 0 0 0 30.206998-52.179997" p-id="5392"></path>
                            </svg>
                            <a class="link" href="<?php $loginUrl = $this->options->index.'/tepass/signin';_e($loginUrl);?>">登录</a><span class="line">/</span><a class="link" href="<?php $loginUrl = $this->options->index.'/tepass/signin';_e($loginUrl);?>">注册</a>
                            <?php else: ?>
                            <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <path d="M256.003012 341.329983c0-141.182993 114.805994-255.997988 255.987988-255.997987 141.182993 0 255.996988 114.814994 255.996988 255.996987 0 141.173993-114.813994 255.996988-255.996988 255.996988S255.994013 482.502976 255.994013 341.329983M979.869977 970.349953c-41.949998-157.139992-152.539993-280.018986-291.409986-337.404984 98.592995-59.902997 164.861992-168.019992 164.861992-291.622986C853.311983 153.128993 700.182991 0 511.983 0s-341.329983 153.128993-341.329983 341.329983c0 123.594994 66.260997 231.709989 164.904992 291.613986C196.680015 690.372966 86.090021 813.20896 44.114023 970.347953a42.649998 42.649998 0 0 0 30.207998 52.171997 42.708998 42.708998 0 0 0 52.256998-30.206998C175.280016 810.00896 333.741009 682.658967 512 682.658967s336.755984 127.357994 385.445981 309.669985a42.579998 42.579998 0 0 0 52.223998 30.207998 42.649998 42.649998 0 0 0 30.206998-52.179997" p-id="5392"></path>
                            </svg>
                            <div class="sign-box">
                                <span class="j-drop">登录</span>
                                <form class="j-dropdown" id="loginForm" stop-propagation method="post" name="login" action="<?php $this->options->loginAction() ?>">
                                    <input type="hidden" name="referer" value="<?php $this->options->siteUrl(); ?>">
                                    <div class="form-item">
                                        <div>用户名</div>
                                        <input class="username" placeholder="请输入用户名" type="text" maxlength="16" name="name" autocomplete="off" />
                                    </div>
                                    <div class="form-item">
                                        <div>密码</div>
                                        <input class="password" placeholder="请输入密码" type="password" maxlength="16" name="password" autocomplete="off" />
                                    </div>
                                    <div class="form-item">
                                        <button type="submit">登 录</button>
                                    </div>
                                </form>
                            </div>
                            <?php if ($this->options->allowRegister) : ?>
                                <span class="line">/</span>
                                <div class="sign-box">
                                    <span class="j-drop">注册</span>
                                    <form stop-propagation id="registerForm" class="j-dropdown" action="<?php $this->options->registerAction(); ?>" method="post" name="register">
                                        <div class="form-item">
                                            <div>用户名</div>
                                            <input class="username" placeholder="请输入用户名" type="text" maxlength="16" name="name" autocomplete="off" />
                                        </div>
                                        <div class="form-item">
                                            <div>邮箱</div>
                                            <input class="mail" placeholder="请输入邮箱" type="text" name="mail" autocomplete="off" />
                                        </div>
                                        <div class="form-item">
                                            <button type="submit">注 册</button>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <?php endif; ?>
                        </section>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- 弹幕 -->
                <?php if ($this->options->JBarragerStatus === 'on') : ?>
                    <input id="barrager" class="barrager" type="checkbox" title="开启/关闭弹幕">
                <?php endif; ?>
            </section>
        </section>

        <?php if ($this->options->JProgressStatus === 'on') : ?>
            <section id="progress" class="progress"></section>
        <?php endif; ?>

    </header>
<?php else : ?>
    <header class="container-fluid j-header j-header-fluid">

        <!-- 进度条 -->
        <?php if ($this->options->JProgressStatus === 'on') : ?>
            <section id="progress" class="progress"></section>
        <?php endif; ?>

        <div class="j-slide slide">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <!-- 网站 logo -->
        <h1 class="logo j-hover-music" title="<?php $this->options->title(); ?>">
            <?php $this->options->title(); ?>
            <a href="<?php $this->options->siteUrl(); ?>">
                <img src="<?php echo $this->options->JLogo ? $this->options->JLogo : 'https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/assets/img/logo.png' ?>" alt="logo">
            </a>
        </h1>

        <section class="left j-nav">

            <!-- 链接 -->
            <nav class="nav">
                <a class="link <?php if ($this->is('index')) : ?>active<?php endif; ?>" href="<?php $this->options->siteUrl(); ?>">首页</a>
                <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
                <?php while ($categorys->next()) : ?>
                    <?php if ($categorys->levels === 0) : ?>
                        <?php $children = $categorys->getAllChildren($categorys->mid); ?>
                        <?php if (empty($children)) { ?>
                            <a class="link <?php if ($this->is('category', $categorys->slug)) : ?>active<?php endif; ?>" href="<?php $categorys->permalink(); ?>"><?php $categorys->name(); ?></a>
                        <?php } else { ?>
                            <section class="drop drops">
                                <section class="j-drop">
                                    <span><?php $categorys->name(); ?></span>
                                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M825.728 390.144L521.056 702.336 217.152 390.144c-16.576-16.576-43.744-16.576-60.32 0s-16.576 43.744 0 60.32L483.36 778.496c10.56 9.056 23.392 19.616 36.96 17.344 13.568 3.008 27.904-6.784 38.464-17.344L886.08 450.464a42.816 42.816 0 0 0 0-60.32 42.784 42.784 0 0 0-60.352 0z"></path>
                                    </svg>
                                </section>
                                <nav class="j-dropdown">
                                    <?php foreach ($children as $mid) { ?>
                                        <?php $child = $categorys->getCategory($mid); ?>
                                        <a <?php if ($this->is('category', $child['slug'])) : ?>class="active" <?php endif; ?> href="<?php echo $child['permalink'] ?>" title="<?php echo $child['name']; ?>"><?php echo $child['name']; ?></a>
                                    <?php } ?>
                                </nav>
                            </section>
                        <?php } ?>
                    <?php endif; ?>
                <?php endwhile; ?>

                <!-- 页面 -->
                <section class="drop drops">
                    <section class="j-drop">
                        <span>页面</span>
                        <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M813.056 201.216c-11.776 32.768-18.432 67.584-18.432 103.424 0 34.816 6.144 69.632 17.92 101.888H250.88c-56.32 0-102.4-46.08-102.4-102.4s46.08-102.4 102.4-102.4h562.176M947.2 129.536H250.88c-96.256 0-174.08 77.824-174.08 174.08s77.824 174.08 174.08 174.08h694.272c-48.64-41.984-78.848-103.936-78.848-173.568 0-70.144 31.232-132.608 80.896-174.592zM773.12 617.984c56.32 0 102.4 46.08 102.4 102.4s-46.08 102.4-102.4 102.4H211.456c11.776-32.256 17.92-66.56 17.92-101.888 0-35.84-6.144-70.656-18.432-103.424H773.12m0-71.168H76.8c49.664 41.984 80.896 104.96 80.896 175.104 0 69.12-30.72 131.072-78.848 173.568H773.12c96.256 0 174.08-77.824 174.08-174.08 0-96.768-77.824-174.592-174.08-174.592z" p-id="2529"></path>
                        </svg>
                    </section>
                    <nav class="j-dropdown">
                        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                        <?php while ($pages->next()) : ?>
                            <a class="<?php if ($this->is('page', $pages->slug)) : ?>active<?php endif; ?>" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                        <?php endwhile; ?>
                    </nav>
                </section>

                <!-- 其他 -->
                <?php if ($this->options->JCustomNavs) : ?>
                    <section class="drop">
                        <section class="j-drop">
                            <span>其他</span>
                            <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <path d="M825.728 390.144L521.056 702.336 217.152 390.144c-16.576-16.576-43.744-16.576-60.32 0s-16.576 43.744 0 60.32L483.36 778.496c10.56 9.056 23.392 19.616 36.96 17.344 13.568 3.008 27.904-6.784 38.464-17.344L886.08 450.464a42.816 42.816 0 0 0 0-60.32 42.784 42.784 0 0 0-60.352 0z"></path>
                            </svg>
                        </section>
                        <nav class="j-dropdown">
                            <?php
                            $txt = $this->options->JCustomNavs;
                            $string_arr = explode("\r\n", $txt);
                            $long = count($string_arr);
                            for ($i = 0; $i < $long; $i++) {
                                $title = explode("||", $string_arr[$i])[0];
                                $url = explode("||", $string_arr[$i])[1];
                                ?>
                                <a target="_blank" href="<?php echo $url ?>"><?php echo $title ?></a>
                            <?php } ?>
                        </nav>
                    </section>
                <?php endif; ?>

                <!-- 统计 -->
                <?php if ($this->options->JCensusStatus === 'on') : ?>
                    <section class="drop drop-census drops">
                        <section class="j-drop">
                            <span>统计</span>
                            <svg t="1603101294607" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2418" width="200" height="200">
                                <path d="M273.5104 565.82656l200.704-209.97632 194.00704 202.98752c1.4848 2.31424 2.46272 4.93568 4.4544 6.9888 15.90784 16.65536 41.65632 16.65536 57.51808 0l222.86848-233.16992c2.5088-1.68448 4.82304-3.62496 6.92224-5.80608 16.256-17.00864 16.256-44.5952 0-61.61408-16.27136-17.01888-42.64448-17.01888-58.9056 0-1.19296 1.28512-1.72544 2.94912-2.76992 4.34176l-195.73248 204.8256-198.0928-207.27808c-0.50176-0.57856-0.67584-1.3312-1.19296-1.88928-16.26112-17.01376-42.63424-17.01376-58.91072 0-1.21344 1.29024-1.70496 2.95424-2.72896 4.34688L215.99744 505.69216c-15.88736 16.6144-15.88736 43.56608 0 60.1344 15.88224 16.66048 41.64608 16.66048 57.51296 0z m704.8448 273.32096H88.70912V144.1024c0-20.20864-15.91808-36.5824-35.584-36.5824s-35.58912 16.37376-35.58912 36.5824v731.63776c0 20.20864 15.9232 36.57216 35.58912 36.57216h925.2352c19.64032 0 35.58912-16.3584 35.58912-36.57216 0.00512-20.1984-15.93856-36.59264-35.59424-36.59264z m0 0" p-id="2419"></path>
                            </svg>
                        </section>
                        <nav class="j-dropdown census">
                            <div class="stats">
                                <ul>
                                    <?php if ($this->options->JSitedate): ?>
                                        <li><?php _e('建站日期：'); ?><?php $this->options->JSitedate(); ?></li>
                                    <?php endif; ?>
                                    <?php global $stat; ?>
                                    <li><?php _e('文章总数：'); ?><?php $stat->publishedPostsNum() ?><?php _e(' 篇'); ?></li>
                                    <li><?php _e('评论总数：'); ?><?php $stat->publishedCommentsNum() ?><?php _e(' 条'); ?></li>
                                    <li><?php _e('分类总数：'); ?><?php $stat->categoriesNum() ?><?php _e(' 个'); ?></li>
                                    <li><?php _e('最后更新：'); ?><?php get_last_update(); ?></li>
                                </ul>
                            </div>
                        </nav>
                    </section>
                <?php endif; ?>
            </nav>

            <!-- 弹幕 -->
            <?php if ($this->options->JBarragerStatus === 'on') : ?>
                <input id="barrager" class="barrager" type="checkbox" title="开启/关闭弹幕">
            <?php endif; ?>

        </section>

        <section class="right">

            <!-- 登录/注册 -->
            <?php if ($this->options->JSignStatus === 'on') : ?>
                <?php if ($this->user->hasLogin()) : ?>
                    <section class="logged">
                        <section class="j-drop">
                            <img src="<?php ParseAvatar($this->user->mail); ?>">
                        </section>
                        <nav class="j-dropdown">
                            <?php if ($this->user->group == 'administrator') : ?>
                                <a rel="nofollow" target="_balnk" href="<?php $this->options->adminUrl("options-theme.php"); ?>">修改外观</a>
                            <?php endif; ?>
                            <?php if ($this->user->group == 'administrator' || $this->user->group == 'editor' || $this->user->group == 'contributor') : ?>
                                <a rel="nofollow" target="_balnk" href="<?php $this->options->adminUrl("manage-posts.php"); ?>">管理文章</a>
                            <?php endif; ?>
                            <a rel="nofollow" target="_balnk" href="<?php $this->options->adminUrl(); ?>">进入后台</a>
                            <a rel="nofollow" href="<?php $this->options->logoutUrl(); ?>">退出登录</a>
                        </nav>
                    </section>
                <?php else : ?>
                    <section class="sign">
                        <div class="sign-box">
                            <button class="j-drop">
                                <span>登录</span>
                                <span>Go !</span>
                            </button>
                            <form class="j-dropdown" id="loginForm" stop-propagation method="post" name="login" action="<?php $this->options->loginAction() ?>">
                                <input type="hidden" name="referer" value="<?php $this->options->siteUrl(); ?>">
                                <div class="form-item">
                                    <div>用户名</div>
                                    <input class="username" placeholder="请输入用户名" type="text" maxlength="16" name="name" autocomplete="off" />
                                </div>
                                <div class="form-item">
                                    <div>密码</div>
                                    <input class="password" placeholder="请输入密码" type="password" maxlength="16" name="password" autocomplete="off" />
                                </div>
                                <div class="form-item">
                                    <button type="submit">登 录</button>
                                </div>
                            </form>
                        </div>
                        <?php if ($this->options->allowRegister) : ?>
                            <div class="sign-box">
                                <button class="j-drop">
                                    <span>注册</span>
                                    <span>Go !</span>
                                </button>
                                <form stop-propagation id="registerForm" class="j-dropdown" action="<?php $this->options->registerAction(); ?>" method="post" name="register">
                                    <div class="form-item">
                                        <div>用户名</div>
                                        <input class="username" placeholder="请输入用户名" type="text" maxlength="16" name="name" autocomplete="off" />
                                    </div>
                                    <div class="form-item">
                                        <div>邮箱</div>
                                        <input class="mail" placeholder="请输入邮箱" type="text" name="mail" autocomplete="off" />
                                    </div>
                                    <div class="form-item">
                                        <button type="submit">注 册</button>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                    </section>
                <?php endif; ?>
            <?php endif; ?>

            <!-- 搜索 -->
            <form class="search j-search" method="get" action="<?php $this->options->siteUrl(); ?>">
                <input maxlength="20" name="s" autocomplete="off" <?php if ($this->is('search')) : ?>value="<?php $this->archiveTitle(' &raquo; ', '', ''); ?>" <?php endif; ?> type="text" placeholder="请输入关键字..." />
                <button type="submit">
                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path d="M999.038976 940.800004l-186.879991-186.239991c159.999992-186.239991 144.639993-465.278977-35.199998-632.317969-179.199991-167.679992-458.878978-161.919992-632.957969 11.519999-169.599992 169.599992-178.559991 440.958978-21.759999 622.07897 156.799992 181.119991 427.518979 208.63999 618.87897 63.999997l188.799991 188.798991c12.159999 12.159999 30.079999 16.639999 46.719997 12.159999 16.638999-3.84 30.078999-17.279999 33.918999-33.919998 5.76-16.639999 0.64-33.919998-11.52-46.079998zM466.560002 816.64001c-199.67999 0-360.319982-161.279992-360.319982-360.318982 0-198.39999 161.279992-359.679982 360.319982-359.679983 199.67999 0 360.319982 161.279992 360.319983 360.319983 0.64 198.39999-160.639992 359.679982-360.319983 359.679982z m0 0" p-id="5075"></path>
                    </svg>
                </button>
                <span></span>
            </form>

            <div class="search-toggle j-search-toggle">
                <svg t="1605187854542" class="close" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="15933" width="200" height="200">
                    <path d="M578.382 512.5L861.58 795.696c18.745 18.745 18.745 49.137 0 67.883-18.746 18.745-49.138 18.745-67.883 0L510.5 580.382 227.304 863.58c-18.745 18.745-49.137 18.745-67.883 0-18.745-18.746-18.745-49.138 0-67.883L442.618 512.5 159.42 229.304c-18.745-18.745-18.745-49.137 0-67.883 18.746-18.745 49.138-18.745 67.883 0L510.5 444.618 793.696 161.42c18.745-18.745 49.137-18.745 67.883 0 18.745 18.746 18.745 49.138 0 67.883L578.382 512.5z" p-id="15934"></path>
                </svg>
                <svg class="open" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M419.61244445 837.17688889c98.53155555 0 191.71555555-33.90577778 266.46755555-96.14222222l269.08444445 269.08444444c7.50933333 7.50933333 17.408 11.264 27.30666666 11.264s19.79733333-3.75466667 27.30666667-11.264c15.13244445-15.13244445 15.13244445-39.59466667 0-54.61333333L740.80711111 686.30755555c136.07822222-163.84 127.43111111-408.12088889-26.05511111-561.6071111-78.848-78.73422222-183.63733333-122.19733333-295.13955555-122.19733334-111.50222222 0-216.29155555 43.46311111-295.13955556 122.19733334-162.70222222 162.70222222-162.70222222 427.46311111 0 590.16533333 78.96177778 78.96177778 183.75111111 122.31111111 295.13955556 122.31111111zM179.2 179.42755555c64.28444445-64.17066667 149.61777778-99.55555555 240.41244445-99.55555555 90.79466667 0 176.24177778 35.38488889 240.41244444 99.55555555 132.55111111 132.55111111 132.55111111 348.38755555 0 480.93866667-64.28444445 64.17066667-149.61777778 99.55555555-240.41244444 99.55555556S243.48444445 724.53688889 179.2 660.36622222C46.64888889 527.70133333 46.64888889 311.97866667 179.2 179.42755555z" fill="#333303" p-id="12018"></path>
                </svg>
            </div>
        </section>

        <svg class="search-toggle-xs" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="18925" width="200" height="200">
            <path d="M1008.190624 932.031321l-236.471871-236.471871a431.153179 431.153179 0 1 0-76.157382 76.157382l236.407873 236.471872a53.758152 53.758152 0 0 0 76.157382 0 53.758152 53.758152 0 0 0 0-76.157383zM107.805575 431.184538a323.636875 323.636875 0 0 1 323.316886-323.380884 323.700873 323.700873 0 0 1 323.380883 323.380884 323.636875 323.636875 0 0 1-323.380883 323.316886 323.636875 323.636875 0 0 1-323.316886-323.316886z" p-id="18926"></path>
        </svg>
    </header>
<?php endif; ?>

<div class="j-sidebar-xs">
    <div class="mask"></div>
    <div class="content">
        <div class="item user d-none d-md-block">
            <img src="<?php $this->options->JAuthorAvatar ? $this->options->JAuthorAvatar() : ParseAvatar($this->author->mail); ?>" />
            <p class="name"><?php $this->author->screenName(); ?></p>
            <?php if ($this->options->JMotto) : ?>
                <div class="desc j-aside-motto"><?php GetRandomMotto(); ?></div>
            <?php else : ?>
                <div class="desc j-aside-motto"></div>
            <?php endif; ?>
        </div>
        <div class="item recommend">
            <div class="card">
                <div class="title ">热门推荐</div>
                <ul>
                    <li>
                        <a class="link" href="<?php echo $this->options->index.'/resources' ?>">
                            <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M325.31499999 764.323l1e-8-508.83099999c0-28.16 22.598-50.934 50.757-50.93400001 13.09300001 0 24.932 5.024 33.901 13.092l335.755 251.633c22.24 16.859 26.905 48.607 10.044 71.024-2.87099999 3.947-6.281 7.355-10.045 10.045l-339.338 254.51c-22.241 16.676-54.16 12.193-70.844-10.225-6.996-9.15-10.225-19.73-10.225-30.31v0z" p-id="6117"></path></svg>
                            资源专区
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <?php if ($categorys->have()) : ?>
            <div class="item category">
                <div class="card">
                    <div class="title">类目归类</div>
                    <ul class="category-nav">
                        <?php while ($categorys->next()) : ?>
                            <?php $children = $categorys->getAllChildren($categorys->mid); ?>
                            <?php if ($categorys->levels === 0): ?>
                                <?php if (empty($children)): ?>
                                    <li class='<?php if ($this->is('category', $categorys->slug)) _e("active"); ?>'>

                                        <a href="<?php $categorys->permalink(); ?>">
                                            <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M325.31499999 764.323l1e-8-508.83099999c0-28.16 22.598-50.934 50.757-50.93400001 13.09300001 0 24.932 5.024 33.901 13.092l335.755 251.633c22.24 16.859 26.905 48.607 10.044 71.024-2.87099999 3.947-6.281 7.355-10.045 10.045l-339.338 254.51c-22.241 16.676-54.16 12.193-70.844-10.225-6.996-9.15-10.225-19.73-10.225-30.31v0z" p-id="6117"></path>
                                            </svg>
                                            <?php $categorys->name(); ?></a>
                                    </li>
                                <?php else: ?>
                                    <li class='<?php if ($this->is('category', $categorys->slug)) _e("active"); ?>'>

                                        <a no-pjax href="<?php $categorys->permalink(); ?>">
                                            <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M325.31499999 764.323l1e-8-508.83099999c0-28.16 22.598-50.934 50.757-50.93400001 13.09300001 0 24.932 5.024 33.901 13.092l335.755 251.633c22.24 16.859 26.905 48.607 10.044 71.024-2.87099999 3.947-6.281 7.355-10.045 10.045l-339.338 254.51c-22.241 16.676-54.16 12.193-70.844-10.225-6.996-9.15-10.225-19.73-10.225-30.31v0z" p-id="6117"></path>
                                            </svg>
                                            <?php $categorys->name(); ?>
                                            <span><i class="icon iconfont icon-Chevronrighticon text-right"></i><i class="icon iconfont icon-Chevrondownicon text-down"></i></span>
                                        </a>
                                        <ul>
                                            <?php foreach ($children as $mid):?>
                                                <?php $child = $categorys->getCategory($mid); ?>
                                                <li <?php if($this->is('category', $child['slug'])): ?> class="active"<?php endif; ?>>
                                                    <a href="<?php echo $child['permalink'] ?>" title="<?php echo $child['name']; ?>"><?php echo $child['name']; ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <div class="item">
            <div class="card">
                <div class="title">网站页面</div>
                <ul>
                    <li class="<?php if ($this->is('index')) : ?>active<?php endif; ?>">
                        <a href="<?php $this->options->siteUrl(); ?>"><svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <path d="M325.31499999 764.323l1e-8-508.83099999c0-28.16 22.598-50.934 50.757-50.93400001 13.09300001 0 24.932 5.024 33.901 13.092l335.755 251.633c22.24 16.859 26.905 48.607 10.044 71.024-2.87099999 3.947-6.281 7.355-10.045 10.045l-339.338 254.51c-22.241 16.676-54.16 12.193-70.844-10.225-6.996-9.15-10.225-19.73-10.225-30.31v0z" p-id="6117"></path>
                            </svg>首页</a>
                    </li>
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while ($pages->next()) : ?>
                        <li class="<?php if ($this->is('page', $pages->slug)) : ?>active<?php endif; ?>">

                            <a href="<?php $pages->permalink(); ?>">
                                <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M325.31499999 764.323l1e-8-508.83099999c0-28.16 22.598-50.934 50.757-50.93400001 13.09300001 0 24.932 5.024 33.901 13.092l335.755 251.633c22.24 16.859 26.905 48.607 10.044 71.024-2.87099999 3.947-6.281 7.355-10.045 10.045l-339.338 254.51c-22.241 16.676-54.16 12.193-70.844-10.225-6.996-9.15-10.225-19.73-10.225-30.31v0z" p-id="6117"></path>
                                </svg><?php $pages->title(); ?></a>
                        </li>
                    <?php endwhile; ?>
                    <?php if ($this->options->JOpenContrib):?>
                    <li>
                        <a class="link" style="color: #f64444" href="/contribute.html"><i style="margin-right: 3px" class="icon iconfont icon-chaoji"></i>成为投稿者</a>
                    </li>
                    <?php endif;?>

                    <!-- 自定义链接 -->
                    <?php if ($this->options->JCustomNavs) : ?>
                        <?php
                        $txt = $this->options->JCustomNavs;
                        $string_arr = explode("\r\n", $txt);
                        $long = count($string_arr);
                        for ($i = 0; $i < $long; $i++) {
                            $title = explode("||", $string_arr[$i])[0];
                            $url = explode("||", $string_arr[$i])[1];
                            ?>
                            <li>
                                <a target="_blank" href="<?php echo $url ?>"><svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M325.31499999 764.323l1e-8-508.83099999c0-28.16 22.598-50.934 50.757-50.93400001 13.09300001 0 24.932 5.024 33.901 13.092l335.755 251.633c22.24 16.859 26.905 48.607 10.044 71.024-2.87099999 3.947-6.281 7.355-10.045 10.045l-339.338 254.51c-22.241 16.676-54.16 12.193-70.844-10.225-6.996-9.15-10.225-19.73-10.225-30.31v0z" p-id="6117"></path>
                                    </svg><?php echo $title ?>
                                </a>
                            </li>
                        <?php } ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

    </div>
</div>

<div class="j-search-down-xs">
    <div class="content">
        <form method="get" action="<?php $this->options->siteUrl(); ?>">
            <input maxlength="20" name="s" autocomplete="off" <?php if ($this->is('search')) : ?>value="<?php $this->archiveTitle(' &raquo; ', '', ''); ?>" <?php endif; ?> type="text" placeholder="请输入关键字..." />
            <button type="submit">Search</button>
        </form>
        <?php $this->widget('Widget_Metas_Tag_Cloud', array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true, 'limit' => 30))->to($tags); ?>
        <?php if ($tags->have()) : ?>
            <div class="title">
                <svg viewBox="0 0 1445 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1055.021176 277.865412a348.762353 348.762353 0 0 1 348.400942 348.340706c0 178.959059-136.131765 327.68-311.777883 346.172235l-758.603294 2.349176A291.237647 291.237647 0 0 1 42.164706 683.791059a291.237647 291.237647 0 0 1 273.227294-290.334118A369.242353 369.242353 0 0 1 683.791059 42.164706a370.567529 370.567529 0 0 1 344.18447 236.905412c9.336471-0.783059 18.191059-1.204706 27.045647-1.204706z m-371.230117-121.615059a255.036235 255.036235 0 0 0-254.735059 254.795294v95.954824H333.101176a177.031529 177.031529 0 0 0-176.790588 176.790588 177.031529 177.031529 0 0 0 176.790588 176.850823h721.980236a234.676706 234.676706 0 0 0 234.315294-234.435764 234.616471 234.616471 0 0 0-234.315294-234.255059 234.616471 234.616471 0 0 0-234.315294 234.315294v18.070588H706.56v-18.070588A348.400941 348.400941 0 0 1 915.817412 307.2a255.578353 255.578353 0 0 0-232.026353-151.009882z" p-id="20337"></path>
                </svg>标签搜索
            </div>
            <ul id="search-cloud" class="cloud">
                <?php while ($tags->next()) : ?>
                    <li>
                        <a href="<?php $tags->permalink(); ?>"><?php $tags->name(); ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="mask"></div>
</div>
