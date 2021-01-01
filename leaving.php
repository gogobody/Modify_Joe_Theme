<?php
/**
 * 留言
 * 
 * @package custom 
 * 
 **/

?>
<?php $this->need('common/common.header.php'); ?>
        <!-- 主体 -->
        <section class="container j-post">
            <section class="j-adaption">
                <div class="main">
                    <!-- 分类 -->
                    <?php $this->need('component/post.classify.php'); ?>
                    
                    <!-- 标题 -->
                    <?php $this->need('component/post.header.php'); ?>

                    <?php $this->need('component/leaving.list.php'); ?>
                </div>

                <?php $this->need('public/comment.php'); ?>
            </section>
        </section>

<?php $this->need('common/common.footer.php'); ?>