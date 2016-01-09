<?php
 $team_member_rows = get_field('team_members', 183);
 $row_num = 0;

	if( $team_member_rows ) :
		foreach( $team_member_rows as $team_member) :
			$department_name = $team_member['department']->name;
       		$grouped_members[$department_name][] = $team_member;
    	endforeach; ?>
		<main class= "contact content">
			<div class="entry-content">
				<h1>Our Team</h1>
					<div class="inner-wrap">
					<?php if( !empty( $grouped_members['Board'] ) ) : ?>
						<?php foreach ( $grouped_members['Board'] as $member ):
							$wrap_class = "team-member";

							if($row_num % 2 != 0) {
								$reversed = true;
								$wrap_class .= " reversed";
							}
						?>
							<div class= "<?php echo $wrap_class; ?>">
								<?php
									$image_id = $member['picture'];
									$image = wp_get_attachment_image_src($image_id);
									echo '<img class="member-photo" src="'. $image[0] .'"/>';
								?>
								<div class= "member-text-area">
									<h2 class="name"><?php echo $member['name']; ?></h2>
									<h3 class="position"><?php echo $member['position']; ?></h3>
									<?php echo $member['bio']; ?>
								</div>
							</div>
							<?php $row_num += 1; ?>
						<?php endforeach ?>
					<?php endif; ?>
				</div>
			</div>
		</main>
	<?php endif; ?>