<?php
	
// Background Color
if ( ! empty( $settings->bg_color ) && empty( $settings->bg_hover_color ) ) {
	$settings->bg_hover_color = $settings->bg_color;
}

// Old Background Gradient Setting
if ( isset( $settings->three_d ) && $settings->three_d ) {
	$settings->style = 'gradient';
}

// Background Gradient
if ( ! empty( $settings->bg_color ) ) {
	$bg_grad_start = FLBuilderColor::adjust_brightness( $settings->bg_color, 30, 'lighten' );
}
if ( ! empty( $settings->bg_hover_color ) ) {
	$bg_hover_grad_start = FLBuilderColor::adjust_brightness( $settings->bg_hover_color, 30, 'lighten' );
}

// Border Size
if ( 'transparent' == $settings->style ) {
	$border_size = $settings->border_size;
}
else {
	$border_size = 1;
}

// Border Color
if ( ! empty( $settings->bg_color ) ) {
	$border_color = FLBuilderColor::adjust_brightness( $settings->bg_color, 12, 'darken' );
}
if ( ! empty( $settings->bg_hover_color ) ) {
	$border_hover_color = FLBuilderColor::adjust_brightness( $settings->bg_hover_color, 12, 'darken' );
}

?>
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-button,
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-button:visited {

	font-size: <?php echo $settings->font_size; ?>px;
	line-height: <?php echo $settings->font_size + 2; ?>px;
	padding: <?php echo $settings->padding . 'px ' . ($settings->padding * 2) . 'px'; ?>;
	border-radius: <?php echo $settings->border_radius; ?>px;
	-moz-border-radius: <?php echo $settings->border_radius; ?>px;
	-webkit-border-radius: <?php echo $settings->border_radius; ?>px;
	
	<?php if ( 'custom' == $settings->width ) : ?>
	width: <?php echo $settings->custom_width; ?>px;
	<?php endif; ?>

	<?php if ( ! empty( $settings->bg_color ) ) : ?>
	background: #<?php echo $settings->bg_color; ?>;
	border: <?php echo $border_size; ?>px solid #<?php echo $border_color; ?>;
	
		<?php if ( 'transparent' == $settings->style ) : // Transparent ?>
		background-color: rgba(<?php echo implode( ',', FLBuilderColor::hex_to_rgb( $settings->bg_color ) ) ?>, <?php echo $settings->bg_opacity/100; ?>);
		<?php endif; ?>

		<?php if( 'gradient' == $settings->style ) : // Gradient ?>
		background: -moz-linear-gradient(top,  #<?php echo $bg_grad_start; ?> 0%, #<?php echo $settings->bg_color; ?> 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $bg_grad_start; ?>), color-stop(100%,#<?php echo $settings->bg_color; ?>)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  #<?php echo $bg_grad_start; ?> 0%,#<?php echo $settings->bg_color; ?> 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  #<?php echo $bg_grad_start; ?> 0%,#<?php echo $settings->bg_color; ?> 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  #<?php echo $bg_grad_start; ?> 0%,#<?php echo $settings->bg_color; ?> 100%); /* IE10+ */
		background: linear-gradient(to bottom,  #<?php echo $bg_grad_start; ?> 0%,#<?php echo $settings->bg_color; ?> 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $bg_grad_start; ?>', endColorstr='#<?php echo $settings->bg_color; ?>',GradientType=0 ); /* IE6-9 */
		<?php endif; ?>
	
	<?php endif; ?>
}

<?php if ( ! empty( $settings->text_color ) ) : ?>
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-button,
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-button:visited,
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-button *,
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-button:visited * {
	color: #<?php echo $settings->text_color; ?>;
}
<?php endif; ?>

<?php if ( ! empty( $settings->bg_hover_color ) ) : ?>
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-button:hover,
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-button:focus {

	background: #<?php echo $settings->bg_hover_color; ?>;
	border: <?php echo $border_size; ?>px solid #<?php echo $border_hover_color; ?>;
	
	<?php if ( 'transparent' == $settings->style ) : // Transparent ?>
	background-color: rgba(<?php echo implode( ',', FLBuilderColor::hex_to_rgb( $settings->bg_hover_color ) ) ?>, <?php echo $settings->bg_hover_opacity/100; ?>);
	border-color: #<?php echo $settings->bg_hover_color; ?>
	<?php endif; ?>

	<?php if ( 'gradient' == $settings->style ) : // Gradient ?>
	background: -moz-linear-gradient(top,  #<?php echo $bg_hover_grad_start; ?> 0%, #<?php echo $settings->bg_hover_color; ?> 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $bg_hover_grad_start; ?>), color-stop(100%,#<?php echo $settings->bg_hover_color; ?>)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #<?php echo $bg_hover_grad_start; ?> 0%,#<?php echo $settings->bg_hover_color; ?> 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #<?php echo $bg_hover_grad_start; ?> 0%,#<?php echo $settings->bg_hover_color; ?> 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #<?php echo $bg_hover_grad_start; ?> 0%,#<?php echo $settings->bg_hover_color; ?> 100%); /* IE10+ */
	background: linear-gradient(to bottom,  #<?php echo $bg_hover_grad_start; ?> 0%,#<?php echo $settings->bg_hover_color; ?> 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $bg_hover_grad_start; ?>', endColorstr='#<?php echo $settings->bg_hover_color; ?>',GradientType=0 ); /* IE6-9 */
	<?php endif; ?>
}
<?php endif; ?>

<?php if ( ! empty( $settings->text_hover_color ) ) : ?>
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-button:hover,
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-button:focus,
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-button:hover *,
.fl-builder-content .fl-node-<?php echo $id; ?> a.fl-button:focus * {
	color: #<?php echo $settings->text_hover_color; ?>;
}
<?php endif; ?>


<?php // Transition
	  if ('enable' == $settings->button_transition): ?>
.fl-builder-content .fl-node-<?php echo $id; ?> .fl-button,
.fl-builder-content .fl-node-<?php echo $id; ?> .fl-button * {
	transition: all 0.2s linear !important;
    -moz-transition: all 0.2s linear !important;
    -webkit-transition: all 0.2s linear !important;
    -o-transition: all 0.2s linear !important;
}
<?php endif; ?>

<?php if ( empty( $settings->text ) ) : ?>
<?php if ('after' == $settings->icon_position): ?>
.fl-builder-content .fl-node-<?php echo $id; ?> .fl-button i.fl-button-icon-after {
	margin-left: 0;
}
<?php endif; ?>
<?php if ('before' == $settings->icon_position): ?>
.fl-builder-content .fl-node-<?php echo $id; ?> .fl-button i.fl-button-icon-before {
	margin-right: 0;
}
<?php endif; ?>
<?php endif; ?>

<?php 

// Click action - lightbox
if ( isset($settings->click_action) && $settings->click_action == 'lightbox') :
	if ( 'html' == $settings->lightbox_content_type ) : ?>
	.fl-node-<?php echo $id; ?>.fl-button-lightbox-content {
	    background: #fff none repeat scroll 0 0;
	    margin: 20px auto;
	    max-width: 600px;
	    padding: 20px;
	    position: relative;
	    width: auto;
	}
	.fl-node-<?php echo $id; ?>.fl-button-lightbox-content .mfp-close,
	.fl-node-<?php echo $id; ?>.fl-button-lightbox-content .mfp-close:hover {
		top: -10px!important;
		right: -10px;
	}
	<?php endif; ?>

	<?php if ( 'video' == $settings->lightbox_content_type ) : ?>
	.fl-button-lightbox-wrap .mfp-content {
		background: #fff;
	}
	.fl-button-lightbox-wrap .mfp-iframe-scaler iframe {
		left: 2%;
		height: 94%;
		top: 3%;
		width: 96%;
	}
	.mfp-wrap.fl-button-lightbox-wrap .mfp-close,
	.mfp-wrap.fl-button-lightbox-wrap .mfp-close:hover {
		color: #333!important;
		right: -4px;
		top: -10px!important;
	}		
	<?php endif; ?>
	
<?php endif; ?>