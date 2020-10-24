<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?= configs('meta_description', 'value'); ?>">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <title><?= $title; ?></title>
    <?= link_tag('public/themes/' . config('theme') . '/images/' . configs('website_favicon', 'value'), 'shortcut icon', 'image/ico'); ?>
	<!-- Google fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <!-- Bootstrap CSS -->
    <?= set_css('bootstrap.min.css'); ?>
    <?= set_css('bootstrap-toggle.min.css'); ?>
    <!-- animate CSS -->
    <?= set_css('animate.min.css'); ?>
    <!-- fontawesome CSS -->
    <?= set_css('font-awesome.min.css'); ?>
    <!-- style CSS -->
    <?= set_css('style.min.css'); ?>
    <!-- fonts size CSS -->
    <?= set_css('fontsize.min.css'); ?>
    <!-- style css required (do not remove) -->
	<style>.loading:after {content: '<?= lang("loading") . "... " . lang("loading_patient_wait") . ""; ?>';}</style>
	<script src="<?= set_js('jquery-3.4.1.min.js'); ?>"></script>
	<?= configs('javascript_embed_header', 'value'); ?>
</head>

<body>

<div class="preloader">
	<div class="loader">
		<div class="ytp-spinner">
			<div class="ytp-spinner-container">
				<div class="ytp-spinner-rotator">
					<div class="ytp-spinner-left">
						<div class="ytp-spinner-circle"></div>
					</div>
					<div class="ytp-spinner-right">
						<div class="ytp-spinner-circle"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="page-overlay" class="visible incoming">
	<div class="loader-wrapper-outer">
		<div class="loader-wrapper-inner">
			<div class="loader">
				<div class="balls mx-auto">
					<div></div>
					<div></div>
					<div></div>
				</div>
				<br>
				<div class="loading"></div>
			</div>
		</div>
	</div>
</div>

<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-sm-6">
			<a class="navbar-brand mb-5 d-flex justify-content-center" href="<?= base_url(); ?>"><img src="<?= set_image(configs('website_logo', 'value')); ?>" alt="logo-boostpanel"></a>

			<div class="section_tittle text-center">
				<p><?= lang("password_reset"); ?></p>
				<h2><?= lang("recover_password"); ?></h2>
			</div>

			<?php if (configs('protocol', 'value') != ''): ?>
			<div class="alert alert-danger alert-dismissible rounded error" style="display:none;" role="alert">
				<i class="fa fa-exclamation-triangle"></i> <span class="error-message"></span>
				<a class="close cursor-pointer" aria-label="close">&times;</a>
			</div> <!-- Alert error -->

			<div class="alert alert-success alert-dismissible rounded success" style="display:none;" role="alert">
				<i class="fa fa-thumbs-up"></i> <span class="success-message"></span>
				<a class="close cursor-pointer" aria-label="close">&times;</a>
			</div> <!-- Alert success -->

			<div class="bg-white p-3 rounded shadow">
				<?= form_open('recover', ['class' => 'actionForm', 'id' => 'recover-form']); ?>
				<div class="form-group">
					<?php
					echo form_label(lang("input_email"), 'email_recover', [
						'class' => 'font-weight-bold form-text'
					]);

					echo form_input([
						'name' => 'email_recover',
						'class' => 'form-control',
						'type' => 'email',
						'value' => set_value("email_recover"),
						'placeholder' => lang("input_email"),
						'onfocus' => "this.placeholder = ''",
						'onblur' => "this.placeholder = '" . lang("input_email") . "'"
					]);
					?>
				</div>

				<?php if (configs('google_recaptcha', 'value') == 'on'): ?>
					<div class="form-group">
						<div class="g-recaptcha" data-sitekey="<?= configs('recaptcha_public_key', 'value'); ?>"></div>
					</div>
				<?php endif; ?>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<?php
						echo form_submit([
							'class' => 'genric-btn info-purple e-large btn-block radius fs-16',
							'type' => 'submit',
							'value' => lang("button_recover_password")
						]);
						?>
						</div>
					</div>

					<div class="mt-3 col-sm-6 text-center">
						<a href="<?= base_url('login'); ?>" class="btn_6 e-large radius text-decoration-none fs-14"><?= lang("back_to_login_page"); ?></a>
					</div>
				</div>

				<?= form_close(); ?>
			</div>
			<?php else: ?>
				<div class="bg-danger text-white p-2 mb-4 rounded"><i class="fa fa-exclamation-triangle"></i> <?= lang("error_page_not_configured"); ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>

<!-- popper js -->
<script src="<?= set_js('popper.min.js'); ?>"></script>
<!-- bootstrap js -->
<script src="<?= set_js('bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= set_js('bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?= set_js('bootstrap-toggle.min.js'); ?>"></script>
<!-- counterup js -->
<script src="<?= set_js('waypoints.min.js'); ?>"></script>
<script src="<?= set_js('jquery.counterup.min.js'); ?>"></script>
<!-- custom js -->
<script src="<?= set_js('core.min.js'); ?>"></script>
<script src="<?= set_js('scripts.min.js'); ?>"></script>
<!-- tagsinput js -->
<script src="<?= set_js('jquery.tagsinput-revisited.min.js'); ?>"></script>
<?php if (configs('google_recaptcha', 'value') == 'on') : ?>
	<!-- Google Recaptcha v2 -->
	<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<?php endif; ?>

<?= configs('javascript_embed', 'value'); ?>
</body>

</html>