<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Mellis_Elementor_Promotions extends Widget_Base {

	
	public function get_name() {
		return 'mellis_elementor_promotions';
	}

	
	public function get_title() {
		return esc_html__( 'Promotions', 'mellis' );
	}

	
	public function get_icon() {
		return 'eicon-undo';
	}

	
	public function get_categories() {
		return [ 'mellis' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'mellis' ),
			]
		);	
			
			
			// Add Class control
			$this->add_control(
				'template',
				[
					'label' => esc_html__( 'Template', 'mellis' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'template_1',
					'options' => [
						'template_1' => esc_html__( 'Template 1', 'mellis' ),
						'template_2' => esc_html__( 'Template 2', 'mellis' ),
						'template_3' => esc_html__( 'Template 3', 'mellis' ),
					]
				]
			);

			$this->add_control(
				'sub_title',
				[
					'label' => esc_html__( 'Sub Title', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'template' => [
							'template_1',
							'template_2'
						]
					],
				]
			);

			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'mellis' ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Title', 'mellis' ),
				]
			);

			$this->add_control(
				'title_font_family_v2',
				[
					'label' 	=> esc_html__( 'Font Family', 'mellis' ),
					'type' 		=> \Elementor\Controls_Manager::FONT,
					'default' 	=> "Parisienne",
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion .pricing-title' => 'font-family: {{VALUE}}',
					],
					'condition' => [
						'template' => [
							'template_2'
						]
					],
				]
			);
			
			$this->add_control(
				'promo_code_number',
				[
					'label' => esc_html__( 'Promo Code', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( '6578980', 'mellis' ),
					'condition' => [
						'template' => [
							'template_3'
						]
					],
				]
			);

			$this->add_control(
				'promo_code_text',
				[
					'label' => esc_html__( 'Promo Code Text', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Promo Code', 'mellis' ),
					'condition' => [
						'template' => [
							'template_3'
						]
					],
				]
			);
			

			$this->add_control(
	            'currency_symbol',
	            [
	                'label' => __( 'Currency Symbol', 'mellis' ),
	                'type' => Controls_Manager::SELECT,
	                'options' => [
	                    '' => __( 'None', 'mellis' ),
	                    'dollar' => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'mellis' ),
	                    'euro' => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'mellis' ),
	                    'baht' => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'mellis' ),
	                    'franc' => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'mellis' ),
	                    'guilder' => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'mellis' ),
	                    'krona' => 'kr ' . _x( 'Krona', 'Currency Symbol', 'mellis' ),
	                    'lira' => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'mellis' ),
	                    'peseta' => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'mellis' ),
	                    'peso' => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'mellis' ),
	                    'pound' => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'mellis' ),
	                    'real' => 'R$ ' . _x( 'Real', 'Currency Symbol', 'mellis' ),
	                    'ruble' => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'mellis' ),
	                    'rupee' => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'mellis' ),
	                    'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'mellis' ),
	                    'shekel' => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'mellis' ),
	                    'yen' => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'mellis' ),
	                    'won' => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'mellis' ),
	                    'custom' => __( 'Custom', 'mellis' ),
	                ],
	                'default' => 'dollar',
	            ]
	        );

			$this->add_control(
				'currency_symbol_custom',
				[
					'label' => esc_html__( 'Custom Symbol', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'default' => '%',
					'condition' => [
	                    'currency_symbol' => 'custom',
	                ],
				]
			);

			$this->add_responsive_control(
				'position_currency',
				[
					'label' 	=> esc_html__( 'Position', 'mellis' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'row' => [
							'title' => esc_html__( 'Left', 'mellis' ),
							'icon' 	=> 'eicon-h-align-left',
						],
						'row-reverse' => [
							'title' => esc_html__( 'Right', 'mellis' ),
							'icon' 	=> 'eicon-h-align-right',
						],
					],
				
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion .price .number-symbol' => 'flex-direction: {{VALUE}}',

					],
				]
			);

			$this->add_control(
				'price',
				[
					'label' => esc_html__( 'Price', 'mellis' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 30,
					'condition' => [
						'template!' => [
							'template_3'
						]
					],
				]
			);

			$this->add_control(
				'price_v3',
				[
					'label' => esc_html__( 'Price', 'mellis' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 10,
					'condition' => [
						'template' => [
							'template_3'
						]
					],
				]
			);

			$this->add_control(
				'suffix',
				[
					'label' => esc_html__( 'Suffix', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Off', 'mellis' ),
					'condition' => [
						'template' => [
							'template_2'
						]
					],
				]
			);


			$this->add_control(
				'link',
				[
					'label' => esc_html__( 'Link Button', 'mellis' ),
					'type' => Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => esc_html__( 'https://your-link.com', 'mellis' ),
					'show_label' => true,
				]
			);

			$this->add_control(
				'text_button',
				[
					'label' 	=> esc_html__( 'Text Button', 'mellis' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'visit now', 'mellis' ),
					'condition' => [
						'template' => [
							'template_1'
						]
					],
				]
			);

			$this->add_control(
				'text_button_v2',
				[
					'label' 	=> esc_html__( 'Text Button', 'mellis' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Book now', 'mellis' ),
					'condition' => [
						'template' => [
							'template_2'
						]
					],
				]
			);

			$this->add_control(
				'text_button_v3',
				[
					'label' 	=> esc_html__( 'Text Button', 'mellis' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Apply code', 'mellis' ),
					'condition' => [
						'template' => [
							'template_3'
						]
					],
				]
			);

			$this->add_control(
				'conditions_apply',
				[
					'label' 	=> esc_html__( 'Conditions Apply', 'mellis' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Conditions apply', 'mellis' ),
					'condition' => [
						'template' => [
							'template_3'
						]
					],
				]
			);





		$this->end_controls_section();


		/* Begin General Style */
		$this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );
        
        	$this->add_responsive_control(
				'general_justify',
				[
					'label' 	=> esc_html__( 'Justify', 'mellis' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'flex-start' => [
							'title' => esc_html__( 'Start', 'mellis' ),
							'icon' 	=> 'eicon-v-align-top',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'mellis' ),
							'icon' 	=> 'eicon-v-align-middle',
						],
						'flex-end' => [
							'title' => esc_html__( 'End', 'mellis' ),
							'icon' 	=> 'eicon-v-align-bottom',
						],
						'space-around' => [
							'title' => esc_html__( 'Space Around', 'mellis' ),
							'icon' 	=> 'eicon-justify-space-around-v',
						],
						'space-between' => [
							'title' => esc_html__( 'Space Between', 'mellis' ),
							'icon' 	=> 'eicon-justify-space-between-v',
						],
						
					],
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion' => 'justify-content: {{VALUE}};',
						
					],
				]
			);

			$this->add_responsive_control(
				'general_align',
				[
					'label' 	=> esc_html__( 'Alignment', 'mellis' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'flex-start' => [
							'title' => esc_html__( 'Start', 'mellis' ),
							'icon' 	=> 'eicon-order-start',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'mellis' ),
							'icon' 	=> 'eicon-align-center-v',
						],
						'flex-end' => [
							'title' => esc_html__( 'End', 'mellis' ),
							'icon' 	=> 'eicon-order-end',
						],
					],
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion' => 'align-items: {{VALUE}};',
						
					],
				]
			);

			$this->add_responsive_control(
				'promotion_height',
				[
					'label' => esc_html__( 'Height', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 300,
							'max' => 600,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

        	$this->add_responsive_control(
				'template_1_general_padding',
				[
					'label' => esc_html__( 'Padding', 'mellis' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);


			$this->add_responsive_control(
				'template_3_general_margin',
				[
					'label' => esc_html__( 'Margin', 'mellis' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion.template_3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'template' => [
							'template_3'
						]
					],
				]
			);

			$this->add_control(
				'template_3_general_background',
				[
					'label'	 	=> esc_html__( 'Background', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion.template_3' => 'background-color : {{VALUE}};'	
					],
					'condition' => [
						'template' => [
							'template_3'
						]
					],
				]
			);

        $this->end_controls_section();
		/* End General style */

        /* Begin Background Style */
        $this->start_controls_section(
            'background',
            [
                'label' => esc_html__( 'Background', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );
        
        	$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'background_image',
					'label' => esc_html__( 'Background', 'mellis' ),
					'types' => [ 'classic'],
					'selector' => '{{WRAPPER}} .ova-promotions',
				]
			);

			$this->add_control(
				'background_v2',
				[
					'label' => esc_html__( 'Background Secondary', 'mellis' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'background_1',
					'options' => [
						'background_1' => esc_html__( 'Version 1', 'mellis' ),
						'background_2' => esc_html__( 'Version 2', 'mellis' ),
						'default' => esc_html__( 'Default', 'mellis' ),
						'bg_none' => esc_html__( 'None', 'mellis' ),
					],
					'condition' => [
						'template' => [
							'template_2'
						]
					],
				]
			);

        $this->end_controls_section();
		/* End Background style */

		/* End Sub Title style */
		$this->start_controls_section(
			'section_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'mellis' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'template' => [
						'template_1',
						'template_2',
					]
				],
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'content_typography_sub_title',
					'label' 	=> esc_html__( 'Typography', 'mellis' ),
					'selector' 	=> '{{WRAPPER}} .ova-promotions .promotion .sub-title',
				]
			);

			$this->add_control(
				'color_sub_title',
				[
					'label'	 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion .sub-title' => 'color : {{VALUE}};'	
					],
				]
			);

			$this->add_responsive_control(
				'margin_sub_title',
				[
					'label' 	 => esc_html__( 'Margin', 'mellis' ),
					'type' 		 => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-promotions .promotion .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			
		$this->end_controls_section();
		/* End Sub Title style */

		/* Begin Title style */
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'mellis' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'content_typography_title',
					'label' 	=> esc_html__( 'Typography', 'mellis' ),
					'selector' 	=> '{{WRAPPER}} .ova-promotions .promotion .pricing-title',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label'	 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion .pricing-title' => 'color : {{VALUE}};'
					],
				]
			);

			$this->add_responsive_control(
				'margin_title',
				[
					'label' 	 => esc_html__( 'Margin', 'mellis' ),
					'type' 		 => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-promotions .promotion .pricing-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'template_2_title_padding',
				[
					'label' 	 => esc_html__( 'Padding', 'mellis' ),
					'type' 		 => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-promotions .promotion .pricing-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'template' => [
							'template_2'
						]
					],
				]
			);
			
		$this->end_controls_section();
		/* End Title style */
		
		/* Begin  Price style */
		$this->start_controls_section(
			'section_price',
			[
				'label' => esc_html__( 'Price', 'mellis' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'content_typography_price',
					'label' 	=> esc_html__( 'Typography Price', 'mellis' ),
					'selector' 	=> '{{WRAPPER}} .ova-promotions .promotion .price .number-symbol',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'template_2_price_suffix_typo',
					'label' 	=> esc_html__( 'Typography Suffix', 'mellis' ),
					'selector' 	=> '{{WRAPPER}} .ova-promotions .promotion.template_2 .price .suffix',
				]
			);

			$this->add_control(
				'color_price',
				[
					'label'	 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion .price' => 'color : {{VALUE}};'	
					],
				]
			);

			$this->add_control(
				'template_2_price_background',
				[
					'label'	 	=> esc_html__( 'Background', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion .price' => 'background-color : {{VALUE}};'	
					],
					'condition' => [
						'template' => [
							'template_2'
						]
					],
				]
			);

			$this->add_control(
				'template_2_show_mask',
				[
					'label' => esc_html__( 'Show Mask', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'mellis' ),
					'label_off' => esc_html__( 'Hide', 'mellis' ),
					'return_value' => 'yes',
					'default' => 'no',
					'condition' => [
						'template' => [
							'template_2'
						]
					],
				]
			);

			$this->add_responsive_control(
				'margin_price_general',
				[
					'label' 	 => esc_html__( 'Margin', 'mellis' ),
					'type' 		 => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-promotions .promotion .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'template!' => [
							'template_2'
						]
					],
				]
			);

			$this->add_control(
				'template_2_price_fontsize',
				[
					'label' => esc_html__( 'Width', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 120,
							'max' => 200,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion.template_2 .price' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'template' => [
							'template_2'
						]
					],
				]
			);

			$this->add_control(
				'template_2_price_position',
				[
					'label' => esc_html__( 'Top', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => -100,
							'max' => 100,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion.template_2 .price' => 'top: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'template' => [
							'template_2'
						]
					],
				]
			);
			
		$this->end_controls_section();
		/* End Price style */

		/* Begin Promo style */
		$this->start_controls_section(
			'section_promo',
			[
				'label' => esc_html__( 'Promo', 'mellis' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'template' => [
						'template_3'
					]
				],
			]
		);
			$this->start_controls_tabs(
				'style_promo_tabs'
			);

				$this->start_controls_tab(
					'style_promo_code_tab',
					[
						'label' => esc_html__( 'Code', 'mellis' ),
					]
				);
					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' 		=> 'content_typography_promo_code',
							'label' 	=> esc_html__( 'Typography', 'mellis' ),
							'selector' 	=> '{{WRAPPER}} .ova-promotions .promotion.template_3 .promo-code',
						]
					);

					$this->add_control(
						'color_promo_code',
						[
							'label'	 	=> esc_html__( 'Color', 'mellis' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-promotions .promotion.template_3 .promo-code' => 'color : {{VALUE}};'
								
								
							],
						]
					);

					$this->add_responsive_control(
						'margin_promo_code',
						[
							'label' 	 => esc_html__( 'Margin', 'mellis' ),
							'type' 		 => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', 'em', '%' ],
							'selectors'  => [
								'{{WRAPPER}} .ova-promotions .promotion.template_3 .promo-code' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'style_promo_text_tab',
					[
						'label' => esc_html__( 'Text', 'mellis' ),
					]
				);
					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' 		=> 'content_typography_promo_text',
							'label' 	=> esc_html__( 'Typography', 'mellis' ),
							'selector' 	=> '{{WRAPPER}} .ova-promotions .promotion.template_3 .promo-text',
						]
					);

					$this->add_control(
						'color_promo_text',
						[
							'label'	 	=> esc_html__( 'Color', 'mellis' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-promotions .promotion.template_3 .promo-text' => 'color : {{VALUE}};'
							],
						]
					);

					$this->add_responsive_control(
						'margin_promo_text',
						[
							'label' 	 => esc_html__( 'Margin', 'mellis' ),
							'type' 		 => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', 'em', '%' ],
							'selectors'  => [
								'{{WRAPPER}} .ova-promotions .promotion.template_3 .promo-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
		/* End Promo code style */

		/* Begin button Style */
		$this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Button', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'text_button_typography',
					'selector' 	=> '{{WRAPPER}} .ova-promotions .promotion .pricing-btn',
				]
			);

			$this->add_control(
				'button_width',
				[
					'label' => esc_html__( 'Width', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 150,
							'max' => 200,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion .pricing-btn' => 'width: {{SIZE}}{{UNIT}};',
					],
				
				]
			);

			$this->add_control(
				'button_height',
				[
					'label' => esc_html__( 'Height', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 50,
							'max' => 100,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion .pricing-btn' => 'height: {{SIZE}}{{UNIT}};',
					],
				
				]
			);

			$this->start_controls_tabs(
				'style_buton_tabs'
			);

				$this->start_controls_tab(
					'style_button_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'mellis' ),
						]
					);
						$this->add_control(
							'button_text_color',
							[
								'label' 	=> esc_html__( 'Color', 'mellis' ),
								'type' 		=> Controls_Manager::COLOR,
								'selectors' => [
									'{{WRAPPER}} .ova-promotions .promotion .pricing-btn' => 'color: {{VALUE}};',
								],
							]
						);

						 $this->add_control(
							'button_bgcolor',
							[
								'label' 	=> esc_html__( 'Background Color', 'mellis' ),
								'type' 		=> Controls_Manager::COLOR,
								'selectors' => [
									'{{WRAPPER}} .ova-promotions .promotion .pricing-btn' => 'background-color: {{VALUE}};',
								],
							]
						);

						$this->add_responsive_control(
				            'button_padding',
				            [
				                'label' 		=> esc_html__( 'Padding', 'mellis' ),
				                'type' 			=> Controls_Manager::DIMENSIONS,
				                'size_units' 	=> [ 'px', '%', 'em' ],
				                'selectors' 	=> [
				                    '{{WRAPPER}} .ova-promotions .promotion .pricing-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				                ],
				            ]
				        );

				        $this->add_responsive_control(
				            'button_margin',
				            [
				                'label' 		=> esc_html__( 'Margin', 'mellis' ),
				                'type' 			=> Controls_Manager::DIMENSIONS,
				                'size_units' 	=> [ 'px', '%', 'em' ],
				                'selectors' 	=> [
				                    '{{WRAPPER}} .ova-promotions .promotion .pricing-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				                ],
				            ]
				        );

				        $this->add_responsive_control(
				            'button_border_radius',
				            [
				                'label' 		=> esc_html__( 'Border Radius', 'mellis' ),
				                'type' 			=> Controls_Manager::DIMENSIONS,
				                'size_units' 	=> [ 'px', '%', 'em' ],
				                'selectors' 	=> [
				                    '{{WRAPPER}} .ova-promotions .promotion .pricing-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				                ],
				            ]
				        );

				        $this->add_group_control(
							\Elementor\Group_Control_Border::get_type(),
							[
								'name' => 'button_border',
								'label' => esc_html__( 'Border', 'mellis' ),
								'selector' => '{{WRAPPER}} .ova-promotions .promotion .pricing-btn',
							]
						);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'style_button_hover_tab',
						[
							'label' => esc_html__( 'Hover', 'mellis' ),
						]
					);

						$this->add_control(
							'button_text_color_hover',
							[
								'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
								'type' 		=> Controls_Manager::COLOR,
								'selectors' => [
									'{{WRAPPER}} .ova-promotions .promotion .pricing-btn:hover' => 'color: {{VALUE}};',
								],
							]
						);

						$this->add_control(
							'button_bgcolor_hover',
							[
								'label' 	=> esc_html__( 'Background Color Hover', 'mellis' ),
								'type' 		=> Controls_Manager::COLOR,
								'selectors' => [
									'{{WRAPPER}} .ova-promotions .promotion .pricing-btn:hover' => 'background-color: {{VALUE}};',
								],
							]
						);

						$this->add_control(
							'button_border_hover',
							[
								'label' 	=> esc_html__( 'Border Color', 'mellis' ),
								'type' 		=> Controls_Manager::COLOR,
								'selectors' => [
									'{{WRAPPER}} .ova-promotions .promotion .pricing-btn:hover' => 'border-color: {{VALUE}};',
								],
							]
						);

				$this->end_controls_tab();

			$this->end_controls_tabs();
          
        $this->end_controls_section();
		/* End button style */
		
		/* Begin button Style */
		$this->start_controls_section(
            'condition_style',
            [
                'label' => esc_html__( 'Conditions', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
                'condition' => [
					'template' => [
						'template_3'
					]
				],
            ]
        );
        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'condition_typography',
					'selector' 	=> '{{WRAPPER}} .ova-promotions .promotion.template_3 .promo-condition',
				]
			);

			$this->add_control(
				'condition_text_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-promotions .promotion.template_3 .promo-condition' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'condition_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-promotions .promotion.template_3 .promo-condition' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End Condition style */

	}

	private function get_currency_symbol( $symbol_name ) {
        $symbols = [
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'pound' => '&#163;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'baht' => '&#3647;',
            'yen' => '&#165;',
            'won' => '&#8361;',
            'guilder' => '&fnof;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'rupee' => '&#8360;',
            'indian_rupee' => '&#8377;',
            'real' => 'R$',
            'krona' => 'kr',
        ];

        return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
    }

	// Render Template Here
	protected function render() {

		$settings 		= $this->get_settings();
		$template 		= 	$settings['template'];
        
        $sub_title      =   $settings['sub_title'];
        $title          =   $settings['title'];
		$price          =   $template == 'template_3' ? number_format($settings['price_v3'], 2) : $settings['price'];
		$suffix         =   $settings['suffix'];
		$background_2 	=   $settings['background_v2'];
		
		$promo_code 	= 	$settings['promo_code_number'];
		$promo_text 	= 	$settings['promo_code_text'];
		$conditions 	= 	$settings['conditions_apply'];

		if($template =='template_1' || $template == 'template_3'){
			$text_button    =  $template == 'template_1' ? $settings['text_button'] : $settings['text_button_v3'];

			if ( ! empty( $settings['currency_symbol'] ) ) {
	            if ( 'custom' !== $settings['currency_symbol'] ) {
	                $symbol = $this->get_currency_symbol( $settings['currency_symbol'] );
	            } else {
	                $symbol = $settings['currency_symbol_custom'];
	            }
	        }
		}

		if($template =='template_2'){
			$text_button = $settings['text_button_v2'];
			$symbol = $settings['currency_symbol_custom'];
		}

		$link      =  $settings['link'];
		$nofollow  =  ( isset( $link['nofollow'] ) && $link['nofollow'] ) ? 'rel=nofollow' : '';
		$target    =  ( isset( $link['is_external'] ) && $link['is_external'] !== '' ) ? 'target=_blank' : '';

		// show mask star price
		$template_2_show_mask = $settings['template_2_show_mask'];

		if( $template_2_show_mask == 'yes' ) {
			$template_2_show_mask = 'has-mask-image';
		} else {
			$template_2_show_mask = '';
		}

		?>

		<?php if($template == 'template_1' || $template == 'template_2'): ?>

			<div class="ova-promotions" >
				<div class="promotion <?php echo esc_html( $template ); echo ' ' . esc_html( $background_2 ); ?>">

					<?php if( !empty( $sub_title ) && $template == 'template_1' ) :?>
						<span class="sub-title">
							<?php echo esc_html( $sub_title ); ?>
						</span>
	                <?php endif; ?>

					<?php if( !empty( $price ) ) :?>
						<div class="price <?php echo esc_attr($template_2_show_mask);?>">
							<div class="number-symbol">
								<span class="number">
									<?php echo esc_html( $price ); ?>
								</span>
								<span class="symbol">
									<?php echo esc_html( $symbol ); ?>
								</span>	
							</div>
							<?php if( !empty( $suffix ) && $template == 'template_2' ) :?>
								<span class="suffix">
									<?php echo esc_html( $suffix ); ?>
								</span>
							<?php endif; ?>
						</div>
	                <?php endif; ?>

					<?php if( !empty( $title ) ) : ?>
	           	    	<h3 class="pricing-title"><?php echo esc_html( $title ) ; ?></h3>   
	                <?php endif; ?>

	                <?php if( !empty( $sub_title ) && $template == 'template_2' ) :?>
						<span class="sub-title">
							<?php echo esc_html( $sub_title ); ?>
						</span>
	                <?php endif; ?>

	                <?php if( !empty( $text_button ) ) : ?>
		                <a <?php if( !empty( $link['url'] ) ) : ?> href="<?php echo esc_url( $link['url'] ) ;?>" <?php endif; ?> 
		                    class="pricing-btn" <?php echo esc_attr( $nofollow ) ;?> <?php echo esc_attr( $target ) ;?> title="<?php echo esc_attr( $text_button ); ?>">
	                        <span class="text-button">
	                        	<?php echo esc_html( $text_button ) ;?>
	                        </span>
		                </a>
		            <?php endif; ?>

				</div>
			</div>

		<?php endif; ?>
		 
		<!-- version 3 -->
 		<?php if($template == 'template_3'): ?>

 			<div class="ova-promotions" >
				<div class="promotion template_3 ">

					<?php if( !empty( $price ) ) :?>
						<div class="price">
							<div class="number-symbol">
								<span class="number">
									<?php echo esc_html( $price ); ?>
								</span>
								<span class="symbol">
									<?php echo esc_html( $symbol ); ?>
								</span>	
							</div>
							<?php if( !empty( $suffix ) && $template == 'template_2' ) :?>
							<span class="suffix">
								<?php echo esc_html( $suffix ); ?>
							</span>
							 <?php endif; ?>

						</div>
	                <?php endif; ?>

	                <?php if( !empty( $title ) ) : ?>
	           	    	<h3 class="pricing-title">
		                	<?php echo esc_html( $title ) ; ?>
		                </h3>   
	                <?php endif; ?>

					<?php if( !empty( $promo_code ) ) : ?>
	           	    	<span class="promo-code">
		                	<?php echo esc_html( $promo_code ) ; ?>
		                </span>   
	                <?php endif; ?> 

	                <?php if( !empty( $promo_text ) ) : ?>
	           	    	<span class="promo-text">
		                	<?php echo esc_html( $promo_text ) ; ?>
		                </span>   
	                <?php endif; ?>

	                <?php if( !empty( $text_button ) ) : ?>
		                <a <?php if( !empty( $link['url'] ) ) : ?> href="<?php echo esc_url( $link['url'] ) ;?>" <?php endif; ?> 
		                    class="pricing-btn" <?php echo esc_attr( $nofollow ) ;?> <?php echo esc_attr( $target ) ;?> title="<?php echo esc_attr( $text_button ); ?>">
	                        <span class="text-button">
	                        	<?php echo esc_html( $text_button ) ;?>
	                        </span>
		                </a>
		            <?php endif; ?>

		            <?php if( !empty( $conditions ) ) : ?>
	           	    	<p class="promo-condition">
		                	<?php echo esc_html( $conditions ) ; ?>
		                </p>   
	                <?php endif; ?>
				</div>
			</div>

		<?php endif; ?>

		<?php
	}

	
}
$widgets_manager->register( new Mellis_Elementor_Promotions() );