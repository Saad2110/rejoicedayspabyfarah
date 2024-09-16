<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Mellis_Elementor_Toggle_Content extends Widget_Base {

	public function get_name() {
		return 'mellis_elementor_toggle_content';
	}

	public function get_title() {
		return esc_html__( 'Toggle Content', 'mellis' );
	}

	public function get_icon() {
		return 'eicon-menu-toggle';
	}

	public function get_categories() {
		return [ 'mellis' ];
	}

	public function get_script_depends() {
		return [ 'mellis-elementor-toggle-content' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Toggle Content', 'mellis' ),
			]
		);	
			
			$this->add_control(
				'menu_pos',
				[
					'label' => esc_html__( 'Menu Direction', 'mellis' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'pos_left' => [
							'title' => esc_html__( 'Left', 'mellis' ),
							'icon' => 'eicon-h-align-left',
						],
						'pos_right' => [
							'title' => esc_html__( 'Right', 'mellis' ),
							'icon' => 'eicon-h-align-right',
						],
					],
					'default' => 'pos_right',
				]
			);

			$this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'mellis' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'ovaicon-menu-1',
						'library' 	=> 'all',
					],
				]
			);

			$this->add_control(
				'content_heading',
				[
					'label' => esc_html__( 'Content', 'mellis' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'image',
				[
					'label' => esc_html__( 'Choose Image', 'mellis' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'content_title',
				[
					'label' => esc_html__( 'Title', 'mellis' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'About Us', 'mellis' ),
				]
			);

			$this->add_control(
				'description',
				[
					'label' => esc_html__( 'Description', 'mellis' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 10,
					'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'mellis' ),
				]
			);

			$this->add_control(
				'button_contact_heading',
				[
					'label' => esc_html__( 'Button Contact', 'mellis' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'button_contact_link',
				[
					'label' => esc_html__( 'Link', 'mellis' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'mellis' ),
					'options' => [ 'url', 'is_external', 'nofollow' ],
					'default' => [
						'url' => '#',
						'is_external' => false,
						'nofollow' => false,
					],
				]
			);

			$this->add_control(
				'button_contact_text',
				[
					'label' => esc_html__( 'Text', 'mellis' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( ' Get a Quote ', 'mellis' ),
					'condition' => [
						'button_contact_link[url]!' => '',
					],
				]
			);

			$this->add_control(
				'button_contact_icon',
				[
					'label' => esc_html__( 'Icon', 'mellis' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-angle-double-right',
						'library' => 'fa-solid',
					],
					'condition' => [
						'button_contact_link[url]!' => '',
					],
				]
			);

			$this->add_control(
				'social_heading',
				[
					'label' => esc_html__( 'Contact Info', 'mellis' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'social_title',
				[
					'label' => esc_html__( 'Title', 'mellis' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Contact Us', 'mellis' ),
				]
			);

			$repeater1 = new \Elementor\Repeater();

				$repeater1->add_control(
					'contact_icon',
					[
						'label' => esc_html__( 'Icon', 'mellis' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' => [
							'value' => 'far fa-bell',
							'library' => 'all',
						],
					]
				);

				$repeater1->add_control(
					'contact_label',
					[
						'label'   => esc_html__( 'Label', 'mellis' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
					]
				);

				$repeater1->add_control(
					'contact_link',
					[
						'label'   => esc_html__( 'Link', 'mellis' ),
						'type'    => \Elementor\Controls_Manager::URL,
						'description' => esc_html__( 'https://your-domain.com', 'mellis' ),
						'default' => [
							'url' => '#',
							'is_external' => false,
							'nofollow' => false,
						],
					]
				);

				$this->add_control(
					'items_1',
					[
						'label'       => esc_html__( 'Contact', 'mellis' ),
						'type'        => Controls_Manager::REPEATER,
						'fields'      => $repeater1->get_controls(),
						'default' => [
							[	
								'contact_icon' => [
									'value'    => 'far fa-bell',
									'library'  => 'all',
								],
								'contact_label'  => '92 666 888 0000',
								'contact_link'  => [
									'url' => 'tel:926668880000',
								]
							],
							[
								'contact_icon' => [
									'value'    => 'fab fa-telegram-plane',
									'library'  => 'all',
								],
								'contact_label'  => 'needhelp@example.com',
								'contact_link'  => [
									'url' => 'mailto:needhelp@example.com',
								]
							],
							[
								'contact_icon' => [
									'value'    => 'fas fa-globe',
									'library'  => 'all',
								],
								'contact_label'  => 'www.example.com',
								'contact_link'  => [
									'url' => 'https://ovatheme.com/',
								]
							],
							[
								'contact_icon' => [
									'value'    => 'ovaicon ovaicon-placeholder',
									'library'  => 'ovaicon',
								],
								'contact_label'  => '57 Main Street, 2nd Block, USA',
								'contact_link'  => [
									'url' => 'https://www.google.com/maps',
								]
							],
						],
						'title_field' => '{{{ contact_label }}}',
					]
				);

			$repeater2 = new \Elementor\Repeater();

				$repeater2->add_control(
					'social_icon',
					[
						'label' => esc_html__( 'Icon', 'mellis' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' => [
							'value' => 'fab fa-twitter',
							'library' => 'all',
						],
					]
				);

				$repeater2->add_control(
					'social_link',
					[
						'label' => esc_html__( 'Link', 'mellis' ),
						'type' => \Elementor\Controls_Manager::URL,
						'placeholder' => esc_html__( 'https://your-link.com', 'mellis' ),
						'options' => [ 'url', 'is_external', 'nofollow' ],
						'default' => [
							'url' => '#',
							'is_external' => true,
							'nofollow' => true,
						],
					]
				);

				$this->add_control(
					'items_2',
					[
						'label'       => esc_html__( 'Socials', 'mellis' ),
						'type'        => Controls_Manager::REPEATER,
						'fields'      => $repeater2->get_controls(),
						'default' => [
							[
								'social_link'  =>[
									'url' => 'https://www.twitter.com/',
									'is_external' => true,
									'nofollow' => true,
								],
							],
							[
								'social_icon' => [
									'value'    => 'ovaicon ovaicon-facebook-logo-1',
									'library'  => 'all',
								],
								'social_link'  =>[
									'url' => 'https://www.facebook.com/',
									'is_external' => true,
									'nofollow' => true,
								],
							],
							[
								'social_icon' => [
									'value'    => 'fab fa-linkedin-in',
									'library'  => 'all',
								],
								'social_link'  =>[
									'url' => 'https://www.linkedin.com/',
									'is_external' => true,
									'nofollow' => true,
								],
							],
							[
								'social_icon' => [
									'value'    => 'ovaicon ovaicon-instagram',
									'library'  => 'all',
								],
								'social_link'  =>[
									'url' => 'https://www.instagram.com/',
									'is_external' => true,
									'nofollow' => true,
								],
							],
						],
					]
				);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_section',
			[
				'label' => esc_html__( 'Toggle Button Icon', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'button_size',
				[
					'label' => esc_html__( 'Button Size', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 300,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .button-toggle' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_size',
				[
					'label' => esc_html__( 'Icon Size', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .button-toggle i' => 'font-size: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-toggle-content .button-toggle svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .button-toggle i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-toggle-content .button-toggle svg' => 'fill: {{VALUE}}',
						'{{WRAPPER}} .ova-toggle-content .button-toggle svg path' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .button-toggle:hover i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-toggle-content .button-toggle:hover svg' => 'fill: {{VALUE}}',
						'{{WRAPPER}} .ova-toggle-content .button-toggle:hover svg path' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'icon_border',
					'selector' => '{{WRAPPER}} .ova-toggle-content .button-toggle',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'icon_box_shadow',
					'selector' => '{{WRAPPER}} .ova-toggle-content .button-toggle',
				]
			);

			$this->add_control(
				'icon_border_color_hover',
				[
					'label' => esc_html__( 'Border Color Hover', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .button-toggle:hover' => 'border-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .button-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_title_section',
			[
				'label' => esc_html__( 'Content Title', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'content_title_typography',
					'selector' => '{{WRAPPER}} .ova-toggle-content .content .wrap-content .content-title',
				]
			);

			$this->add_control(
				'content_title_color',
				[
					'label' => esc_html__( 'Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .content-title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'content_title_margin',
				[
					'label' => esc_html__( 'Margin', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .content-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_description_section',
			[
				'label' => esc_html__( 'Description', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'content_description_typography',
					'selector' => '{{WRAPPER}} .ova-toggle-content .content .wrap-content .description',
				]
			);

			$this->add_control(
				'content_description_color',
				[
					'label' => esc_html__( 'Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .description' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'content_description_margin',
				[
					'label' => esc_html__( 'Margin', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_contact_section',
			[
				'label' => esc_html__( 'Button Contact', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'button_contact_typography',
					'selector' => '{{WRAPPER}} .ova-toggle-content .content .wrap-content .button-contact',
				]
			);

			$this->add_control(
				'button_contact_color',
				[
					'label' => esc_html__( 'Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .button-contact' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_contact_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .button-contact:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_contact_background_color',
				[
					'label' => esc_html__( 'Background Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .button-contact' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_contact_background_color_hover',
				[
					'label' => esc_html__( 'Background Color Hover', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .button-contact:hover' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'button_contact_padding',
				[
					'label' => esc_html__( 'Padding', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .button-contact' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_contact_margin',
				[
					'label' => esc_html__( 'Margin', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .button-contact' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'contact_info_title_section',
			[
				'label' => esc_html__( 'Contact Info Title', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'contact_info_title_typography',
					'selector' => '{{WRAPPER}} .ova-toggle-content .content .wrap-content .contact-info-title',
				]
			);

			$this->add_control(
				'contact_info_title_color',
				[
					'label' => esc_html__( 'Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .contact-info-title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'contact_info_title_margin',
				[
					'label' => esc_html__( 'Margin', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .contact-info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'contact_item_section',
			[
				'label' => esc_html__( 'Contact Item', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'contact_item_typography',
					'selector' => '{{WRAPPER}} .ova-toggle-content .content .wrap-content .contact-item',
				]
			);

			$this->add_control(
				'contact_item_color',
				[
					'label' => esc_html__( 'Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .contact-item' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'icon_spacing',
				[
					'label' => esc_html__( 'Icon Spacing', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .contact-item' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'contact_item_margin',
				[
					'label' => esc_html__( 'Margin', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .contact-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'social_section',
			[
				'label' => esc_html__( 'Socials', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'social_spacing',
				[
					'label' => esc_html__( 'Spacing', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .list-social' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'social_margin',
				[
					'label' => esc_html__( 'Margin', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .list-social ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'social_background_heading',
				[
					'label' => esc_html__( 'Background', 'mellis' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'social_background_size',
				[
					'label' => esc_html__( 'Size', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .list-social .social' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'social_background_color',
				[
					'label' => esc_html__( 'Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .list-social .social' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'social_background_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .list-social .social:hover ' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'social_background_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .list-social .social' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'social_icon_heading',
				[
					'label' => esc_html__( 'Icon', 'mellis' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'social_icon_size',
				[
					'label' => esc_html__( 'Size', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .list-social .social i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .list-social .social svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'social_icon_color',
				[
					'label' => esc_html__( 'Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .list-social .social i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .list-social .social svg' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'social_icon_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .list-social .social:hover i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-toggle-content .content .wrap-content .list-social .social:hover svg' => 'fill: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {
		$settings = $this->get_settings();

		$icon = $settings['icon'];

		$image 		 = 	$settings['image'];
		$url		 = 	$settings['image']['url'];
		$image_alt 	 =  ( isset( $settings['image']['alt']) &&  $settings['image']['alt'] != '' ) ?  $settings['image']['alt'] : esc_html__( 'Toggle content', 'mellis' );

		$content_title 	= $settings['content_title'];
		$description 	= $settings['description'];

		$button_contact_link 	= $settings['button_contact_link'];
		$nofollow    			=  ( isset( $button_contact_link['nofollow'] ) && $button_contact_link['nofollow'] == 'on' ) ? 'rel=nofollow' : '';
		$target      			=  ( isset( $button_contact_link['is_external'] ) && $button_contact_link['is_external'] == 'on' ) ? '_blank' : '_self';
		$button_contact_text 	= $settings['button_contact_text'];
		$button_contact_icon 	= $settings['button_contact_icon'];

		$social_title 	= $settings['social_title'];
		$items_1 		= $settings['items_1'];
		$items_2 		= $settings['items_2'];

		?>
			<nav class="ova-toggle-content">
	            <button class="button-toggle" aria-label="<?php echo esc_html__( 'Button toggle', 'mellis' );?>">
	            	<?php if( !empty($icon['value']) ) :
					    \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );
	            	endif; ?>
	            </button>
	            <nav class="content <?php echo  esc_attr( $settings['menu_pos'] ); ?>" >
		            <div class="close-menu">
		            	<i class="ovaicon-cancel"></i>
		            </div>
					<div class="wrap-content">
						<?php if( !empty( $url ) ) : ?>
							<img class="img" src="<?php echo esc_attr( $url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
						<?php endif; ?>	 

						<?php if( !empty( $content_title ) ) : ?>
							<h3 class="content-title"><?php echo esc_html($content_title); ?></h3>
						<?php endif; ?>

						<?php if( !empty( $description ) ) : ?>
							<p class="description"><?php echo esc_html($description); ?></p>
						<?php endif; ?>

						<?php if( !empty( $button_contact_link['url'] ) ) : ?>
						<a href="<?php echo esc_html($button_contact_link['url']); ?>" class="button-contact" 
							target="<?php echo esc_attr( $target ); ?>" <?php echo esc_attr( $nofollow ); ?> 
							>
							<?php echo esc_html($button_contact_text); ?>
							<?php \Elementor\Icons_Manager::render_icon($button_contact_icon, [ 'aria-hidden' => 'true' ] ); ?>
						</a>
						<?php endif; ?>
						
						<?php if( !empty( $social_title ) ) : ?>
							<h3 class="contact-info-title"><?php echo esc_html($social_title); ?></h3>
						<?php endif; ?>
		
						<?php foreach( $items_1 as $item_1 ) : 
			               $contact_icon 	= $item_1['contact_icon']['value'];
			           	   $contact_label   = $item_1['contact_label'];
			           	   $contact_link    = $item_1['contact_link'];
		               	   $contact_target  =  ( $contact_link['is_external'] != '' && $contact_link['is_external'] == 'on' ) ? '_blank' : '_self';
					    ?>
						    <div class="contact-item">
						    	<i class="<?php echo esc_attr($contact_icon); ?>"></i>
						    	<?php if( !empty( $contact_link['url'] ) ) { ?>
						    	<a href="<?php echo esc_attr($contact_link['url']); ?>" target="<?php echo esc_attr( $contact_target ); ?>">
						    	<?php } ?>
						    		<span><?php echo esc_html($contact_label); ?></span>
						    	<?php if( !empty( $contact_link['url'] ) ) { ?>
						    	</a>
						    	<?php } ?>
						    </div>
						<?php endforeach; ?>

						<div class="list-social">
							<?php foreach( $items_2 as $item_2 ) :
				               	$social_icon 	  =  $item_2['social_icon']['value'];
				           	   	$social_link      =  $item_2['social_link'];
				           	   	$social_nofollow  =  ( isset( $social_link['nofollow'] ) && $social_link['nofollow'] ) ? ' rel=nofollow' : '';
		               			$social_target    =  ( $social_link['is_external'] != '' && $social_link['is_external'] == 'on' ) ? '_blank' : '_self';
						    ?>
						    	<a href="<?php echo esc_attr($social_link['url']); ?>" aria-label="<?php echo esc_html__( 'Socials', 'mellis' );?>"
						    		class="social <?php echo 'elementor-repeater-item-'.$item_2['_id']; ?>" 
						    		target="<?php echo esc_attr( $social_target ); ?>" <?php echo esc_attr( $social_nofollow ); ?>>
						    		<i class="<?php echo esc_attr($social_icon); ?>"></i>
						    	</a>
							<?php endforeach; ?>
						</div>
					</div>
				</nav>
				<div class="site-overlay"></div>
	        </nav>


		<?php
	}
}
$widgets_manager->register( new Mellis_Elementor_Toggle_Content() );