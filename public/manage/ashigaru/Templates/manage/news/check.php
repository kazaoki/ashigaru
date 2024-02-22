<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include __TEMPLATES_DIR__.'/manage/meta.php' ?>
  <title><?= @$Ag['config']['site_title'] ?> CMS管理画面</title>
  <link rel="stylesheet" href="<?= __MANAGE__ ?>/assets/css/ckeditor-add.css?20231118">
</head>
<body class="<?= implode(' ', @$page_slugs) ?>">
<?php include __TEMPLATES_DIR__.'/manage/header.php' ?>
<main class="<?= implode(' ', $page_slugs) ?>">
<?php include __TEMPLATES_DIR__.'/manage/side.php' ?>
<div id="content">
<?php include __TEMPLATES_DIR__.'/manage/flash.php' ?>
<!-------------------------- content start -------------------------->

<section class="title">
  <h1>お知らせ管理 - <?= @$_POST['entry_id'] ? '編集' : '新規追加' ?></h1>
</section>

<section>
  <p class="uk-text-default">
    以下の内容でよろしければ、下の「保存する」ボタンをクリックしてください。
  </p>
  <form action="<?= __MANAGE__ ?>/news/save/" method="POST" class="uk-form-horizontal uk-margin-large" id="form">
    <?= AG::hiddens() ?>
    <div class="uk-margin">
      <label class="uk-form-label">登録ID</label>
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
    <div class="uk-margin">
      <label class="uk-form-label">カテゴリ</label>
      <div class="uk-form-controls uk-form-controls-text">
        <?= AG::h($entry->category->label) ?>
      </div>
    </div>
    <hr>
    <div class="uk-margin">
      <label class="uk-form-label">記事タイプ</label>
      <div class="uk-form-controls uk-form-controls-text">
        <?= AG::h(@$Ag['config']['news']['type_labels'][$entry->type]) ?>
      </div>
    </div>
    <hr>
    <?php if('entry'===$entry->type) { ?>
    <div class="uk-margin uk-overflow-hidden">
      <label class="uk-form-label">本文</label>
      <div class="uk-form-controls uk-form-controls-text">
        <div class="content-preview page" style="overflow:hidden">
          <?= $entry->content ?>
        </div>
      </div>
    </div>
    <?php } else if('pdf'===$entry->type) { ?>
    <div class="uk-margin">
      <label class="uk-form-label">PDFファイルアップロード</label>
      <div class="uk-form-controls uk-form-controls-text">
        <div class="uk-grid-small" uk-grid>
          <?php if(!@$_POST['pdf_delete']) { ?>
            <?php if(@$_POST['pdf_base64'] || @$_POST['pdf_upped']) { ?>
            <a onclick="document.getElementById('pdf-preview-form').submit()">
              <?= $entry->pdf_filename ?>
            </a>
            <?php } else { ?>
            <div class="uk-text uk-text-default">
              （PDF未選択）
            </div>
            <?php } ?>
          <?php } else { ?>
          <div class="uk-text uk-text-danger">
            （PDFを削除します）
          </div>
          <?php } ?>
        </div>
        <?php if($entry->is_blank) { ?>
          <div>（別ウィンドウで開く）</div>
        <?php } ?>
      </div>
    </div>
    <?php } else if('url'===$entry->type) { ?>
    <div class="uk-margin">
      <label class="uk-form-label">URLリンク先</label>
      <div class="uk-form-controls uk-form-controls-text">
        <a href="<?= \AG::h($entry->url) ?>" target="_blank"><?= \AG::h($entry->url) ?></a>
        <?php if($entry->is_blank) { ?>
          <div>（別ウィンドウで開く）</div>
        <?php } ?>
      </div>
    </div>
    <?php } ?>
    <hr>
    <div class="uk-flex uk-flex-center" id="submit-buttons">
      <button type="button" class="uk-button uk-button-link uk-margin-right" onclick="validon.back('../edit/<?= @$_POST['entry_id'] ? @$_POST['entry_id'].'/' : '' ?>')"><i class="fas fa-pen"></i> 修正する</button>
      <button type="submit" class="uk-button uk-button-primary uk-button-large uk-margin-left"><i class="fas fa-save"></i> 保存する</button>
    </div>
  </form>
  <!-- PDFプレビュー用フォーム -->
  <form action="<?= __MANAGE__ ?>/news/pdf_preview/" target="_blank" method="POST" id="pdf-preview-form" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $entry->id ?>">
    <input type="hidden" name="pdf_base64" value="<?= @$_POST['pdf_base64'] ?>">
    <input type="hidden" name="pdf_filename" value="<?= $entry->pdf_filename ?>">
  </form>
</section>

<!--------------------------- content end --------------------------->
</div>
</main>
<?php include __TEMPLATES_DIR__.'/manage/footer.php' ?>

<script src="<?= __MANAGE__ ?>/assets/validon/validon.js"></script>
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
