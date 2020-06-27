<?php

session_start();

require 'config.php';

$get_setting = mysqli_query($conn, "SELECT * FROM setting");
$get_setting = mysqli_fetch_array($get_setting);

$id_pub = $get_setting['id_pub'];
$popup_ad = $get_setting['popup_ad'];

$balance = '0';
$username = '';
$password = '';
$update_info_txt = '';
$update_admin_txt = '';

if (isset($_POST['login'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = sha1($_POST['password']);

	$check_user = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
	$check_user = mysqli_num_rows($check_user);

	if ($check_user==1) {
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
	}
}

if (!empty($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
}

$check_user = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$check_user = mysqli_num_rows($check_user);

if ($check_user==1) {
if (isset($_POST['update_info'])) {
	$title = $_POST['title'];
	$description = $_POST['description'];
	$keywords = $_POST['keywords'];
	$api_key = $_POST['api_key'];
	$id_user = $_POST['id_user'];
	$sms_type = $_POST['sms_type'];
	$id_pub = $_POST['id_pub'];
	$popup_ad = $_POST['popup_ad'];
	$bad_words = $_POST['bad_words'];
	$footer_credit = $_POST['footer_credit'];
	$max_sms_length = $_POST['max_sms_length'];
	$max_daily_sms = $_POST['max_daily_sms'];
	$max_daily_user = $_POST['max_daily_user'];
	$max_daily_number = $_POST['max_daily_number'];
	$status_service = $_POST['status_service'];

	$update_info = mysqli_query($conn, "UPDATE setting SET title='$title', description='$description', keywords='$keywords', api_key='$api_key', id_user='$id_user', sms_type='$sms_type', id_pub='$id_pub', popup_ad='$popup_ad', bad_words='$bad_words', footer_credit='$footer_credit', max_sms_length='$max_sms_length', max_daily_sms='$max_daily_sms', max_daily_user='$max_daily_user', max_daily_number='$max_daily_number', status_service='$status_service'");

	if ($update_info) {
		$update_info_txt = 'Pengaturan berhasil disimpan';
	}
}

if (isset($_POST['update_admin'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = sha1($_POST['password']);

	$update_admin = mysqli_query($conn, "UPDATE admin SET username='$username', password='$password'");

	if ($update_admin) {
		$update_admin_txt = 'User & Pass berhasil diganti';
	}
}

$get_setting = mysqli_query($conn, "SELECT * FROM setting");
$get_setting = mysqli_fetch_array($get_setting);

$title = $get_setting['title'];
$description = $get_setting['description'];
$keywords = $get_setting['keywords'];
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

$url = "$api_url/api/index.php?token=$api_key&id_user=$id_user&menu=CHECK_BALANCE";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$output = curl_exec($ch);
curl_close($ch);

$output = json_decode($output, true);

$result = $output['result'];

if ($result==1) {
	$balance = $output['data']['balance_remaining'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<?php include 'head.php' ?>
</head>
<body>
	<div class="contact1">
		<div class="container-contact1">
			<p class="text-center">
				<form class="contact1-form" method="POST">
					<span class="contact1-form-title">
						Setting
					</span>
					<p class="text-center"><?php echo "$update_info_txt"; ?></p><br>
					<p>Your KuySMS Balance : Rp <?php echo "$balance"; ?></p><br>

					<div class="wrap-input1">
						<label><strong>Web Title</strong></label>
						<input class="input1" type="text" name="title" required="" value="<?php echo "$title"; ?>">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1">
						<label><strong>Web Description</strong></label>
						<input class="input1" type="text" name="description" required="" value="<?php echo "$description"; ?>">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1">
						<label><strong>Web Keywords</strong></label>
						<input class="input1" type="text" name="keywords" required="" value="<?php echo "$keywords"; ?>">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1">
						<label><strong>KuySMS API Key</strong></label>
						<input class="input1" type="text" name="api_key" required="" value="<?php echo "$api_key"; ?>">
						<span class="shadow-input1"></span>
						<label><small>*API Key secara default merupakan API testing dimana digunakan secara bersama-sama, gunakan API Key Anda sendiri untuk menghilangkan limit pada SMS, silahkan mendaftar di <a href="<?php echo "$api_url"; ?>/page/profile" target="_blank"><strong><u>KuySMS.me</u></strong></a> untuk mendapatkan API Key</small></label>
					</div>

					<div class="wrap-input1">
						<label><strong>KuySMS ID User</strong></label>
						<input class="input1" type="number" name="id_user" required="" value="<?php echo "$id_user"; ?>">
						<span class="shadow-input1"></span>
						<label><small>*Login di <a href="<?php echo "$api_url"; ?>/page/user" target="_blank"><strong><u>KuySMS.me</u></strong></a> untuk melihat ID User Anda</small></label>
					</div>

					<div class="wrap-input1">
						<label><strong>KuySMS SMS Type</strong></label>
						<input class="input1" type="text" name="sms_type" required="" value="<?php echo "$sms_type"; ?>">
						<span class="shadow-input1"></span>
						<label><small>*OTP / REG / BULK / FREE</small></label>
					</div>

					<div class="wrap-input1">
						<label><strong>Adstriton Publisher ID</strong></label>
						<input class="input1" type="number" name="id_pub" required="" value="<?php echo "$id_pub"; ?>">
						<span class="shadow-input1"></span>
						<label><small>*ID Publisher dari akun Adstriton Anda. Silahkan mendaftar di <a href="https://adstriton.com/page/publisher" target="_blank"><strong><u>Adstriton.com</u></strong></a> untuk mendapatkan ID Publisher</small></label>
					</div>

					<div class="wrap-input1">
						<label><strong>Popup Ad</strong></label>
						<input class="input1" type="number" name="popup_ad" required="" value="<?php echo "$popup_ad"; ?>">
						<span class="shadow-input1"></span>
						<label><small>*1 : Enable / 0 : Disable</small></label>
					</div>

					<div class="wrap-input1">
						<label><strong>Sensor Kata</strong></label>
						<input class="input1" type="text" name="bad_words" required="" value="<?php echo "$bad_words"; ?>">
						<span class="shadow-input1"></span>
						<label><small>*Kata yang disensor, pisahkan dengan tanda koma</small></label>
					</div>

					<div class="wrap-input1">
						<label><strong>SMS Footer</strong></label>
						<input class="input1" type="text" name="footer_credit" value="<?php echo "$footer_credit"; ?>">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1">
						<label><strong>Max SMS Length</strong></label>
						<input class="input1" type="number" name="max_sms_length" required="" value="<?php echo "$max_sms_length"; ?>">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1">
						<label><strong>Max SMS/Day</strong></label>
						<input class="input1" type="number" name="max_daily_sms" required="" value="<?php echo "$max_daily_sms"; ?>">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1">
						<label><strong>Max Send SMS/IP Address/Day</strong></label>
						<input class="input1" type="number" name="max_daily_user" required="" value="<?php echo "$max_daily_user"; ?>">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1">
						<label><strong>Max Send SMS/Number/Day</strong></label>
						<input class="input1" type="number" name="max_daily_number" required="" value="<?php echo "$max_daily_number"; ?>">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1">
						<label><strong>Status Service</strong></label>
						<input class="input1" type="number" name="status_service" required="" value="<?php echo "$status_service"; ?>">
						<span class="shadow-input1"></span>
						<label><small>*1 : ON / 0 : OFF</small></label>
					</div>

					<div class="container-contact1-form-btn">
						<button class="contact1-form-btn" name="update_info">
							<span>
								Update
							</span>
						</button>
					</div>
				</form>
			</p>
			<p class="text-center">
				<form class="contact1-form" method="POST">
					<br><br>
					<span class="contact1-form-title">
						Change Admin Username / Password
					</span>
					<p class="text-center"><?php echo "$update_admin_txt"; ?></p><br>

					<div class="wrap-input1">
						<label><strong>Username</strong></label>
						<input class="input1" type="text" name="username" required="">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1">
						<label><strong>Password</strong></label>
						<input class="input1" type="password" name="password" required="">
						<span class="shadow-input1"></span>
					</div>

					<div class="container-contact1-form-btn">
						<button class="contact1-form-btn" name="update_admin">
							<span>
								Update
							</span>
						</button>
					</div>

					<br><br><br>
					<a href="logout.php"><strong>LOGOUT</strong></a>
				</form>
			</p>
		</div>
		<?php include 'credit.php' ?>
	</div>

	<?php include 'footer.php' ?>
</body>
</html>

<?php } else { ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<?php include 'head.php' ?>
</head>
<body>
	<div class="contact1">
		<div class="container-contact1">
			<p class="text-center">
				<form class="contact1-form" method="POST">
					<span class="contact1-form-title">
						Login Admin
					</span>

					<div class="wrap-input1">
						<label><strong>Username</strong></label>
						<input class="input1" type="text" name="username" required="">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1">
						<label><strong>Password</strong></label>
						<input class="input1" type="password" name="password" required="">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1">
						<div id="captcha"></div>
					</div>

					<div class="container-contact1-form-btn">
						<button class="contact1-form-btn" id="input_btn" name="login" disabled="">
							<span>
								Login
							</span>
						</button>
					</div>
				</form>
			</p>
		</div>
		<?php include 'credit.php' ?>
	</div>

	<?php include 'footer.php' ?>
</body>
<script type="text/javascript">
	$(document).ready(function() {
		captchaShow(10);
	});
</script>
</html>

<?php } ?>