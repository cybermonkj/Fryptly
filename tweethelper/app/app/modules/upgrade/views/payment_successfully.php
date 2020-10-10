<div class="min-height-200px">
  <div class="row clearfix justify-content-md-center">
    <div class="col-md-5 mt-5">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h3 class="m-t-10"><i class="fa fa-check-circle text-blue"></i> <?=lang("payment_sucessfully")?></h3>
        </div>
        <div class="card-body">

          <?php if(!empty($transaction) && $transaction->type == 'paypal'){?>
          <div class="for-group text-center">
            <img src="<?=BASE?>/assets/images/paypal.svg" alt="Paypay icon">
          </div>
          <?php }?>

          <?php if(!empty($transaction) && $transaction->type == 'stripe'){?>
          <div class="for-group text-center">
            <img src="<?=BASE?>/assets/images/stripe-dark.svg" alt="Stripe icon">
          </div>
          <?php }?>

          <div class="detail">
            <p class="mt-3"><?=lang("your_payment_has_been_processed_here_are_the_details_of_this_transaction_for_your_reference")?></p>
            <ul>
              <li><?=lang("Transaction_ID")?>: <span class="h5"><?=(!empty($transaction)) ? $transaction->transaction_id : ''?></span></li>
              <li><?=lang("Amount_Paid")?>:    <span class="h5"><?=(!empty($transaction)) ? $transaction->amount : ''?> <?=getOption("currency_code", "")?></span> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>