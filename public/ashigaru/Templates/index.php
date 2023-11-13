<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include __TEMPLATES_DIR__.'/meta.php' ?>
  <title>TOP PAGE</title>
</head>
<body>
<?php include __TEMPLATES_DIR__.'/header.php' ?>
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

</main>
<?php include __TEMPLATES_DIR__.'/footer.php' ?>
</body>
</html>
