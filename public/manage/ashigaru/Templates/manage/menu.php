<ul class="menu">
  <li class="<?= now_active('top') ?>"><a href="/manage/"><i class="fas fa-layer-group"></i>トップ</a></li>
  <li class="<?= now_active('news') ?>">
    <a href="/manage/news/"><i class="fas fa-bullhorn"></i>お知らせ<span>管理</span></a>
    <ul class="sub-menu">
      <li class="<?= now_active('public') ?>"><a href="/manage/news/public/">一般のお知らせ</a></li>
      <li class="<?= now_active('member') ?>"><a href="/manage/news/member/">会員のお知らせ</a></li>
      <li class="<?= now_active('partner') ?>"><a href="/manage/news/partner/">パートナーのお知らせ</a></li>
    </ul>
  </li>
  <li><a href="/" target="_blank"><i class="fas fa-globe"></i>サイト</a></li>
  <li><a href="/manage/logout/"><i class="fas fa-power-off"></i>ログアウト</a></li>
</ul>
