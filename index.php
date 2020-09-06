<?php

require 'config.php';

$get_setting = mysqli_query($conn, "SELECT * FROM setting");
$get_setting = mysqli_fetch_array($get_setting);

$title = $get_setting['title'];
$description = $get_setting['description'];
$keywords = $get_setting['keywords'];
$id_user = $get_setting['id_user'];
$id_pub = $get_setting['id_pub'];
$popup_ad = $get_setting['popup_ad'];
$safelink_ad = $get_setting['safelink_ad'];

$next_page = 'result.php';

if ($safelink_ad==1) {
	$next_page = 'result2.php';
}

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo "$title"; ?></title>
	<meta charset="utf-8" name="description" content="<?php echo "$description"; ?>">
	<meta charset="utf-8" name="keywords" content="<?php echo "$keywords"; ?>">
	<?php include 'head.php' ?>
</head>
<body>
	<div class="contact1">
		<div class="container-contact1">
			<div class="contact1-pic js-tilt" data-tilt>
				<img src="images/img-01.png">
			</div>

			<form class="contact1-form" action="<?php echo "$next_page"; ?>" method="POST">
				<span class="contact1-form-title">
					Kirim SMS Gratis ke Semua Operator Indonesia
				</span>

				<div class="wrap-input1">
					<input class="input1" type="number" name="number" placeholder="085712345678" required="">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1">
					<textarea class="input1" name="sms" required=""></textarea>
					<span class="shadow-input1"></span>
				</div>

				<div class="container-contact1-form-btn">
					<button class="contact1-form-btn" name="send_sms">
						<span>
							Send SMS
						</span>
					</button>
				</div>
			</form>
		</div>
		<?php include 'credit.php' ?>
	</div>

	<?php include 'footer.php' ?>
</body>
</html>