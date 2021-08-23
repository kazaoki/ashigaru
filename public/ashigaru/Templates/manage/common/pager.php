<ul class="uk-pagination uk-flex-center uk-margin-top">
  <?php if(1!==$pager['now']) { ?>
  <li><a href="<?= sprintf($pager['href_template'], $pager['prev_page']) ?>"><span uk-pagination-previous></span></a></li>
  <?php } else { ?>
  <li><a class="uk-disabled"><span uk-pagination-previous></span></a></li>
  <?php } ?>
  <?php if(1!==$pager['head_page']) { ?>
  <li><a href="<?= sprintf($pager['href_template'], 1) ?>">1</a></li>
  <li class="uk-disabled"><span>...</span></li>
  <?php } ?>
  <?php foreach($pager['pages'] as $page) { ?>
  <?php if($page['active']) { ?>
  <li><a class="uk-active uk-text-emphasis uk-text-bold"><?= $page['page'] ?></a></li>
  <?php } else { ?>
  <li><a href="<?= sprintf($pager['href_template'], $page['page']) ?>"><?= $page['page'] ?></a></li>
  <?php } ?>
  <?php } ?>
  <?php if($pager['last_page']!==$pager['tail_page']) { ?>
  <li class="uk-disabled"><span>...</span></li>
  <li><a href="<?= sprintf($pager['href_template'], $pager['last_page']) ?>"><?= $pager['last_page'] ?></a></li>
  <?php } ?>
  <?php if($pager['last_page']!==$pager['now']) { ?>
  <li><a href="<?= sprintf($pager['href_template'], $pager['next_page']) ?>"><span uk-pagination-next></span></a></li>
  <?php } else { ?>
  <li><a class="uk-disabled"><span uk-pagination-next></span></a></li>
  <?php } ?>
</ul>
