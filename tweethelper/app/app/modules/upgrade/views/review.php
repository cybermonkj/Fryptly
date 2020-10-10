<div class="min-height-200px review">
  <div class="row clearfix justify-content-md-center">
    <div class="col-md-6 col-sm-12 mt-5">
      <div class="title text-center mb-30">
        <div class="package-name">
          <h1><?=lang("Plan")?> <?=$package->name?></h1>
        </div>
        <small><?=lang("please_select_payment_gateway_to_renew_your_account")?></small>
      </div>
      <div class="card mb-30">
        <div class="card-body">
          <div class="tab">
            <ul class="nav nav-tabs customtab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#paypal" role="tab" aria-selected="true">Paypal</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#stripe" role="tab" aria-selected="false">Stripe</a>
              </li>

            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="paypal" role="tabpanel">
                <div class="pd-20">
                  <form class="actionForm" action="<?=cn($module."/process/".$package->id)?>" data-redirect="<?=cn($module."/paypal/create_payment")?>">
                    <?php 
                      if (getOption("paypal_client_id", '') != "" && getOption("paypal_client_secret", '') != "") {
                    ?>
                    <div class="form-group text-center">
                      <img src="<?=BASE?>/assets/images/paypal.svg" alt="Paypay icon">
                      <p class="p-t-10"><small><?=sprintf(lang("you_can_deposit_funds_with_paypal_they_will_be_automaticly_added_into_your_account"), 'Paypal')?></small>
                      </p>
                    </div>

                    <div class="form-group">
                      <label><?=sprintf(lang("amount_usd"), getOption("currency_code",''))?></label>
                      <input class="form-control square" name="amount" value="<?=$package->price?>" disabled>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox mb-5">
                        <input type="checkbox" class="custom-control-input " id="customCheck2" name="agree">
                        <label class="custom-control-label" for="customCheck2"><?=lang("yes_i_understand_after_the_payment_completed_i_will_not_ask_fraudulent_dispute_or_chargeback")?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn round btn-block btn-primary btn-lg"><?=lang("Submit")?></button>
                    </div>

                    <?php }else{?>
                    <div class="form-group">
                      <div class="alert alert-danger p-t-10" role="alert">
                        <?=lang("this_payment_gateway_is_not_already_active_at_the_present")?>
                      </div>
                    </div>
                    <?php }?>

                  </form>
    
                </div>
              </div>
              <div class="tab-pane fade" id="stripe" role="tabpanel">
                <div class="pd-20">
                  <form class="actionForm" action="<?=cn($module."/process/".$package->id)?>" data-redirect="<?=cn($module."/stripe_form")?>">
                    <?php 
                      if (getOption("stripe_secret_key", '') != "" && getOption("stripe_publishable_key", '') != "") {
                    ?>
                    <div class="form-group text-center">
                      <img src="<?=BASE?>/assets/images/stripe-dark.svg" alt="Stripe icon">
                      <p class="p-t-10"><small><?=sprintf(lang("you_can_deposit_funds_with_paypal_they_will_be_automaticly_added_into_your_account"), 'Stripe')?></small>
                      </p>
                    </div>

                    <div class="form-group">
                      <label><?=sprintf(lang("amount_usd"), getOption("currency_code",''))?></label>
                      <input class="form-control square" name="amount" value="<?=$package->price?>" disabled>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox mb-5">
                        <input type="checkbox" class="custom-control-input " id="customCheck1" name="agree">
                        <label class="custom-control-label" for="customCheck1"><?=lang("yes_i_understand_after_the_payment_completed_i_will_not_ask_fraudulent_dispute_or_chargeback")?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn round btn-block btn-primary btn-lg"><?=lang("Submit")?></button>
                    </div>

                    <?php }else{?>
                    <div class="form-group">
                      <div class="alert alert-danger p-t-10" role="alert">
                        <?=lang("this_payment_gateway_is_not_already_active_at_the_present")?>
                      </div>
                    </div>
                    <?php }?>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    


  </div>
</div>