	<script type="text/javascript" src="<?php echo "$source_url"; ?>/assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo "$source_url"; ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="<?php echo "$source_url"; ?>/assets/js/captcha.js"></script>
	<script type="text/javascript" src="<?php echo "$source_url"; ?>/assets/js/publib.js"></script>
	<script type="text/javascript" src="js/select2.js"></script>
	<script type="text/javascript" src="js/tilt.jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.js-tilt').tilt({
				scale: 1.1
			});

			coreAdstriton('<?php echo "$id_user"; ?>', '<?php echo "$id_pub"; ?>', 0, 0, '', '<?php echo "$popup_ad"; ?>', 90, 0, 0, 0, 0, 0);
		});
	</script>
	<script type="text/javascript" src="js/main.js"></script>
	