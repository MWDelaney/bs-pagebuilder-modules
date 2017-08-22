<?php

/**
 * @class BSButtonModule
 */
class BSButtonModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Button', 'fl-builder'),
            'description'   => __('Bootstrap styled button.', 'fl-builder'),
            'category'		=> __('Basic Modules', 'fl-builder'),
            'dir'           => FL_MODULE_BS_DIR . 'bsbutton/',
            'url'           => FL_MODULE_BS_URL . 'bsbutton/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));

        /**
         * Use these methods to enqueue css and js already
         * registered or to register and enqueue your own.
         */
        // Already registered

    }


    /**
     * This method will be called by the builder
     * right before the module is deleted.
     *
     * @method delete
     */
    public function delete()
    {

    }

		/**
		 * @method enqueue_scripts
		 */
		public function enqueue_scripts()
		{
			if($this->settings && $this->settings->click_action == 'lightbox') {
				$this->add_js('jquery-magnificpopup');
				$this->add_css('jquery-magnificpopup');
			}
		}

		/**
		 * @method update
		 */
		public function update( $settings )
		{
			// Remove the old three_d setting.
			if ( isset( $settings->three_d ) ) {
				unset( $settings->three_d );
			}

			return $settings;
		}

		/**
		 * @method get_classname
		 */
		public function get_classname()
		{
			$classname = 'fl-button-wrap';

			if(!empty($this->settings->width)) {
				$classname .= ' fl-button-width-' . $this->settings->width;
			}
			if(!empty($this->settings->align)) {
				$classname .= ' fl-button-' . $this->settings->align;
			}
			if(!empty($this->settings->icon)) {
				$classname .= ' fl-button-has-icon';
			}

			return $classname;
		}

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('BSButtonModule', array(
	'general'       => array(
		'title'         => __('General', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'text'          => array(
						'type'          => 'text',
						'label'         => __('Text', 'fl-builder'),
						'default'       => __('Click Here', 'fl-builder'),
						'preview'         => array(
							'type'            => 'text',
							'selector'        => '.fl-button-text'
						)
					),
					'button_type' => array(
						'type'          => 'select',
						'label'         => __('Button Type', 'fl-builder'),
						'default'       => 'primary',
						'options'       => array(
							'primary'        		=> __('Primary', 'fl-builder'),
							'secondary'         => __('Secondary', 'fl-builder'),
							'info'         			=> __('Info', 'fl-builder'),
							'success'         	=> __('Success', 'fl-builder'),
							'warning'         	=> __('Warning', 'fl-builder'),
							'danger'         		=> __('Danger', 'fl-builder'),
							'link'         			=> __('Link Only', 'fl-builder'),
							'outline-primary'				=> __('Outline Primary', 'fl-builder'),
							'outline-secondary'			=> __('Outline Secondary', 'fl-builder'),
							'outline-info'					=> __('Outline Info', 'fl-builder'),
							'outline-success'				=> __('Outline Success', 'fl-builder'),
							'outline-warning'				=> __('Outline Warning', 'fl-builder'),
							'outline-danger'				=> __('Outline Danger', 'fl-builder'),
              'other'				          => __('Other', 'fl-builder')
						),
            'toggle' 		=> array(
							'other'			=> array(
								'fields' 		=> array('button_type_other')
							)
					   )
           ),
          'button_type_other' => array(
						'type'          => 'text',
						'label'         => __('Button Type', 'fl-builder'),
						'default'       => __('', 'fl-builder'),
					),
					'button_size' => array(
						'type'          => 'select',
						'label'         => __('Button Size', 'fl-builder'),
						'default'       => 'normal',
						'options'       => array(
							'normal'        => __('Normal', 'fl-builder'),
							'lg'         => __('Large', 'fl-builder'),
							'sm'         => __('Small', 'fl-builder')
						)
					),
					'icon'          => array(
						'type'          => 'icon',
						'label'         => __('Icon', 'fl-builder'),
						'show_remove'   => true
					),
					'icon_position' => array(
						'type'          => 'select',
						'label'         => __('Icon Position', 'fl-builder'),
						'default'       => 'before',
						'options'       => array(
							'before'        => __('Before Text', 'fl-builder'),
							'after'         => __('After Text', 'fl-builder')
						)
					),
					'icon_animation' => array(
						'type'          => 'select',
						'label'         => __('Icon Visibility', 'fl-builder'),
						'default'       => 'disable',
						'options'       => array(
							'disable'        => __('Always Visible', 'fl-builder'),
							'enable'         => __('Fade In On Hover', 'fl-builder')
						)
					),
					'click_action' => array(
						'type' 			=> 'select',
						'label'         => __('Click Action', 'fl-builder'),
						'default' 		=> 'link',
						'options' 		=> array(
							'link' 			=> __('Link', 'fl-builder'),
							'lightbox' 		=> __('Lightbox', 'fl-builder')
						),
						'toggle'  => array(
							'link'		=> array(
								'sections' => array('link')
							),
							'lightbox'	=> array(
								'sections' => array('lightbox')
							)
						)
					)
				)
			),
			'link'          => array(
				'title'         => __('Link', 'fl-builder'),
				'fields'        => array(
					'link'          => array(
						'type'          => 'link',
						'label'         => __('Link', 'fl-builder'),
						'placeholder'   => __( 'http://www.example.com', 'fl-builder' ),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'link_target'   => array(
						'type'          => 'select',
						'label'         => __('Link Target', 'fl-builder'),
						'default'       => '_self',
						'options'       => array(
							'_self'         => __('Same Window', 'fl-builder'),
							'_blank'        => __('New Window', 'fl-builder')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'link_nofollow'          => array(
						'type'          => 'select',
						'label'         => __('Link No Follow', 'fl-builder'),
						'default'       => 'no',
						'options' 		=> array(
							'yes' 			=> __('Yes', 'fl-builder'),
							'no' 			=> __('No', 'fl-builder'),
						),
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			),
			'lightbox'	=> array(
				'title'		=> __('Lightbox Content', 'fl-builder'),
				'fields'        => array(
					'lightbox_content_type' => array(
						'type' 				=> 'select',
						'label' 			=> __('Content Type', 'fl-builder'),
						'default' 			=> 'html',
						'options' 			=> array(
							'html' 				=> __('HTML', 'fl-builder'),
							'video' 			=> __('Video', 'fl-builder')
						),
						'preview'       	=> array(
							'type'          	=> 'none'
						),
						'toggle' 		=> array(
							'html'			=> array(
								'fields' 		=> array('lightbox_content_html')
							),
							'video'			=> array(
								'fields' 		=> array('lightbox_video_link')
							)
						)
					),
					'lightbox_content_html'	=> array(
						'type'          		=> 'code',
						'editor'        		=> 'html',
						'label'         		=> '',
						'rows'          		=> '19',
						'preview'       		=> array(
							'type'          		=> 'none'
						)
					),
					'lightbox_video_link' => array(
						'type'          => 'text',
						'label'         => __('Video Link', 'fl-builder'),
						'placeholder'   => 'https://vimeo.com/122546221',
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			)
		)
	),
	'style'         => array(
		'title'         => __('Style', 'fl-builder'),
		'sections'      => array(
			'colors'        => array(
				'title'         => __('Colors', 'fl-builder'),
				'fields'        => array(
					'bg_color'      => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'fl-builder'),
						'default'       => '',
						'show_reset'    => true
					),
					'bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Background Hover Color', 'fl-builder'),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'text_color'    => array(
						'type'          => 'color',
						'label'         => __('Text Color', 'fl-builder'),
						'default'       => '',
						'show_reset'    => true
					),
					'text_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Text Hover Color', 'fl-builder'),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			),
			'style'         => array(
				'title'         => __('Style', 'fl-builder'),
				'fields'        => array(
					'style'         => array(
						'type'          => 'select',
						'label'         => __('Style', 'fl-builder'),
						'default'       => 'flat',
						'options'       => array(
							'flat'          => __('Flat', 'fl-builder'),
							'gradient'      => __('Gradient', 'fl-builder'),
							'transparent'   => __('Transparent', 'fl-builder')
						),
						'toggle'        => array(
							'transparent'   => array(
								'fields'        => array('bg_opacity', 'bg_hover_opacity', 'border_size')
							)
						)
					),
					'border_size'   => array(
						'type'          => 'text',
						'label'         => __('Border Size', 'fl-builder'),
						'default'       => '2',
						'description'   => 'px',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					),
					'bg_opacity'    => array(
						'type'          => 'text',
						'label'         => __('Background Opacity', 'fl-builder'),
						'default'       => '0',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					),
					'bg_hover_opacity'    => array(
						'type'          => 'text',
						'label'         => __('Background Hover Opacity', 'fl-builder'),
						'default'       => '0',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					),
					'button_transition'         => array(
						'type'          => 'select',
						'label'         => __('Transition', 'fl-builder'),
						'default'       => 'disable',
						'options'       => array(
							'disable'        => __('Disabled', 'fl-builder'),
							'enable'         => __('Enabled', 'fl-builder')
						)
					)
				)
			),
			'formatting'    => array(
				'title'         => __('Structure', 'fl-builder'),
				'fields'        => array(
					'width'         => array(
						'type'          => 'select',
						'label'         => __('Width', 'fl-builder'),
						'default'       => 'auto',
						'options'       => array(
							'auto'          => _x( 'Auto', 'Width.', 'fl-builder' ),
							'full'          => __('Full Width', 'fl-builder'),
							'custom'        => __('Custom', 'fl-builder')
						),
						'toggle'        => array(
							'auto'          => array(
								'fields'        => array('align')
							),
							'full'          => array(),
							'custom'        => array(
								'fields'        => array('align', 'custom_width')
							)
						)
					),
					'custom_width'  => array(
						'type'          => 'text',
						'label'         => __('Custom Width', 'fl-builder'),
						'default'       => '200',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'fl-builder'),
						'default'       => 'left',
						'options'       => array(
							'center'        => __('Center', 'fl-builder'),
							'left'          => __('Left', 'fl-builder'),
							'right'         => __('Right', 'fl-builder')
						)
					),
					'font_size'     => array(
						'type'          => 'text',
						'label'         => __('Font Size', 'fl-builder'),
						'default'       => '16',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'padding'       => array(
						'type'          => 'text',
						'label'         => __('Padding', 'fl-builder'),
						'default'       => '12',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'border_radius' => array(
						'type'          => 'text',
						'label'         => __('Round Corners', 'fl-builder'),
						'default'       => '4',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					)
				)
			)
		)
	)
));
