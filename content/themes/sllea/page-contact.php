<?php get_header();
 $team_member_rows = get_field('team_members', 183);

		if( $team_member_rows ) :	
			foreach( $team_member_rows as $team_member) :
				$department_name = $team_member['department']->name;
           		$grouped_members[$department_name][] = $team_member;
        	endforeach; ?>
			<div class= "contact main-content">
				<div class = "wrap">	
					<h1>Our Team</h1>
					<?php if( !empty( $grouped_members['Board'] ) ) : ?>
						<div id= "board-bios" class= "bio-section">
							<h2>Board</h2>
							<?php create_department_profiles($grouped_members, 'Board'); ?> 
						</div>
					<?php endif; 
					if( !empty( $grouped_members['Creative'] ) ) : ?>
						<div id="creative-bios" class= "bio-section">
							<h2>Creative Department</h2>
							<?php create_department_profiles($grouped_members, 'Creative'); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
	<?php endif;

	function create_department_profiles($array, $department_name ) {
	    	foreach( $array[$department_name] as $member ) : ?>
				<div class= "team-member">
					<div class= "team-member-wrap">
						<div class= "member-image-area">
						<?php 
							$image_id = $member['picture'];
							$image = wp_get_attachment_image_src($image_id);
							echo '<img src="'. $image[0] .'"/>';
						?>
						</div>
						<div class= "member-text-area">
							<h2><?php echo $member['name']; ?></h2>
							<h3><?php echo $member['position']; ?></h3>	
							<?php echo $member['bio']; ?> 
						</div>
					</div>
				</div>
			<?php endforeach;

	}
 get_footer(); ?>