<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="w-75 container-fluid padding_top">
	<div class="row justify-content-center">
		<div class="col-sm-12 mt-3">
			<div class="section_tittle text-center" data-aos="fade-up">
				<p><?= lang("system_information"); ?></p>
				<h2><?= lang("menu_about"); ?></h2>
			</div>

			<div class="row d-flex justify-content-center">
				<div class="col-sm-3">
					<?= form_open('/admin/about/update', ['id' => 'check-update']); ?>
					<div class="form-group mx-auto">
						<div class="alert alert-danger alert-dismissible rounded error mt-2" style="display:none;" role="alert">
							<i class="fa fa-exclamation-triangle"></i> <span class="error-message"></span>
							<a class="close cursor-pointer" aria-label="close">&times;</a>
						</div> <!-- Alert error -->

						<div class="alert alert-success alert-dismissible rounded success mt-2" style="display:none;" role="alert">
							<i class="fa fa-thumbs-up"></i> <span class="success-message"></span>
							<a class="close cursor-pointer" aria-label="close">&times;</a>
						</div> <!-- Alert success -->

						<div class="card shadow-sm p-4">
							<?= lang("check_for_update_message"); ?><br><br>

							<?php if (verify_update_boostpanel()) : ?>
								<div class="bg-info p-1 text-white rounded mb-2 text-center"><?= lang("message_new_update_boostpanel"); ?></div>
								<button type="submit" id="btnCheckUpdate" class="genric-btn info-green e-large btn-block radius fs-16 <?= (DEMO_VERSION == FALSE ? '' : 'disabled') ?>"><?= lang("button_check_for_update"); ?></button>
							<?php else : ?>
								<div class="bg-danger p-1 text-white rounded mb-2 text-center"><?= lang("no_exists_update_boostpanel"); ?></div>
							<?php endif; ?>

							<div class="mt-4 text-center">
								<strong><?= lang("version"); ?>:</strong> <?= $version['version']; ?>
							</div>
						</div>
					</div>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('#check-update').on('submit', function(e) {
		e.preventDefault();
		$("#btnCheckUpdate").html("<?= lang("checking_for_updates"); ?> ...").attr("disabled", 'disabled');
		axios.post(this.action, $(this).serialize()).then(function(response) {
			if (response.data.type == 'error') {
				$("#btnCheckUpdate").html("<?= lang("button_check_for_update"); ?>").removeAttr("disabled");
				$('.success').attr('style', 'display:none;');
				$('.error').attr('style', 'display:block;');
				$('.error-message').html(response.data.message);
			} else if (response.data.type == 'success') {
				$('.error').attr('style', 'display:none;');
				$('.success').attr('style', 'display:block;');
				$('.success-message').html(response.data.message);
			}
			$("#btnCheckUpdate").html("<?= lang("button_check_for_update"); ?>").removeAttr("disabled");
		});
	});
</script>
