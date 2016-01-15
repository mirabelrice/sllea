<?php
	$email = get_field("email");
	$twitter = get_field("twitter");
	$facebook = get_field("facebook");
?>
	<main class="content contact">
		<div class="page-wrap">
			<div id="contact-table">
				<h1>Contact Us</h1>
				<div id="message-box" class="contact-column">
					<?php echo do_shortcode('[sllea_contact_form]'); ?>
				</div>
				<div id="contact-box" class="contact-column">
					<h4>Phone</h4>
					<div class="contact-field">555-555-5555</div>
					<h4>Email</h4>
					<div class="contact-field"><?php echo $email; ?></div>
					<h4>Social</h4>
					<ul class= "social-icons-list">
			  			<li><a href= ""><span class="icon ion-social-facebook"></span></a></li>
			  			<li><a href= ""><span class="icon ion-social-twitter"></span></a></li>
			  			<li><a href= ""><span class="icon ion-social-instagram-outline"></span></a></li>
			  		</ul>
				</div>
			</div>
		</div>
	</main>
