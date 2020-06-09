<?php
use App\Controllers\AuthenticationController;
use App\Controllers\PostController;
use Config\Services;

$principal = ($session = Services::session())->has('principal') ? $session->get('principal') : null;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Welcome to CodeIgniter 4!</title>
		<meta name="description" content="The small framework with powerful features">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<h2><?= $this->renderSection('pageTitle') ?></h2>
			<div class="row">
				<div class="col-12">
					<ul class="nav justify-content-end">
					<?php if(is_null($principal)) { ?>
						<li class="nav-item">
							<a class="nav-link" href="<?=route_to(AuthenticationController::LOGIN_PAGE_ROUTE_ALIAS)?>">Login</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?=route_to(AuthenticationController::REGISTER_PAGE_ROUTE_ALIAS)?>">Register</a>
						</li>
					<?php } else { ?>
						<li class="nav-item">
							<a class="nav-link" href="<?=route_to(AuthenticationController::LOGOUT_ROUTE_ALIAS)?>">Logout</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?=route_to(PostController::LIST_PAGE_ROUTE_ALIAS)?>">Posts</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?=route_to(PostController::ADD_PAGE_ROUTE_ALIAS)?>">New</a>
						</li>
					<?php } ?>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-12"><?= $this->renderSection('content') ?></div>
			</div>
		</div>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	</body>
</html>