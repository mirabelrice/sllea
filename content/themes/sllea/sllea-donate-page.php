<?php
/*
 * Template Name: Donate Page
*/
	add_action( 'genesis_before', 'remove_content' );
	add_action( 'genesis_loop', 'create_donate_page' );
	function remove_content() {
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_filter( 'genesis_markup_site-inner', '__return_null' );
		add_filter( 'genesis_markup_content-sidebar-wrap_output', '__return_false' );
		add_filter( 'genesis_markup_content', '__return_null' );
	}
	//https://www.paypal.com/cgi-bin/webscr
	//paypal@sllea.orgpaypal@sllea.org
	function create_donate_page(){ ?>
		<main>
			<div class = "wrap">
				<div class= "donate main-content">
					<form id= "sllea-make-donation" target= "paypal" action="https://www.paypal.com/cgi-bin/webscr" method= "POST">
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
						
						<div id= "form-error-display">
							<div id="form-errors">
								<span><i class="fa fa-exclamation-triangle"></i>The following error(s) occured:</span>
								<ul></ul>	
							</div>
						</div>
						<h1>Thank you for supporting Smart, Living, <br>Learning &amp Earning with Autism (SLLEA)</h1>
						<div id= "text-block">
							<?php
								$donate_statement = get_field("donate_statement");
								if($donate_statement) {
									echo '<div id= "donate-statement">'. $donate_statement .'</div>';
								} 
							?>
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
								<div id= "donation-info">
									<label class= "entry-label">Amount</label>
									<i class="fa fa-usd"></i>
									<div id= "donate-amount" class= "required">
										<input id= "entered-donate-amount" class= "donate-entry" type="number" name= "donation" min="0" step="1" pattern="[0-9]*" value="10">
										<span class= "per-month-selected">/mo</span>
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
												<input type= "text" name= "first-name">
												<p>First Name</p>
											</div>
											<div class="donate-entry last-name">
												<input type= "text" name= "last-name">
												<p>Last Name</p>
											</div>
										</div>
										<div id="email">
											<label>Email</label>
											<div class="donate-entry">
												<input type= "text" name= "email">
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
												<span id="final-donation-amount">$10.00</span>
												<span class= "per-month-selected">/mo</span>
											</div>
										</div>
										<div class= "payment-bottom donate-link medium">
											<a id= "make-donation">Donate Now</a>
										</div>
									</section>
								</fieldset>
							</div>
						</div>	
					</form>
				</div>
			</div>
		</main>
<?php }
genesis();