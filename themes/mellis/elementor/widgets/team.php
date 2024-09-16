<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Mellis_Elementor_Team extends Widget_Base {

	
	public function get_name() {
		return 'mellis_elementor_team';
	}

	
	public function get_title() {
		return esc_html__( 'Ova Team', 'mellis' );
	}

	
	public function get_icon() {
		return 'eicon-person';
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

			$this->add_control(
				'template',
				[
					'label' => esc_html__( 'Template', 'mellis' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'template_1',
					'options' => [
						'template_1' => esc_html__( 'Template 1', 'mellis' ),
						'template_2' => esc_html__( 'Template 2', 'mellis' ),
					]
				]
			);	

			$this->add_control(
				'columns',
				[
					'label' => esc_html__( 'Columns', 'mellis' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'column_3',
					'options' => [
						'column_2' => esc_html__( '2 Columns', 'mellis' ),
						'column_3' => esc_html__( '3 Columns', 'mellis' ),
						'column_4' => esc_html__( '4 Columns', 'mellis' ),
					]
				]
			);

			$repeater = new \Elementor\Repeater();

				// Add Class control
				$repeater->add_control(
					'ova_team_image',
					[
						'label' => esc_html__( 'Choose Image', 'mellis' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					]
				);

				// Name
				$repeater->add_control(
					'ova_team_name',
					[
						'label' => esc_html__( 'Name', 'mellis' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( '', 'mellis' ),
						'label_block' => true,
					]
				);

				// job
				$repeater->add_control(
					'ova_team_job',
					[
						'label' => esc_html__( 'Job', 'mellis' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( '', 'mellis' ),
						'label_block' => true,
					]
				);

				$repeater->add_control(
					'ova_team_class_icon_1',
					[
						'label' => esc_html__( 'Icon 1', 'mellis' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' 	=> [
							'value' 	=> 'ovaicon ovaicon-twitter',
							'library' 	=> 'all',
						],
					]
				);

				$repeater->add_control(
					'ova_team_link_icon_1',
					[
						'label'   => esc_html__( 'Link Icon 1', 'mellis' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
					]
				);

				$repeater->add_control(
					'ova_team_class_icon_2',
					[
						'label' => esc_html__( 'Icon 2', 'mellis' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' 	=> [
							'value' 	=> 'ovaicon ovaicon-facebook-logo',
							'library' 	=> 'all',
						],
					]
				);

				$repeater->add_control(
					'ova_team_link_icon_2',
					[
						'label'   => esc_html__( 'Link Icon 2', 'mellis' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
					]
				);

				$repeater->add_control(
					'ova_team_class_icon_3',
					[
						'label' => esc_html__( 'Icon 3', 'mellis' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' 	=> [
							'value' 	=> 'ovaicon ovaicon-instagram-1',
							'library' 	=> 'all',
						],
					]
				);

				$repeater->add_control(
					'ova_team_link_icon_3',
					[
						'label'   => esc_html__( 'Link Icon 3', 'mellis' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
					]
				);

				$repeater->add_control(
					'ova_team_class_icon_4',
					[
						'label' => esc_html__( 'Icon 4', 'mellis' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' 	=> [
							'value' 	=> 'fab fa-linkedin-in',
							'library' 	=> 'all',
						],
					]
				);

				$repeater->add_control(
					'ova_team_link_icon_4',
					[
						'label'   => esc_html__( 'Link Icon 4', 'mellis' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
					]
				);

			$this->add_control(
				'item_list',
				[
					'label' => esc_html__( 'Team List', 'mellis' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'ova_team_name'	=> 	esc_html__( 'Aleesha Brown', 'mellis' ),
							'ova_team_job'	=> 	esc_html__( 'THERAPIST', 'mellis' ),
						],
						[
							'ova_team_name'	=> 	esc_html__( 'David Cooper', 'mellis' ),
							'ova_team_job'	=> 	esc_html__( 'THERAPIST', 'mellis' ),		
						],
						[
							'ova_team_name'	=> 	esc_html__( 'Jessica Rose', 'mellis' ),
							'ova_team_job'	=> 	esc_html__( 'THERAPIST', 'mellis' ),		
						],
					],
				]
			);

		$this->end_controls_section();

		/*===== Begin tab Style =====*/

		/* Begin General Style */
		$this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_responsive_control(
				'general_align',
				[
					'label' 	=> esc_html__( 'Alignment', 'mellis' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' => [
							'title' => esc_html__( 'Left', 'mellis' ),
							'icon' 	=> 'eicon-order-start',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'mellis' ),
							'icon' 	=> ' eicon-align-center-v',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'mellis' ),
							'icon' 	=> 'eicon-order-end',
						],
						
					],
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-team .ova-team-box .item .info' => 'text-align: {{VALUE}};',
						
					],
				]
			);

			$this->add_responsive_control(
				'general_margin',
				[
					'label' => esc_html__( 'Margin', 'mellis' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-team .ova-team-box .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],				
				]
			);


			$this->add_control(
				'general_background',
				[
					'label'	 	=> esc_html__( 'Background', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-team .ova-team-box .item' => 'background-color : {{VALUE}};'	
					],
				]
			);

			$this->add_responsive_control(
				'image_margin',
				[
					'label' => esc_html__( 'Image Margin', 'mellis' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-team .ova-team-box .item .img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],				
				]
			);

        $this->end_controls_section();
		/* End General style */

		/* Begin Social Style */
		$this->start_controls_section(
            'team_social',
            [
                'label' => esc_html__( 'Social', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );	

        	$this->add_control(
				'team_social_width',
				[
					'label' => esc_html__( 'Width', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 30,
							'max' => 60,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-team .ova-team-box .item .img .social .icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'team_social_fontsize',
				[
					'label' => esc_html__( 'Size', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 10,
							'max' => 16,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-team .ova-team-box .item .img .social .icon i' => 'font-size: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'team_social_gap',
				[
					'label' => esc_html__( 'Gap', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 5,
							'max' => 20,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-team .ova-team-box .item .img .social' => 'gap: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'team_social_bottom',
				[
					'label' => esc_html__( 'Bottom', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 15,
							'max' => 60,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-team .ova-team-box .item:hover .img .social' => 'bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

			
			//tab style
			$this->start_controls_tabs(
				'social_style_tabs'
			);

				$this->start_controls_tab(
					'social_style_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'mellis' ),
					]
				);
					//nomarl
					$this->add_control(
						'nomarl_color',
						[
							'label'	 	=> esc_html__( 'Color', 'mellis' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team .ova-team-box .item .img .social .icon' => 'color : {{VALUE}};'	
							],
						]
					);

					$this->add_control(
						'nomarl_bg_color',
						[
							'label'	 	=> esc_html__( 'Background', 'mellis' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team .ova-team-box .item .img .social .icon' => 'background-color : {{VALUE}};'	
							],
						]
					);

				$this->end_controls_tab();

				//hover
				$this->start_controls_tab(
					'social_style_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'mellis' ),
					]
				);
					$this->add_control(
						'hover_color',
						[
							'label'	 	=> esc_html__( 'Color', 'mellis' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team .ova-team-box .item .img .social .icon a:hover' => 'color : {{VALUE}};'	
							],
						]
					);

					$this->add_control(
						'hover_bg_color',
						[
							'label'	 	=> esc_html__( 'Background', 'mellis' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team .ova-team-box .item .img .social .icon a:hover' => 'background-color : {{VALUE}};'	
							],
						]
					);
				$this->end_controls_tab();

			$this->end_controls_tabs();

        $this->end_controls_section();
		/* End Social style */

		/* Begin  Info style */
		$this->start_controls_section(
			'section_info',
			[
				'label' => esc_html__( 'Info', 'mellis' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs(
				'style_info_tabs'
			);

				$this->start_controls_tab(
					'style_name_tab',
					[
						'label' => esc_html__( 'Name', 'mellis' ),
					]
				);
					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' 		=> 'content_typography_name',
							'label' 	=> esc_html__( 'Typography', 'mellis' ),
							'selector' 	=> '{{WRAPPER}} .ova-team .ova-team-box .item .info .name',
						]
					);

					$this->add_control(
						'color_name',
						[
							'label'	 	=> esc_html__( 'Color', 'mellis' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team .ova-team-box .item .info .name' => 'color : {{VALUE}};'
								
								
							],
						]
					);

					$this->add_responsive_control(
						'margin_name',
						[
							'label' 	 => esc_html__( 'Margin', 'mellis' ),
							'type' 		 => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', 'em', '%' ],
							'selectors'  => [
								'{{WRAPPER}} .ova-team .ova-team-box .item .info .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'style_job_tab',
					[
						'label' => esc_html__( 'Job', 'mellis' ),
					]
				);
					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' 		=> 'content_typography_job',
							'label' 	=> esc_html__( 'Typography', 'mellis' ),
							'selector' 	=> '{{WRAPPER}} .ova-team .ova-team-box .item .info .job',
						]
					);

					$this->add_control(
						'color_job',
						[
							'label'	 	=> esc_html__( 'Color', 'mellis' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team .ova-team-box .item .info .job' => 'color : {{VALUE}};'
							],
						]
					);

					$this->add_responsive_control(
						'margin_job',
						[
							'label' 	 => esc_html__( 'Margin', 'mellis' ),
							'type' 		 => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', 'em', '%' ],
							'selectors'  => [
								'{{WRAPPER}} .ova-team .ova-team-box .item .info .job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
		/* End Promo code style */
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();
		
		$template = $settings['template'];
		$columns  = $settings['columns'];
		$list 	  = $settings['item_list'];

		?>

		<div class="ova-team">

			<div class="ova-team-box ova-team-box-<?php echo esc_attr($template); ?> ova-<?php echo esc_html( $columns ); ?>">

				<?php foreach( $list as $item ):

					$image_url 		= $item['ova_team_image']['url'];
					$ova_team_name	= $item['ova_team_name'];

					$icon_1 		= $item['ova_team_class_icon_1'];
					$link_1 		= $item['ova_team_link_icon_1'] ;

					$icon_2 		= $item['ova_team_class_icon_2'];
					$link_2 		= $item['ova_team_link_icon_2'] ;

					$icon_3 		= $item['ova_team_class_icon_3'];
					$link_3 		= $item['ova_team_link_icon_3'] ;

					$icon_4 		= $item['ova_team_class_icon_4'];
					$link_4 		= $item['ova_team_link_icon_4'] ;
				?>

					<div class="item">
						<div class="img">
							<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_html( $ova_team_name );  ?>">
							
							<?php if( $template == 'template_2' ) { ?>
								<div class="share-button">
									<i class="fas fa-share-alt"></i>
								</div>
							<?php } ?>

							<div class="social">
								<?php if( !empty( $icon_1['value'] ) ){ ?>
									<div class="icon">
										<?php if(!empty( $link_1 )): ?>
											<a href="<?php echo esc_url( $link_1); ?>" class="icon" target="_blank">
										<?php endif; ?>
											
											<?php \Elementor\Icons_Manager::render_icon( $icon_1, [ 'aria-hidden' => 'true' ] ); ?>
										
										<?php if(!empty( $link_1 )): ?>
											</a>
										<?php endif; ?>
									</div>
								<?php } ?>

								<?php if( !empty( $icon_2['value'] ) ){ ?>
									<div class="icon">
										<?php if(!empty( $link_2 )): ?>
											<a href="<?php echo esc_url( $link_2); ?>" class="icon" target="_blank">
										<?php endif; ?>
											
											<?php \Elementor\Icons_Manager::render_icon( $icon_2, [ 'aria-hidden' => 'true' ] ); ?>
										
										<?php if(!empty( $link_2 )): ?>
											</a>
										<?php endif; ?>
									</div>
								<?php } ?>

								<?php if( !empty( $icon_3['value'] ) ){ ?>

									<div class="icon">
										<?php if(!empty( $link_3 ) ): ?>
											<a href="<?php echo esc_url( $link_3); ?>" class="icon" target="_blank">
										<?php endif; ?>
											
											<?php \Elementor\Icons_Manager::render_icon( $icon_3, [ 'aria-hidden' => 'true' ] ); ?>
										
										<?php if(!empty( $link_3 )): ?>
											</a>
										<?php endif; ?>
									</div>

								<?php } ?>

								<?php if( !empty( $icon_4['value'] ) ){ ?>

									<div class="icon">
										<?php if(!empty( $link_4 ) ): ?>
											<a href="<?php echo esc_url( $link_4); ?>" class="icon" target="_blank">
										<?php endif; ?>
											
											<?php \Elementor\Icons_Manager::render_icon( $icon_4, [ 'aria-hidden' => 'true' ] ); ?>
										
										<?php if(!empty( $link_4 )): ?>
											</a>
										<?php endif; ?>
									</div>

								<?php } ?>
							</div>
						</div>
						
						<div class="info">
							<h3 class="name"><?php echo esc_html( $item['ova_team_name'] ); ?></h3>
							<p class="job"><?php echo esc_html($item['ova_team_job'] ); ?></p>
						</div>
					</div>

				<?php endforeach; ?>
			</div>

		</div>
		 	
		<?php
	}
	
}

$widgets_manager->register( new Mellis_Elementor_Team() );