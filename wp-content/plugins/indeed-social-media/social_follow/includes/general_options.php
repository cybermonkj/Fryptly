<?php
	isf_update_metas();//update metas
	$meta_arr = isf_get_metas();//get metas
?>
<form action="" method="post">

        <div class="stuffbox-ism">
            <h3>
                <label>Social Follow Settings:</label>
            </h3>
            <div class="inside">
                <table class="isf-follow-table">
                		<tr>
                			<td style="width: 10%;"></td>
                			<td style="width: 50%;"><b>URL</b></td>
                			<td style="width: 20%;"><b>Sublabel</b></td>
                			<td style="width: 15%;"><b>Offline Counts</b></td>
                		</tr>
						<?php
							$sm_items = ism_return_general_labels_sm( '', TRUE, '', TRUE );
						
							if($sm_items['subscribe']) unset($sm_items['subscribe']);
					

							$limit = ceil(count($sm_items)/3);
							$i = 1;
							foreach ($sm_items as $k=>$v){

								?>
									<tr>
										<td  style="width: 10%;">
											<?php
												if (!empty($v['font']) && $v['font']=='socicon'){
													?>
														<i class="ism-sc-icon ism-socicon-<?php echo $v['long_key'];?>"></i>
													<?php
												} else {
													?>
														<i class="fa-ism fa-<?php echo $v['long_key'];?>-ism"></i>
													<?php
												}
											?>

										</td>
										<td style="width: 50%;">
											<input type="text" value="<?php if (isset($meta_arr['isf_urls'][$v['long_key']])) echo $meta_arr['isf_urls'][$v['long_key']];?>" name="isf_urls[<?php echo $v['long_key'];?>]"/>
										</td>
										<td style="width: 20%;">
											<input type="text" value="<?php if (isset($meta_arr['isf_sublabels'][$v['long_key']])) echo $meta_arr['isf_sublabels'][$v['long_key']];?>" name="isf_sublabels[<?php echo $v['long_key'];?>]" />
										</td>
										<td style="width: 15%;">
											<input type="number" value="<?php if (isset($meta_arr['isf_initial_counts'][$v['long_key']]) ) echo $meta_arr['isf_initial_counts'][$v['long_key']];?>" name="isf_initial_counts[<?php echo $v['long_key'];?>]" min="0" />
										</td>
									</tr>
								<?php
								$i++;
								if ($i>=$limit){
									$i = 1;
									?>
									</table>
									<table class="isf-follow-table">
										<tr>
				                			<td style="width: 10%;"></td>
				                			<td style="width: 50%;"><b>URL</b></td>
				                			<td style="width: 20%;"><b>Sublabel</b></td>
				                			<td style="width: 15%;"><b>Offline Counts</b></td>
										</tr>
									<?php
								}
							}
						?>
                </table>
				<div class="submit">
                    <input type="submit" value="Save changes" name="isf_submit_bttn" class="button button-primary button-large" />
                </div>
             </div>
		</div>
				<div class="stuffbox-ism">
		            <h3>
		                <label>Social Follow APIs</label>
		            </h3>
		            <div class="inside">
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">Facebook</div>
		            	<!--	<div class="isf_row_dashboard">
		            			<span class="isf_inside_row_label">Page URL:</span> <input type="text" value="<?php //echo $meta_arr['isf_facebook_page_n'];?>" name="isf_facebook_page_n" />
		            		</div> -->
									<!-- start developer work -->
										<div class="isf_row_dashboard">
											<span class="isf_inside_row_label">Page ID:</span> <input type="text" value="<?php echo $meta_arr['isf_facebook_page_id'];?>" name="isf_facebook_page_id" />
											<span class="ism-info"> In order to get Facebook page ID go to https://facebook.com/your_page_name click <b>About</b> and look bellow for <b>Page ID</b> </span>
										</div>
										<div class="isf_row_dashboard">
											<span class="isf_inside_row_label">Page Access Token:</span> <input type="text" value="<?php echo $meta_arr['isf_facebook_page_acc_token'];?>" name="isf_facebook_page_acc_token" />
											<span class="ism-info">To receive a Page Access Token, register on <a href="https://developers.facebook.com" target="_blank">https://developers.facebook.com</a> and create a new application.
												 After you suceed<br> with your first app, go to header menu  <b>Tools</b> and submit on <b>Graph API explorer</b>. Click <b>Get Token</b> and submit option
											  	<b>Get Page Access Token</b>.<br> After you login in <b>Access Token bar</b>  will generate a token.
												 	Paste in Page Access Token field the token you just generate. </span>
												<span class="ism-info">
													<p class="ism-info"><b>Generate a long-lived access token</b></p>
													<ol>
														<li> Create a Facebook App or use an existing app if you already have one.</li>
														<li>Navigate to Facebook <a href='https://developers.facebook.com/tools/explorer' target='_blank'>Graph API Explorer</a>.</li>
															<ul>
																<li>Select an app from Application drop-down.</li>
																<li>In the next drop-down select "Get user access token". In the  pop-up window select permissions for the user access token.</li>
																<li>Click on "Get Access Token" button. This will create short-lived user access token.</li>
															</ul>
														<li>Navigate to <a href='https://developers.facebook.com/tools/accesstoken'target='_blank'>Access Token Tool page</a>.</li>
															<ul type="a">
																<li>Press debug option for the User Token for the current app.</li>
																<li>This will  take you again to <a href='https://developers.facebook.com/tools/debug/accesstoken/' target='_blank'>Access Token Debugger</a>
																and press debug to see the full info regarding short lived user access token.</li>
																<li>Short-lived user access token expire after an hour. Click on “Extend Access Token” to get the long-lived access token.</li>
															</ul>
														<li>Return to <a href='https://developers.facebook.com/tools/explorer' target='_blank'>Graph API Explorer</a> and paste the recently created long-lived user access token in the Access Token field.</li>
														<li>Paste in Page Access Token field the long-lived token you just generate.</li>
													</ol>
												</span>
										</div>
									<!--end developer work -->
		            	</div>
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">Twitter</div>
		            		<div class="isf_row_dashboard">
		            			<span class="isf_inside_row_label">UserName:</span> <input type="text" value="<?php echo $meta_arr['isf_twitter_username'];?>" name="isf_twitter_username" />
		            		</div>
		            		<div class="isf_row_dashboard">
		            			<span class="isf_inside_row_label">Consumer key:</span> <input type="text" value="<?php echo $meta_arr['isf_twitter_ck'];?>" name="isf_twitter_ck" />
		            		</div>
		            		<div class="isf_row_dashboard">
		            			<span class="isf_inside_row_label">Consumer secret:</span> <input type="text" value="<?php echo $meta_arr['isf_twitter_cs'];?>" name="isf_twitter_cs" />
		            		</div>
		            		<div class="isf_row_dashboard">
		            			<span class="isf_inside_row_label">Access token:</span> <input type="text" value="<?php echo $meta_arr['isf_twitter_at'];?>" name="isf_twitter_at" />
		            		</div>
		            		<div class="isf_row_dashboard">
		            			<span class="isf_inside_row_label">Access token secret:</span> <input type="text" value="<?php echo $meta_arr['isf_twitter_ats'];?>" name="isf_twitter_ats" />
		            		</div>
		            		<div>
		            			<span class="ism-info">
		            				You can get consumer key, consumer secret, acces token and access token secret after you register on <br/> Twitter Application Management:
		    	         			<a href="https://apps.twitter.com/app/new" target="_blank">https://apps.twitter.com/app/new</a>
		            			</span>
		            		</div>
		            	</div>
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">Google+</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">Page ID/Name</span> <input type="text" value="<?php echo $meta_arr['isf_google_page_id'];?>" name="isf_google_page_id" />
		            			</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">API key</span> <input type="text" value="<?php echo $meta_arr['isf_google_api_key'];?>" name="isf_google_api_key" />
		            			</div>
		            	</div>
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">LinkedIn</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">Company Name: </span> <input type="text" value="<?php echo $meta_arr['isf_link_id'];?>" name="isf_link_id" />
		            			</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">APP Key: </span> <input type="text" value="<?php echo $meta_arr['isf_link_app_key'];?>" name="isf_link_app_key" />
		            			</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">APP Secret: </span> <input type="text" value="<?php echo $meta_arr['isf_link_app_secret'];?>" name="isf_link_app_secret" />
		            			</div>
		            	</div>
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">Pinterest</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">UserName: </span> <input type="text" value="<?php echo $meta_arr['isf_pinterest_user'];?>" name="isf_pinterest_user" />
		            			</div>
		            	</div>
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">VKontakte</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">ID/Name: </span> <input type="text" value="<?php echo $meta_arr['isf_vk_name'];?>" name="isf_vk_name" />
		            			</div>
		            	</div>
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">Delicious</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">UserName: </span> <input type="text" value="<?php echo $meta_arr['isf_delicious_user'];?>" name="isf_delicious_user" />
		            			</div>
		            	</div>

		            	<div style="margin-top: 40px;">
		            		<div style="display:inline-block;">Check On Every <input type="number" value="<?php echo $meta_arr['isf_check_time'];?>" name="isf_check_time" style="width: 60px;" min="1"/> Hours</div>
		            	</div>
				<div class="submit">
                    <input type="submit" value="Save changes" name="isf_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
      </div>
</form>
