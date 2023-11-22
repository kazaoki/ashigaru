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
  <h1 class="error">503 Service Unavailable</h1>
  <h2>予期しないエラーが発生しました。</h2>
</section>

<section>
  <?php if(@$messages) { ?>
  <ul class="uk-list uk-list-bullet">
    <?php foreach($messages as $message) { ?>
      <li class="messages"><?= preg_replace('/^<br>|<br>$/', '', $message) ?></li>
    <?php } ?>
  </ul>
  <?php } ?>
</section>

<!--------------------------- content end --------------------------->
</div>
</main>
<?php include __TEMPLATES_DIR__.'/manage/footer.php' ?>
</body>
</html>
