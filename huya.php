<?php

/**
 * 虎牙直播
 *
 * @package custom
 *
 **/

?>

<?php $this->need('public/prevent.php'); ?>
<?php $this->need('public/defend.php'); ?>
<!DOCTYPE html>
<html lang="en" data-color-mode="<?php if($_COOKIE['night']=='1')echo 'dark';else echo 'light'; ?>">

<head>
    <?php $this->need('public/head.php'); ?>
</head>

<body>
<?php $this->options->JCustomBodyStart() ?>

<section id="joe">
    <!-- 头部 -->
    <?php $this->need('public/header.php'); ?>

    <!-- 主体 -->
    <section class="container j-post">
        <section class="j-adaption">
            <?php $this->need('component/huya.api.php'); ?>
        </section>
    </section>

    <!-- 尾部 -->
    <?php $this->need('public/footer.php'); ?>
</section>
<!-- 配置文件 -->
<?php $this->need('public/config.php'); ?>
</body>

</html>