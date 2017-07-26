(function($){

	FLBuilder.registerModuleHelper('callout', {

		rules: {
			title: {
				required: false
			}
		},

		init: function()
		{
			var form        = $('.fl-builder-settings'),
				imageType   = form.find('select[name=image_type]'),
				ctaType     = form.find('select[name=cta_type]'),
				titleSize   = form.find('select[name=title_size]'),
				align       = form.find('select[name=align]');

			// Init validation events.
			this._imageTypeChanged();
			this._ctaTypeChanged();
			this._titleSizeChanged();

			// Validation events.
			imageType.on('change', this._imageTypeChanged);
			ctaType.on('change', this._ctaTypeChanged);
			titleSize.on('change', this._titleSizeChanged);

			// Preview events.
			align.on('change', this._previewAlign);

			// Button background color change
			$( 'input[name=btn_bg_color]' ).on( 'change', this._bgColorChange );
			this._bgColorChange();
		},

		_imageTypeChanged: function()
		{
			var form        = $('.fl-builder-settings'),
				imageType   = form.find('select[name=image_type]').val(),
				photo       = form.find('input[name=photo]'),
				icon       = form.find('input[name=icon]');

			photo.rules('remove');
			icon.rules('remove');

			if(imageType == 'photo') {
				photo.rules('add', { required: true });
			}
			else if(imageType == 'icon') {
				icon.rules('add', { required: true });
			}
		},

		_ctaTypeChanged: function()
		{
			var form    = $('.fl-builder-settings'),
				ctaType = form.find('select[name=cta_type]').val(),
				ctaText = form.find('input[name=cta_text]');

			ctaText.rules('remove');

			if(ctaType != 'none') {
				ctaText.rules('add', {
					required: true
				});
			}
		},

		_titleSizeChanged: function()
		{
			var form        = $('.fl-builder-settings'),
				titleSize   = form.find('select[name=title_size]').val(),
				customSize  = form.find('input[name=title_custom_size]');

			customSize.rules('remove');

			if(titleSize == 'custom') {
				customSize.rules('add', {
					number: true,
					required: true
				});
			}
		},

		_previewAlign: function()
		{
			var form   = $('.fl-builder-settings'),
				align  = form.find('select[name=align]').val(),
				wrap   = FLBuilder.preview.elements.node.find('.fl-callout');

			wrap.removeClass('fl-callout-left');
			wrap.removeClass('fl-callout-center');
			wrap.removeClass('fl-callout-right');
			wrap.addClass('fl-callout-' + align);
		},

		_bgColorChange: function()
		{
			var bgColor = $( 'input[name=btn_bg_color]' ),
				style   = $( '#fl-builder-settings-section-btn_style' );


			if ( '' == bgColor.val() ) {
				style.hide();
			}
			else {
				style.show();
			}
		}
	});

})(jQuery);
