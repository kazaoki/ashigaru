<?php include __TEMPLATES_DIR__.'/header.php' ?>

<main>
<h1>お知らせ</h1>

<section>
  <h2><?= \AG::h($entry->title) ?></h2>
  <h2><?= \AG::h($entry->published_at->format('Y.m.d')) ?></h2>
  <h2><span class="<?= \AG::h($entry->category->class) ?>"><?= \AG::h($entry->category->label) ?></span></h2>
  <article><?= nl2br($entry->content) ?></article>
</section>

</main>

<?php include __TEMPLATES_DIR__.'/footer.php' ?>
