<main id="donate" class="content">
	<div class= "page-wrap">
		<div class = "inner-wrap">
			<h1>Thank you for supporting Smart, Living, <br>Learning &amp Earning with Autism (SLLEA)</h1>
			<div id= "text-block">
				<?php
					$donate_statement = get_field("donate_statement");
					if($donate_statement) {
						echo '<div id= "donate-statement">'. $donate_statement .'</div>';
					}
				?>
			</div>
			<?php echo do_shortcode('[sllea_donate_form]'); ?>
		</div>
	</div>
</main>