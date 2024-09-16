<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Mellis_Elementor_Gallery_Slide extends Widget_Base {

	public function get_name() {
		return 'mellis_elementor_gallery_slide';
	}

	public function get_title() {
		return esc_html__( 'Ova Gallery Slide', 'mellis' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'mellis' ];
	}

	public function get_script_depends() {
		wp_enqueue_style( 'fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.css' );
		wp_enqueue_script( 'fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.umd.js', array('jquery'), false, true );
		return [ 'mellis-elementor-gallery-slide' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		/* Content */
		$this->start_controls_section(
				'section_content',
				[
					'label' => esc_html__( 'Content', 'mellis' ),
				]
			);	

			$repeater = new \Elementor\Repeater();


			$repeater->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'mellis' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'ovaicon-diagonal-arrow',
						'library' => 'all',
					],		
				]
			);

			$repeater->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'mellis' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'mellis' ),
					'options' => [ 'url', 'is_external', 'nofollow' ],
					'default' => [
						'url' => '',
						'is_external' => false,
						'nofollow' => false,
					],
					'description' => esc_html__('( If you enter the link, it will redirect to the link instead of Fancybox popup )','mellis'),
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'video_link',
				[
					'label' => esc_html__( 'Embed Video Link', 'mellis' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'mellis' ),
					'options' => [ 'url', 'is_external', 'nofollow' ],
					'default' => [
						'url' => '',
						'is_external' => false,
						'nofollow' => false,
					],
					'description' => 'https://www.youtube.com/watch?v=MLpWrANjFbI',
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'mellis' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 3,
					'default' => esc_html__( 'Body Massage', 'mellis' ),
				]
			);

			$repeater->add_control(
				'category',
				[
					'label' => esc_html__( 'Category', 'mellis' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 3,
					'default' => esc_html__( 'Spa & Beauty', 'mellis' ),
				]
			);

			$repeater->add_control(
				'image',
				[
					'label' => esc_html__( 'Gallery Image', 'mellis' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'image_popup',
				[
					'label' => esc_html__( 'Popup Image', 'mellis' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'list',
				[
					'label' => esc_html__( 'Items', 'mellis' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'title' => esc_html__( 'Skin Treatments', 'mellis' ),
						],
						[
							'title' => esc_html__( 'Body Massage', 'mellis' ),
						],
						[
							'title' => esc_html__( 'Body Massage 2', 'mellis' ),
						],
						[
							'title' => esc_html__( 'Hydro Therapy', 'mellis' ),
						],
						[
							'title' => esc_html__( 'Skin Treatments 2', 'mellis' ),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

		/* Additional Options */
		$this->start_controls_section(
				'section_additional_options',
				[
					'label' => esc_html__( 'Additional Options', 'mellis' ),
				]
			);

			$this->add_control(
				'margin_items',
				[
					'label'   => esc_html__( 'Margin Right Items', 'mellis' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 45,
				]
			);


			$this->add_control(
				'item_number',
				[
					'label'       => esc_html__( 'Item Number', 'mellis' ),
					'type'        => Controls_Manager::NUMBER,
					'description' => esc_html__( 'Number Item', 'mellis' ),
					'default'     => 3,
				]
			);

			$this->add_control(
				'slides_to_scroll',
				[
					'label'       => esc_html__( 'Slides to Scroll', 'mellis' ),
					'type'        => Controls_Manager::NUMBER,
					'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'mellis' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'   => esc_html__( 'Pause on Hover', 'mellis' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'mellis' ),
						'no'  => esc_html__( 'No', 'mellis' ),
					],
					'frontend_available' => true,
				]
			);


			$this->add_control(
				'infinite',
				[
					'label'   => esc_html__( 'Infinite Loop', 'mellis' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'mellis' ),
						'no'  => esc_html__( 'No', 'mellis' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'   => esc_html__( 'Autoplay', 'mellis' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
					'options' => [
						'yes' => esc_html__( 'Yes', 'mellis' ),
						'no'  => esc_html__( 'No', 'mellis' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'     => esc_html__( 'Autoplay Speed', 'mellis' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 3000,
					'step'      => 500,
					'condition' => [
						'autoplay' => 'yes',
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'smartspeed',
				[
					'label'   => esc_html__( 'Smart Speed', 'mellis' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 500,
				]
			);

			$this->add_control(
				'dot_control',
				[
					'label'   => esc_html__( 'Show Dots', 'mellis' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
					'options' => [
						'yes' => esc_html__( 'Yes', 'mellis' ),
						'no'  => esc_html__( 'No', 'mellis' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'nav_control',
				[
					'label'   => esc_html__( 'Show Nav', 'mellis' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
					'options' => [
						'yes' => esc_html__( 'Yes', 'mellis' ),
						'no'  => esc_html__( 'No', 'mellis' ),
					],
					'frontend_available' => true,
				]
			);

		$this->end_controls_section();
	    
		//SECTION TAB STYLE General
		$this->start_controls_section(
				'section_general_style',
				[
					'label' => esc_html__( 'General', 'mellis' ),
					'tab' 	=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'icon_box_padding',
				[
					'label' => esc_html__( 'Padding', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_heading',
				[
					'label' => esc_html__( 'Icon', 'mellis' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);

			$this->add_responsive_control(
				'icon_box_size',
				[
					'label' => esc_html__( 'Icon Size', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 10,
							'max' => 70,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_rotate',
				[
					'label' => esc_html__( 'Rotate', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'deg', 'grad', 'rad', 'turn', 'custom' ],
					'default' => [
						'unit' => 'deg',
					],
					'tablet_default' => [
						'unit' => 'deg',
					],
					'mobile_default' => [
						'unit' => 'deg',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .icon i, {{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
					],
				]
			);

			$this->add_control(
				'icon_box_color',
				[
					'label' => esc_html__( 'Icon Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .icon svg' => 'fill: {{VALUE}}',
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .icon svg path' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_box_background_color',
				[
					'label' => esc_html__( 'Background Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .icon' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'overlay_heading',
				[
					'label' => esc_html__( 'Overlay', 'mellis' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);

			$this->add_control(
				'image_overlay_hover',
				[
					'label' => esc_html__( 'Background Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery:before' => 'background-color: {{VALUE}}',
					],
				]
			);


		$this->end_controls_section();

		/* Title */
		$this->start_controls_section(
				'title_style_section',
				[
					'label' => esc_html__( 'Title', 'mellis' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label' => esc_html__( 'Margin', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_padding',
				[
					'label' => esc_html__( 'Padding', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'title_bgcolor',
				[
					'label' => esc_html__( 'Background Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .title' => 'background-color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Category */
		$this->start_controls_section(
				'category_style_section',
				[
					'label' => esc_html__( 'Category', 'mellis' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'category_margin',
				[
					'label' => esc_html__( 'Margin', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'category_padding',
				[
					'label' => esc_html__( 'Padding', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'category_typography',
					'selector' => '{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .category',
				]
			);

			$this->add_control(
				'category_color',
				[
					'label' => esc_html__( 'Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .category' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'category_bgcolor',
				[
					'label' => esc_html__( 'Background Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .gallery-box .list-gallery .icon-box .category' => 'background-color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
		
		// SECTION TAB STYLE DOTS
		$this->start_controls_section(
			'section_dots',
			[
				'label' 	=> esc_html__( 'Dots', 'mellis' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'dot_control' => 'yes',
				],
			]
		);

			$this->add_responsive_control(
			 	'position_dots',
			  	[
				  	'label' 	=> esc_html__( 'Position', 'mellis' ),
				  	'type' 		=> \Elementor\Controls_Manager::CHOOSE,
				  	'options' 	=> [
					  	'absolute' => [
						  	'title' => esc_html__( 'Absolute', 'mellis' ),
						  	'icon' 	=> 'eicon-text-align-left',
					  	],
					  	'relative' => [
						  	'title' => esc_html__( 'Relative', 'mellis' ),
						  	'icon' 	=> 'eicon-text-align-center',
					  	],
					  	 
				  	],
				  	'toggle' 	=> true,
				  	'selectors' => [
					  	'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-dots' => 'position: {{VALUE}};',
				  	],
			  	]
			);

			$this->add_responsive_control(
				'position_bottom',
				[
					'label' 		=> esc_html__( 'Position Bottom', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 70,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'dots_margin',
				[
					'label' => esc_html__( 'Margin', 'mellis' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'position_dots' => 'relative',
					],
				]
			);


			$this->add_control(
				'style_dots',
				[
					'label' 	=> esc_html__( 'Dots', 'mellis' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'dot_control' => 'yes',
					],
				]
			);

			$this->add_control(
				'dot_color',
				[
					'label'     => esc_html__( 'Dot Color', 'mellis' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .owl-carousel .owl-dots button' => 'background-color : {{VALUE}};',
						
					],
					'condition' => [
						'dot_control' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'dot_width',
				[
					'label' 		=> esc_html__( 'Dots width', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 70,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-dots button' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'dot_height',
				[
					'label' 		=> esc_html__( 'Dots Height', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 70,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-dots button' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'border_radius_dot',
				array(
					'label'      => esc_html__( 'Border Radius', 'mellis' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-dots button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_control(
				'style_dot_active',
				[
					'label' 	=> esc_html__( 'Dots Active', 'mellis' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'dot_control' => 'yes',
					],
				]
			);

			$this->add_control(
				'dot_color_active',
				[
					'label'     => esc_html__( 'Dot Color Active', 'mellis' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-dots button.active' => 'background-color : {{VALUE}};',
						
					],
					'condition' => [
						'dot_control' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'dot_width_active',
				[
					'label' 		=> esc_html__( 'Dots Width Active', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 70,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-dots button.active' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'dot_height_active',
				[
					'label' 		=> esc_html__( 'Dots Height Active', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 70,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-dots button.active' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);


		$this->end_controls_section();
		//END SECTION TAB STYLE DOTS
		
		//SECTION TAB STYLE NAV
		$this->start_controls_section(
			'section_nav',
			[
				'label' 	=> esc_html__( 'Nav', 'mellis' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'nav_control' => 'yes',
				],
			]
		);

			$this->add_responsive_control(
				'nav_size',
				[
					'label' 		=> esc_html__( 'Nav Size', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 70,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-nav button' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_size',
				[
					'label' 		=> esc_html__( 'Icon Size', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 30,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-nav button i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);


			$this->add_responsive_control(
				'border_radius_nav',
				array(
					'label'      => esc_html__( 'Border Radius', 'mellis' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->start_controls_tabs( 'tabs_nav_style' );

				$this->start_controls_tab(
		            'tab_nav',
		            [
		                'label' => esc_html__( 'Normal', 'mellis' ),
		            ]
		        );

					$this->add_control(
						'nav_color',
						[
							'label'     => esc_html__( 'Color', 'mellis' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-nav button' => 'color : {{VALUE}};',		
							],
							'condition' => [
								'nav_control' => 'yes',
							],
						]
					);

					$this->add_control(
						'nav_bg',
						[
							'label'     => esc_html__( 'Background', 'mellis' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-nav button' => 'background-color : {{VALUE}};',
							],
							'condition' => [
								'nav_control' => 'yes',
							],
						]
					);

				$this->end_controls_tab();

			    $this->start_controls_tab(
		            'tab_hover',
		            [
		                'label' => esc_html__( 'Hover', 'mellis' ),
		            ]
		        );
		        	$this->add_control(
						'nav_next_color_hover',
						[
							'label'     => esc_html__( 'Color', 'mellis' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-nav button:hover ' => 'color : {{VALUE}};',		
							],
							'condition' => [
								'nav_control' => 'yes',
							],
						]
					);

					$this->add_control(
						'nav_bg_hover',
						[
							'label'     => esc_html__( 'Background', 'mellis' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-slide .gallery-slide .owl-nav button:hover' => 'background-color : {{VALUE}};',
								
							],
							'condition' => [
								'nav_control' => 'yes',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

		$this->end_controls_section();
		// END SECTION TAB STYLE NAV
		
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings_for_display();

		$list = $settings['list'];

        // data option for slide
		$data_options['items']         		= $settings['item_number'];
		$data_options['margin']         	= $settings['margin_items'];
		$data_options['slideBy']            = $settings['slides_to_scroll'];
		$data_options['autoplayHoverPause'] = $settings['pause_on_hover'] === 'yes' ? true : false;
		$data_options['loop']               = $settings['infinite'] === 'yes' ? true : false;
		$data_options['autoplay']           = $settings['autoplay'] === 'yes' ? true : false;
		$data_options['autoplayTimeout']    = $settings['autoplay_speed'];
		$data_options['smartSpeed']         = $settings['smartspeed'];
		$data_options['dots']               = $settings['dot_control'] === 'yes' ? true : false;
		$data_options['nav']                = $settings['nav_control'] === 'yes' ? true : false;
		$data_options['rtl']                = is_rtl() ? true : false;	

		?>

		<?php if ( !empty($list) ) : ?>

			<div class="ova-gallery-slide">
				<div class="gallery-slide owl-carousel" data-options="<?php echo esc_attr(json_encode($data_options)); ?>" >

					<?php foreach ( $list as $key => $item ) :

						$icon 			= $item['icon'];
						$title 			= $item['title'];
						$category 		= $item['category'];
						$image_id 		= $item['image']['id']; 
                        $img_url 	    = $item['image']['url'] ;
                        $img_popup_id 	= $item['image_popup']['id'];
                        $img_popup_url 	= $item['image_popup']['url'];

                        $alt 			= get_post_meta($image_id, '_wp_attachment_image_alt', true) ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : esc_html__('Gallery Slide','mellis');  

                        $caption        = wp_get_attachment_caption( $image_id );

                        if ( ! $img_popup_url ) {
                        	$img_popup_url = $img_url;
                        }
                        if ( $caption == '') {
                        	$caption = $alt;
                        }

                        // link
	  					$video_link = $item['video_link']['url'];
                        $link 		= $item['link']['url'];
						$target 	= $item['link']['is_external'] ? 'target="_blank"' : '';
                        
						?>

							<div class="gallery-box ">

								<?php if( $video_link ) { ?>
	                            	<a href="#" class="gallery-fancybox" data-src="<?php echo esc_url( $video_link ); ?>" 
	                            		href="<?php echo esc_attr($video_link); ?>"
		  								data-fancybox="gallery-slide" 
		  								data-caption="<?php echo esc_attr( $caption ); ?>">
		  						<?php } elseif ( $link ) { ?>
		  							<a href="<?php echo esc_attr($link); ?>" <?php printf( $target ); ?>>
	                            <?php } else { ?>
	                            	<a href="#" class="gallery-fancybox" data-src="<?php echo esc_url( $img_popup_url ); ?>" 
		  								data-fancybox="gallery-slide" 
		  								data-caption="<?php echo esc_attr( $caption ); ?>">
	                            <?php } ?>

									<div class="list-gallery">
		                                
										<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
										
										<div class="icon-box">
											<div class="icon">
												<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
											</div>

											<div class="info">
												<?php if ( $title ) : ?>
													<h3 class="title"><?php echo esc_html( $title ); ?></h3>
												<?php endif; ?>
												<?php if ( $category ) : ?>
													<span class="category"><?php echo esc_html( $category ); ?></span>
												<?php endif; ?>
											</div>
										</div>

									</div>

								</a>

							</div>
							
						<?php endforeach; ?>

				</div>
			</div>

		<?php endif; ?>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Mellis_Elementor_Gallery_Slide() );