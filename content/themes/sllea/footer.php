<?php
	$logo_url = get_stylesheet_directory_uri() .'/images/mirbz.png';
	$contact_url = get_bloginfo('url') . '/contact-us';
	$privacy_url = get_bloginfo('url') . '/privacy-policy';
	$terms_url = get_bloginfo('url') . '/terms';
?>

<footer class = "site-footer">
	<div class= "content-wrap">
		<div class="content-inner">
			<div class="inner-row">
			  	<div class="footer-section footer-left">
			  		<div class="contact-link">Contact Us
			  			<a href="<?php echo $contact_url; ?>"></a>
			  		</div>
			  	</div>
			  	<div class="footer-section footer-center credits">
			  		<p>
			  			<span><a href="<?php echo $privacy_url; ?>">Privacy</a></span>
			  			<span> &#124; <a href="<?php echo $terms_url; ?>">Terms</a></span>
			  			<span>&#124; &copy 2015 Smart Living, Learning &amp Earning with Autism (SLLEA)</span>
			  		</p>
			  		<p>Site by: <a href="http://www.linkedin.com/in/natalia-wheeler-15474760">Natalia&amp;Mirabel</a></p>
			  	</div>
				<div class="footer-section footer-right">
			  		<ul class= "social-icons-list">
			  			<ul>
				  			<li><a href= "http://facebook.com/sllea.org"><span class="icon ion-social-facebook"></span></a></li>
				  			<li><a href= "http://twitter.com/sllea_org"><span class="icon ion-social-twitter"></span></a></li>
				  			<li><a href= "http://www.linkedin.com/in/sllea-org-8b256b105"><span class="icon ion-social-linkedin"></span></a></li>
			  			</ul>
			  		</ul>
			  	</div>
		  	</div>
	  	</div>
	  	<div class="hidden-row credits">
	  		<p>
				<span><a href="<?php echo $privacy_url; ?>">Privacy</a></span>
				<span> &#124; <a href="<?php echo $terms_url; ?>">Terms</a></span>
				<span>&#124; &copy 2015 Smart Living, Learning &amp Earning with Autism (SLLEA)</span>
			</p>
			<p>Site by: <a href="http://www.linkedin.com/in/natalia-wheeler-15474760">Natalia&amp;Mirabel</a></p>
	  	</div>
	</div>
</footer>
<?php wp_footer(); ?>
 <!-- END BODY WRAP-->
</div>
</body>