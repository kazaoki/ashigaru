<?php require 'ashigaru/loader.php' ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include __TEMPLATES_DIR__.'/meta.php' ?>
  <title>SUB PAGE</title>
</head>
<body>
<?php include __TEMPLATES_DIR__.'/header.php' ?>
<main>

<h1>ルーター無しの個別ページ（autoloadのみ）</h1>

<pre>
<?php
var_dump($Ag);
?>
</pre>

<?= AG::h('<a href="">') ?><br><br><br>
__URL__ = <?= __URL__ ?><br>
__SITE__ = <?= __SITE__ ?><br>
__SITE_DIR__ = <?= __SITE_DIR__ ?><br>
__MANAGE__ = <?= __MANAGE__ ?><br>
__MANAGE_ASSETS__ = <?= __MANAGE_ASSETS__ ?><br>
__TEMPLATES_DIR__ = <?= __TEMPLATES_DIR__ ?><br>

</main>
<?php include __TEMPLATES_DIR__.'/footer.php' ?>
