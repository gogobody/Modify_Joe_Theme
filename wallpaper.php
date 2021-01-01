<?php
/**
 * 壁纸
 *
 * @package custom
 *
 **/

?>
<?php $this->need('common/common.header.php'); ?>

    <!-- 主体 -->
    <section class="container j-post">
        <section class="j-adaption">
            <?php $this->need('component/wallpaper.api.php'); ?>
        </section>
    </section>

<?php $this->need('common/common.footer.php'); ?>