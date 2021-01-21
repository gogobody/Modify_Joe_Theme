<?php
/**
 * Typecho Joe Theme 魔改版
 * @package TypechoJoeTheme
 * @author gogobody
 * @version 3.0
 * @link check https://geekscholar.net/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('common/common.header.php'); ?>
    <!-- 主体 -->
    <section class="container j-index">
        <section class="j-adaption">
            <section class="main <?php $this->options->JListType() ?>">
                <?php if ($this->is('index')) : ?>
                    <?php $this->need('component/index.banner.php'); ?>
                    <?php $this->need('component/index.hot.php'); ?>
                    <?php $this->need('component/index.ad.php'); ?>
                    <?php $this->need('component/index.title.php'); ?>
                <?php else : ?>
                    <?php $this->need('component/search.title.php'); ?>
                <?php endif; ?>

                <section class="j-index-article article">
                    <!-- 置顶文章 -->
                    <?php if ($this->is('index')) : ?>
                        <?php $this->need('component/index.sticky.php'); ?>
                    <?php endif; ?>
                    <!-- 列表 -->
                    <?php $this->need('component/index.list.php'); ?>
                </section>

            </section>
            <?php $this->need('public/pagination.php'); ?>
        </section>

        <?php if ($this->options->JIndexAsideStatus === 'on') : ?>
            <?php $this->need('public/aside.php'); ?>
        <?php endif; ?>
    </section>

<?php $this->need('common/common.footer.php'); ?>