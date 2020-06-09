<?php use App\Controllers\PostController; ?>
<?= $this->extend('layout/master') ?>
<?= $this->section('pageTitle') ?>New Post<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php 
if(!is_null($errors)) {
    foreach($errors as $key => $value) {
        ?>
        <p style="color: red"><?=$value ?></p>
        <?php 
    }
} 
?>
<form action="<?=route_to(PostController::ADD_ROUTE_ALIAS)?>" method="post">
	<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
	</div>
	<div class="form-group">
		<label for="message">Message</label>
		<textarea class="form-control" id="message" name="message" placeholder="Message"></textarea>
	</div>
	<button type="reset" class="btn btn-primary">Reset</button>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
<?= $this->endSection() ?>