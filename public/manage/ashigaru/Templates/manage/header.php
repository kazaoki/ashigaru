<header>
  <div class="inner">
    <div id="cap">
      <div class="title">
        <div class="logo"></div>
        <h1>
          <div class="site-title"><?= @$Ag['config']['site_title'] ?></div>
          <div class="system-title"><?= @$Ag['config']['system_title'] ?></div>
        </h1>
      </div>
    </div>
    <?php if(@$_SESSION['loggedin_admin_id']) { ?>
    <nav id="global-menu">
      <?php include __DIR__.'/menu.php' ?>
      <button id="menu-sw" uk-toggle="target: #side-menu"><i class="fas fa-bars"></i></button>
    </nav>
    <?php } ?>
  </div>
</header>
