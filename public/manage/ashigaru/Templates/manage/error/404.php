<!DOCTYPE html>
<html>
<head>
  <?php include __TEMPLATES_DIR__.'/manage/meta.php' ?>
  <title><?= @$Ag['config']['site_title'] ?> <?= @$Ag['config']['system_title'] ?></title>
</head>
<body>
<?php include __TEMPLATES_DIR__.'/manage/header.php' ?>
<main class="<?= implode(' ', $page_slugs) ?>">
<?php include __TEMPLATES_DIR__.'/manage/side.php' ?>
<div id="content">
<?php include __TEMPLATES_DIR__.'/manage/flash.php' ?>
<!-------------------------- content start -------------------------->

<section class="title">
  <h1>404 Not Found</h1>
  <h2>ご指定のページは見つかりませんでした。</h2>
</section>

<section>
  <p>お探しのページは削除されたか、URLが変更された可能性があります。</p>
</section>

<!--------------------------- content end --------------------------->
</div>
</main>
<?php include __TEMPLATES_DIR__.'/manage/footer.php' ?>
</body>
</html>
