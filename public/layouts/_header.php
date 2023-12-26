<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:08 PM
 **/

use app\lib\App;

/**
 * @var App $app
 * @var string $title
 */
$auth = $app->call('Auth');
$auth->logout();
$user = $auth->user;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="W3crm:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:title" content="W3crm:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:description" content="W3crm:Customer Relationship Management Admin Bootstrap 5 Template">
	<meta property="og:image" content="social-image.png">
	<meta name="format-detection" content="telephone=no">
	<title>
		<?= $app->params['name'] . ' | ' . $title ?>
	</title>
	<link rel="shortcut icon" type="image/png" href="<?= $app->params['favicon'] ?>">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons">
	<?php
	$app->registerAssets();
	?>
</head>

<body data-typography="poppins" data-theme-version="light" data-layout="vertical" data-nav-headerbg="black"
	data-headerbg="color_1">
	<?php
	include __DIR__ . '/_preloader.php';
	?>
	<div id="main-wrapper">
		<div class="nav-header">
			<a href="<?= $app->params['home_url'] ?>" class="brand-logo">
				<img src="<?= $app->params['logo'] ?>" alt="" class="img-fluid mt-1" width="70">
			</a>
			<div class="nav-control">
				<div class="hamburger">
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
				</div>
			</div>
		</div>
		<div class="header">
			<div class="header-content">
				<nav class="navbar navbar-expand">
					<div class="collapse navbar-collapse justify-content-between">
						<div class="header-left"></div>
						<ul class="navbar-nav header-right">
							<li class="nav-item ps-3">
								<div class="dropdown header-profile2">
									<a class="nav-link">
										<div class="header-info2 d-flex align-items-center">
											<div class="header-info">
												<h6>
													<?= $user->username ?>
												</h6>
												<p>
													<?= $user->email ?>
												</p>
											</div>

										</div>
									</a>
								</div>
							</li>
							<li class="nav-item align-items-center header-border">
								<a href="?action=logout" class="btn btn-primary btn-sm">Đăng Xuất</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>

		<?php
		include __DIR__ . '/_navbar.php';
		?>
		<div class="content-body">
			<!-- row -->
			<?php
			include __DIR__ . '/_breadcrumb.php'
				?>
			<div class="container-fluid">
				<?php
				include __DIR__ . '/_alert.php'
					?>
			</div>
	