<?php require 'ashigaru/loader.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>

<h1>ルーター無しの個別ページ（autoloadのみ）</h1>

<pre>
<?php
var_dump($Ag);
?>
</pre>

<?= AG::h('<a href="">') ?><br><br><br>
__TEMPLATES_DIR__ = <?= __TEMPLATES_DIR__ ?><br>
__BASE__ = <?= __BASE__ ?><br>
__BASE_DIR__ = <?= __BASE_DIR__ ?><br>
__MANAGE_ASSETS__ = <?= __MANAGE_ASSETS__ ?><br>


</body>
</html>
