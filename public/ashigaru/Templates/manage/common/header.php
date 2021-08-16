<header>
  <div class="inner">
    <div id="cap">
      <!-- <img class="logo" src="<?= __BASE__ ?>/assets/images/logo.svg"> -->
      <div class="title">
        <!-- <h1><?= @$Settings['package_label'] ?></h1> -->
        <h2 style="text-align:center;line-height:1.5">システム<wbr>管理画面</h2>
      </div>
    </div>
    <?php if(@$_SESSION['loggedin']) { ?>
    <nav id="global-menu">
      <?php include __DIR__.'/menu.php' ?>
      <button id="menu-sw" uk-toggle="target: #side-menu"><i class="fas fa-bars"></i></button>
    </nav>
    <?php } ?>
  </div>
</header>
