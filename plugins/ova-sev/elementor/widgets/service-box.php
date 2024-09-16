<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Ovasev_Elementor_Service_Box extends Widget_Base {

	
	public function get_name() {
		return 'ovasev_elementor_service_box';
	}

	
	public function get_title() {
		return esc_html__( 'Service Box', 'ova-sev' );
	}

	
	public function get_icon() {
		return 'eicon-icon-box';
	}

	
	public function get_categories() {
		return [ 'ovasev' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'ova-sev' ),
			]
		);	


		    // Add Class control
			$this->add_control(
				'template',
				[
					'label' => esc_html__( 'Template', 'ova-sev' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'template2',
					'options' => [
						'template1' => esc_html__('Template 1', 'ova-sev'),
						'template2' => esc_html__('Template 2', 'ova-sev'),
						'template3' => esc_html__('Template 3', 'ova-sev'),
						'template4' => esc_html__('Template 4', 'ova-sev'),
					]
				]
			);

			$this->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'ova-sev' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default'  	=> esc_html__( 'Default', 'ova-sev' ),
						'new_page' 	=> esc_html__( 'New Page', 'ova-sev' ),
					],
				]
			);

			$this->add_control(
				'custom_link',
				[
					'label' 		=> esc_html__( 'Custom Link', 'ova-sev' ),
					'type' 			=> \Elementor\Controls_Manager::URL,
					'placeholder' 	=> esc_html__( 'https://your-link.com', 'ova-sev' ),
					'dynamic' 		=> [
						'active' => true,
					],
					'default' => [
						'url' 			=> '#',
						'is_external' 	=> false,
						'nofollow' 		=> false,
					],
					'condition' => [
						'link' => 'new_page',
					],
				]
			);

			$this->add_control(
				'number_column',
				[
					'label' => esc_html__( 'Column', 'ova-sev' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'three_column',
					'options' => [
						'one_column' => esc_html__('Single Column', 'ova-sev'),
						'two_column' => esc_html__('2 Column', 'ova-sev'),
						'three_column' => esc_html__('3 Column', 'ova-sev'),
						'four_column' => esc_html__('4 Column', 'ova-sev'),
						'five_column' => esc_html__('5 Column', 'ova-sev'),
						'six_column' => esc_html__('6 Column', 'ova-sev'),
					]
				]
			);

			$args = array(
				'taxonomy' 	=> 'cat_sev',
			  	'orderby' 	=> 'name',
			  	'order' 	=> 'ASC'
			);

			$categories  	= get_categories($args);
			$cate_array 	= array();
			$arrayCateAll 	= array( 'all' => esc_html__( 'All categories', 'ova-sev' ) );
			
			if ($categories) {
				foreach ( $categories as $cate ) {
					$cate_array[$cate->slug] = $cate->cat_name;
				}
			} else {
				$cate_array[ esc_html__( 'No content Category found', 'ova-sev' ) ] = 0;
			}

			$this->add_control(
				'category',
				[
					'label' 	=> esc_html__( 'Category', 'ova-sev' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'all',
					'options' 	=> array_merge($arrayCateAll,$cate_array),
				]
			);

			$this->add_control(
				'post_per_page',
				[
					'label'   => esc_html__( 'Post Per Page', 'ova-sev' ),
					'type'    => Controls_Manager::NUMBER,
					'min'     => 1,
					'default' => 3
				]
			);

			$this->add_control(
				'order_by',
				[
					'label'   => esc_html__( 'Order By', 'ova-sev' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'date',
					'options' => [
						'title' 	=> esc_html__( 'Title', 'ova-sev' ),
						'date' 		=> esc_html__( 'Date', 'ova-sev' ),
						'ID' 		=> esc_html__( 'ID', 'ova-sev' ),
						'ova_sev_met_order_sev'  => esc_html__( 'Custom Order', 'ova-sev' ),		
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label'   => esc_html__( 'Order', 'ova-sev' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'DESC',
					'options' => [
						'DESC' => esc_html__( 'Descending', 'ova-sev' ),
						'ASC'  => esc_html__( 'Ascending', 'ova-sev' ),
					],
				]
			);

			$this->add_control(
				'text_button',
				[
					'label'   => esc_html__( 'Text Button', 'ova-sev' ),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__( 'Book Now', 'ova-sev' ),
					'condition' => [
						'template' => 'template1'
					]
				]
			);

			$this->add_control(
				'show_description',
				[
					'label' => esc_html__( 'Show Description', 'prooty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'prooty' ),
					'label_off' => esc_html__( 'Hide', 'prooty' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

		$this->end_controls_section();

		 //******Service box style*****/
		$this->start_controls_section(
			'section_service_box_style',
			[
				'label' => esc_html__( 'Service box', 'ova-sev' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		    $this->add_control(
				'background_image',
				[
					'label'   => esc_html__( 'Background Image', 'ova-sev' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'condition' => [
						'template' => ['template1','template2']
					]
				]
			);

			$this->add_control(
				'bgcolor_service_box',
				[
					'label' => esc_html__( 'Background Color', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bgcolor_service_box_hover',
				[
					'label' => esc_html__( 'Background Color Hover', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box:hover' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'boder_service_box_hover',
				[
					'label' => esc_html__( 'Border Color Hover', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box:hover' => 'border-color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_service_box',
				[
					'label' => esc_html__( 'Padding', 'ova-sev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'border_radius_service_box',
				[
					'label' => esc_html__( 'Border Radius', 'ova-sev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => esc_html__( 'Box Shadow', 'ova-sev' ),
					'selector' => '{{WRAPPER}} .ova-service-box-elementor .ova-service-box',
				]
			);

        $this->end_controls_section();

        //****** Image *****/
		$this->start_controls_section(
			'section_image_style',
			[
				'label' => esc_html__( 'Image', 'ova-sev' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'template' => ['template1','template3']
				]
			]
		);

            $this->add_control(
				'image_size',
				[
					'label' => esc_html__( 'Size', 'ova-sev' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 100,
							'max' => 240,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-service-box .img-service img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'template' => 'template1'
					]
				]
			);

			$this->add_control(
				'image_height',
				[
					'label' => esc_html__( 'Height', 'ova-sev' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 200,
							'max' => 440,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-service-box .img-service img' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'template' => 'template3'
					]
				]
			);

			$this->add_responsive_control(
				'image_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'ova-sev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-service-box .img-service img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);		

        $this->end_controls_section();

        //****** Icon *****/
		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'ova-sev' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
				'icon_size',
				[
					'label' => esc_html__( 'Icon Size', 'ova-sev' ),
					'type' 	=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 40,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Icon Color', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box .icon i' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bgcolor_icon',
				[
					'label' => esc_html__( 'Background Color', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box-template1 .img-service .icon' => 'background-color : {{VALUE}};',
					],
					'condition' => [
	                	'template' => 'template1',
	                ]
				],
			);

        $this->end_controls_section();

        //******Title Service*****/
		$this->start_controls_section(
			'section_title_service_style',
			[
				'label' => esc_html__( 'Title', 'ova-sev' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_service_typography_t4',
					'selector' => '{{WRAPPER}} .ova-service-box-elementor .ova-service-box-template4 .title',
					'condition' => [
						'template' => 'template4'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_service_typography_t3',
					'selector' => '{{WRAPPER}} .ova-service-box-elementor .ova-service-box-template3 .title',
					'condition' => [
						'template' => 'template3'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_service_typography_t2',
					'selector' => '{{WRAPPER}} .ova-service-box-elementor .ova-service-box-template2 .title',
					'condition' => [
						'template' => 'template2'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_service_typography_t1',
					'selector' => '{{WRAPPER}} .ova-service-box-elementor .ova-service-box-template1 .info .title',
					'condition' => [
						'template' => 'template1'
					]
				]
			);

			$this->add_control(
				'color_title_service',
				[
					'label' => esc_html__( 'Color', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_title_service_hover',
				[
					'label' => esc_html__( 'Color Hover', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box:hover .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_title_service',
				[
					'label' => esc_html__( 'Padding', 'ova-sev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_title_service',
				[
					'label' => esc_html__( 'Margin', 'ova-sev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

        //******Descriprion ( Excerpt )*****/
		$this->start_controls_section(
			'section_description_service_style',
			[
				'label' => esc_html__( 'Description', 'ova-sev' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_description' => 'yes'
				]
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'description_service_typography_t4',
					'selector' => '{{WRAPPER}} .ova-service-box-elementor .ova-service-box-template4 .description',
					'condition' => [
						'template' => 'template4'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'description_service_typography_t3',
					'selector' => '{{WRAPPER}} .ova-service-box-elementor .ova-service-box-template3 .description',
					'condition' => [
						'template' => 'template3'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'description_service_typography_t2',
					'selector' => '{{WRAPPER}} .ova-service-box-elementor .ova-service-box-template2 .description',
					'condition' => [
						'template' => 'template2'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'description_service_typography_t1',
					'selector' => '{{WRAPPER}} .ova-service-box-elementor .ova-service-box-template1 .info .description',
					'condition' => [
						'template' => 'template1'
					]
				]
			);

			$this->add_control(
				'color_description_service',
				[
					'label' => esc_html__( 'Color', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box .description' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_description_service_hover',
				[
					'label' => esc_html__( 'Color Hover', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box:hover .description' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_description_service',
				[
					'label' => esc_html__( 'Padding', 'ova-sev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_description_service',
				[
					'label' => esc_html__( 'Margin', 'ova-sev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

        //****** Button *****/
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__( 'Button', 'ova-sev' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
                	'template' => 'template1',
                ]
			]
		);

            $this->add_control(
				'icon_button_size',
				[
					'label' 		=> esc_html__( 'Icon Size', 'ova-sev' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 40,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box .book-button i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'button_typography',
					'selector' =>'{{WRAPPER}} .ova-service-box-elementor .ova-service-box .book-button',
				]
			);

			$this->add_control(
				'button_color',
				[
					'label' => esc_html__( 'Color', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box .book-button' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-box-elementor .ova-service-box .book-button:hover' => 'color : {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
	}

	// Render Template Here
	protected function render() {

		$settings       = $this->get_settings();
		$template       = apply_filters( 'el_ovasev_service_box', 'elementor/service-box.php' );

		ob_start();
		ovasev_get_template( $template, $settings );
		echo ob_get_clean();
	}
	
}

$widgets_manager->register( new Ovasev_Elementor_Service_Box() );