<?php include __TEMPLATES_DIR__.'/header.php' ?>
<?php global $message; ?>

<h1>404 Not Found.</h1>
<h2>ページが見つかりませんでした。</h2>
<?php if(@$message) { ?>
<p class="message"><?= $message ?></p>
<?php } ?>

<?php include __TEMPLATES_DIR__.'/footer.php' ?>
