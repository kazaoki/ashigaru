<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include __INCLUDES_DIR__.'/meta.php' ?>
  <title>503 Service Unavailable</title>
</head>
<body>
<?php include __INCLUDES_DIR__.'/header.php' ?>
<main>

<section>
  <h1>503 Service Unavailable</h1>
  <h2>予期しないエラーが発生しました。</h2>
  <?php if(@$messages) { ?>
  <ul>
    <?php foreach($messages as $message) { ?>
      <li class="messages"><?= preg_replace('/^<br>|<br>$/', '', $message) ?></li>
    <?php } ?>
  </ul>
  <?php } ?>
</section>

</main>
<?php include __INCLUDES_DIR__.'/footer.php' ?>
</body>
</html>
