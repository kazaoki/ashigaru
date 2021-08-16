<?php
if($flashes = \Ag\flash::get()) {
  ?>
  <section id="flash">
    <?php foreach($flashes as $flash) { ?>
    <div class="uk-alert-<?= $flash['class'] ? $flash['class'] : '' ?>" uk-alert>
      <a class="uk-alert-close" uk-close></a>
      <p><?= $flash['message'] ?></p>
    </div>
    <?php } ?>
  <?php
}
