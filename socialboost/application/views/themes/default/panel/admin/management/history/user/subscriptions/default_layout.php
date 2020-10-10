<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row justify-content-center">
	<div class="col-sm-12">
		<div class="input-group bg-dark rounded">
			<?php
			echo form_input([
				'name' => 'searchSubscriptions',
				'class' => 'form-control searchSubscriptionsAjax bg-dark text-white border-0',
				'type' => 'text',
				'data-url' => '/subscriptions/search',
				'placeholder' => lang("placeholder_search_subscription"),
			]);
			?>

			<div class="input-group-prepend">
				<i class="fa fa-search rounded-right text-white bg-default m-t-12 mr-3"></i>
			</div>
		</div>

		<div class="tabs-wrapper mt-3">
			<ul class="nav nav-justified nav-tabs font-weight-bold fs-16">
				<li class="nav-item">
					<a class="nav-link <?=(active('subscriptions') ? active('subscriptions') : active('subscriptions/' . uri(2))); ?>" href="<?= base_url("subscriptions"); ?>">
						<i class="fa fa-list-ul"></i> <?= lang("text_status_all"); ?>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?=(active('subscriptions/type/active') ? active('subscriptions/type/active') : active('subscriptions/type/active/' . uri(4))); ?>" href="<?= base_url("subscriptions/type/active"); ?>">
						<i class="fa fa-bolt"></i> <?= lang("status_active"); ?>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?=(active('subscriptions/type/paused') ? active('subscriptions/type/paused') : active('subscriptions/type/paused/' . uri(4))); ?>" href="<?= base_url("subscriptions/type/paused"); ?>">
						<i class="fa fa-pause"></i> <?= lang("status_subs_paused"); ?>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?=(active('subscriptions/type/completed') ? active('subscriptions/type/completed') : active('subscriptions/type/completed/' . uri(4))); ?>" href="<?= base_url("subscriptions/type/completed"); ?>">
						<i class="fa fa-check"></i> <?= lang("status_completed"); ?>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?=(active('subscriptions/type/expired') ? active('subscriptions/type/expired') : active('subscriptions/type/expired/' . uri(4))); ?>" href="<?= base_url("subscriptions/type/expired"); ?>">
						<i class="fa fa-exclamation-triangle"></i> <?= lang("status_subs_expired"); ?>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?=(active('subscriptions/type/canceled') ? active('subscriptions/type/canceled') : active('subscriptions/type/canceled/' . uri(4))); ?>" href="<?= base_url("subscriptions/type/canceled"); ?>">
						<i class="fa fa-times-circle"></i> <?= lang("status_canceled"); ?>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
