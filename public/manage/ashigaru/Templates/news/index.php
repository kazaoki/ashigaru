<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include __TEMPLATES_DIR__.'/meta.php' ?>
  <title>NEWS INDEX</title>
</head>
<body>
<?php include __TEMPLATES_DIR__.'/header.php' ?>
<main>
<h1>お知らせ</h1>

<section>
  <h2>カテゴリ</h2>
  <ul class="listAnk">
    <li<?= $cat ? '' : ' class="Onn"' ?>><a href="<?= __SITE__ ?>/news/">すべて</a></li>
    <?php if($categories = \App\Models\NewsCategory::get()) { ?>
    <?php foreach($categories as $category) { ?>
    <li<?= $category->slug===$cat ? ' class="Onn"' : '' ?>><a href="<?= __SITE__ ?>/news/cat/<?= $category->slug ?>"><?= $category->label ?></a></li>
    <?php } ?>
    <?php } ?>
  </ul>
</section>

<section>
  <h2>新着</h2>
  <?php if(@count($posts)) { ?>
  <dl>
  <?php foreach($posts as $post) { ?>
  <dt><?= \AG::h($post->published_at->format('y.m.d')) ?> <span class="<?= $post->category->class ?>""><?= $post->category->label ?></span></dt>
  <dd><a href="<?= \AG::h($post->permalink) ?>"<?= $post->permalink_blank ?>><?= \AG::h($post->title) ?></a></dd>
  <?php } ?>
  </dl>
  <?php } else { ?>
    (none)
  <?php } ?>

  <?php include __TEMPLATES_DIR__.'/pager.php' ?>
</section>

</main>
<?php include __TEMPLATES_DIR__.'/footer.php' ?>
</body>
</html>
