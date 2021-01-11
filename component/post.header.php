<div class="header">
    <h1 class="title"><?php $this->title() ?></h1>
    <?php if ($this->options->JPostCountingStatus === 'on') : ?>
        <div class="conting">
            <div class="info">
                <a href="<?php $this->author->permalink(); ?>"><img src="<?php ParseAvatar($this->author->mail); ?>" alt=""/></a>
                <div class="meta">
                    <div class="author">
                        <a href="<?php $this->author->permalink(); ?>"><?php $this->author();autvip($this->author->mail); ?></a>
                    </div>
                    <div class="item">
                        <span><?php $this->date('Y-m-d'); ?></span>
                        <div class="line">/</div>
                        <span><?php $this->commentsNum('%d'); ?> 评论</span>
                        <div class="line">/</div>
                        <span><?php getPostViews($this) ?> 阅读</span>
                        <div class="line">/</div>
                        <span id="baiduIncluded">检测收录...</span>
                    </div>
                </div>
            </div>
            <div class="time"><?php $this->date('m/d'); ?></div>
        </div>
    <?php endif; ?>
</div>