<?php
	$logo_path = get_template_directory_uri() . '/images/LogoSLLEA.png';
	echo htmlspecialchars($imagePath);
?>

<div id="coming-soon">
	<div class="wrap">
		<div class="logo"><img src="<?php echo $logo_path; ?>"/></div>
		<h1>Coming Soon</h1>
		<h2>Subscribe to our mailing list for news and updates</h2>
		<div class="subscribe">
			<input type="text" class="email-input" value = "Enter Your Email Address"/>
			<button type="submit" class="red sign-up">Sign Up</button>
		</div>
	</div>
</div>