<?php
/*
* The template used to display the landing section of the home page
*/
?>
<?php 
	$sllea_trailer_url = get_field("sllea-trailer");
?>
<div id= "load-wrapper"></div>
<div id= "site-landing">
	<div class="overlay"></div>
	<div class="image"></div>
	<div id= "landing-content" class= "landing-animated">
		<h1>Smart Living, Learning,<br>& Earning with Autism</h1>
		<div id= "video-link" class= "landing-link">
			<a href="<?php echo $sllea_trailer_url; ?>">
				<span>WATCH THE VIDEO</span>
			</a>
		</div>
	</div>
	<div id="continue-to-site"><a href="#mission-statement"><i class="icon ion-chevron-down"/></i></a></div>
</div>