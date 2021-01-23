<?php $this->need('public/prevent.php'); ?>
<?php $this->need('public/defend.php'); ?>
<?php try{$tpOptions = Helper::options()->plugin('TpCache');}catch (Typecho_Plugin_Exception $e){$tpOptions=NULL;};?>
<!DOCTYPE html>
<html lang="en" data-color-mode="<?php if ($tpOptions->enable_gcache){_e('{colorMode}');}else{if($_COOKIE['night']=='1')echo 'dark';else echo 'light';} ?>">

    <head>
        <?php $this->need('public/head.php'); ?>
    </head>

<body>
<?php $this->options->JCustomBodyStart() ?>

<section id="joe" class="<?php if ($this->options->JMobiset) _e('setmobi');?>">
    <!-- 头部 -->
    <?php $this->need('public/header.php'); ?>
    <section id="pjax-container">
    <!-- 面包屑 -->
    <?php if($this->is('post')): ?>
        <?php $this->need('component/post.bread.php'); ?>
    <?php endif; ?>