<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include __TEMPLATES_DIR__.'/meta.php' ?>
  <title>404 PAGE</title>
</head>
<body>
<?php include __TEMPLATES_DIR__.'/header.php' ?>
<main>

<section>
  <?php global $message; ?>
  <h1>404 Not Found.</h1>
  <h2>ページが見つかりませんでした。</h2>
  <?php if(@$message) { ?>
  <p class="message"><?= $message ?></p>
  <?php } ?>
</section>

</main>
<?php include __TEMPLATES_DIR__.'/footer.php' ?>
</body>
</html>
