<?php

if(!empty($_GET['deleteId'])) {
	global $wpdb;
	$table_name = $wpdb->prefix . "ism_newsletter_subscribe";
	$id = $_GET['deleteId'];
	$query = $wpdb->prepare("DELETE FROM $table_name WHERE id=%d", $id);
	$made = $wpdb->query($query);
}

// default settings

	if(isset($_POST['ns_cs_title'])) {

		$ns_cs_title = esc_sql($_POST['ns_cs_title']);
			update_option('ns_title_saved', $ns_cs_title);
}
	if(isset($_POST['ns_cs_content'])) {

		$ns_cs_content = esc_sql($_POST['ns_cs_content']);
			update_option('ns_content_saved', $ns_cs_content);
}
	if(isset($_POST['ns_cs_button_label'])) {

		$ns_cs_button_label = esc_sql($_POST['ns_cs_button_label']);
			update_option('ns_cs_button_label_saved', $ns_cs_button_label);
}

	if(isset($_POST['ns_cs_page_url'])) {

		$ns_cs_page_url = $_POST['ns_cs_page_url'];
			update_option('ns_cs_page_url_saved', $ns_cs_page_url);
}

	if(isset($_POST['ism_ns_tmplt'])) {
			if($_POST['ism_ns_tmplt'] == 'ns_theme_1' ) {

					update_option('ns_cs_theme_opt_saved', 'ns_theme_1');
			}
			if($_POST['ism_ns_tmplt'] == 'ns_theme_2' ) {

					update_option('ns_cs_theme_opt_saved', 'ns_theme_2');
			}
			if($_POST['ism_ns_tmplt'] == 'ns_theme_3' ) {

					update_option('ns_cs_theme_opt_saved', 'ns_theme_3');
			}
		}
	if(isset($_POST['ns_cs_placeholder'])) {
			$ns_cs_placeholder = esc_sql($_POST['ns_cs_placeholder']);
			update_option('ns_cs_placeholder_saved', $ns_cs_placeholder);
				}

	if(isset($_POST['ns_cs_succes_msg'])) {
				$ns_cs_succes_msg = esc_sql($_POST['ns_cs_succes_msg']);
				update_option('ns_cs_succes_msg_saved', $ns_cs_succes_msg);
			  }

	if(isset($_POST['ns_cs_error_msg'])) {
					$ns_cs_error_msg = esc_sql($_POST['ns_cs_error_msg']);
					update_option('ns_cs_error_msg_saved', $ns_cs_error_msg);
				}

	if(isset($_POST['ns_cs_empty_field_msg'])) {
						$ns_cs_empty_field_msg = esc_sql($_POST['ns_cs_empty_field_msg']);
						update_option('ns_cs_empty_field_msg_saved', $ns_cs_empty_field_msg);
				}

	if(isset($_POST['ns_cs_duplicate_adress_msg'])) {
							$ns_cs_duplicate_adress_msg = esc_sql($_POST['ns_cs_duplicate_adress_msg']);

							update_option('ns_cs_duplicate_adress_saved', $ns_cs_duplicate_adress_msg);
				}
	if(isset($_POST['ns_cs_checkbox_msg'])) {
							$ns_cs_checkbox_msg = esc_sql($_POST['ns_cs_checkbox_msg']);
							update_option('ns_cs_checkbox_msg', $ns_cs_checkbox_msg);
				}


				$ns_cs_title = get_option('ns_title_saved');
				$ns_cs_content = get_option('ns_content_saved');
				$ns_cs_button_label = get_option('ns_cs_button_label_saved');
				$ns_cs_page_url = get_option('ns_cs_page_url_saved');
				$ns_cs_theme_opt = get_option('ns_cs_theme_opt_saved');
				$ns_cs_placeholder = get_option('ns_cs_placeholder_saved');

				//message custom fields
				$ns_cs_succes_msg = get_option('ns_cs_succes_msg_saved');
				$ns_cs_error_msg = get_option('ns_cs_error_msg_saved');
				$ns_cs_empty_field_msg = get_option('ns_cs_empty_field_msg_saved');
				$ns_cs_duplicate_adress_msg = get_option('ns_cs_duplicate_adress_saved');
				$ns_cs_checkbox_msg = get_option('ns_cs_checkbox_msg');

				// wordpress editor box for URL link
	if(isset($_POST['ns_cs_page_url'])) {
			$ns_editor_content = $_POST['ns_cs_page_url'];
						update_option('ns_cs_editor_url_saved', $ns_editor_content);
				}
			$ns_editor_content = get_option('ns_cs_editor_url_saved');
			$ns_editor_content = stripslashes($ns_editor_content);
			$options = array('textarea_name' => 'ns_cs_page_url', 'textarea_rows' => 5, 'media_buttons' => false, 'tinymce' => array('toolbar1' =>
				 							 'formatselect, bold, italic, bullist, numlist, blockquote, link, wp_more, fullscreen, wp_adv, icon'));

			// Get the number of susbscribers from the Database

			global $wpdb;
			$table_name = $wpdb->prefix . "ism_newsletter_subscribe";
			$ns_total_subscribers = $wpdb->get_var("SELECT COUNT(id) FROM $table_name");
		 $ns_display_subscribers = $wpdb->get_results("SELECT *  FROM  $table_name order by id");

		 /*** Pagination for table ***/

