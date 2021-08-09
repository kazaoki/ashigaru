<?php include 'header.php' ?>

<img src="/assets/images/albert-01.jpg" width="50"><br>
id: <?= @$post->id ?><br>
title: <?= @$post->title ?><br>
photos: <?php if(@count($photos=@$post->with('limit 1')->ownPhotosList)) { ?>
<?php foreach($photos as $photo) { ?>
<?= $photo->filename ?>　
<?php } ?>
<?php } ?>

<?php include 'footer.php' ?>
