(function($){

	FLBuilder.registerModuleHelper('button', {

		rules: {
			link: {
				required: true
			},
			border_size: {
				required: true,
				number: true
			},
			bg_opacity: {
				required: true,
				number: true
			},
			font_size: {
				required: true,
				number: true
			},
			padding: {
				required: true,
				number: true
			},
			border_radius: {
				required: true,
				number: true
			}
		},
		
		init: function()
		{
			$( 'input[name=bg_color]' ).on( 'change', this._bgColorChange );			
			this._bgColorChange();

			$( 'select[name=click_action]' ).on( 'change', this._clickActionChange );			
			this._clickActionChange();

			$( 'select[name=lightbox_content_type]' ).on( 'change', this._contentTypeChange );			
			this._contentTypeChange();

		},
		
		_bgColorChange: function()
		{
			var bgColor = $( 'input[name=bg_color]' ),
				style   = $( '#fl-builder-settings-section-style' );
			
			if ( '' == bgColor.val() ) {
				style.hide();
			}
			else {
				style.show();
			}
		},

		_clickActionChange: function()
		{
			var clickAction = $( 'select[name=click_action]' ).val(),
				link 		= $( 'input[name=link]' );				

			if ( clickAction == 'link' ) {
				link.rules('add', {
					required: true
				});
			}
			else {
				link.rules('remove');
			}
		},

		_contentTypeChange: function()
		{
			var contentType 	= $( 'select[name=lightbox_content_type]' ).val(),
				fieldCode 		= $( '.fl-code-field' ),
				activeEditor 	= fieldCode.find('.ace_editor'),
				editor 			= ace.edit(activeEditor[0]);
			
			/**
			 * Fix for initializing hidden Ace editor
			 */
			if (contentType == 'html') {
				editor.resize();
				editor.renderer.updateFull();
			}
		}
	});

})(jQuery);