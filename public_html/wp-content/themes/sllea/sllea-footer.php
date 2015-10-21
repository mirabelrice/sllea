<?php
	remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
	remove_action( 'genesis_footer', 'genesis_do_footer' );
	remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
	add_action( 'genesis_footer', 'sllea_footer');
	//add_action('genesis_after_footer', function(){
		//echo '</div>';
	//});
	function sllea_footer() { 
		if( !(is_page(20)) ){ ?>
		<footer class = "site-footer">
			<div class= "wrap">
				<div class="footer-section footer-left">
					<div id = "footer-logo">
						<div class= "sllea-type-logo gray">SLLEA</div>
					</div>
				</div>		
				<div class="footer-section footer-center">
			  		<ul class= "social-icons-list">
			  			<ul>
				  			<li><a href= ""><span class="icon ion-social-facebook"></span></a></li>
				  			<li><a href= ""><span class="icon ion-social-twitter"></span></a></li>
				  			<li><a href= ""><span class="icon ion-social-instagram-outline"></span></a></li>
				  			<li><a href= ""><span class=" icon ion-social-linkedin"></span></a></li>
			  			</ul>
			  		</ul>
			  	</div>
			  	<div class="footer-section footer-right">
			  		<div id="sllea-mail-list">
			  			<div id= "mail-signup-link">
				  			<p>Join Our Mailing List</p>
				  			<span id= "mail-signup-action" class="icon ion-ios-arrow-down"></span>
			  			</div>
				  		<div id= "mail-signup-form">
				  			<form action="" method="POST" id="mail-subscribe-form" class="validate">
				  				<label for="first-name">First Name</label>
				  				<input type="text" name="first-name">
				  				<label for="last-name">Last Name</label>
				  				<input type="text" name="last-name">
				  				<label for="email-address">Email Address</label>
				  				<input type="text" name="email-address">
				  				<input type= "submit" name= "subscribe" value= "submit">		
				  			</form>
				  		</div>
			  		</div>
			  	</div>
			  	<!--
			  	<div class="footer-level bottom">
			  		<h4>Address or phone number</h4>
			  	</div>
			  	-->
			</div>
		</footer>
	<?php }
    }