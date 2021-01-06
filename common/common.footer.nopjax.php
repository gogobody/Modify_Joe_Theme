<!-- 弹幕 -->
<?php if ($this->options->JBarragerStatus === 'on') : ?>
    <ul class="j-barrager-list">
        <?php $this->widget('Widget_Comments_Recent@index', 'ignoreAuthor=true')->to($comments); ?>
        <?php while ($comments->next()) : ?>
            <li>
                <span class="j-barrager-list-avatar" data-src="<?php ParseAvatar($comments->mail); ?>"></span>
                <span class="j-barrager-list-content"><?php $comments->excerpt(); ?></span>
            </li>
        <?php endwhile; ?>
    </ul>
<?php endif; ?>

<!-- 尾部 -->
<?php $this->need('public/footer.php'); ?>
</section>

<!-- 配置文件 -->
<?php $this->need('public/config.php'); ?>
</body>

</html>