/** define how many results  per page will be **/
	$ns_results_per_page = 50;

/** determine nr of total pages available **/
	 $ns_pages_nr = ceil($ns_total_subscribers / $ns_results_per_page);



/** determine wich page number visitor is currently on **/

if(!isset($_GET['listpage'])) {
	$current_page = 1;

}else{
	$current_page = $_GET['listpage'];
}

/** determine the sql LIMIT starting nr of the results on the displaying page**/
   $this_page_first_result = ($current_page - 1) * $ns_results_per_page;


/** get selected results from databse and display them on page **/
		$display_emails_by_limit = $wpdb->get_results("SELECT *  FROM  $table_name ORDER BY id DESC LIMIT $this_page_first_result, $ns_results_per_page");


if ($ns_display_subscribers) {

		$ns_table_emails =	"
		<div class='export_emails' onclick='ism_export_email_list();'>
													<i class='fa-ism fa-download-ism subs-downld' aria-hidden='true'></i>
													<div class='exp-ism'>Export to CSV</div>
													</div>
													<a href='' id='csv_file' target='_self'> Download</a>
													<div class='ism-clear'></div>";

										if ($ns_pages_nr <= 3) {
												for ($pageNumber=1; $pageNumber<=$ns_pages_nr; $pageNumber++ ) {
																$show_links_ns[] = $pageNumber;
												}

										} else {
																$show_links_ns = array(1, $ns_pages_nr, $current_page, $current_page + 1, $current_page - 1 );
													}

	 $ns_table_emails .="<div style='text-align: right;'><div class='ism-pagination-wrapper'>";
													//prev
										if ($current_page > 1) {

												$prev_page = $current_page - 1;
												$page_url_prev = admin_url('admin.php?page=ism_manage&tab=subscribe_newsletter') . '&listpage=' . $prev_page;
												$ns_table_emails .= "<a class='ns-page-nr' href='$page_url_prev'> < </a>";
													}

										for ($pageNumber=1; $pageNumber<=$ns_pages_nr; $pageNumber++ ) {

												if (in_array($pageNumber, $show_links_ns)) {
																if ($current_page==$pageNumber) {
																		$activeClass = 'ns-active-page';
															} else {
																		$activeClass = '';
																}

																		$page_url = admin_url('admin.php?page=ism_manage&tab=subscribe_newsletter') . '&listpage=' . $pageNumber;
																		$ns_table_emails .=  "<div class='ism-list-pagination-emails'><a class='ns-page-nr $activeClass' href='$page_url'>" . $pageNumber. "</a></div>";
																		$dots_on_sm = TRUE;
															} else {
																		if (!empty($dots_on_sm)) {
																			$ns_table_emails .= "<span class='ns-page-nr'>...</span>";
																			$dots_on_sm = FALSE;
																						}
															}
											}

										// next link
										if ($current_page < $ns_pages_nr) {
											$next_page = $current_page + 1;
											$page_url_next = admin_url('admin.php?page=ism_manage&tab=subscribe_newsletter') . '&listpage=' . $next_page;
											$ns_table_emails .= 	"<a class='ns-page-nr' href='$page_url_next'> > </a>";


						}
		$ns_table_emails .= "</div></div>";
		$ns_table_emails .= '<table class="ns-display-emails ns-eml-list">
											  	<tr>
											    	<th>Nr</th>
											    	<th>Email adress</th>
											    	<th>Action</th>
											  	</tr>';

 foreach ( $display_emails_by_limit as $ns_adress_display) {

		$deleteLink = admin_url('admin.php?page=ism_manage&tab=subscribe_newsletter') . '&deleteId=' . $ns_adress_display->id;
		$ns_table_emails .= '<tr>
													 <td id="email_nr">'.$ns_adress_display->id.'</td>
														<td>'. $ns_adress_display->ns_email.'</td>
														<td><a href="' . $deleteLink . '"><i class="fa-ism fa-trash-ism" aria-hidden="true"></i></a></td>
												 </tr>';

					 }

	  $ns_table_emails .= '</table>';
		$ns_table_emails .= '<div class="delete-all-emails" onClick="ism_deleting_all_data();" id="eliminate_emails">Erase all data</div>';

	} else {
		$ns_table_emails = 'No subscribers was found';
		$ism_export = 'export-btn-cls';
	}

