<?php if ( 'custom' == $settings->title_size ) : ?>
.fl-builder-content .fl-node-<?php echo $id; ?> .fl-cta-title {
	font-size: <?php echo $settings->title_custom_size; ?>px;
}
<?php endif; ?>
<?php if ( ! empty( $settings->text_color ) ) : ?>
.fl-node-<?php echo $id; ?> {
	color: #<?php echo $settings->text_color; ?>;
}
.fl-node-<?php echo $id; ?> * {
	color: #<?php echo $settings->text_color; ?>;
}
<?php endif; ?>
<?php if ( ! empty( $settings->bg_color ) ) : ?>
.fl-node-<?php echo $id; ?> .fl-module-content {
	background-color: #<?php echo $settings->bg_color; ?>;
	background-color: rgba(<?php echo implode( ',', FLBuilderColor::hex_to_rgb( $settings->bg_color ) ) ?>, <?php echo $settings->bg_opacity / 100; ?>);
}
<?php endif; ?>
<?php if ( is_numeric( $settings->spacing ) ) : ?>
.fl-node-<?php echo $id; ?> .fl-module-content {
	padding: <?php echo $settings->spacing; ?>px;
}
<?php endif; ?>
<?php

FLBuilder::render_module_css('button', $id, array(
	'align'             => '',
	'bg_color'          => $settings->btn_bg_color,
	'bg_hover_color'    => $settings->btn_bg_hover_color,
	'bg_opacity'        => $settings->btn_bg_opacity,
	'bg_hover_opacity'  => $settings->btn_bg_hover_opacity,
	'button_transition' => $settings->btn_button_transition,
	'border_radius'     => $settings->btn_border_radius,
	'border_size'       => $settings->btn_border_size,
	'font_size'         => $settings->btn_font_size,
	'icon'              => $settings->btn_icon,
	'icon_position'		=> $settings->btn_icon_position,
	'link'              => $settings->btn_link,
	'link_target'       => $settings->btn_link_target,
	'padding'           => $settings->btn_padding,
	'style'             => ( isset( $settings->btn_3d ) && $settings->btn_3d ) ? 'gradient' : $settings->btn_style,
	'text'              => $settings->btn_text,
	'text_color'        => $settings->btn_text_color,
	'text_hover_color'  => $settings->btn_text_hover_color,
	'width'             => 'stacked' == $settings->layout ? 'auto' : 'full',
));
