<!DOCTYPE html>
<html lang="ja">
<head>
<?php include __TEMPLATES_DIR__.'/manage/meta.php' ?>
<title><?= @$Ag['config']['site_title'] ?> CMS管理画面</title>
</head>
<body class="<?= implode(' ', @$page_slugs) ?>">
<?php include __TEMPLATES_DIR__.'/manage/header.php' ?>
<main class="<?= implode(' ', $page_slugs) ?>">
<?php include __TEMPLATES_DIR__.'/manage/side.php' ?>
<div id="content">
<?php include __TEMPLATES_DIR__.'/manage/flash.php' ?>
<!-------------------------- content start -------------------------->

<section class="title">
  <h1>お知らせ管理 - <?= @$entry_id ? '編集' : '新規追加' ?></h1>
</section>

<section>
  <form action="<?= __MANAGE__ ?>/news/check/" method="POST" class="uk-form-horizontal uk-margin-large" id="form" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= AG::csrf_generate() ?>">
    <input type="hidden" name="entry_id" value="<?= $entry->id ?>">
    <div class="uk-margin">
      <label class="uk-form-label">管理ID</label>
      <div class="uk-form-controls">
        <input class="uk-input" type="text" value="<?= $entry->id ? $entry->id.'（変更不可）' : '（自動発行）' ?>" disabled>
      </div>
    </div>
    <hr>
    <div class="uk-margin">
      <div class="uk-form-label req">状態</div>
      <div class="uk-form-controls uk-form-controls-text">
        <label class="uk-margin-right"><input class="uk-radio" type="radio" name="status"<?= $entry->status ? ' checked' : '' ?> value="1"> 公開</label>
        <label><input class="uk-radio" type="radio" name="status"<?= !$entry->status ? ' checked' : '' ?> value="0"> 準備中</label>
      </div>
    </div>
    <hr>
    <div class="uk-margin">
      <label class="uk-form-label req">公開日時</label>
      <div class="uk-form-controls">
        <input class="uk-input uk-width-1-3" type="date" name="published_date" value="<?= $entry->published_date ? AG::h($entry->published_date) : '' ?>">
        <input class="uk-input uk-width-1-3" type="time" name="published_time" value="<?= $entry->published_time ? AG::h($entry->published_time) : '' ?>">
        <button type="button" class="uk-button" id="set-current-time">現在の日時をセット</button>
        <div class="uk-text-meta uk-margin-small-top">
          ※未来の日時を指定した場合、公開状態でもその日時が過ぎない限り表示されません。（「公開予約」状態）
        </div>
      </div>
    </div>
    <hr>
    <div class="uk-margin">
      <label class="uk-form-label req">タイトル</label>
      <div class="uk-form-controls">
        <input class="uk-input" type="text" name="title" value="<?= AG::h($entry->title) ?>">
      </div>
    </div>
    <hr>
    <div class="uk-margin">
      <label class="uk-form-label req">本文</label>
      <div class="uk-form-controls">
        <textarea class="uk-textarea" name="content" rows="5" data-ckeditor="content"><?= $entry->content ?></textarea>
      </div>
    </div>
    <hr>
    <div class="uk-flex uk-flex-center" id="submit-buttons">
      <button class="uk-button-primary uk-button-large">確認画面へ <i class="fas fa-arrow-right"></i></button>
    </div>
  </form>

</section>

<!--------------------------- content end --------------------------->
</div>
</main>
<?php include __TEMPLATES_DIR__.'/manage/footer.php' ?>

<script src="https://cdn.ckeditor.com/4.17.1/standard-all/ckeditor.js"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<script src="<?= __SITE__ ?>/assets/validon/validon.js"></script>
<script>
var validon
document.addEventListener('DOMContentLoaded', function (event)
{
  validon = new Validon({
    form:       '#form',
    config:     'manage/news',
    eachfire:   true,
    errorgroup: 'div',
    errortag: '<div class="error uk-text-danger">$message</div>',
    loadedFunc: function(){
      // Validonがロード完了したらボタン表示
      document.getElementById('submit-buttons').style.visibility = 'visible'
    },
    startFunc: function(json){
      // CKEditorのフォーカスが移る前にバリデータが動き出してしまうので、ここで強制的にデータを反映さす
      document.querySelectorAll('[data-ckeditor]').forEach(function(textarea){
        textarea.ckeSync()
      })
    },
    finishFunc: function(json){
      if(json.isSubmit) {
        var error = document.querySelector('#form .error')
        if(error) {
          var scroll_top = (error.getBoundingClientRect().top+window.pageYOffset) - (window.innerHeight / 2)
          if(-1!==navigator.userAgent.indexOf('Trident')) {
            window.scroll(0, scroll_top) // for IE11
          } else {
            window.scroll({top: scroll_top, behavior: 'smooth'}) // for other browser
          }
        }
      }
    }
  })
})
</script>

</body>
</html>
