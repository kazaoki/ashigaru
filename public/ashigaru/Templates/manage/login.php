<!DOCTYPE html>
<html>
<head>
<?php include __TEMPLATES__.'/manage/common/meta.php' ?>
<title>システム管理画面 - <?= @$Ag['config']['site_title'] ?></title>
</head>
<body>
<?php include __TEMPLATES__.'/manage/common/header.php' ?>
<main class="<?= implode(' ', $page_slugs) ?>">
<div id="content">
<!-------------------------- content start -------------------------->

<section class="title">
  <h1><i class="fas fa-user-lock"></i>ログイン認証</h1>
  <p>ログインID及びパスワードをご入力しログインして下さい。</p>
</section>

<section>
  <form class="uk-form-stacked" method="post">
    <input type="hidden" name="csrf_token" value="<?= \Ag\Csrf::generate() ?>">
    <div class="uk-margin">
      <div class="uk-form-controls">
        <input type="text" class="uk-input uk-form-large" name="login_id" placeholder="ログインID">
      </div>
    </div>
    <div class="uk-margin">
      <div class="uk-form-controls">
        <input type="password" class="uk-input uk-form-large" name="login_pw" placeholder="パスワード">
      </div>
    </div>
    <div class="uk-inline">
      <button type="submit" class="uk-button uk-button-primary uk-button-large">ログイン<i class="fas fa-angle-right"></i></button>
    </div>
  </form>
</section>

<!--------------------------- content end --------------------------->
</div>
</main>
<?php include __TEMPLATES__.'/manage/common/footer.php' ?>
</body>
</html>
