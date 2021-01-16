<?php if ($this->options->JIndexAD) : ?>
    <?php
    $ad = $this->options->JIndexAD;
    $adCounts = explode("||", $ad);
    ?>
    <div class="index-ad">
        <a target="_blank" rel="noopener" href="<?php echo $adCounts[1] ?>" title="广告">
            <img class="lazyload" src="<?php echo GetLazyLoad() ?>" data-src="<?php echo $adCounts[0] ?>" width="640" height="320" alt=""/>
            <span class="j-ad">广告</span>
        </a>
    </div>
<?php endif; ?>