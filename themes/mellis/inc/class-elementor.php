<?php

class Mellis_Elementor {
	
	function __construct() {
            
		// Register Header Footer Category in Pane
	    add_action( 'elementor/elements/categories_registered', array( $this, 'mellis_add_category' ) );

	    add_action( 'elementor/frontend/after_register_scripts', array( $this, 'mellis_enqueue_scripts' ) );
		
		add_action( 'elementor/widgets/register', array( $this, 'mellis_include_widgets' ) );
		
		add_filter( 'elementor/controls/animations/additional_animations', array( $this, 'mellis_add_animations'), 10 , 0 );

		add_action( 'wp_print_footer_scripts', array( $this, 'mellis_enqueue_footer_scripts' ) );

		// load icons
		add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'mellis_icons_filters_new' ), 9999999, 1 );

		//Add customize icon 
		add_action( 'elementor/element/icon/section_style_icon/after_section_end', array( $this, 'mellis_icon_custom' ), 10, 2 );

		//Add icons social customize
		add_action( 'elementor/element/social-icons/section_social_hover/after_section_end', array( $this, 'mellis_social_icons_custom' ), 10, 2 );

		//Add Icon Box customize
		add_action( 'elementor/element/icon-box/section_style_content/after_section_end', array( $this, 'mellis_icon_box_customize' ), 10, 2 );

		//Add Accordion custom control styles
		add_action( 'elementor/element/accordion/section_toggle_style_content/after_section_end', array( $this, 'mellis_accordion_custom' ), 10, 2 );

		//Add Text editor custom  control style
		add_action( 'elementor/element/text-editor/section_style/after_section_end', array( $this, 'mellis_text_editor_custom' ), 10, 2 );	
	}


	// Ova accordion custom 
    function mellis_accordion_custom( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_accordion',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Accordion', 'mellis' ),
			]
		);

		    $element->add_responsive_control(
				'accordion_content_title',
				[
					'label' 		=> esc_html__( 'Title', 'mellis' ),
					'type' 			=> \Elementor\Controls_Manager::HEADING,
				]
			);

				$element->add_responsive_control(
					'accordion_title_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'mellis' ),
						'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em' ],
						'selectors' 	=> [
						'{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$element->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'accordion_title_border',
						'label' => esc_html__( 'Border', 'mellis' ),
						'selector' => '{{WRAPPER}} .elementor-accordion .elementor-accordion-item:not(:first-child) .elementor-tab-title',
					]
				);		   

			$element->add_responsive_control(
				'accordion_content_heading',
				[
					'label' 		=> esc_html__( 'Content', 'mellis' ),
					'type' 			=> \Elementor\Controls_Manager::HEADING,
				]
			);

				$element->add_responsive_control(
					'accordion_content_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'mellis' ),
						'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em' ],
						'selectors' 	=> [
						'{{WRAPPER}} .elementor-accordion .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$element->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'accordion_content_border',
						'label' => esc_html__( 'Border', 'mellis' ),
						'selector' => '{{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-content',
					]
				);

			$element->add_responsive_control(
				'accordion_icon_heading',
				[
					'label' 		=> esc_html__( 'Icon', 'mellis' ),
					'type' 			=> \Elementor\Controls_Manager::HEADING,
				]
			);
			
				$element->add_responsive_control(
					'accordion_icon_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'mellis' ),
						'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em' ],
						'selectors' 	=> [
						'{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$element->add_control(
				'accordion_icon_size',
				[
					'label' => esc_html__( 'Size ', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 5,
							'max' => 20,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon' => 'font-size: {{SIZE}}{{UNIT}};',	
					],
				]
			);
			

		$element->end_controls_section();
	}  
	
	function mellis_icon_box_customize($element, $args) {

		$element->start_controls_section(
			'ova_icon_box_customize',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Icon Box', 'mellis' ),
			]
		);

			$element->add_responsive_control(
				'ova_icon_box_margin_title',
				[
					'label' => esc_html__( 'Margin Title', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			

		$element->end_controls_section();

	}

	function mellis_social_icons_custom ( $element, $args ) {

	$element->start_controls_section(
		'ova_social_icons',
		[
			'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			'label' => esc_html__( 'Ova Social Icon', 'mellis' ),
		]
	);

		$element->add_responsive_control(
            'ova_social_icons_display',
            [
                'label' 	=> esc_html__( 'Display', 'mellis' ),
                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
                'options' 	=> [
                    'inline-block' => [
                        'title' => esc_html__( 'Block', 'mellis' ),
                        'icon' 	=> 'eicon-h-align-left',
                    ],
                    'inline-flex' => [
                        'title' => esc_html__( 'Flex', 'mellis' ),
                        'icon' 	=> 'eicon-h-align-center',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon.elementor-social-icon' => 'display: {{VALUE}}',
                ],
            ]
        );

		$element->end_controls_section();
	}

	// text-editor custom 
    function mellis_text_editor_custom( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_tabs',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Text Editor', 'mellis' ),
			]
		);

			$element->add_responsive_control(
				'text_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'mellis' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
					'{{WRAPPER}} p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$element->add_responsive_control(
		        'text_padding',
		        [
		            'label' 		=> esc_html__( 'Padding', 'mellis' ),
		            'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		            'size_units' 	=> [ 'px', '%', 'em' ],
		            'selectors' 	=> [
		             '{{WRAPPER}}  p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            ],
		         ]
		    );


		$element->end_controls_section();
	}

	
	function mellis_add_category(  ) {

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'hf',
	        [
	            'title' => __( 'Header Footer', 'mellis' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'mellis',
	        [
	            'title' => __( 'Mellis', 'mellis' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	}

	function mellis_enqueue_scripts(){
        
        $files = glob(get_theme_file_path('/assets/js/elementor/*.js'));
        
        foreach ($files as $file) {
            $file_name = wp_basename($file);
            $handle    = str_replace(".js", '', $file_name);
            $src       = get_theme_file_uri('/assets/js/elementor/' . $file_name);
            if (file_exists($file)) {
                wp_register_script( 'mellis-elementor-' . $handle, $src, ['jquery'], false, true );
            }
        }


	}

	function mellis_include_widgets( $widgets_manager ) {
        $files = glob(get_theme_file_path('elementor/widgets/*.php'));
        foreach ($files as $file) {
            $file = get_theme_file_path('elementor/widgets/' . wp_basename($file));
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }

    function mellis_add_animations(){
    	$animations = array(
            'Mellis' => array(
                'ova-move-up' 		=> esc_html__('Move Up', 'mellis'),
                'ova-move-down' 	=> esc_html__( 'Move Down', 'mellis' ),
                'ova-move-left'     => esc_html__('Move Left', 'mellis'),
                'ova-move-right'    => esc_html__('Move Right', 'mellis'),
                'ova-scale-up'      => esc_html__('Scale Up', 'mellis'),
                'ova-flip'          => esc_html__('Flip', 'mellis'),
                'ova-helix'         => esc_html__('Helix', 'mellis'),
                'ova-popup'			=> esc_html__( 'PopUp','mellis' )
            ),
        );

        return $animations;
    }

   

	function mellis_enqueue_footer_scripts(){
		 // Font Icon
	    wp_enqueue_style('ovaicon', MELLIS_URI.'/assets/libs/ovaicon/font/ovaicon.css', array(), null);

	    // Flaticon
	    wp_enqueue_style('ova-flaticon', MELLIS_URI.'/assets/libs/flaticon/font/flaticon.css', array(), null);
	}
	
	

	public function mellis_icons_filters_new( $tabs = array() ) {
		$newicons = [];

		$font_data['json_url'] = MELLIS_URI.'/assets/libs/ovaicon/ovaicon.json';
		$font_data['name'] = 'ovaicon';

		$newicons[ $font_data['name'] ] = [
			'name'          => $font_data['name'],
			'label'         => esc_html__( 'Default', 'mellis' ),
			'url'           => '',
			'enqueue'       => '',
			'prefix'        => 'ovaicon-',
			'displayPrefix' => '',
			'ver'           => '1.0',
			'fetchJson'     => $font_data['json_url'],
		];

		// Flaticon
		$flaticon_data['json_url'] = MELLIS_URI.'/assets/libs/flaticon/flaticon.json';
		$flaticon_data['name'] = 'flaticon';

		$newicons[ $flaticon_data['name'] ] = [
			'name'          => $flaticon_data['name'],
			'label'         => esc_html__( 'Flaticon', 'mellis' ),
			'url'           => '',
			'enqueue'       => '',
			'prefix'        => 'flaticon-',
			'displayPrefix' => '',
			'ver'           => '1.0',
			'fetchJson'     => $flaticon_data['json_url'],
		];

		return array_merge( $tabs, $newicons );
	}

	public function mellis_icon_custom($element, $args){
		$element->start_controls_section(
			'ova_icon_customize',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Icon', 'mellis' ),
			]
		);
			$element->add_control(
				'ova_icon_wrapper_line_height',
				[
					'label' => esc_html__( 'Line Height', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 1.5,
							'step' => 0.1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-wrapper' => 'line-height: {{SIZE}};',	
					],
				]
			);

		$element->end_controls_section();
	}
    

}

return new Mellis_Elementor();