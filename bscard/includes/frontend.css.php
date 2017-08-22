<?php

if($settings->cta_type == 'button') {
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
		'icon_position'     => $settings->btn_icon_position,
		'link'              => $settings->link,
		'link_target'       => $settings->link_target,
		'padding'           => $settings->btn_padding,
		'style'             => ( isset( $settings->btn_3d ) && $settings->btn_3d ) ? 'gradient' : $settings->btn_style,
		'text'              => $settings->cta_text,
		'text_color'        => $settings->btn_text_color,
		'text_hover_color'  => $settings->btn_text_hover_color,
		'width'             => $settings->btn_width
	));
}

if($settings->image_type == 'icon') {
	FLBuilder::render_module_css('icon', $id, array(
		'align'          => '',
		'bg_color'       => $settings->icon_bg_color,
		'bg_hover_color' => $settings->icon_bg_hover_color,
		'color'          => $settings->icon_color,
		'hover_color'    => $settings->icon_hover_color,
		'icon'           => $settings->icon,
		'link'           => $settings->link,
		'link_target'    => $settings->link_target,
		'size'           => $settings->icon_size,
		'text'           => '',
		'three_d'        => $settings->icon_3d
	));
}

?>
<?php if($settings->title_size == 'custom') : ?>
.fl-builder-content .fl-node-<?php echo $id; ?> .fl-callout-title {
	font-size: <?php echo $settings->title_custom_size; ?>px;
	line-height: <?php echo $settings->title_custom_size; ?>px;
}
<?php endif; ?>