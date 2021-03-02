<?php if (count((explode("||", ($this->options->JIndexRecommend)))) == 2 || $this->options->JIndexCarousel) : ?>
    <div class="index-banner">
        <?php if ($this->options->JIndexCarousel) : ?>
            <?php
            $txt = $this->options->JIndexCarousel;
            $string_arr = explode("\r\n", $txt);
            $long = count($string_arr);
            ?>
            <div class="lb-box" id="lb-1">
                <!-- 轮播内容 -->
                <div class="lb-content">
                    <?php
                    for ($i = 0; $i < $long; $i++) {
                        $img = explode("||", $string_arr[$i])[0];
                        $url = explode("||", $string_arr[$i])[1];
                        $title = explode("||", $string_arr[$i])[2];
                    ?>
                    <div class="lb-item <?php if($i == 0) _e('active');?>">
                        <a class="lazyload" href="<?php echo $url ?>" target="_blank" style="background-image: url('<?php echo GetLazyLoad() ?>')" data-bg="<?php echo $img ?>" rel="noopener">
                            <i class="mask"></i>
                            <div>
                                <h1><?php echo $title ?></h1>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
                <!-- 轮播标志 -->
                <ol class="lb-sign">
                    <?php for ($i = 0; $i < $long; $i++):?>
                    <li class="<?php if($i == 0) _e('active');?>" slide-to="<?php _e($i);?>"><?php _e($i+1);?></li>
                    <?php endfor;?>
                </ol>
                <!-- 轮播控件 -->
                <div class="lb-ctrl left">＜</div>
                <div class="lb-ctrl right">＞</div>
            </div>
        <?php endif; ?>

        <?php
        $recommend = $this->options->JIndexRecommend;
        $recommendCounts = explode("||", $recommend);
        $number = count($recommendCounts);
        if ($number === 2) {
        ?>
            <div class="recommend <?php if (!$this->options->JIndexCarousel) : ?>noCarousel<?php endif; ?>" id="recommend">
                <?php for ($i = 0; $i < $number; $i++) {
                ?>
                    <?php $this->widget('Widget_Archive@recommend' . $i, 'pageSize=1&type=post', 'cid=' . $recommendCounts[$i])->to($item); ?>
                    <a class="r-item lazyload" title="<?php $item->title(); ?>" href="<?php $item->permalink() ?>" style="background-image: url('<?php echo GetLazyLoad() ?>')" data-bg="<?php GetRandomThumbnail($item) ?>">
                        <i class="mask"></i>
                        <div class="desc">
                            <span class="type">推荐</span>
                            <p><?php $item->title(); ?></p>
                        </div>
                    </a>

                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php endif; ?>