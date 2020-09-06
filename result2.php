<?php

require 'config.php';

$get_setting = mysqli_query($conn, "SELECT * FROM setting");
$get_setting = mysqli_fetch_array($get_setting);

$id_pub = $get_setting['id_pub'];
$popup_ad = 0;
$safelink_ad = $get_setting['safelink_ad'];

$id_user = $get_setting['id_user'];

$base_url_host = 'example.com';
$redirect_url = $base_url;

if (isset($_POST['send_sms'])) {
	$number = $_POST['number'];
	$sms = $_POST['sms'];

	$url_parameter = base64_encode(json_encode(array($number, $sms)));

	$redirect_url = "$base_url/result.php?parse_sms=$url_parameter";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Result</title>
	<?php include 'head.php' ?>
</head>
<body>
	<div class="contact1">
		<div class="container-contact1">
			<div class="col col-lg-12 text-center">
				<div id="adstriton-728">Loading Adstriton.com</div>
				<br>
			</div>

			<div class="col-md-auto text-center">
				<div id="adstriton-300">Loading Adstriton.com</div>
				<br><br>
			</div>

			<div class="col col-lg-4">
				<p class="text-center">
					<br>
					<a href="<?php echo "$redirect_url"; ?>"><i class="fas fa-evelope" style="color: blue"></i> <strong>Klik Disini Untuk Mengirim SMS</strong></a>
					<br><br>
				</p>
			</div>

			<div class="col-md-auto text-center">
				<!-- Adsense 300x250 Code Here -->
				<br>
			</div>

			<div class="col col-lg-12 text-center">
				<!-- Adsense 728x90 Code Here -->
			</div>
		</div>
		<?php include 'credit.php' ?>
	</div>

	<?php include 'footer.php' ?>
</body>
</html>