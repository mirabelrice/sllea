<?php
	$background_image = get_field("background_image");
	if(!$background_image){ $background_image = get_stylesheet_directory_uri() .'/images/sitting-around-table.jpg'; }
	$text = get_field("text");
?>

<main class="content history">
	<div id= "landing" class="page-landing-image">
		<div class="image" style="background-image: url('<?php echo $background_image; ?>');"></div>
	</div>
	<div class="page-wrap landing" >
		<div class="entry-content">
			<h1>History</h1>
			<?php echo $text; ?>
		</div>
	</div>
</main>
