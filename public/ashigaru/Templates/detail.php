<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include __TEMPLATES_DIR__.'/meta.php' ?>
  <title>DETAIL PAGE</title>
</head>
<body>
<?php include __TEMPLATES_DIR__.'/header.php' ?>
<main>

<section>
  <img src="/assets/images/albert-01.jpg" width="50"><br>
  id: <?= @$post->id ?><br>
  title: <?= @$post->title ?><br>
  photos: <?php if(@count($photos=@$post->with('limit 1')->ownPhotosList)) { ?>
  <?php foreach($photos as $photo) { ?>
  <?= $photo->filename ?>　
  <?php } ?>
  <?php } ?>
</section>

</main>
<?php include __TEMPLATES_DIR__.'/footer.php' ?>
</body>
</html>
