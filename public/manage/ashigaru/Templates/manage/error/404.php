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
  <h1>管理画面トップ</h1>
</section>

<section>
  <ul class="uk-list uk-list-bullet">
    <li>...</li>
    <li>...</li>
    <li>...</li>
  </ul>
</section>

<!--------------------------- content end --------------------------->
</div>
</main>
<?php include __TEMPLATES_DIR__.'/manage/footer.php' ?>
</body>
</html>
