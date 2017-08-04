<div class="<?php echo $module->get_classname(); ?>">
	<?php

	// Image left
	$module->render_image('left');

	?>
	<div class="fl-callout-content">
    <?php

    // Image above title
    $module->render_image('above-title');

    ?>
		<div class="fl-callout-text-wrap">
      <div class="card">
        <div class="card-block">
			<?php
			// Title
			$module->render_title();

			// Image below title
			$module->render_image('below-title');

			// Text
			$module->render_text();
      ?>
      </div> <!-- /.card-block -->
    </div> <!-- /.card -->
      <?php
			// Link CTA
			$module->render_link();

			// Button CTA
			$module->render_button();

			?>
		</div>
	</div>
	<?php

	// Image right
	$module->render_image('right');

	?>
</div>
