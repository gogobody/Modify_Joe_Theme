<div class="news-foot">
    <?php if ($this->is('author')) : ?><?php else : ?>
        <div class="container d-block height-auto">
            <div class="part-news-foot">
                <h2 class="section-title">栏目推荐</h2>
                <div class="section-content">
                    <?php
                    $this->widget('Widget_Archive@recommend', 'pageSize=5&type=category', 'mid='.$this->options->JFootRecommendMid)->to($categoryPosts);
                    ?>
                    <?php while ($categoryPosts->next()): ?>
                        <div class="item">
                            <a href="<?php $categoryPosts->permalink(); ?>" class="thumb">
                                <div class="item-thumb">
                                    <div class="thumb">
                                            <img class="lazyload" src="<?php echo GetLazyLoad(); ?>" data-src="<?php GetRandomThumbnail($categoryPosts); ?>" alt="recommend not found ">
                                    </div>
                                </div>
                                <div class="item-main">
                                    <h3><?php $categoryPosts->title(); ?></h3>
                                    <p><?php if ($categoryPosts->excerpt) $categoryPosts->excerpt(18,'...'); else _e('啥也没写，不如自己看看');?></p>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>

            </div>
        </div>
    <?php endif; ?>
</div>

