<?php
	function our_model_section_image($image) {
		ob_start(); ?>
			<div class="content-column image">
				<div class="image-wrap" style="background-image:url(http://sllea.local:8888/wp-content/uploads/2015/06/DSC_1795.jpg);"></div>
			</div>
		<?php $html = ob_get_clean();
		return $html;
	}

	function our_model_section_text($headline, $text) {
		ob_start(); ?>
		<div class="content-column text">
			<div class="text-wrap">
				<h2><?php echo $headline; ?></h2>
				<?php echo $text; ?>
			</div>
		</div>
		<?php $html = ob_get_clean();
		return $html;
	}

	function meet_the_team_image($member) {
		$image_id = $member['picture'];
		$image = wp_get_attachment_image_src($image_id);
		$html = '<img class="member-photo" src="'. $image[0] .'"/>';
		return $html;
	}

	function meet_the_team_text($member) {
		ob_start(); ?>
		<div class= "member-text-area">
			<h2 class="name"><?php echo $member['name']; ?></h2>
			<h3 class="position"><?php echo $member['position']; ?></h3>
			<?php echo $member['bio']; ?>
		</div>
		<?php $html = ob_get_clean();
		return $html;
	}

?>