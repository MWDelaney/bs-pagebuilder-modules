<?php

/**
 * @class FLCalloutModule
 */
class BSCardModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Card', 'fl-builder'),
			'description'   	=> __('Bootstrap styled heading and snippet of text with an optional link, header, and footer.', 'fl-builder'),
			'category'      	=> __('Basic Modules', 'fl-builder'),
			'partial_refresh'	=> true,
      'dir'           => FL_MODULE_BS_DIR . 'bscard/',
      'url'           => FL_MODULE_BS_URL . 'bscard/',
		));
	}

	/**
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings)
	{
		// Cache the photo data.
		if(!empty($settings->photo)) {

			$data = FLBuilderPhoto::get_attachment_data($settings->photo);

			if($data) {
				$settings->photo_data = $data;
			}
		}

		return $settings;
	}

	/**
	 * @method delete
	 */
	public function delete()
	{
		// Delete photo module cache.
		if($this->settings->image_type == 'photo' && !empty($this->settings->photo_src)) {
			$module_class = get_class(FLBuilderModel::$modules['photo']);
			$photo_module = new $module_class();
			$photo_module->settings = new stdClass();
			$photo_module->settings->photo_source = 'library';
			$photo_module->settings->photo_src = $this->settings->photo_src;
			$photo_module->settings->crop = $this->settings->photo_crop;
			$photo_module->delete();
		}
	}

	/**
	 * @method get_classname
	 */
	public function get_classname()
	{
		$classname = 'fl-card fl-card-' . $this->settings->align;

		if($this->settings->image_type == 'photo') {
			$classname .= ' fl-card-has-photo fl-card-photo-' . $this->settings->photo_position;
		}

		return $classname;
	}

	/**
	 * @method render_title
	 */
	public function render_title()
	{
  	  if(!empty($this->settings->title)) {
  		echo '<' . $this->settings->title_tag . ' class="fl-card-title card-title">';
  		echo $this->settings->title;
  		echo '</' . $this->settings->title_tag . '>';
    }
	}

	/**
	 * @method render_text
	 */
	public function render_text()
	{
		global $wp_embed;

		echo '<div class="fl-card-text">' . wpautop( $wp_embed->autoembed( $this->settings->text ) ) . '</div>';
	}

	/**
	 * @method render_button
	 */
	public function render_button()
	{
		if($this->settings->cta_type == 'button') {

			$btn_settings = array(
				'align'             => '',
				'icon'              => $this->settings->btn_icon,
				'icon_position'     => $this->settings->btn_icon_position,
				'icon_animation'	=> $this->settings->btn_icon_animation,
				'link'              => $this->settings->link,
				'link_nofollow'		=> $this->settings->link_nofollow,
				'link_target'       => $this->settings->link_target,
				'text'              => $this->settings->cta_text,
				'width'             => $this->settings->btn_width,
        'button_type'       => ($this->settings->button_type == 'other') ? $this->settings->button_type_other : $this->settings->button_type,
        'button_size'       => $this->settings->button_size,
			);

			FLBuilder::render_module_html('bsbutton', $btn_settings);
		}
	}

  /**
   * @method render_image
   */
  public function render_image($position)
  {
    if($this->settings->photo_position == $position) {

      if(empty($this->settings->photo)) {
        return;
      }

      $photo_data = FLBuilderPhoto::get_attachment_data($this->settings->photo);

      if(!$photo_data) {
        $photo_data = $this->settings->photo_data;
      }

      $photo_settings = array(
        'align'         => 'center',
        'crop'          => $this->settings->photo_crop,
        'link_target'   => $this->settings->link_target,
        'link_type'     => 'url',
        'link_url'      => $this->settings->link,
        'photo'         => $photo_data,
        'photo_src'     => $this->settings->photo_src,
        'photo_source'  => 'library'
      );

      echo '<div class="card-img-' . $this->settings->photo_position . ' fl-card-photo">';
      FLBuilder::render_module_html('photo', $photo_settings);
      echo '</div>';
    }
  }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('BSCardModule', array(
	'general'       => array(
		'title'         => __('General', 'fl-builder'),
		'sections'      => array(
			'title'         => array(
				'title'         => 'Header and Footer',
				'fields'        => array(
					'header'         => array(
						'type'          => 'text',
						'label'         => __('Header', 'fl-builder'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-card-header'
						)
					),
          'title'         => array(
						'type'          => 'text',
						'label'         => __('Title', 'fl-builder'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-card-title'
						)
					),
          'footer'         => array(
						'type'          => 'text',
						'label'         => __('Footer', 'fl-builder'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-card-footer'
						)
					)
				)
			),
			'text'          => array(
				'title'         => __('Text', 'fl-builder'),
				'fields'        => array(
					'text'          => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false,
						'wpautop'		=> false,
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-card-text'
						)
					)
				)
			)
		)
	),
	'style'         => array(
		'title'         => __('Style', 'fl-builder'),
		'sections'      => array(
			'overall_structure' => array(
				'title'         => __('Structure', 'fl-builder'),
				'fields'        => array(
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Overall Alignment', 'fl-builder'),
						'default'       => 'left',
						'options'       => array(
							'center'        => __('Center', 'fl-builder'),
							'left'          => __('Left', 'fl-builder'),
							'right'         => __('Right', 'fl-builder')
						),
						'help'          => __('The alignment that will apply to all elements within the callout.', 'fl-builder'),
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			),
      'card_style' => array(
        'title'         => __('Card Type', 'fl-builder'),
        'fields'        => array(
          'card_style'         => array(
            'type'          => 'select',
            'label'         => __('Card Style Type', 'fl-builder'),
            'default'       => 'bg-default',
            'options'       => array(
              'bg-default'        		=> __('Default', 'fl-builder'),
              'bg-primary'        		=> __('Primary', 'fl-builder'),
              'bg-secondary'         => __('Secondary', 'fl-builder'),
              'bg-info'         			=> __('Info', 'fl-builder'),
              'bg-success'         	=> __('Success', 'fl-builder'),
              'bg-warning'         	=> __('Warning', 'fl-builder'),
              'bg-danger'         		=> __('Danger', 'fl-builder'),
              'bg-light'         	=> __('Light', 'fl-builder'),
              'bg-dark'         		=> __('Dark', 'fl-builder'),
              'border-primary'				=> __('Border Primary', 'fl-builder'),
              'border-secondary'			=> __('Border Secondary', 'fl-builder'),
              'border-info'					=> __('Border Info', 'fl-builder'),
              'border-success'				=> __('Border Success', 'fl-builder'),
              'border-warning'				=> __('Border Warning', 'fl-builder'),
              'border-danger'				=> __('Border Danger', 'fl-builder'),
              'border-light'				=> __('Border Light', 'fl-builder'),
              'border-dark'				=> __('Border Dark', 'fl-builder'),
              'other'				          => __('Other', 'fl-builder')
            ),
            'toggle' 		=> array(
							'other'			=> array(
								'fields' 		=> array('card_style_other')
							)
					   )
           ),
          'card_style_other' => array(
						'type'          => 'text',
						'label'         => __('Card Style Type', 'fl-builder'),
						'default'       => __('', 'fl-builder'),
          ),
          'text_color'         => array(
            'type'          => 'select',
            'label'         => __('Card Text Color', 'fl-builder'),
            'default'       => 'bg-default',
            'options'       => array(
              'text-default'        		=> __('Default', 'fl-builder'),
              'text-white'        		=> __('White', 'fl-builder'),
              'text-primary'        		=> __('Primary', 'fl-builder'),
              'text-secondary'         => __('Secondary', 'fl-builder'),
              'text-info'         			=> __('Info', 'fl-builder'),
              'text-success'         	=> __('Success', 'fl-builder'),
              'text-warning'         	=> __('Warning', 'fl-builder'),
              'text-danger'         		=> __('Danger', 'fl-builder'),
              'text-light'         	=> __('Light', 'fl-builder'),
              'text-dark'         		=> __('Dark', 'fl-builder'),
              'other'				          => __('Other', 'fl-builder')
            ),
            'toggle' 		=> array(
							'other'			=> array(
								'fields' 		=> array('text_color_other')
							)
					   )
           ),
          'text_color_other' => array(
						'type'          => 'text',
						'label'         => __('Card Text Color', 'fl-builder'),
						'default'       => __('', 'fl-builder'),
          )
        )
      ),
			'title_structure' => array(
				'title'         => __( 'Heading Structure', 'fl-builder' ),
				'fields'        => array(
					'title_tag'     => array(
						'type'          => 'select',
						'label'         => __('Heading Tag', 'fl-builder'),
						'default'       => 'h3',
						'options'       => array(
							'h1'            => 'h1',
							'h2'            => 'h2',
							'h3'            => 'h3',
							'h4'            => 'h4',
							'h5'            => 'h5',
							'h6'            => 'h6'
						)
					)
				)
			)
		)
	),
	'image'         => array(
		'title'         => __('Image', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'image_type'    => array(
						'type'          => 'select',
						'label'         => __('Image Type', 'fl-builder'),
						'default'       => 'photo',
						'options'       => array(
							'none'          => _x( 'None', 'Image type.', 'fl-builder' ),
							'photo'         => __('Photo', 'fl-builder'),
						),
						'toggle'        => array(
							'none'          => array(),
							'photo'         => array(
								'sections'      => array('photo')
							)
						)
					)
				)
			),
			'photo'         => array(
				'title'         => __('Photo', 'fl-builder'),
				'fields'        => array(
					'photo'         => array(
						'type'          => 'photo',
						'label'         => __('Photo', 'fl-builder')
					),
					'photo_crop'    => array(
						'type'          => 'select',
						'label'         => __('Crop', 'fl-builder'),
						'default'       => '',
						'options'       => array(
							''              => _x( 'None', 'Photo Crop.', 'fl-builder' ),
							'landscape'     => __('Landscape', 'fl-builder'),
							'panorama'      => __('Panorama', 'fl-builder'),
							'portrait'      => __('Portrait', 'fl-builder'),
							'square'        => __('Square', 'fl-builder'),
							'circle'        => __('Circle', 'fl-builder')
						)
					),
					'photo_position' => array(
						'type'          => 'select',
						'label'         => __('Position', 'fl-builder'),
						'default'       => 'top',
						'options'       => array(
							'top'   => __('Top', 'fl-builder'),
							'bottom'   => __('Bottom', 'fl-builder'),
						)
					)
				)
			)
		)
	),
	'cta'           => array(
		'title'         => __('Call To Action', 'fl-builder'),
		'sections'      => array(
			'link'          => array(
				'title'         => __('Link', 'fl-builder'),
				'fields'        => array(
					'link'          => array(
						'type'          => 'link',
						'label'         => __('Link', 'fl-builder'),
						'help'          => __('The link applies to the entire module. If choosing a call to action type below, this link will also be used for the text or button.', 'fl-builder'),
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
			'cta'           => array(
				'title'         => __('Call to Action', 'fl-builder'),
				'fields'        => array(
					'cta_type'      => array(
						'type'          => 'select',
						'label'         => __('Type', 'fl-builder'),
						'default'       => 'none',
						'options'       => array(
							'none'          => _x( 'None', 'Call to action.', 'fl-builder' ),
							'button'        => __('Button', 'fl-builder')
						),
						'toggle'        => array(
							'none'          => array(),
							'link'          => array(
								'fields'        => array('cta_text')
							),
							'button'        => array(
								'fields'        => array('cta_text', 'btn_icon', 'btn_icon_position', 'btn_icon_animation', 'button_type', 'button_size'),
								'sections'      => array('btn_style', 'btn_colors', 'btn_structure')
							)
						)
					),
					'cta_text'      => array(
						'type'          => 'text',
						'label'         => __('Text', 'fl-builder'),
						'default'		=> __('Read More', 'fl-builder'),
					),
					'btn_icon'      => array(
						'type'          => 'icon',
						'label'         => __('Button Icon', 'fl-builder'),
						'show_remove'   => true
					),
					'btn_icon_position' => array(
						'type'          => 'select',
						'label'         => __('Button Icon Position', 'fl-builder'),
						'default'       => 'before',
						'options'       => array(
							'before'        => __('Before Text', 'fl-builder'),
							'after'         => __('After Text', 'fl-builder')
						)
					),
					'btn_icon_animation' => array(
						'type'          => 'select',
						'label'         => __('Icon Visibility', 'fl-builder'),
						'default'       => 'disable',
						'options'       => array(
							'disable'        => __('Always Visible', 'fl-builder'),
							'enable'         => __('Fade In On Hover', 'fl-builder')
						)
					)
				)
			),
			'btn_style'     => array(
				'title'         => __('Button Style', 'fl-builder'),
				'fields'        => array(
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
          'btn_width'     => array(
						'type'          => 'select',
						'label'         => __('Button Width', 'fl-builder'),
						'default'       => 'auto',
						'options'       => array(
							'auto'          => _x( 'Auto', 'Width.', 'fl-builder' ),
							'full'          => __('Full Width', 'fl-builder')
						)
					)
				)
			)
		)
	)
));
