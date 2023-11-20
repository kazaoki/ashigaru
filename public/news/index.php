<?php
// ディスパッチャからの呼び出しでなければトップへ強制移動
if(!isset($router)) { header('Location: /'); exit; }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include __SITE_DIR__.'/includes/meta.php' ?>
  <title>NEWS INDEX</title>
</head>
<body>
<?php include __SITE_DIR__.'/includes/header.php' ?>
<main>
<h1>お知らせ</h1>

<section>
  <h2>カテゴリ</h2>
  <ul class="listAnk">
    <li<?= $cat ? '' : ' class="Onn"' ?>><a href="<?= __SITE__ ?>/news/">すべて</a></li>
    <?php if($categories = \App\Models\NewsCategory::get()) { ?>
    <?php foreach($categories as $category) { ?>
    <li<?= $category->slug===$cat ? ' class="Onn"' : '' ?>><a href="<?= __SITE__ ?>/news/cat/<?= $category->slug ?>"><?= $category->label ?></a></li>
    <?php } ?>
    <?php } ?>
  </ul>
</section>

<section>
  <h2>新着</h2>
  <?php if(isset($posts) && @count($posts)) { ?>
  <dl>
  <?php foreach($posts as $post) { ?>
  <dt><?= \AG::h($post->published_at->format('y.m.d')) ?> <span class="<?= $post->category->class ?>""><?= $post->category->label ?></span></dt>
  <dd><a href="<?= \AG::h($post->permalink) ?>"<?= $post->permalink_blank ?>><?= \AG::h($post->title) ?></a></dd>
  <?php } ?>
  </dl>
  <?php } else { ?>
    (none)
  <?php } ?>

  <?php include __SITE_DIR__.'/includes/pager.php' ?>
</section>

</main>
<?php include __SITE_DIR__.'/includes/footer.php' ?>
</body>
</html>
