<?php require 'ashigaru/loader.php' ?>
<?php include __TEMPLATES_DIR__.'/header.php' ?>

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

<?php include __TEMPLATES_DIR__.'/footer.php' ?>
