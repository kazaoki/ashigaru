<!DOCTYPE html>
<html>
<head>
<?php include __TEMPLATES__.'/system/common/meta.php' ?>
<title>システム管理画面 - <?= @$Ag['config']['site_title'] ?></title>
</head>
<body>
<?php include __TEMPLATES__.'/system/common/header.php' ?>
<main class="<?= implode(' ', $page_slugs) ?>">
<?php include __TEMPLATES__.'/system/common/side.php' ?>
<div id="content">
<!-------------------------- content start -------------------------->

<section class="title">
  <h1>お知らせ管理</h1>
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
<?php include __TEMPLATES__.'/system/common/footer.php' ?>
</body>
</html>
