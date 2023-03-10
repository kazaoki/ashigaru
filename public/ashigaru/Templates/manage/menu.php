<?php
$menus = [
  'top' => ['path'=>__SITE__.'/manage/', 'icon'=>'fas fa-layer-group', 'label'=>'トップ' ],
  'news' => ['path'=>__SITE__.'/manage/news/', 'icon'=>'fas fa-bullhorn', 'label'=>'お知らせ管理' ],
  // 'news' => ['path'=>__SITE__.'/manage/news/', 'icon'=>'fas fa-bullhorn',       'label'=>'お知らせ管理',
  //   'sub' => [
  //     'news-public'  => ['path'=>__SITE__.'/manage/news/public/',  'label'=>'一般のお知らせ' ],
  //     'news-member'  => ['path'=>__SITE__.'/manage/news/member/',  'label'=>'会員のお知らせ' ],
  //     'news-partner' => ['path'=>__SITE__.'/manage/news/partner/', 'label'=>'パートナーのお知らせ' ],
  //   ]
  // ],
  'site' => ['path'=>__SITE__.'/', 'icon'=>'fas fa-globe', 'label'=>'サイト', 'isBlank'=>true ],
  'logout' => ['path'=>__SITE__.'/manage/logout/', 'icon'=>'fas fa-power-off', 'label'=>'ログアウト' ],
];
?>
<ul>
<?php foreach($menus as $slug=>$menu) { ?>
<li<?= @in_array($slug, @$page_slugs) ? ' class="active"':'' ?>><a href="<?= $menu['path'] ?>"<?= @$menu['isBlank'] ?' target="_blank"':'' ?>><i class="<?= $menu['icon'] ?>"></i><span><?= @$sub_show?$menu['label']:str_replace('管理','',$menu['label']) ?></span></a>
<?php if(@$sub_show && @$menu['sub'] && @count(@$menu['sub'])) { ?>
<ul>
<?php foreach($menu['sub'] as $s=>$m) { ?>
<li<?= @in_array($s, @$page_slugs) ? ' class="active"':'' ?>><a href="<?= $m['path'] ?>"<?= @$m['isBlank'] ?' target="_blank"':'' ?>><?= $m['label'] ?></a>
<?php }?>
</ul>
<?php } ?>
</li>
<?php } ?>
</ul>
