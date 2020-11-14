<?php
$curl_active = (function_exists('curl_version')) ? TRUE : FALSE;
?>
<?php
$responseNumber = isset($_GET['response']) ? $_GET['response'] : false;
if ( !empty($_GET['token'] ) && $responseNumber == 1 ){
		$ElCheck = new \Indeed\ISM\ElCheck();
		$responseNumber = $ElCheck->responseFromGet();
}
if ( $responseNumber !== false ){
		$ElCheck = new \Indeed\ISM\ElCheck();
		$responseMessage = $ElCheck->responseCodeToMessage( $responseNumber, 'ism-danger-box', 'ism-success-box', 'ism' );
}
$license = get_option( 'ism_license_set' );
$envato_code = get_option( 'ism_envato_code' );
?>
<div class="metabox-holder indeed">
		<div class="stuffbox-ism">
			<h3>
				<label style=" font-size:16px;">
					<?php _e('Activate Indeed Social Share & Locker Pro', 'ihc');?>
				</label>
			</h3>
			<form method="post" action="">
				<div class="inside">
					<?php if (!$curl_active): ?>
					<div class="iump-form-line iump-no-border" style="font-weight: bold; color: red;padding: 10px 0px 0px 5px;">cURL is disabled. You need to enable if for further activation request.</div>
					<?php endif;?>
					<div class="iump-form-line iump-no-border" style="width:10%;    padding: 10px 5px; float:left; box-sizing:border-box; text-align:right; font-weight:bold;">
						<label for="tag-name" class="ism-labels"><?php _e('Purchase Code', 'ihc');?></label>
					</div>
					<div class="iump-form-line iump-no-border" style="width:70%;    padding: 10px 5px; float:left; box-sizing:border-box;">
						<input name="ism_licensing_code" type="text" value="<?php echo $envato_code;?>" style="width:100%;"/>
					</div>

					<div class="ism-stuffbox-submit-wrap ism-submit-form" style="width:20%; float:right; box-sizing:border-box;">
						<?php if ( $license ):?>
		            <div class="ism-revoke-license ism-js-revoke-license"><?php _e( 'Revoke License', 'ism' );?></div>
		        <?php else: ?>
								<input type="submit" value="<?php _e('Activate License', 'ism');?>" name="ism_save_licensing_code" class="button button-primary button-large" />
		        <?php endif;?>
					</div>

					<div class="clear"></div>

					<div class="ism-license-status">
		        	<?php
								if ( $responseNumber !== false ){
										echo $responseMessage;
								} else if ( !empty( $_GET['revoke'] ) ){
										?>
										<div class="ism-success-box"><?php _e( 'You have just revoke your license for Indeed Social Share & Locker Pro plugin.', 'ism' );?></div>
										<?php
								} else if ( $license ){ ?>
											<div class="ism-success-box"><?php _e( 'Your license for Indeed Social Share & Locker Pro is currently Active.', 'ism' );?></div>
		          <?php } ?>
		      </div>

					<div class="ism-license-status">
						<?php
						if ( isset($_GET['extraCode']) && isset( $_GET['extraMess'] ) && $_GET['extraMess'] != '' ){
								$_GET['extraMess'] = stripslashes($_GET['extraMess']);
								if ( $_GET['extraCode'] > 0 ){
										// success
										?>
										<div class="ism-success-box"><?php echo urldecode( $_GET['extraMess'] );?></div>
										<?php
								} else if ( $_GET['extraCode'] < 0 ){
										// errors
										?>
										<div class="ism-danger-box"><?php echo urldecode( $_GET['extraMess'] );?></div>
										<?php
								} else if ( $_GET['extraCode'] == 0 ){
										// warning
										?>
										<div class="ism-warning-box"><?php echo urldecode( $_GET['extraMess'] );?></div>
										<?php
								}
						}
					?>
					</div>

					<div style="padding:0 60px;">
					<p>A valid purchase code Activate the Full Version of<strong> Indeed Social Share & Locker Pro</strong> plugin and provides access on support system. A purchase code can only be used for <strong>ONE</strong> Indeed Social Share & Locker Pro for WordPress installation on <strong>ONE</strong> WordPress site at a time. If you previosly activated your purchase code on another website, then you have to get a <a href="http://codecanyon.net/item/social-share-locker-pro-wordpress-plugin/8137709?ref=azzaroco" target="_blank">new Licence</a>.</p>
					<h4>Where can I find my Purchase Code?</h4>
					<a href="http://codecanyon.net/item/social-share-locker-pro-wordpress-plugin/8137709?ref=azzaroco" target="_blank">
						<img src="<?php echo ISM_DIR_URL;?>admin/files/images/purchase_code.jpg" style="margin: 0 auto; display: block;"/>
						</a>
					</div>
				</div>
			</form>
		</div>
	<div class="stuffbox-ism">
		<h3>
			<label style="text-transform: uppercase; font-size:16px;">
				Contact Support
			</label>
		</h3>
		<div class="inside">
			<div class="submit" style="float:left; width:80%;">
				In order to contact Indeed support team you need to create a ticket providing all the necessary details via our support system: support.wpindeed.com
			</div>
			<div class="submit" style="float:left; width:20%; text-align:center;">
				<a href="http://support.wpindeed.com/open.php?topicId=12" target="_blank" class="button button-primary button-large"> Submit Ticket</a>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="stuffbox-ism">
		<h3>
			<label style="text-transform: uppercase; font-size:16px;">
		    	Documentation
		    </label>
		</h3>
		<div class="inside">
			<iframe src="https://demoism.wpindeed.com/documentation/" width="100%" height="1000px" ></iframe>
		</div>
	</div>
</div>
</div>

<script>
jQuery( document ).ready(function(){
		jQuery( '[name=ism_save_licensing_code]' ).on( 'click', function(){
				jQuery.ajax({
							type : "post",
							url : window.ism_base_path + '/wp-admin/admin-ajax.php',
							data : {
											 action						: "ism_el_check_get_url_ajax",
											 purchase_code		: jQuery('[name=ism_licensing_code]').val(),
											 nonce 						: '<?php echo wp_create_nonce( 'ism_license_nonce' );?>',
							},
							success: function (data) {
									if ( data ){
											window.location.href = data;
									} else {
											alert( 'Error!' );
									}
							}
				});
				return false;
		});
		jQuery( '.ism-js-revoke-license' ).on( 'click', function(){
				jQuery.ajax({
							type : "post",
							url : window.ism_base_path + '/wp-admin/admin-ajax.php',
							data : {
											 action						: "ism_revoke_license",
											 nonce 						: '<?php echo wp_create_nonce( 'ism_license_nonce' );?>',
							},
							success: function (data) {
									window.location.href = '<?php echo admin_url('admin.php?page=ism_manage&tab=help&revoke=true');?>';
							}
				});
		});
});
</script>
