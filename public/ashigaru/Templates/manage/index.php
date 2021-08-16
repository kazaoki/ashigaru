<!DOCTYPE html>
<html>
<head>
<?php include __TEMPLATES__.'/manage/common/meta.php' ?>
<title>システム管理画面 - <?= @$Ag['config']['site_title'] ?></title>
</head>
<body>
<?php include __TEMPLATES__.'/manage/common/header.php' ?>
<main class="<?= implode(' ', $page_slugs) ?>">
<?php include __TEMPLATES__.'/manage/common/side.php' ?>
<div id="content">
<?php include __DIR__.'/common/flash.php' ?>
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
<?php include __TEMPLATES__.'/manage/common/footer.php' ?>
</body>
</html>
