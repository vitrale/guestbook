<?php use App\Controllers\AuthenticationController; ?>
<?= $this->extend('layout/master') ?>
<?= $this->section('pageTitle') ?>Register<?= $this->endSection() ?>
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
<form action="<?=route_to(AuthenticationController::REGISTER_ROUTE_ALIAS)?>" method="post">
	<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
	</div>
	<div class="form-group">
		<label for="email">E-mail</label>
		<input type="text" class="form-control" id="email" name="email" placeholder="Enter e-mail">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" id="password" name="password" placeholder="Password">
	</div>
	<button type="reset" class="btn btn-primary">Reset</button>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
<?= $this->endSection() ?>