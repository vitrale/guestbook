<?= $this->extend('layout/master') ?>
<?= $this->section('pageTitle') ?>Posts<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php if(count($data) == 0) { ?><p style="text-align: center">No post to show</p><?php } ?>
<?php
for($i = 0; $i < count($data); $i++) {
    $post = $data[$i];
?>
<div class="card mb-3">
	<div class="card-header"><?=$post->title?></div>
	<div class="card-body">
		<blockquote class="blockquote mb-0">
			<p><?=$post->message?></p>
			<footer class="blockquote-footer"><?=$post->username?></footer>
		</blockquote>
	</div>
</div>
<?php 
}
?>
<?= $this->endSection() ?>