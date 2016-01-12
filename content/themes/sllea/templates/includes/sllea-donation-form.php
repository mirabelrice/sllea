<?php
	class SlleaDonateForm {
		public $has_errors;

		function __construct() {
			add_shortcode('sllea_donate_form', array($this, 'shortcode'));
		}

		public function form($donate_fields, $form_errors) {
			ob_start(); ?>
				<form id= "sllea-make-donation" method="POST">
				<input type="hidden" name="cmd" value="_donations">
				<input type="hidden" name="business" value="paypal@sllea.org">
				<input type="hidden" name="item_type" value="donation">
				<input type="hidden" name="amount" value="">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="no_shipping" value="0">
				<input type="hidden" name="no_note" value="1">
				<input type="hidden" name="return" value="<?php echo WP_SITEURL; ?>/donate">
				<input type="hidden" name="cancel_return" value="<?php echo WP_SITEURL; ?>/donate">
				<input type="hidden" name="first_name" value="">
				<input type="hidden" name="last_name" value="">
				<?php if( $this->has_errors ) : ?>
					<div id= "form-error-display">
						<div id="form-errors">
							<span><i class="fa fa-exclamation-triangle"></i>The following error(s) occured:</span>
							<ul>
								<li class="error donation"><?php echo $form_errors['donation']; ?></li>
								<li class="error first-name"><?php echo $form_errors['first-name']; ?></li>
								<li class="error last-name"><?php echo $form_errors['last-name']; ?></li>
								<li class="error email"><?php echo $form_errors['email']; ?></li>
							</ul>
						</div>
					</div>
				<?php endif; ?>
				<fieldset id= "select-donate-amount">
					<legend>
						<h2>Make a Donation</h2>
					</legend>
					<section id= "donation-amount-entry">
						<ul id= "donation-suggestions">
							<li class= "donate-option"><div class="circle-wrap"><a data-amount= "10">$10</a></div></li>
							<li class= "donate-option"><div class="circle-wrap"><a data-amount= "50">$50</a></div></li>
							<li class= "donate-option"><div class="circle-wrap"><a data-amount= "75">$75</a></div></li>
							<li class= "donate-option"><div class="circle-wrap"><a data-amount= "100">$100</a></div></li>
							<li class= "donate-option"><div class="circle-wrap"><a data-amount= "1000">$1000</a></div></li>
							<li class= "donate-option"><div class="circle-wrap"><a data-amount= "Other">Other</a></div></li>
						</ul>
					</section>
					<div class= "fieldset-wrap">
						<div id= "donation-info">
							<label class= "entry-label">Amount</label>
							<i class="fa fa-usd"></i>
							<div id= "donate-amount" class= "required">
								<input id= "entered-donate-amount" class= "donate-entry" type="number" name= "donation" min="0" step="1" pattern="[0-9]*" value="<?php echo $donate_fields['donation']; ?>">
								<span id= "currency">USD</span>
							</div>
						</div>
					</div>
				</fieldset>
				<div id="contributor-info">
					<h2>Contributor</h2>
					<div id= "contributor-wrap">
						<fieldset id= "contact-info">
							<div class= "fieldset-wrap">
								<div class="full-name">
									<label>Name</label>
									<div class="donate-entry first-name">
										<input type= "text" name= "first-name" value="<?php echo $donate_fields['first-name']; ?>">
										<p>First Name</p>
									</div>
									<div class="donate-entry last-name">
										<input type= "text" name= "last-name" value="<?php echo $donate_fields['last-name']; ?>">
										<p>Last Name</p>
									</div>
								</div>
								<div id="email">
									<label>Email</label>
									<div class="donate-entry">
										<input type= "text" name= "email" value="<?php echo $donate_fields['email']; ?>">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset id="payment-info">
							<legend><h2>Payment Information</h2></legend>
							<section>
								<div id="donation-summary" class= "payment-bottom">
									<p>Amount:</p>
									<div id= "amount-due">
										<span id="final-donation-amount"><?php echo "$" . $donate_fields['donation']; ?></span>
									</div>
								</div>
								<input class="payment-bottom donate-link medium" type="submit" name="submit" value="donate now" />
							</section>
						</fieldset>
					</div>
				</div>
			</form>
			<?php return ob_get_clean();
		}

		public function process_form() {
			$donate_fields = array();
			$form_errors = array();

			if(isset($_SESSION['donation_fields'])) {
				$donate_fields = $_SESSION['donation_fields'];
			}

			if(isset($_SESSION['form_errors'])) {
				$form_errors = $_SESSION['form_errors'];
			}

			if(isset($_SESSION['has_errors'])) {
				$this->has_errors = $_SESSION['has_errors'];
			} else {
				$donate_fields['donation'] = 10;
			}



/*
			if(isset($_POST['submit'])) {
				if(count(array_filter($form_errors, 'strlen')) === 0) {
					$this->has_errors = false;
					$_SESSION['redirect_to_paypal'] = true;
				} else{
					$this->has_errors = true;
				}
*/
			return $this->form($donate_fields, $form_errors);
		}

		public function shortcode() {
			return $this->process_form();
		}
	}
	new SlleaDonateForm;
?>