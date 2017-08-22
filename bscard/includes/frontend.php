<div class="<?php echo $module->get_classname(); ?>">
  <div class="
  card
  <?php echo ($settings->card_style == "other") ? "bg-" . $settings->card_style_other : $settings->card_style; ?>
  <?php echo ($settings->text_color == "other") ? "text-" . $settings->text_color_other : $settings->text_color; ?>
  text-<?php echo $settings->align; ?>
  fl-card-content">

  <?php if($settings->header): ?>
    <div class="card-header fl-card-header">
      <?php echo $settings->header; ?>
    </div>
  <?php endif; ?>

    <?php $module->render_image('top'); ?>

    <div class="card-body fl-card-text-wrap">
    	<?php
    	// Title
    	$module->render_title();

    	// Text
    	$module->render_text();

    	// Button CTA
    	$module->render_button();

    	?>
    </div> <!-- /.card-body -->

    <?php $module->render_image('bottom'); ?>

    <?php if($settings->footer): ?>
      <div class="card-footer fl-card-footer">
        <?php echo $settings->footer; ?>
      </div>
    <?php endif; ?>

  </div> <!-- /.card -->
</div>
