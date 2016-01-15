<?php
	class SlleaDonateForm {
		public $has_errors;

		function __construct() {
			add_shortcode('sllea_donate_form', array($this, 'shortcode'));
		}

		public function form($donate_fields, $form_errors) {
			$error_list_display = $this->has_errors? "block" : "none";
			ob_start(); ?>
				<form id= "sllea-make-donation" method="POST">
				<div id= "form-error-display" style="<?php echo "display:" . $error_list_display; ?>;">
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
						<div class="donate-field donate-amount">
							<label class="entry-label">Amount</label>
							<div id= "donate-amount" class= "donate-entry donation">
								<span class="ion-social-usd"></span>
								<input id= "entered-donate-amount" type="number" name= "donation" min="0" step="1" pattern="[0-9]*" value="<?php echo $donate_fields['donation']; ?>">
								<span id= "currency">USD</span>
								<p class="error-subtitle">Please Enter valid donation amount</p>
							</div>
						</div>
					</div>
				</fieldset>
				<div id="contributor-info">
					<h2>Contributor</h2>
					<div id= "contributor-wrap">
						<fieldset id= "contact-info">
							<div class= "fieldset-wrap">
								<div class="donate-field full-name">
									<label class= "entry-label">Name</label>
									<div class="donate-entry first-name">
										<input type= "text" name= "first-name" value="<?php echo $donate_fields['first-name']; ?>" pattern="[A-Za-z]">
										<p>First Name</p>
										<p class="error-subtitle">Please Enter valid first name</p>
									</div>
									<div class="donate-entry last-name">
										<input type= "text" name= "last-name" value="<?php echo $donate_fields['last-name']; ?>" pattern="[A-Za-z]">
										<p>Last Name</p>
										<p class="error-subtitle">Please Enter valid last name</p>
									</div>
								</div>
								<div class="donate-field email">
									<label class="entry-label">Email</label>
									<div class="donate-entry email">
										<input type= "email" name= "email" value="<?php echo $donate_fields['email']; ?>">
										<p class="error-subtitle">Please Enter valid email</p>
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
								<input id="make-donation" class="payment-bottom donate-link medium" type="submit" name="submit" value="donate now" />
							</section>
						</fieldset>
					</div>
				</div>
			</form><?php
			return ob_get_clean();
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
			return $this->form($donate_fields, $form_errors);
		}

		public function shortcode() {
			return $this->process_form();
		}
	}
	new SlleaDonateForm;
?>