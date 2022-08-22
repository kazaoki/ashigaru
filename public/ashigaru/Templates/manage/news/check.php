<!DOCTYPE html>
<html lang="ja">
<head>
<?php include __TEMPLATES_DIR__.'/manage/meta.php' ?>
<title><?= @$Ag['config']['site_title'] ?> CMS管理画面</title>
<link rel="stylesheet" href="<?= __MANAGE__ ?>/assets/css/add-ckeditor.css?20220120-01">
</head>
<body class="<?= implode(' ', @$page_slugs) ?>">
<?php include __TEMPLATES_DIR__.'/manage/header.php' ?>
<main class="<?= implode(' ', $page_slugs) ?>">
<?php include __TEMPLATES_DIR__.'/manage/side.php' ?>
<div id="content">
<?php include __TEMPLATES_DIR__.'/manage/flash.php' ?>
<!-------------------------- content start -------------------------->

<section class="title">
  <h1>お知らせ管理 - <?= $entry->id ? '編集' : '新規追加' ?></h1>
</section>

<section>
  <p class="uk-text-default">
    以下の内容でよろしければ、下の「保存する」ボタンをクリックしてください。
  </p>
  <form action="<?= __MANAGE__ ?>/news/save/" method="POST" class="uk-form-horizontal uk-margin-large" id="form">
    <div class="uk-margin">
      <label class="uk-form-label">管理ID</label>
      <div class="uk-form-controls uk-form-controls-text">
        <?= $entry->id ? $entry->id.'（変更不可）' : '（自動発行）' ?>
      </div>
    </div>
    <hr>
    <div class="uk-margin">
      <div class="uk-form-label">状態</div>
      <div class="uk-form-controls uk-form-controls-text">
        <?= $entry->status ? '公開' : '準備中' ?>
      </div>
    </div>
    <hr>
    <div class="uk-margin">
      <label class="uk-form-label">公開日時</label>
      <div class="uk-form-controls uk-form-controls-text">
        <?= AG::h($entry->published_at->format('Y年m月d日 H:i')) ?>
      </div>
    </div>
    <hr>
    <div class="uk-margin">
      <label class="uk-form-label">タイトル</label>
      <div class="uk-form-controls uk-form-controls-text">
        <?= AG::h($entry->title) ?>
      </div>
    </div>
    <hr>
    <div class="uk-margin uk-overflow-hidden">
      <label class="uk-form-label">本文</label>
      <div class="uk-form-controls uk-form-controls-text">
        <div class="content-preview Inner">
          <?= $entry->content ?>
        </div>
      </div>
    </div>
    <div class="uk-flex uk-flex-center" id="submit-buttons">
      <button type="button" class="uk-button uk-button-link uk-margin-right" onclick="validon.back('../edit/<?= @$_POST['news_id'] ? @$_POST['news_id'].'/' : '' ?>')"><i class="fas fa-pen"></i> 修正する</button>
      <button type="submit" class="uk-button uk-button-primary uk-button-large uk-margin-left"><i class="fas fa-save"></i> 保存する</button>
    </div>
    <?= AG::hiddens() ?>
  </form>
</section>

<!--------------------------- content end --------------------------->
</div>
</main>
<?php include __TEMPLATES_DIR__.'/manage/footer.php' ?>

<script src="<?= __SITE__ ?>/assets/validon/validon.js"></script>
<script>
var validon
document.addEventListener('DOMContentLoaded', function (event)
{
  validon = new Validon({
    form:       '#form',
    config:     'manage/news',
    loadedFunc: function(){
      document.getElementById('submit-buttons').style.visibility = 'visible'
    },
  })
})
</script>

</body>
</html>
