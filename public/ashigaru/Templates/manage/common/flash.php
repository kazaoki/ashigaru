<?php if(@$Flash) { ?>
<?php foreach(array_keys($Flash) as $key) { ?>
<div class="flash flash-<?= $key ?>">
<?php foreach($Flash[$key] as $message) { ?>
<p><?= $message ?></p>
<?php } ?>
</div>
<?php } ?>
<?php } ?>
