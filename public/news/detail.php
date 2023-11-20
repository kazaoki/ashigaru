<?php
// ディスパッチャからの呼び出しでなければトップへ強制移動
if(!isset($router)) { header('Location: /'); exit; }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include __SITE_DIR__.'/includes/meta.php' ?>
  <title>NEWS DETAIL</title>
</head>
<body>
<?php include __SITE_DIR__.'/includes/header.php' ?>
<main>
<h1>お知らせ</h1>

<section>
  <h2><?= \AG::h($entry->title) ?></h2>
  <h2><?= \AG::h($entry->published_at->format('Y.m.d')) ?></h2>
  <h2><span class="<?= \AG::h($entry->category->class) ?>"><?= \AG::h($entry->category->label) ?></span></h2>
  <article><?= $entry->content ?></article>
</section>

</main>
<?php include __SITE_DIR__.'/includes/footer.php' ?>
</body>
</html>
