<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include __TEMPLATES_DIR__.'/manage/meta.php' ?>
  <title><?= @$Ag['config']['site_title'] ?> <?= @$Ag['config']['system_title'] ?></title>
</head>
<body class="<?= implode(' ', @$page_slugs) ?>">
<?php include __TEMPLATES_DIR__.'/manage/header.php' ?>
<main class="<?= implode(' ', $page_slugs) ?>">
<?php include __TEMPLATES_DIR__.'/manage/side.php' ?>
<div id="content">
<?php include __TEMPLATES_DIR__.'/manage/flash.php' ?>
<!-------------------------- content start -------------------------->

<section class="title">
  <h1>お知らせ管理 - <?= $entry_id ? '編集' : '新規追加' ?></h1>
</section>

<section>
  <form action="<?= __MANAGE__ ?>/news/check/" method="POST" class="uk-form-horizontal uk-margin-large" id="form" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= AG::csrf_generate() ?>">
    <div class="uk-margin">
      <label class="uk-form-label">登録ID</label>
      <div class="uk-form-controls">
        <input class="uk-input" type="text" value="<?= $entry->id ? $entry->id.'（変更不可）' : '（自動発行）' ?>" disabled>
        <input type="hidden" name="entry_id" value="<?= $entry_id ?>">
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
      <label class="uk-form-label req">カテゴリ</label>
      <div class="uk-form-controls">
        <select class="uk-select" name="category_id">
          <option value="">（選択してください）</option>
          <?php foreach($cats as $cat) { ?>
          <option value="<?= AG::h($cat->id) ?>"<?= ($entry->category && $entry->category->id===$cat->id) ? 'selected' : '' ?>><?= AG::h($cat->label) ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <hr>
    <div class="uk-margin">
      <div class="uk-form-label req">記事タイプ</div>
      <div class="uk-form-controls uk-form-controls-text">
        <label class="uk-margin-right"><input class="uk-radio" type="radio" name="type"<?= 'entry'===$entry->type ? ' checked' : '' ?> value="entry"> 通常記事</label>
        <label class="uk-margin-right"><input class="uk-radio" type="radio" name="type"<?= 'pdf'===$entry->type ? ' checked' : '' ?> value="pdf"> PDFファイル</label>
        <label><input class="uk-radio" type="radio" name="type"<?= 'url'===$entry->type ? ' checked' : '' ?> value="url"> URLリンク</label>
      </div>
    </div>
    <hr>

    <!-- 本文 -->
    <div class="uk-margin" id="tab-type-entry">
      <label class="uk-form-label req">本文</label>
      <div class="uk-form-controls">
        <textarea class="uk-textarea" name="content" rows="5" data-ckeditor="content"><?= $entry->content ?></textarea>
      </div>
    </div>

    <!-- PDFファイルアップロード -->
    <div class="uk-margin" id="tab-type-pdf">
      <?php $upload_pdf_accept = implode(',', array_map(function($ext){ return '.'.$ext; }, $Ag['config']['allow_pdf_ext'])) ?>
      <?php $upped_pdf = @$_POST['pdf_upped'] ?: $entry->pdf_filename ?>
      <label class="uk-form-label uk-text-nowrap req">PDFファイル<wbr>アップロード</label>
      <div class="uk-form-controls">
        <div class="uk-grid-small@m">
          <div class="uk-width-1-2@m uk-margin-small-top">
            <div class="pdf-filelink">
              <a id="pdf-preview-form-submit">
                <span id="pdf-filename-label"><?= \AG::h($entry->pdf_filename) ?></span>
              </a>
              <span class="cancel-button-block<?= @$_POST['pdf_base64'] ? ' cancel-button-show' : ''?>" id="pdf-cancel">
                <button type="button" class="cancel-button uk-button uk-button-link uk-margin-small-left" data-for="pdf"><i class="fas fa-times"></i> キャンセル</button>
              </span>
            </div>
            <div class="uk-display-block uk-margin-small-bottom" uk-form-custom>
              <input type="hidden" name="pdf_upped" value="<?= $upped_pdf ?>">
              <input type="hidden" name="pdf_base64" value="<?= @$_POST['pdf_base64'] ?>" id="pdf-base64">
              <input type="hidden" name="pdf_filename" value="<?= \AG::h(@$_POST['pdf_filename'] ?: @$entry->pdf_filename) ?>" id="pdf-filename">
              <input type="file" name="pdf" accept="<?= $upload_pdf_accept ?>" class="upload-pdf">
              <button class="uk-button uk-button-default uk-width-expand" type="button" tabindex="-1">PDFファイルを選択</button>
            </div>
          </div>
        </div>
        <label><input class="uk-checkbox" type="checkbox" name="is_blank" id="is-blank-pdf" value="1"<?= $entry->is_blank ? ' checked' : '' ?>> 別ウィンドウで開く</label>
      </div>
    </div>

    <!-- URLリンク先 -->
    <div class="uk-margin" id="tab-type-url">
      <label class="uk-form-label req">URLリンク先</label>
      <div class="uk-form-controls">
        <div class="uk-margin-small-bottom"><input class="uk-input" type="text" name="url" value="<?= $entry->url ?>" placeholder="https://"></div>
        <label><input class="uk-checkbox" type="checkbox" name="is_blank" id="is-blank-url" value="1"<?= $entry->is_blank ? ' checked' : '' ?>> 別ウィンドウで開く</label>
      </div>
    </div>
    <hr>
    <div class="uk-flex uk-flex-center" id="submit-buttons">
      <button class="uk-button-primary uk-button-large">確認画面へ <i class="fas fa-arrow-right"></i></button>
    </div>
  </form>

  <!-- PDFプレビュー用フォーム -->
  <form action="<?= __MANAGE__ ?>/news/pdf_preview/" target="_blank" method="POST" id="pdf-preview-form" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $entry->id ?>">
    <input type="hidden" name="pdf_base64" id="pdf-base64-for-preview">
    <input type="hidden" name="pdf_filename" id="pdf-filename-for-preview">
  </form>
</section>

<!--------------------------- content end --------------------------->
</div>
</main>
<?php include __TEMPLATES_DIR__.'/manage/footer.php' ?>

<script src="https://cdn.ckeditor.com/4.17.1/standard-all/ckeditor.js"></script>
<script src="<?= __MANAGE_ASSETS__ ?>/validon/validon.js"></script>
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

  // 記事タイプ切り替えイベント登録
  document.addEventListener('change', update_tab)
  update_tab()
})

// 記事タイプ切り替え
function update_tab() {
  var type = document.querySelector('[name="type"]:checked').value;
  document.getElementById('tab-type-entry').classList.remove('show');
  document.getElementById('tab-type-pdf').classList.remove('show');
  document.getElementById('tab-type-url').classList.remove('show');
  document.getElementById('tab-type-'+type).classList.add('show');
  document.getElementById('is-blank-pdf').disabled = 'pdf'!==type // is_blank要素が２つ出ちゃうので、隠れている方は disabled にしてしまう。
  document.getElementById('is-blank-url').disabled = 'url'!==type // 〃
}
</script>

</body>
</html>
