<div class="limiter">
	<div class="container-login100">
		<div class="login100-more" style="background-image: url('<?=BASE?>assets/images/bg-01.jpg');background-size: auto;background-repeat: no-repeat;background-position: center left;"></div>

		<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
			<form class="login100-form validate-form" action="<?=cn('users/ajax_register')?>" method="POST">
				<span class="login100-form-title">
					<a href="<?=cn()?>">
						<h3 class="title"><?=lang("TweetPost")?></h3>
						<p class="desc"><?=lang("twitter_scheduling_tool")?></p>
					</a>
				</span>

				<div class="wrap-input100 validate-input" data-validate="<?=lang("Username_is_required")?>">
					<input class="input100" type="text" name="username" placeholder="<?=lang('Username')?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "<?=lang("Invalid_email_format")?>">
					<input class="input100" type="text" name="email" placeholder="<?=lang('Email')?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "<?=lang("Password_is_required")?>">
					<input class="input100" type="password" name="password" placeholder="<?=lang('Password')?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "<?=lang("confirm_password_is_required")?>">
					<input class="input100" type="password" name="re_password" placeholder="<?=lang('Confirm_Password')?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" >
					<select class="input100" name="timezone" class="form-control">
						<option><?=lang('Your_Timezone')?></option>
						<?php if(!empty(tz_list())){
							foreach (tz_list() as $key => $value) {
						?>
						<option value="<?=$value['zone']?>"><?=$value['time']?></option>
						<?php }}?>
					</select>
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
						<a href="javascript:void(0)" class="login100-form-btn btnUserRegister"><?=lang('Register')?></a>
					</div>

					<a href="<?=cn('users/login')?>" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
						<?=lang('Sign_In')?>
						<i class="fa fa-long-arrow-right m-l-5"></i>
					</a>
				</div>
			</form>
		</div>
	</div>
</div>