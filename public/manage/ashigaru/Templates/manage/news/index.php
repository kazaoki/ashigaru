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
  <button data-get-action="<?= __MANAGE__ ?>/news/edit/"class="uk-button uk-button-primary uk-align-right"><i class="fas fa-plus"></i> 新規追加</button>
  <h1>お知らせ管理</h1>
</section>

<section>
  <div class="uk-overflow-auto table-scroll">
  <table class="uk-table uk-table-middle uk-table-divider uk-table-striped uk-table-hover uk-table-small">
      <thead>
        <tr>
          <th>ID</th>
          <th>状態</th>
          <th>公開日時</th>
          <th>
            <select id="filter-cat" class="uk-select uk-form-small">
              <option value="">カテゴリ</option>
              <?php foreach($cats as $cat) { ?>
                <option value="<?= AG::h($cat->id) ?>"<?= intval($cat_id)===$cat->id ? 'selected' : '' ?>><?= AG::h($cat->label) ?> (<?= $cat->news()->full()->get()->count() ?>)</option>
              <?php } ?>
            </select>
          </th>
          <th>タイトル</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if($news->count()) { ?>
        <?php foreach($news as $entry) { ?>
        <tr class="<?= $entry->status ? '' : ' disabled' ?><?= $entry->is_reserved ? ' reserved' : '' ?>">
          <td><?= $entry->id ?></td>
          <td nowrap class="status">
            <?= $entry->is_reserved ? '公開予約' : ($entry->status ? '公開' : '準備中') ?>
          </td>
          <td nowrap class="uk-text-small date">
            <?= $entry->published_at->format('Y/n/j H:i') ?>
            <?= $entry->is_reserved ? '<i class="far fa-clock" uk-tooltip="title: 公開日時が過ぎるまで<br>記事は公開されません"></i>' : '' ?>
          </td>
          <td nowrap>
            <?= AG::h($entry->category->label) ?>
          </td>
          <td>
            <?php if($entry->status) { ?>
            <a href="<?= $entry->permalink ?>" target="_blank" class="uk-link-text"><?= AG::h($entry->title) ?> <i class="fas fa-external-link-alt"></i></a>
            <?php } else { ?>
            <?= AG::h($entry->title) ?>
            <?php } ?>
          </td>
          <td nowrap>
            <button data-get-action="<?= __MANAGE__ ?>/news/edit/<?= $entry->id ?>/" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-pen"></i> 編集</button>
            <button data-post-action="<?= __MANAGE__ ?>/news/delete/" data-params='{"entry_id":<?= $entry->id ?>}' class="uk-button uk-button-small"
              data-confirm=" 「<?= AG::h($entry->title) ?>」 を削除してもよろしいでしょうか。"><i class="fas fa-trash"></i> 削除</button>
          </td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr>
          <td colspan="100">
            現在、表示可能なお知らせはありません。
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php include __TEMPLATES_DIR__.'/manage/pager.php' ?>
</section>

<!-- 操作ボタンによるPOST送信用フォーム -->
<form method="POST" id="post-action-form">
  <input type="hidden" name="csrf_token" value="<?= AG::csrf_generate() ?>">
  <input type="hidden" name="page" value="<?= \Ag::h($pager['now']) ?>">
</form>

<!--------------------------- content end --------------------------->
</div>
</main>
<?php include __TEMPLATES_DIR__.'/manage/footer.php' ?>
</body>
</html>
