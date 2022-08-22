<?php if(@$pager['last_page'] && 1!==$pager['last_page']) { ?>
<div class="pagenation">
  <ul>
    <?php if(1!==$pager['now']) { ?>
    <li><a href="<?= sprintf($pager['href_template'], $pager['prev_page']) ?>">前へ</a></li>
    <?php } else { ?>
    <!-- <li><span>前へ</span></li> -->
    <?php } ?>
    <?php if(1!==$pager['head_page']) { ?>
    <li><a href="<?= sprintf($pager['href_template'], 1) ?>">1</a></li>
    <li>...</li>
    <?php } ?>
    <?php foreach($pager['pages'] as $page) { ?>
    <?php if($page['active']) { ?>
    <li><span class="current"><?= $page['page'] ?></span></li>
    <?php } else { ?>
    <li><a href="<?= sprintf($pager['href_template'], $page['page']) ?>"><?= $page['page'] ?></a></li>
    <?php } ?>
    <?php } ?>
    <?php if($pager['last_page']!==$pager['tail_page']) { ?>
    <li>...</li>
    <li><a href="<?= sprintf($pager['href_template'], $pager['last_page']) ?>"><?= $pager['last_page'] ?></a></li>
    <?php } ?>
    <?php if($pager['last_page']!==$pager['now']) { ?>
    <li><a href="<?= sprintf($pager['href_template'], $pager['next_page']) ?>">次へ</a></li>
    <?php } else { ?>
    <!-- <li><span>次へ</span></li> -->
    <?php } ?>
  </ul>
</div>
<?php } ?>
