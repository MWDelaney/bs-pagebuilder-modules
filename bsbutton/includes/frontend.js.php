<?php if ( isset($settings->click_action) && $settings->click_action == 'lightbox' ) : ?>
(function($){
	$('.fl-node-<?php echo $id; ?> .fl-button-lightbox').magnificPopup({
		<?php if ($settings->lightbox_content_type == 'video') : ?>
		type: 'iframe',		
		mainClass: 'fl-button-lightbox-wrap',
		<?php endif; ?>
		
		<?php if ($settings->lightbox_content_type == 'html') : ?>
		type: 'inline',
		items: {
			src: $('.fl-node-<?php echo $id; ?> .fl-button-lightbox-content')[0]
		},
		<?php endif; ?>
		closeBtnInside: true,
		tLoading: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
	});
})(jQuery);
<?php endif; ?>
	