?>
  <div class="metabox-holder indeed">
    <form method="post" action="">
      <div class="stuffbox-ism">
					<div class="ism-top-message"><b>Subscribe to Newsletter</b> will give you the option to receive email adresses from your readers or your customers.</div>
			</div>
			<div class="stuffbox-ism">
				<h3>Customize Newsletter</h3>
			<div class="inside">
				<table class="form-table ns_cs_table " style="margin-bottom: 0px;">
					<tbody>
								<tr valign="top">
										<td class="ns_cs_fields"><strong>Newsletter title</strong></td>
										<td class="ns_cs_fields_input"><input type="text" value="<?php echo $ns_cs_title;  ?>" name="ns_cs_title"></td>
								</tr>
								<tr valign="top">
										<td class="ns_cs_fields"><strong>Content area</strong></td>
										<td class="ns_cs_fields_input"><textarea name="ns_cs_content" rows="4" ><?php echo $ns_cs_content;  ?></textarea></td>
								</tr>
								<tr valign="top">
										<td class="ns_cs_fields"><strong>Placeholder field text</strong></td>
										<td class="ns_cs_fields_input"><input type="text" value="<?php echo $ns_cs_placeholder;  ?>" name="ns_cs_placeholder"></td>
								</tr>
								<tr valign="top">
										<td class="ns_cs_fields"><strong>Button label</strong></td>
										<td class="ns_cs_fields_input"><input type="text" value="<?php echo $ns_cs_button_label;  ?>" name="ns_cs_button_label"></td>
								</tr>
								<tr valign="top">
										<td class="ns_cs_fields"><strong>Terms of Use page URL</strong></td>
										<td class="ns_cs_editor_input"><?php wp_editor($ns_editor_content, 'ns_cs_page_url_id', $options); ?>	</td>
								</tr>

					</tbody>
				</table>
				<span class="ism-info">Keeping blank fields default values will be sets</span>
				<div class="submit">
						<input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
				</div>
			</div>
			</div>
			<div class="stuffbox-ism">
				<h3>Customize newsletter success and errors notices</h3>
				<div class="inside">
					<table class="form-table ns_cs_table " style="margin-bottom: 0px;">
						<tbody>
							<tr valign="top">
								<td class="ns_cs_fields"><strong>Succes message</strong></td>
								<td class="ns_cs_fields_input"><input type="text" value="<?php echo $ns_cs_succes_msg;  ?>" name="ns_cs_succes_msg"></td>
							</tr>
							<tr valign="top">
								<td class="ns_cs_fields"><strong>Error message</strong></td>
								<td class="ns_cs_fields_input"><input type="text" value="<?php echo $ns_cs_error_msg;  ?>" name="ns_cs_error_msg"></td>
							</tr>
							<tr valign="top">
								<td class="ns_cs_fields"><strong>Empty field</strong></td>
								<td class="ns_cs_fields_input"><input type="text" value="<?php echo $ns_cs_empty_field_msg;  ?>" name="ns_cs_empty_field_msg"></td>
							</tr>
							<tr valign="top">
								<td class="ns_cs_fields"><strong>Duplicate email adress</strong></td>
								<td class="ns_cs_fields_input"><input type="text" value="<?php echo $ns_cs_duplicate_adress_msg;  ?>" name="ns_cs_duplicate_adress_msg"></td>
							</tr>
							<tr valign="top">
								<td class="ns_cs_fields"><strong>Checkbox notification</strong></td>
								<td class="ns_cs_fields_input"><input type="text" value="<?php echo $ns_cs_checkbox_msg;  ?>" name="ns_cs_checkbox_msg"></td>
							</tr>
						</tbody>
					</table>
					<span class="ism-info">Keeping blank fields default values will be sets</span>
					<div class="submit">
							<input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
					</div>
				</div>
			</div>
			<div class="stuffbox-ism box-template">
				<h3>Select a template for Newsletter</h3>
				<div class="inside">
					<table class="form-table ns_cs_table " style="margin-bottom: 0px;">
						<tbody>
									<tr valign="top">
										<td class="ns_cs_fields"><strong>Select a Template</strong></td>
										<td>
											<select name="ism_ns_tmplt" id="ism_ns_tmplt">
												<option name="ns_theme1_layout" <?php if ($ns_cs_theme_opt=='ns_theme_1') echo 'selected';?> value="ns_theme_1">Blue lagoon</option>
												<option name="ns_theme2_layout" <?php if ($ns_cs_theme_opt=='ns_theme_2') echo 'selected';?> value="ns_theme_2">Olive</option>
												<option name="ns_theme3_layout" <?php if ($ns_cs_theme_opt=='ns_theme_3') echo 'selected';?> value="ns_theme_3">Tango</option>
											</select>
										</td>
									</tr>
						</tbody>
					</table>
					<div class="submit">
							<input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
					</div>
				</div>
			</div>
			<div class="stuffbox-ism">
				<h3>Subscribers List</h3>
				<div class="inside">
					<strong id="total_subs">Total subscribers: <?php echo  $ns_total_subscribers ."<br>"; ?></strong>
					<?php
					echo $ns_table_emails;
					?>
				</div>
			</div>
    </form>
  </div>
