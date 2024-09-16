<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Mellis_Elementor_Testimonial_2 extends Widget_Base {

	
	public function get_name() {
		return 'mellis_elementor_testimonial_2';
	}

	
	public function get_title() {
		return esc_html__( 'Ova Testimonial 2', 'mellis' );
	}

	
	public function get_icon() {
		return 'eicon-testimonial';
	}

	
	public function get_categories() {
		return [ 'mellis' ];
	}

	public function get_script_depends() {
		// Carousel
		wp_enqueue_style( 'slick-carousel', get_template_directory_uri().'/assets/libs/slick/slick.css' );
		wp_enqueue_style( 'slick-carousel-theme', get_template_directory_uri().'/assets/libs/slick/slick-theme.css' );
		wp_enqueue_script( 'slick-carousel', get_template_directory_uri().'/assets/libs/slick/slick.min.js', array('jquery'), false, true );

		return ['mellis-elementor-testimonial-2'];
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
				'class_icon',
				[
					'label' => esc_html__( 'Icon Quote', 'mellis' ),
					'type' => Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'ovaicon ovaicon-left-quotes-sign',
						'library' 	=> 'ovaicon',
					],
				]
			);

			// Add Class control
			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'name_author',
					[
						'label'   => esc_html__( 'Author Name', 'mellis' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Mike Hardson', 'mellis' ),
					]
				);

				$repeater->add_control(
					'job',
					[
						'label'   => esc_html__( 'Job', 'mellis' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Customer', 'mellis' ),
					]
				);

				$repeater->add_control(
					'image_author',
					[
						'label'   => esc_html__( 'Author Image', 'mellis' ),
						'type'    => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					]
				);

				$repeater->add_control(
					'testimonial',
					[
						'label'   => esc_html__( 'Testimonial ', 'mellis' ),
						'type'    => \Elementor\Controls_Manager::TEXTAREA,
						'default' => esc_html__( "Saturday is a day for the spa. It's not selfish to love yourself, take care of yourself, and to make your happiness a priority.", 'mellis' ),
					]
				);

				$this->add_control(
					'tab_item',
					[
						'label'       => esc_html__( 'Items Testimonial', 'mellis' ),
						'type'        => Controls_Manager::REPEATER,
						'fields'      => $repeater->get_controls(),
						'default' => [
							[
								'name_author' => esc_html__('Aleesha Brown', 'mellis'),
							],
							[
								'name_author' => esc_html__('Shirley Smith', 'mellis'),
							],
							[
								'name_author' => esc_html__('Mike Hardson', 'mellis'),
							],
						],
						'title_field' => '{{{ name_author }}}',
					]
				);

		$this->end_controls_section();

		/*****************************************************************
						START SECTION ADDITIONAL
		******************************************************************/

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'mellis' ),
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
					'default' => 'yes',
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
					'default' => 300,
				]
			);

			$this->add_control(
				'arrows',
				[
					'label'   => esc_html__( 'Arrows', 'mellis' ),
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
				'dots',
				[
					'label'   => esc_html__( 'Dots', 'mellis' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'mellis' ),
						'no'  => esc_html__( 'No', 'mellis' ),
					],
					'frontend_available' => true,
				]
			);

		$this->end_controls_section();

		/****************************  END SECTION ADDITIONAL *********************/

        /* Begin icon star Style */
		$this->start_controls_section(
            'icon_star_style',
            [
                'label' => esc_html__( 'Star Icon', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );
            
			$this->add_responsive_control(
				'size_icon_star',
				[
					'label' 		=> esc_html__( 'Size', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 60,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .info .icon-star i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
                     
            $this->add_control(
				'icon_color_star',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .info .icon-star i' => 'color: {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
		/* End icon star style */

		/* Begin icon quote Style */
		$this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Quote Icon', 'mellis' ),
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
							'max' => 60,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .client .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
                     
             $this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .client .icon i' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'background_icon',
					'label' => esc_html__( 'Background', 'mellis' ),
					'types' => [ 'classic', 'gradient',],
					'selector' => '{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .client .icon',
				]
			);

	        $this->add_responsive_control(
	            'icon_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .client .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'icon_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .client .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End icon quote style */

		/*************  SECTION NAME JOB AUTHOR. *******************/
		$this->start_controls_section(
			'section_author_name_job',
			[
				'label' => esc_html__( 'Author Name - Job', 'mellis' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		    $this->add_responsive_control(
				'name_job_padding',
				[
					'label'      => esc_html__( 'Padding', 'mellis' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .info .name-job' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		    $this->add_control(
				'author_name_heading',
				[
					'label'     => esc_html__( 'Author Name', 'mellis' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'author_name_typography',
					'selector' => '{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .info .name-job .name',
				]
			);

			$this->add_control(
				'author_name_color',
				[
					'label'     => esc_html__( 'Color', 'mellis' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'
						{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .info .name-job .name' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'job_heading',
				[
					'label'     => esc_html__( 'Job', 'mellis' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'job_typography',
					'selector' => '{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .info .name-job .job',
				]
			);

			$this->add_control(
				'job_color',
				[
					'label'     => esc_html__( 'Color', 'mellis' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'
						{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .info .name-job .job' => 'color : {{VALUE}};',
					],
				]
			);


		$this->end_controls_section();
		###############  end section name job author  ###############


		/*************  SECTION content testimonial  *******************/
		$this->start_controls_section(
			'section_content_testimonial',
			[
				'label' => esc_html__( 'Content Testimonial', 'mellis' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'content_testimonial_typography',
					'selector' => '{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info p.ova-evaluate',
				]
			);

			$this->add_control(
				'content_color',
				[
					'label'     => esc_html__( 'Color', 'mellis' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info p.ova-evaluate' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'content_padding',
				[
					'label'      => esc_html__( 'Padding', 'mellis' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info p.ova-evaluate' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);


		$this->end_controls_section();
		###############  end section content testimonial  ###############

		/* Begin Nav Arrow Style */
		$this->start_controls_section(
            'nav_style',
            [
                'label' => esc_html__( 'Arrows Control', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
                'condition' => [
                	'arrows' => 'yes'
                ]
            ]
        );
            
            $this->add_responsive_control(
				'size_nav_icon',
				[
					'label' 		=> esc_html__( 'Icon Size', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 30,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next:before, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev:before' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'arrow_padding',
				[
					'label'      => esc_html__( 'Padding', 'mellis' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'arrow_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'mellis' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_nav_style' );
				
				$this->start_controls_tab(
		            'tab_nav_normal',
		            [
		                'label' => esc_html__( 'Normal', 'mellis' ),
		            ]
		        );

		            $this->add_control(
						'color_nav_icon',
						[
							'label' => esc_html__( 'Color', 'mellis' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next:before, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev:before' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_nav_border',
						[
							'label' => esc_html__( 'Color Border', 'mellis' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev' => 'border-color : {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_icon_hover',
		            [
		                'label' => esc_html__( 'Hover', 'mellis' ),
		            ]
		        );

		            $this->add_control(
						'color_nav_icon_hover',
						[
							'label' => esc_html__( 'Color Hover', 'mellis' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next:hover:before, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev:hover:before' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_nav_border_hover',
						[
							'label' => esc_html__( 'Color Border Hover', 'mellis' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next:hover, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev:hover' => 'border-color : {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();

		    $this->end_controls_tabs();

        $this->end_controls_section();
        /* End Nav Arrow Style */

		
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

		$tab_item     =    $settings['tab_item'];
		$class_icon   =    $settings['class_icon']['value'];
		
		// carousel data option
		$data_options['loop']               = $settings['infinite'] === 'yes' ? true : false;
		$data_options['autoplay']           = $settings['autoplay'] === 'yes' ? true : false;
		$data_options['arrows']				= $settings['arrows'] === 'yes' ? true : false;
		$data_options['dots']				= $settings['dots'] === 'yes' ? true : false;
		$data_options['autoplay_speed']     = $settings['autoplay_speed'];
		$data_options['smartSpeed']         = $settings['smartspeed'];

		?>
         
         <div class="ova-testimonial-2">

			<div class="slide-testimonials-2" data-options="<?php echo esc_attr(json_encode($data_options)) ; ?>">

				<?php if(!empty($tab_item)) : foreach ($tab_item as $item) : ?>
					<div class="item">
						<div class="client-info">

							<div class="client">
								<?php if( $item['image_author'] != '' ) { ?>
									<?php $alt = isset($item['name_author']) && $item['name_author'] ? $item['name_author'] : esc_html__( 'testimonial','mellis' ); ?>
									<img src="<?php echo esc_attr($item['image_author']['url']); ?>" alt="<?php echo esc_attr( $alt ); ?>" >
								<?php } ?>
								<?php if (!empty( $class_icon )): ?>
					            	<div class="icon">
					            		<i class="<?php echo esc_attr( $class_icon ); ?>"></i>
					            	</div>
					            <?php endif;?>
							</div>

							<div class="info">

								<div class="icon-star">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
								</div>

								<?php if( $item['testimonial'] != '' ) : ?>
									<p class="ova-evaluate">
										<?php echo esc_html($item['testimonial']) ; ?>
									</p>
								<?php endif; ?>

								<div class="name-job">
									<?php if( $item['name_author'] != '' ) { ?>
										<p class="name second_font">
											<?php echo esc_html($item['name_author']) ; ?>
										</p>
									<?php } ?>

									<?php if( $item['job'] != '' ) { ?>
										<p class="job">
											<?php echo esc_html($item['job'])  ; ?>
										</p>
									<?php } ?>
								</div>
							</div><!-- end info -->

						</div>
					</div>
	
				<?php endforeach; endif; ?>
			</div>

			<div class="slide-for">
            	<?php if(!empty($tab_item)) : foreach ($tab_item as $k => $item) :  if ($k >= 3) break; ?>
            		<?php $alt = isset($item['name_author']) && $item['name_author'] ? $item['name_author'] : esc_html__( 'testimonial','mellis' ); ?>
	         	    <div class="small-img">
						<img src="<?php echo esc_attr($item['image_author']['url']); ?>" alt="<?php echo esc_attr( $alt ); ?>">
					</div>	
				<?php endforeach; endif; ?>
			</div>

		</div>
		 	
		<?php
	}

	
}

$widgets_manager->register( new Mellis_Elementor_Testimonial_2() );