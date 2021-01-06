<?php $this->need('public/prevent.php'); ?>
<?php $this->need('public/defend.php'); ?>
<!DOCTYPE html>
<html lang="en" data-color-mode="<?php if($_COOKIE['night']=='1')echo 'dark';else echo 'light'; ?>">

    <head>
        <?php $this->need('public/head.php'); ?>
    </head>

<body class="<?php if ($this->options->JContentMode == 'blog') _e('blog'); else _e('content');?>">
<?php $this->options->JCustomBodyStart() ?>

<section id="joe" class="<?php if ($this->options->JMobiset) _e('setmobi');?>">
    <!-- 头部 -->
    <?php $this->need('public/header.php'); ?>

<!--    <section id="pjax-container"> need self add -->
