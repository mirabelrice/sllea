<?php
/*
* The template used to display the landing section of the home page
*/
?>

<div id= "load-wrapper"></div>
<div id= "site-landing">
	<div class="overlay"></div>
	<div class="image"></div>
	<div class= "logo landing-animated">
		<img src= "<?php
			$imagePath = get_stylesheet_directory_uri() .'/images/logo1.png';
			echo htmlspecialchars($imagePath);
		?>"/>
	</div>
	<div id= "landing-content" class= "landing-animated">
		<h1>Smart Living, Learning,<br>& Earning with Autism</h1>
		<div id= "video-link" class= "landing-link">
			<span>WATCH THE VIDEO</span>
		</div>
	</div>
	<div id="continue-to-site"><a href="#mission-statement"><i class="icon ion-chevron-down"/></i></a></div>
	<div id= "trailer-window">
		<div id="video-container">
			<a id= "close-window"><i class= "icon ion-close"></i></a>
			<div class= "sllea-trailer">
				<?php 
					$sllea_trailer_url = get_field("sllea-trailer");
					echo $sllea_trailer_url;
				//echo '<iframe src="http://vimeo.com/133109508&amp;title=0&amp;byline=0&amp;portrait=0" width="1000" height="565" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
				?>
			</div>
		</div>
	</div>
</div>