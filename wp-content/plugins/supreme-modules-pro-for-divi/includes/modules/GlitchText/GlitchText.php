<?php

class DSM_GlitchText extends ET_Builder_Module {

	public $slug       = 'dsm_glitch_text';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://suprememodules.com/',
		'author'     => 'Supreme Modules',
		'author_uri' => 'https://suprememodules.com/',
	);

	public function init() {
		$this->name = esc_html__( 'Supreme Glitch Text', 'dsm-supreme-modules-pro-for-divi' );
		//$this->icon             = 'j';
		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'dsm-supreme-modules-pro-for-divi' ),
					'glitch_effect' => esc_html__( 'Glitch Effect', 'dsm-supreme-modules-pro-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
				),
			),
		);
	}

	public function get_advanced_fields_config() {
		return array(
			'fonts'      => array(
				'header' => array(
					'label'    => esc_html__( 'Title', 'dsm-supreme-modules-pro-for-divi' ),
					'css'      => array(
						'main' => '%%order_class%% h1.dsm-glitch-text, %%order_class%% h2.dsm-glitch-text, %%order_class%% h3.dsm-glitch-text, %%order_class%% h4.dsm-glitch-text, %%order_class%% h5.dsm-glitch-text, %%order_class%% h6.dsm-glitch-text',
					),
					'font_size' => array(
						'default'      => '30px',
					),
					'line_height'    => array(
						'default' => '1em',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
					'header_level' => array(
						'default' => 'h1',
					),
				),
			),
			'text'       => array(
				'use_text_orientation' => true,
				'use_background_layout' => true,
				'css' => array(
					'text_shadow' => '%%order_class%%',
				),
				'options' => array(
					'background_layout' => array(
						'default' => 'light',
					),
				),
			),
			'background' => array(
				'css'     => array(
					'main' => '%%order_class%% .dsm-glitch-text',
				),
			),
			'borders'               => array(
				'default' => array(
					'css' => array(
						'main' => array(
							'border_radii'  => "%%order_class%%",
							'border_styles' => "%%order_class%%",
						),
					),
				),
			),
			'box_shadow'            => array(
				'default'   => array(
					'css'   => array(
						'main' => '%%order_class%%',
					),
				),
			),
		);
	}

	public function get_fields() {
		return array(
			'glitch_text' => array(
				'label'           => esc_html__( 'Glitch Text', 'dsm-supreme-modules-pro-for-divi' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'main_content',
				'default_on_front' => 'Supreme Glitch Text',
			),
			'glitch_text_effect' => array(
				'label'           => esc_html__( 'Glitch Effect', 'dsm-supreme-modules-pro-for-divi' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'default'         => 'one',
				'options'         => array(
					'one' => esc_html__( 'Glitch One', 'dsm-supreme-modules-pro-for-divi' ),
					'two'  => esc_html__( 'Glitch Two', 'dsm-supreme-modules-pro-for-divi' ),
				),
				'toggle_slug'     => 'glitch_effect',
			),
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {
		$glitch_text_effect = $this->props['glitch_text_effect'];
		$glitch_text = $this->props['glitch_text'];
		$background_layout = $this->props['background_layout'];
		$header_level          = $this->props['header_level'];

		if ( '' !== $glitch_text ) {
			$glitch_text = sprintf( '<%1$s class="dsm-glitch-text et_pb_module_header dsm-glitch-effect-type-%3$s" data-dsm-glitch-text="%2$s">%2$s</%1$s>',
				et_pb_process_header_level( $header_level, 'h1' ),
				$glitch_text,
				esc_attr( $glitch_text_effect )
			);
		}

		$this->add_classname( array(
			$this->get_text_orientation_classname(),
			"et_pb_bg_layout_{$background_layout}"
		));

		// Render module content
		$output = sprintf(
			'%1$s',
			$glitch_text
		);

		return $output;
		//return $this->_render_module_wrapper( $output, $render_slug );
	}
}

new DSM_GlitchText;