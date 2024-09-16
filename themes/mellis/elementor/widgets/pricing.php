<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Mellis_Elementor_Pricing extends Widget_Base {

	
	public function get_name() {
		return 'mellis_elementor_pricing';
	}

	
	public function get_title() {
		return esc_html__( 'Ova Pricing', 'mellis' );
	}

	
	public function get_icon() {
		return 'eicon-price-table';
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
					'default' => 'template1',
					'options' => [
						'template1' => esc_html__( 'Template 1', 'mellis' ),
						'template2' => esc_html__( 'Template 2', 'mellis' ),
					]
				]
			);

			$this->add_control(
				'active_mode',
				[
					'label' 	=> esc_html__( 'Active', 'mellis' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'mellis' ),
					'label_off' => esc_html__( 'No', 'mellis' ),
					'default' 	=> 'no',
				]
			);

			$this->add_control(
				'class_icon',
				[
					'label' => esc_html__( 'Icon', 'mellis' ),
					'type' => Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'flaticon flaticon-spa-candles',
						'library' 	=> 'flaticon',
					],
				]
			);
				
			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'mellis' ),
					'type' => Controls_Manager::TEXTAREA,
					'rows' => 3,
					'default' => esc_html__( 'Comfort Relax', 'mellis' ),
				]
			);

			$this->add_control(
				'description',
				[
					'label' => esc_html__( 'Description', 'mellis' ),
					'type' => Controls_Manager::TEXTAREA,
					'rows' => 4,
				]
			);

			$this->add_control(
				'currency_unit',
				[
					'label' => esc_html__( 'Currency Unit', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( '$', 'mellis' ),
				]
			);

			$this->add_control(
				'price',
				[
					'label' => esc_html__( 'Price', 'mellis' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 60,
				]
			);

			$this->add_control(
				'period',
				[
					'label' => esc_html__( 'Period', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( '/ Per Day', 'mellis' ),
				]
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'class_icon_text_service',
				[
					'label' => esc_html__( 'Icon', 'mellis' ),
					'type' => Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'fas fa-check',
						'library' 	=> 'all',
					],
				]
			);
				
			$repeater->add_control(
				'text_service',
				[
					'label' => esc_html__( 'Text Service', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Add list text service', 'mellis' ),
				]
			);

			$this->add_control(
				'list_service_text',
				[
					'label' => esc_html__( 'List Text Service', 'mellis' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[	
							'text_service'      => esc_html__( 'Lorem ipsum dolor sit amet', 'mellis' ),
						],
						[	
							'text_service'      => esc_html__( 'Eam impedit molestie ett', 'mellis' ),
						],
						[	
							'text_service'      => esc_html__( 'Mei populo est', 'mellis' ),
						],
						[	
							'text_service'      => esc_html__( 'Vivendo oportere', 'mellis' ),
						],
					],
					'title_field' => '{{{ text_service }}}',
				]
			);

			$this->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'mellis' ),
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
					'default' 	=> esc_html__( 'Book now', 'mellis' ),
				]
			);

		$this->end_controls_section();

		/* Begin content Style */
		$this->start_controls_section(
            'content_pricing_style',
            [
                'label' => esc_html__( 'Content', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
				'content_pricing_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing' => 'background-color: {{VALUE}};',
					],
				]
			);
            
            $this->add_control(
				'content_pricing_bgcolor_hover',
				[
					'label' 	=> esc_html__( 'Background Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing:hover, {{WRAPPER}} .ova-pricing.active' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'content_pricing_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-pricing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_control(
				'pricing_hover_animation',
				[
					'label' => __( 'Hover Animation', 'mellis' ),
					'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
					'prefix_class' => 'elementor-animation-',
				]
			);

	        $this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => esc_html__( 'Box Shadow', 'mellis' ),
					'selector' => '{{WRAPPER}} .ova-pricing',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'box_border',
					'label' => esc_html__( 'Border', 'mellis' ),
					'selector' => '{{WRAPPER}} .ova-pricing',
				]
			);


        $this->end_controls_section();
		/* End content style */

        /* Begin title Style */
		$this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-pricing .icon-title .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing .icon-title .title' => 'color: {{VALUE}};',
					],
				]
			);	

			$this->add_control(
				'title_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing:hover .icon-title .title,{{WRAPPER}} .ova-pricing.active .icon-title .title' => 'color: {{VALUE}};',
					],
				]
			);			

			$this->add_responsive_control(
	            'title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-pricing .icon-title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End title style */

		/* Begin icon Style */
		$this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Icon', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );
            
			$this->add_responsive_control(
				'size_icon',
				[
					'label' 		=> esc_html__( 'Size', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 150,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-pricing .icon-title i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
               
            $this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing .icon-title i' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing:hover .icon-title i, {{WRAPPER}} .ova-pricing.active .icon-title i' => 'color: {{VALUE}};',
					],
				]
			);


        $this->end_controls_section();
		/* End icon style */

		/* Begin price Style */
		$this->start_controls_section(
            'price_style',
            [
                'label' => esc_html__( 'Price', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'price_typography',
					'selector' 	=> '{{WRAPPER}} .ova-pricing .price .ova-price',
				]
			);

			$this->add_control(
				'price_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing .price .ova-price' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'price_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing:hover .price .ova-price, {{WRAPPER}} .ova-pricing.active .price .ova-price' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'position_currency',
				[
					'label' 	=> esc_html__( 'Position Currency', 'mellis' ),
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
						'{{WRAPPER}} .ova-pricing .price .ova-price' => 'flex-direction: {{VALUE}}',

					],
				]
			);

        $this->end_controls_section();
		/* End price style */

		/* Begin period Style */
		$this->start_controls_section(
            'period_style',
            [
                'label' => esc_html__( 'Period', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'period_typography',
					'selector' 	=> '{{WRAPPER}} .ova-pricing .price .period',
				]
			);

			$this->add_control(
				'period_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing .price .period' => 'color: {{VALUE}};',
					],
				]
			);
			

        $this->end_controls_section();
		/* End period style */

		/* Begin list text service Style */
		$this->start_controls_section(
            'list_text_service_style',
            [
                'label' => esc_html__( 'List Text Service', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );   

 			$this->add_control(
				'list_text_service_general_heading',
				[
					'label' 	=> esc_html__( 'General', 'mellis' ),
					'type' 		=> Controls_Manager::HEADING,
				]
			);

	            $this->add_responsive_control(
					'space_between_text_service',
					[
						'label' 		=> esc_html__( 'Space Between', 'mellis' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px'],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 40,
								'step' => 1,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .ova-pricing .pricing-service .pricing-service-list .item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
						],
					]
				);
           
				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'general_border',
						'label' => esc_html__( 'Border', 'mellis' ),
						'selector' => '{{WRAPPER}} .ova-pricing .pricing-service',
					]
				);

				$this->add_responsive_control(
					'service_general_margin',
					[
						'label' => esc_html__( 'Margin', 'mellis' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							'{{WRAPPER}} .ova-pricing .pricing-service' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
					]
				);
				$this->add_responsive_control(
					'service_general_padding',
					[
						'label' => esc_html__( 'Padding', 'mellis' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							'{{WRAPPER}} .ova-pricing .pricing-service' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
					]
				);

			$this->add_control(
				'list_text_service_icon_heading',
				[
					'label' 	=> esc_html__( 'Icon', 'mellis' ),
					'type' 		=> Controls_Manager::HEADING,
				]
			);

				$this->add_responsive_control(
					'size_icon_service',
					[
						'label' 		=> esc_html__( 'Size', 'mellis' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px'],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 35,
								'step' => 1,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .ova-pricing .pricing-service .pricing-service-list .item i' => 'font-size: {{SIZE}}{{UNIT}};',
						],
					]
				);
	               
	            $this->add_control(
					'icon_service_color',
					[
						'label' 	=> esc_html__( 'Color', 'mellis' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-pricing .pricing-service .pricing-service-list .item i' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_responsive_control(
					'icon_service_margin',
					[
						'label' => esc_html__( 'Margin', 'mellis' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							'{{WRAPPER}} .ova-pricing .pricing-service .pricing-service-list .item i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
					]
				);

            $this->add_control(
				'list_text_service_heading',
				[
					'label' 	=> esc_html__( 'Text Service', 'mellis' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);

	            $this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' 		=> 'list_text_service_typography',
						'selector' 	=> '{{WRAPPER}} .ova-pricing .pricing-service .pricing-service-list .item .text_service',
					]
				);

				$this->add_control(
					'list_text_service_color',
					[
						'label' 	=> esc_html__( 'Color', 'mellis' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}}  .ova-pricing .pricing-service .pricing-service-list .item .text_service' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'list_text_service_color_hover',
					[
						'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-pricing:hover .pricing-service .pricing-service-list .item .text_service, {{WRAPPER}} .ova-pricing.active .pricing-service .pricing-service-list .item .text_service' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_responsive_control(
					'text_service_margin',
					[
						'label' => esc_html__( 'Margin', 'mellis' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							'{{WRAPPER}} .ova-pricing .pricing-service .pricing-service-list .item .text_service' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
					]
				); 
				

        $this->end_controls_section();
		/* End list text service style */

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
					'selector' 	=> '{{WRAPPER}} .ova-pricing .pricing-btn',
				]
			);
            
            $this->add_control(
				'button_text_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing .pricing-btn' => 'color: {{VALUE}};',
					],
				]
			);

			 $this->add_control(
				'button_text_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing .pricing-btn:hover' => 'color: {{VALUE}};',
					],
				]
			);

            $this->add_control(
				'button_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing .pricing-btn' => 'background-color: {{VALUE}};',
					],
				]
			);
            
            $this->add_control(
				'button_bgcolor_hover',
				[
					'label' 	=> esc_html__( 'Background Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing .pricing-btn:hover' => 'background-color: {{VALUE}};',
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
	                    '{{WRAPPER}} .ova-pricing .pricing-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-pricing .pricing-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-pricing .pricing-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'button_border',
					'label' => esc_html__( 'Border', 'mellis' ),
					'selector' => '{{WRAPPER}} .ova-pricing .pricing-btn',
				]
			);


			$this->add_control(
				'button_border_hover',
				[
					'label' 	=> esc_html__( 'Border Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing .pricing-btn:hover' => 'border-color: {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
		/* End button style */

		
	}

	// Render Template Here
	protected function render() {

		$settings =	$this->get_settings();

		$template = $settings['template'];

		$title             =    $settings['title'];
		$description       =    $settings['description'];
		$currency_unit     =    $settings['currency_unit'];
		$price             =    $settings['price'];
		$period            =    $settings['period'];
		$class_icon        =    $settings['class_icon']['value'];
		$list_service_text =    $settings['list_service_text'];

		$text_button       =    $settings['text_button'];
		$link              =    $settings['link'];
		$nofollow          =    ( isset( $link['nofollow'] ) && $link['nofollow'] ) ? 'rel=nofollow' : '';
		$target            =    ( isset( $link['is_external'] ) && $link['is_external'] !== '' ) ? 'target=_blank' : ''; 

		$active_mode = $settings['active_mode'];
		if($active_mode == 'yes') {
			$active = 'active';
		} else {
			$active = '';
		}

		?>
           

           <div class="ova-pricing <?php echo esc_attr( $template ); ?> <?php echo esc_attr( $active ); ?>"> 

           		<?php if( $template == 'template1' ) : ?>
                    <div class="icon-title">
	           			<?php if( !empty( $title ) ) : ?>
			                <h3 class="title"><?php echo esc_html( $title ) ; ?></h3>
	                	<?php endif; ?>

	                	<?php if( !empty( $class_icon ) ) : ?> 
			                <i class="<?php echo esc_attr( $class_icon ) ;?>"></i>
			            <?php endif; ?>
	           		</div>
           		<?php endif; ?>

           		<?php if( $template == 'template2' ) : ?>
           			<div class="icon-title">

           				<?php if( !empty( $class_icon ) ) : ?> 
			                <i class="<?php echo esc_attr( $class_icon ) ;?>"></i>
			            <?php endif; ?>

			            <?php if( !empty( $title ) ) : ?>
			                <h3 class="title"><?php echo esc_html( $title ) ; ?></h3>
	                	<?php endif; ?>

	                	<div class="price">
							<?php if( !empty( $price ) ) :?>
				                <div class="ova-price">
				                	<span><?php echo esc_html( $currency_unit ) ;?></span> 
				                	<span> <?php echo esc_html( $price ); ?></span>
				                </div>
				                <span class="period"><?php echo esc_html( $period ); ?></span>
				            <?php endif; ?>
	                	</div>

	                	<?php if( !empty( $description ) ) : ?>
			                <p class="description"><?php echo esc_html( $description ) ; ?></p>
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
           		<?php endif; ?>

                <div class="pricing-service">

                	<?php if( $template == 'template1' ) : ?>
	                	<div class="price">
							<?php if( !empty( $price ) ) :?>
				                <div class="ova-price">
				                	<span><?php echo esc_html( $currency_unit ) ;?></span> 
				                	<span> <?php echo esc_html( $price ); ?></span>
				                </div>
				                <span class="period"><?php echo esc_html( $period ); ?></span>
				            <?php endif; ?>
	                	</div>

	                	<?php if( !empty( $description ) ) : ?>
			                <p class="description"><?php echo esc_html( $description ) ; ?></p>
	                	<?php endif; ?>
	                <?php endif; ?>

	                <?php if( $list_service_text != '' ): ?>
	                    <ul class="pricing-service-list">
	                    	<?php foreach( $list_service_text as $list_st ) { 
                                $class_icon_text_service = $list_st['class_icon_text_service']['value'];
	                    	?>
		                        <li class="item">
		                            <i class="<?php echo esc_attr( $class_icon_text_service ) ; ?>"></i>
		                            <span class="text_service"><?php echo esc_html( $list_st['text_service'] ) ; ?></span> 
		                        </li>
	                       <?php } ?>
	                    </ul>
	                <?php endif; ?>

	                <?php if( !empty( $text_button ) && $template == 'template1' ) : ?>
		                <a <?php if( !empty( $link['url'] ) ) : ?> href="<?php echo esc_url( $link['url'] ) ;?>" <?php endif; ?> 
		                    class="pricing-btn" <?php echo esc_attr( $nofollow ) ;?> <?php echo esc_attr( $target ) ;?> title="<?php echo esc_attr( $text_button ); ?>">
	                        <span class="text-button">
	                        	<?php echo esc_html( $text_button ) ;?>
	                        </span>
		                </a>
		            <?php endif; ?>

                </div>

            </div>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Mellis_Elementor_Pricing() );