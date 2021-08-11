<?php include 'header.php' ?>

<form action="./" method="post">
  <input type="password" name="login_pw" placeholder="123456789">
  <input type="hidden" name="csrf_token" value="<?= \Ag\Csrf::generate() ?>">
  <div><button>ログイン</button></div>
</form>

<?php include 'footer.php' ?>
