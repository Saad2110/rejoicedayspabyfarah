<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Mellis_Elementor_Team_2 extends Widget_Base {
	
	public function get_name() {
		return 'mellis_elementor_team_2';
	}

	public function get_title() {
		return esc_html__( 'Ova Team 2', 'mellis' );
	}

	public function get_icon() {
		return 'eicon-user-circle-o';
	}

	public function get_categories() {
		return [ 'mellis' ];
	}

	public function get_keywords() {
		return [ 'social', 'icon', 'link' ];
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
				'image',
				[
					'label' 	=> esc_html__( 'Image Team', 'mellis' ),
					'type' 		=> Controls_Manager::MEDIA,
					'dynamic' 	=> [
						'active' 	=> true,
					],
					'default' 	=> [
						'url' 	=> Utils::get_placeholder_image_src(),
					],
					'separator' => 'before'
				]
			);
				
			$this->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'mellis' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Kevin Martin', 'mellis' ),
				]
			);

			$this->add_control(
				'sub-title',
				[
					'label' 	=> esc_html__( 'Sub Title', 'mellis' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'THERAPIST', 'mellis' ),
				]
			);

			$this->add_control(
				'link_team',
				[
					'label' 		=> esc_html__( 'Link', 'mellis' ),
					'type' 			=> Controls_Manager::URL,
					'placeholder' 	=> esc_html__( 'https://your-link.com', 'mellis' ),
					'show_external' => true,
					'default' => [
						'url' => '#',
					],
				]
			);
            
			// list icons control
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'class_icon',
				[
					'label' 	=> esc_html__( 'Class Icon', 'mellis' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=>  esc_html__( 'ovaicon-twitter', 'mellis' ),
					
				]
			);
			 
			$repeater->add_control(
				'link',
				[
					'label' 	=> esc_html__( 'Link', 'mellis' ),
					'type' 		=> Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => esc_html__( 'https://your-link.com', 'mellis' ),
				]
			);

			$repeater->add_control(
				'list_title_icon', 
				[
					'label' 		=> esc_html__( 'Title Icon', 'mellis' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'Item #1' , 'mellis' ),
					'label_block' 	=> true,
				]
			);
			
            $this->add_control(
				'icons',
				[
					'label' 	=> esc_html__( 'Social Icons', 'mellis' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[	
							'list_title_icon' 	=> esc_html__( 'Twitter', 'mellis' ),
							'class_icon' 		=> esc_html__( 'ovaicon-twitter', 'mellis' ),
							'link' 				=> ['url' => '#'],
						],
						[	
							'list_title_icon' 	=> esc_html__( 'Facebook', 'mellis' ),
							'class_icon' 		=> esc_html__( 'ovaicon ovaicon-facebook-logo', 'mellis' ),
							'link' 				=> ['url' => '#'],
						],
						[	
							'list_title_icon' 	=> esc_html__( 'Instagram', 'mellis' ),
							'class_icon' 		=> esc_html__( 'ovaicon ovaicon-instagram-1', 'mellis' ),
							'link' 				=> ['url' => '#'],
						],
	
					],
					'title_field' => '{{{ list_title_icon }}}',
				]
			);

		$this->end_controls_section();

		// Version 2
		$this->start_controls_section(
			'section_content_v2_style',
			[
				'label' 	=> esc_html__( 'Content', 'mellis' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs( 'tabs_content_v2_style' );
				
				$this->start_controls_tab(
		            'tab_content_v2_normal',
		            [
		                'label' => esc_html__( 'Normal', 'mellis' ),
		            ]
		        );

		        	$this->add_control(
			            'content_v2_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'mellis' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team2-v2' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_group_control(
			            Group_Control_Border::get_type(), [
			                'name' 		=> 'content_v2_border_normal',
			                'selector' 	=> '{{WRAPPER}} .ova-team2-v2',
			            ]
			        );

			        $this->add_control(
			            'content_v2_border_radius_normal',
			            [
			                'label' 		=> esc_html__( 'Border Radius', 'mellis' ),
			                'type' 			=> Controls_Manager::DIMENSIONS,
			                'size_units' 	=> [ 'px', '%' ],
			                'selectors' 	=> [
			                    '{{WRAPPER}} .ova-team2-v2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' 		=> 'content_v2_box_shadow_normal',
							'label' 	=> esc_html__( 'Box Shadow', 'mellis' ),
							'selector' 	=> '{{WRAPPER}} .ova-team2-v2',
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_content_v2_hover',
		            [
		                'label' => esc_html__( 'Hover', 'mellis' ),
		            ]
		        );

		        	$this->add_control(
			            'content_v2_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'mellis' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team2-v2:hover' => 'background-color: {{VALUE}};',
			                    
			                ],
			            ]
			        );

			        $this->add_group_control(
			            Group_Control_Border::get_type(), [
			                'name' 		=> 'content_v2_border_hover',
			                'selector' 	=> '{{WRAPPER}} .ova-team2-v2:hover',
			            ]
			        );

			        $this->add_control(
			            'content_v2_border_radius_hover',
			            [
			                'label' 		=> esc_html__( 'Border Radius', 'mellis' ),
			                'type' 			=> Controls_Manager::DIMENSIONS,
			                'size_units' 	=> [ 'px', '%' ],
			                'selectors' 	=> [
			                    '{{WRAPPER}} .ova-team2-v2:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                    
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' 		=> 'content_v2_box_shadow_hover',
							'label' 	=> esc_html__( 'Box Shadow', 'mellis' ),
							'selector' 	=> '{{WRAPPER}} .ova-team2-v2:hover',
						]
					);

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'content_v2_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team2-v2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                 
	                ],
	                'separator' 	=> 'before',
	            ]
	        );

	        $this->add_responsive_control(
	            'content_v2_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team2-v2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'separator' 	=> 'before',
	            ]
	        );

		$this->end_controls_section();

		// Image
		$this->start_controls_section(
			'section_img_v2_style',
			[
				'label' 	=> esc_html__( 'Image', 'mellis' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
	            'img_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team2-v2 .avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'img_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team2-v2 .avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();

		/* Begin Title Style */
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
					'selector' 	=> '{{WRAPPER}} .ova-team2-v2 .title',
				]
			);

			$this->start_controls_tabs( 'tabs_title_style' );

				$this->start_controls_tab(
		            'tab_title_normal',
		            [
		                'label' => esc_html__( 'Normal', 'mellis' ),
		            ]
		        );

					$this->add_control(
			            'title_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'mellis' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team2-v2 .title' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_title_hover',
		            [
		                'label' => esc_html__( 'Hover', 'mellis' ),
		            ]
		        );

					$this->add_control(
			            'title_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'mellis' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team2-v2:hover .title' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->add_responsive_control(
	            'title_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team2-v2 .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();

        /* Begin Sub-Title Style */
		$this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__( 'Sub Title', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'subtitle_typography',
					'selector' 	=> '{{WRAPPER}} .ova-team2-v2 .job',
				]
			);

			$this->start_controls_tabs( 'tabs_subtitle_style' );

				$this->start_controls_tab(
		            'tab_subtitle_normal',
		            [
		                'label' => esc_html__( 'Normal', 'mellis' ),
		            ]
		        );

					$this->add_control(
			            'subtitle_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'mellis' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team2-v2 .job' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_subtitle_hover',
		            [
		                'label' => esc_html__( 'Hover', 'mellis' ),
		            ]
		        );

					$this->add_control(
			            'subtitle_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'mellis' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team2-v2:hover .job' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->add_responsive_control(
	            'subtitle_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team2-v2 .job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();

        /* Begin Social Style */
		$this->start_controls_section(
            'social_style',
            [
                'label' => esc_html__( 'Social', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'social_typography',
					'selector' 	=> '{{WRAPPER}} .ova-team2-v2 .social-list .social i',
				]
			);

        	$this->start_controls_tabs( 'tabs_social_style' );
				
				$this->start_controls_tab(
		            'tab_social_normal',
		            [
		                'label' => esc_html__( 'Normal', 'mellis' ),
		            ]
		        );

		        	$this->add_control(
			            'social_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'mellis' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team2-v2 .social-list .social i' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        	$this->add_control(
			            'social_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'mellis' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team2-v2 .social-list .social' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_social_hover',
		            [
		                'label' => esc_html__( 'Hover', 'mellis' ),
		            ]
		        );

		        	$this->add_control(
			            'social_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'mellis' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team2-v2 .social-list .social:hover i' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        	$this->add_control(
			            'social_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'mellis' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team2-v2 .social-list .social:hover' => 'background-color: {{VALUE}} !important;',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'social_size',
				[
					'label' 	=> esc_html__( 'Size', 'mellis' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-team2-v2 .social-list .social' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_social_size',
				[
					'label' 	=> esc_html__( 'Icon Size', 'mellis' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-team2-v2 .avatar .social-list .social i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'social_border',
	                'selector' 	=> '{{WRAPPER}} .ova-team2-v2 .social-list .social',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'social_border_color_hover',
	            [
	                'label' 	=> esc_html__( 'Border Color Hover', 'mellis' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-team2-v2 .social-list .social:hover' => 'border-color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_control(
	            'social_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team2-v2 .social-list .social' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'social_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team2-v2 .social-list .social' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();
		
        // Get url image
		$url 	= $settings['image']['url'];
		$alt 	= isset( $settings['image']['alt'] ) ? $settings['image']['alt'] : '';
		
		if ( empty( $url ) ) {
			return;
		}

		$title 		= $settings['title'];
		$subtitle 	= $settings['sub-title'];

		if ( empty( $alt ) ) {
			$alt = $title ? $title : esc_html__( 'Avatar', 'mellis' );
		}

        // list social icons
		$icons 		= $settings['icons'];

		// Version 2
		$link_team 	= $settings['link_team']['url'];
		$target 	= ( 'on' == $settings['link_team']['is_external'] ) ? ' target="_blank"' : '';
		
		?>
        
		
			<div class="ova-team2-v2">
				
				<div class="avatar">

					<?php if ( $link_team ): ?>
						<a href="<?php echo esc_url( $link_team ); ?>"<?php printf( $target ); ?>>
					<?php endif; ?>

						<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">

					<?php if ( $link_team ): ?>
						</a>
					<?php endif; ?>

					<ul class="social-list">
						<?php foreach( $icons as $icon ): 
							$link 	= $icon['link']['url'];
							$target = ( 'on' == $icon['link']['is_external'] ) ? ' target="_blank"' : '';
						?>
							<li class="social">
								<?php if ( ! empty( $link ) ): ?>
									<a href="<?php echo esc_url( $link );?>"<?php echo esc_attr( $target ); ?>>
										<i class="<?php echo esc_attr( $icon['class_icon'] ); ?>"></i>
									</a>
								<?php else: ?>
									<span><i class="<?php echo esc_attr( $icon['class_icon'] ); ?>"></i></span>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>

				</div>

				<?php if ( $link_team ): ?>
					<a href="<?php echo esc_url( $link_team ); ?>"<?php printf( $target ); ?>>
				<?php endif; ?>

					<h2 class="title"><?php echo esc_html( $title ); ?></h2>

				<?php if ( $link_team ): ?>
					</a>
				<?php endif; ?>
				
				<p class="job"><?php echo esc_html( $subtitle ); ?></p>
				
			</div>
		
		<?php
	}

	
}
$widgets_manager->register( new Mellis_Elementor_Team_2() );