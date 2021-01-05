<div class="index-title">
    <div class="titles">
        <h2 class="active"><a href="<?php _e($this->options->index);?>">最新文章</a></h2>
        <?php
            $titles = $this->options->JIndexTitles;
            if ($titles){
                $title_arr = explode('\r\n',$titles);
                foreach ($title_arr as $title){
                    $arr = explode('||',trim($title));
                    echo '<h2 class="active"><a href="'.$arr[1].'">'.$arr[0].'</a></h2>';
                }
            }
        ?>

    </div>
    <?php if ($this->options->JIndexNotice) : ?>
        <?php
        $notice = $this->options->JIndexNotice;
        $noticeCounts = explode("||", $notice);
        ?>
        <div class="notice">
            <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <path d="M656.26112 347.20768a188.65152 188.65152 0 1 0 0 324.04992V347.20768z" fill="#F4CA1C" p-id="6649"></path>
                <path d="M668.34944 118.88128a73.34912 73.34912 0 0 0-71.168-4.06016L287.17056 263.5008a4.608 4.608 0 0 1-2.01216 0.4608H130.048A73.728 73.728 0 0 0 56.32 337.59744v349.63968a73.728 73.728 0 0 0 73.728 73.63584h156.55424a4.67968 4.67968 0 0 1 1.94048 0.43008l309.59104 143.19616a73.7024 73.7024 0 0 0 104.66816-66.82112V181.20704a73.216 73.216 0 0 0-34.45248-62.32576zM125.40416 687.23712V337.59744a4.608 4.608 0 0 1 4.608-4.608h122.0352v358.88128H130.048a4.608 4.608 0 0 1-4.64384-4.6336z m508.31872 150.44096a4.608 4.608 0 0 1-6.56384 4.19328l-306.02752-141.55264V323.77344l305.9712-146.72384a4.608 4.608 0 0 1 6.62016 4.15744v656.47104z m304.5376-358.95808h-150.25152a34.5088 34.5088 0 1 0 0 69.0176h150.25152a34.5088 34.5088 0 1 0 0-69.0176z m-128.25088-117.76a34.44736 34.44736 0 0 0 24.41728-10.10176L940.672 244.736a34.52416 34.52416 0 0 0-48.83968-48.80896L785.5872 302.08a34.5088 34.5088 0 0 0 24.4224 58.88z m24.41728 314.60864a34.52416 34.52416 0 1 0-48.83968 48.81408l106.24512 106.1376a34.52416 34.52416 0 0 0 48.83968-48.80896z" fill="#595BB3" p-id="6650"></path>
            </svg>
            <a target="_blank" title="<?php echo $noticeCounts[0]; ?>" href="<?php echo $noticeCounts[1]; ?>">
                <?php echo $noticeCounts[0]; ?>
            </a>
        </div>
    <?php endif; ?>
</div>