<?php

require 'config.php';

$get_setting = mysqli_query($conn, "SELECT * FROM setting");
$get_setting = mysqli_fetch_array($get_setting);

$id_pub = $get_setting['id_pub'];
$popup_ad = $get_setting['popup_ad'];
$safelink_ad = $get_setting['safelink_ad'];

$api_key = $get_setting['api_key'];
$id_user = $get_setting['id_user'];
$sms_type = $get_setting['sms_type'];
$bad_words = $get_setting['bad_words'];
$footer_credit = $get_setting['footer_credit'];
$max_sms_length = $get_setting['max_sms_length'];
$max_daily_sms = $get_setting['max_daily_sms'];
$max_daily_user = $get_setting['max_daily_user'];
$max_daily_number = $get_setting['max_daily_number'];
$status_service = $get_setting['status_service'];

$ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d');
$status_badge = '<i class="fas fa-times-circle" style="color: red"></i>';
$status = 'ERROR';
$note = '';

$auto_type = FALSE;

if (isset($_POST['send_sms']) || isset($_GET['parse_sms'])) {
	if (isset($_GET['parse_sms'])) {
		$parse_sms = json_decode(base64_decode($_GET['parse_sms']), true);

		$number = $parse_sms[0];
		$sms = $parse_sms[1];
	}
	else {
		$number = $_POST['number'];
		$sms = $_POST['sms'];
	}

	$check_prefix = substr($number, 0, 2);

	if ($check_prefix=='62' || $check_prefix=='08') {
		$number = ltrim($number, '62');
		$number = ltrim($number, '0');
		$number = "62$number";

		$check_prefix = TRUE;
	}
	else {
		$check_prefix = FALSE;
	}

	$bad_words = explode(',', $bad_words);
	$words_count = count($bad_words);

	for ($i=0; $i<$words_count; $i++) {
		$sms = str_ireplace($bad_words[$i], '***', $sms);
	}

	$sms_length = strlen($sms);

	$count_sms = mysqli_query($conn, "SELECT * FROM sms WHERE date_send='$date'");
	$count_sms = mysqli_num_rows($count_sms);

	$count_sms_user = mysqli_query($conn, "SELECT * FROM sms WHERE ip='$ip' AND date_send='$date'");
	$count_sms_user = mysqli_num_rows($count_sms_user);

	$count_sms_number = mysqli_query($conn, "SELECT * FROM sms WHERE number_sms='$number' AND date_send='$date'");
	$count_sms_number = mysqli_num_rows($count_sms_number);

	if ($sms_type=='AUTO') {
		$auto_type = TRUE;

		$i_tmp = 0;
	}
	else {
		$i_tmp = 1;
	}

	if ($check_prefix==TRUE && $max_daily_sms>$count_sms && $max_daily_user>$count_sms_user && $max_daily_number>$count_sms_number && $sms_length<=$max_sms_length && $status_service==1) {
		$note = 'Error not defined';

		for ($i=$i_tmp; $i<2; $i++) {
			if ($i==0 && $auto_type==TRUE) {
				$sms_type = 'FREE';
			}

			if ($i==1 && $auto_type==TRUE) {
				$sms_type = 'BULK';
			}

			if ($sms_type!='FREE') {
				$sms = "$sms\r\n\r\n$footer_credit";
			}

			$sms = urlencode($sms);
			$url = "$api_url/api/index.php?token=$api_key&id_user=$id_user&menu=SEND_SMS&type=$sms_type&number=$number&text=$sms";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			$output = curl_exec($ch);
			curl_close($ch);

			$output = json_decode($output, true);

			$result = $output['result'];
			$note = $output['note'];

			if ($result==1) {
				$id_kuysms = $output['data']['id_sms'];

				$sms = urldecode($sms);

				$input_sms = mysqli_query($conn, "INSERT INTO sms VALUES (NULL, '$id_kuysms', '$number', '$sms', '$ip', '$date')");

				$status_badge = '<i class="fas fa-check-circle" style="color: green"></i>';
				$status = 'SUCCESS';
				$note = 'SMS berhasil dikirim ke nomor tujuan';

				$i = 2;
			}
		}
	}
	else {
		$note = 'Maksimal SMS ke nomor tersebut telah tercapai atau server offline';
	}
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
					<big><?php echo "$status_badge"; ?></big>
					<br>
					<strong><?php echo "$status"; ?></strong>
					<br><br>
					<?php echo "$note"; ?>
					<br><br><br><br>
					<a href="index.php"><i class="fas fa-home" style="color: blue"></i> Back to Home</a>
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