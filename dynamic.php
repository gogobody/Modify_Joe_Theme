<?php

/**
 * 动态
 * 
 * @package custom 
 * 
 **/

?>
<?php $this->need('common/common.header.php'); ?>
        <!-- 主体 -->
        <section class="container j-post">
            <section class="j-adaption">
                <?php $this->need('public/comment.dynamic.php'); ?>
            </section>
            <?php if ($this->options->JPostAsideStatus === 'on' && $this->fields->aside !== 'off') : ?>
                <?php $this->need('public/aside.php'); ?>
            <?php endif; ?>
        </section>

<?php $this->need('common/common.footer.php'); ?>