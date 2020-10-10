
<div class="limiter">
	<div class="container-login100">
		<div class="login100-more" style="background-image: url('<?=BASE?>assets/images/bg-01.jpg');background-size: auto;background-repeat: no-repeat;background-position: center left;"></div>

		<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">

			<form class="login100-form validate-form" action="<?=cn('users/ajax_login')?>" method="POST">
				<span class="login100-form-title">
					<a href="<?=cn()?>">
						<h3 class="title"><?=lang("TweetPost")?></h3>
						<p class="desc"><?=lang("twitter_scheduling_tool")?></p>
					</a>
				</span>

				<div class="wrap-input100 validate-input" data-validate = "<?=lang("Invalid_email_format")?>">
					<input class="input100" type="text" name="email" placeholder="<?=lang('Email')?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "<?=lang("Password_is_required")?>">
					<input class="input100" type="password" name="password" placeholder="<?=lang('Password')?>">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
						<a href="javascript:void(0)" class="btnUserLogin login100-form-btn">
							<?=lang('Sign_In')?>
						</a>
					</div>

					<a href="<?=cn('users/register')?>" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
						<?=lang('Register')?>
						<i class="fa fa-long-arrow-right m-l-5"></i>
					</a>
				</div>
			</form>
		</div>
	</div>
</div>