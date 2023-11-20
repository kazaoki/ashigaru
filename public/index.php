<?php require_once __DIR__.'/manage/ashigaru/loader.php' ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include __DIR__.'/includes/meta.php' ?>
  <title>TOP PAGE</title>
</head>
<body>
<?php include __DIR__.'/includes/header.php' ?>
<main>

<section>
  <h1>test</h1>
  <img src="/assets/images/albert-01.jpg" width="200">
</section>

<section>
  <h1>お知らせ新着</h1>
  <?php if(($posts = \App\Models\News::take(3))->count()) { ?>
  <ul>
    <?php foreach($posts->get() as $post) { ?>
    <li>
      <article>
        <small><?= \AG::h($post->published_at->format('y.m.d')) ?> <span class="<?= $post->category->class ?>""><?=  $post->category->label ?></span></small>
        <a href="<?= \AG::h($post->permalink) ?>"<?= $post->permalink_blank ?>><?= \AG::h($post->title) ?></a>
      </article>
    </li>
    <?php } ?>
    <li><small><a href="/news/">more ...</a></small></li>
  </ul>
  <?php } else { ?>
    （お知らせなし）
  <?php } ?>
</section>


<pre>
<?php
var_dump($Ag);
?>
</pre>

<?= AG::h('<a href="">') ?><br><br><br>

<hr>

__URL__ : <code><?= __URL__ ?></code><br>
__SITE__ : <code><?= __SITE__ ?></code><br>
__SITE_DIR__ : <code><?= __SITE_DIR__ ?></code><br>
__MANAGE__ : <code><?= __MANAGE__ ?></code><br>
__TEMPLATES_DIR__ : <code><?= __TEMPLATES_DIR__ ?></code><br>
__UPLOADS__ : <code><?= __UPLOADS__ ?></code><br>
__UPLOADS_DIR__ : <code><?= __UPLOADS_DIR__ ?></code><br>

<br>

</main>
<?php include __DIR__.'/includes/footer.php' ?>
</body>
</html>
