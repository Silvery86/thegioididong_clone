<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:10 PM
 **/

use app\lib\App;

include __DIR__.'/../vendor/autoload.php';
$app   = new App();
$title = 'OPPS!';
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
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
	<title><?= $app->params['name'].' | '.$title ?></title>
	<link rel="shortcut icon" type="image/png" href="<?= $app->params['favicon'] ?>">
    <?php
    $app->registerAssets();
    ?>
</head>
<body class="vh-100">
<div class="authincation h-100">
	<div class="container h-100">
		<div class="row justify-content-center h-100 align-items-center">
			<div class="col-md-6">
				<div class="error-page">
					<div class="error-inner text-center">
						<div class="dz-error" data-text="&#128528;">&#128528;</div>
						<h4 class="error-head">
							<i class="fa fa-exclamation-triangle text-warning"></i> Chít Tiệc! Có Lỗi Xảy Ra!
						</h4>
						<div>
							<a href="<?= $app->params['home_url'] ?>" class="btn btn-secondary">Về Trang Chủ</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
