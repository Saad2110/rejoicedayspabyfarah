<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Mellis_Elementor_Testimonial extends Widget_Base {

	public function get_name() {
		return 'mellis_elementor_testimonial';
	}

	public function get_title() {
		return esc_html__( 'Ova Testimonial', 'mellis' );
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

		return [ 'mellis-elementor-testimonial' ];
	}

	protected function register_controls() {


		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'mellis' ),
			]
		);

			$this->add_control(
				'version',
				[
					'label' => esc_html__( 'Version', 'mellis' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'version_1',
					'options' => [
						'version_1' => esc_html__( 'Version 1', 'mellis' ),
						'version_2' => esc_html__( 'Version 2', 'mellis' ),
					]
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
					'condition' => [
						'version' 	=> [
							'version_2'
						],
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
								'name_author' => esc_html__('Mike Hardson', 'mellis'),
							],
							[
								'name_author' => esc_html__('Edna Marxten', 'mellis'),
							],
							[
								'name_author' => esc_html__('Kevin Martin', 'mellis'),
							],
							[
								'name_author' => esc_html__('Jessica Brown', 'mellis'),
							],
							[
								'name_author' => esc_html__('David Cooper', 'mellis'),
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
				'items_v1',
				[
					'label'     => esc_html__( 'Item', 'mellis' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 1,
					'frontend_available' => true,
					'condition' 	=>[
						'version' => [
							'version_1'
						],
					],
				]
			);

			$this->add_control(
				'items_v2',
				[
					'label'     => esc_html__( 'Item', 'mellis' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 3,
					'frontend_available' => true,
					'condition' 	=>[
						'version' => [
							'version_2'
						],
					],
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
					'condition' 	=>[
						'version' => [
							'version_1'
						],
					],
				]
			);

			$this->add_control(
				'dots',
				[
					'label'   => esc_html__( 'Dots', 'mellis' ),
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

		/****************************  END SECTION ADDITIONAL *********************/

		/* Begin General Style */
		$this->start_controls_section(
			'section_general_style',
			[
				'label' 	=> esc_html__( 'General', 'mellis' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'version' => 'version_2',
				]
			]
		);
			$this->add_responsive_control(
				'general_v2_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'mellis' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-testimonial.version_2 .slide-testimonials .client-info .info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'general_border',
					'label' => esc_html__( 'Border', 'mellis' ),
					'selector' => '{{WRAPPER}} .ova-testimonial.version_2 .slide-testimonials .client-info',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'general_box_shadow',
					'label' => esc_html__( 'Box Shadow', 'mellis' ),
					'selector' => '{{WRAPPER}} .ova-testimonial.version_2 .slide-testimonials .client-info',
				]
			);

		$this->end_controls_section();
		/* End General Style */

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
						'{{WRAPPER}} .ova-testimonial .slide-testimonials .client-info .info .icon-star i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
                     
            $this->add_control(
				'icon_color_star',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial .slide-testimonials .client-info .info .icon-star i' => 'color: {{VALUE}};',
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
                'condition' 	=>[
					'version' => [
						'version_2'
					],
				],
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
						'{{WRAPPER}} .ova-testimonial.version_2 .slide-testimonials .client-info .info .icon-quote i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
                     
            $this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial.version_2 .slide-testimonials .client-info .info .icon-quote i' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} .ova-testimonial .slide-testimonials .client-info .info .name-job, {{WRAPPER}} .ova-testimonial .slide-for .name-job' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'name'     => 'author_name_typography_v2',
					'selector' => '{{WRAPPER}} .ova-testimonial .slide-testimonials .client-info .info .name-job .name',
					'condition' 	=>[
						'version' => [
							'version_2'
						],
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'author_name_typography_v1',
					'selector' => '{{WRAPPER}} .ova-testimonial .slide-for .name-job .name',
					'condition' 	=>[
						'version' => [
							'version_1'
						],
					],
				]
			);

			$this->add_control(
				'author_name_color',
				[
					'label'     => esc_html__( 'Color', 'mellis' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial .slide-testimonials .client-info .info .name-job .name, {{WRAPPER}} .ova-testimonial .slide-for .name-job .name' => 'color : {{VALUE}};',
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
					'name'     => 'job_typography_v2',
					'selector' => '{{WRAPPER}} .ova-testimonial .slide-testimonials .client-info .info .name-job .job',
					'condition' 	=>[
						'version' => [
							'version_2'
						],
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'job_typography_v1',
					'selector' => '{{WRAPPER}} .ova-testimonial .slide-for .name-job .job',
					'condition' 	=>[
						'version' => [
							'version_1'
						],
					],
				]
			);

			$this->add_control(
				'job_color',
				[
					'label'     => esc_html__( 'Color', 'mellis' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'
						{{WRAPPER}} .ova-testimonial .slide-testimonials .client-info .info .name-job .job, {{WRAPPER}} .ova-testimonial .slide-for .name-job .job' => 'color : {{VALUE}};',
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
					'selector' => '{{WRAPPER}} .ova-testimonial .slide-testimonials .client-info p.ova-evaluate',
				]
			);

			$this->add_control(
				'content_color',
				[
					'label'     => esc_html__( 'Color', 'mellis' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial .slide-testimonials .client-info p.ova-evaluate' => 'color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-testimonial .slide-testimonials .client-info p.ova-evaluate' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                	'arrows' 	=> 'yes',
                	'version' 	=> 'version_1'
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
						'{{WRAPPER}} .ova-testimonial .slide-testimonials .slick-next:before, {{WRAPPER}} .ova-testimonial .slide-testimonials .slick-prev:before' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			 $this->add_control(
				'color_nav_icon',
				[
					'label' => esc_html__( 'Color', 'mellis' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial .slide-testimonials .slick-next:before, {{WRAPPER}} .ova-testimonial .slide-testimonials .slick-prev:before' => 'color : {{VALUE}};',
					],
				]
			);


            $this->add_control(
				'color_nav_icon_hover',
				[
					'label' => esc_html__( 'Color Hover', 'mellis' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial .slide-testimonials .slick-next:hover:before, {{WRAPPER}} .ova-testimonial .slide-testimonials .slick-prev:hover:before' => 'color : {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
        /* End Nav Arrow Style */
		
		//SECTION TAB STYLE DOTS
		$this->start_controls_section(
			'section_dots',
			[
				'label' => esc_html__( 'Dots', 'mellis' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'dots' => 'yes',
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
							'min' 	=> -50,
							'max' 	=> 0,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-testimonial .slide-testimonials .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs(
					'style_tabs_dots'
				);

				$this->start_controls_tab(
					'style_dots_tab',
						[
						'label' => esc_html__( 'Normal', 'mellis' ),
						]
					);

				$this->add_control(
					'style_dots',
					[
						'label' => esc_html__( 'Dots', 'mellis' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
						
					]
				);

				$this->add_control(
					'dot_color',
					[
						'label'     => esc_html__( 'Dot Color', 'mellis' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-testimonial .slide-testimonials .slick-dots button ' => 'background-color : {{VALUE}};',
							
						]
						
					]
				);

				$this->add_control(
					'dot_width',
					[
						'label' 		=> esc_html__( 'Dots Width', 'mellis' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px' ],
						'range' => [
							'px' => [
								'min' 	=> 0,
								'max' 	=> 20,
								'step' 	=> 1,
							]
						],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-testimonial .slide-testimonials .slick-dots button' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'dot_height',
					[
						'label' 		=> esc_html__( 'Dots Height', 'mellis' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px' ],
						'range' => [
							'px' => [
								'min' 	=> 0,
								'max' 	=> 10,
								'step' 	=> 1,
							]
						],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-testimonial .slide-testimonials .slick-dots button' => 'height: {{SIZE}}{{UNIT}};',
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
							'{{WRAPPER}} .ova-testimonial .slide-testimonials .slick-dots button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'style_dots_active_tab',
				[
				'label' => esc_html__( 'Active', 'mellis' ),
				]
			);

			$this->add_control(
				'style_dot_active',
				[
					'label' => esc_html__( 'Dots Active', 'mellis' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					
				]
			);

			$this->add_control(
				'dot_color_active',
				[
					'label'     => esc_html__( 'Dot Color Active', 'mellis' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial .slide-testimonials .slick-dots li.slick-active button' => 'background-color : {{VALUE}};',
						
					],
					
				]
			);

			$this->add_control(
				'dot_width_active',
				[
					'label' 		=> esc_html__( 'Dots Width Active', 'mellis' ),
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
						'{{WRAPPER}} .ova-testimonial .slide-testimonials .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_tab();

	$this->end_controls_tabs();


		$this->end_controls_section();
		//END SECTION TAB STYLE DOTS
	}

	// Render Template Here
	protected function render() {

		$settings     = $this->get_settings();

		$version 	  =    $settings['version'];
		$tab_item     =    $settings['tab_item'];
		$class_icon   =    $settings['class_icon']['value'];
		
		//carousel data option
		$data_options['loop']               = $settings['infinite'] === 'yes' ? true : false;
		$data_options['autoplay']           = $settings['autoplay'] === 'yes' ? true : false;
		$data_options['autoplay_speed']     = $settings['autoplay_speed'];
		$data_options['smartSpeed']         = $settings['smartspeed'];
		$data_options['dots']				= $settings['dots'] === 'yes' ? true : false;
		

		if ($version == 'version_1') {
			// code...
			$data_options['items']			= $settings['items_v1'];
			$data_options['arrows']			= $settings['arrows'] === 'yes' ? true : false;
			$data_options['navfor']			= '.slide-for';
			
		} else {

			$data_options['items']			= $settings['items_v2'];
			$data_options['arrows']		    = false;
			$data_options['padding']		= 30;
		}

		?>
         
        <div class="ova-testimonial <?php echo esc_html( $version ); ?>">

			<div class="slide-testimonials slider-<?php echo esc_html($version); ?>"  data-options="<?php echo esc_attr(json_encode($data_options)) ; ?>">

				<?php if(!empty($tab_item)) : foreach ($tab_item as $item) : ?>

					<?php $alt = isset($item['name_author']) && $item['name_author'] ? $item['name_author'] : esc_html__( 'testimonial','mellis' ); ?>

					<div class="item">

						<div class="client-info">

							<div class="info">

								<?php if (!empty( $class_icon ) && $version === 'version_2'): ?>
					            	<div class="icon-quote">
					            		<i class="<?php echo esc_attr( $class_icon ); ?>"></i>
					            	</div>
				            	<?php endif;?>

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
                                
                                <?php if ( $version === 'version_2'): ?>
									<div class="info-avatar">	
										<div class="small-img">
											<img src="<?php echo esc_attr($item['image_author']['url']); ?>" alt="<?php echo esc_attr( $alt ); ?>">
										</div>

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
									</div>	
								<?php endif; ?>

							</div><!-- end info -->

						</div>

					</div>
	
				<?php endforeach; endif; ?>
			</div>

			<?php if( $version == 'version_1' ) : ?>

	            <div class="slide-for">

	            	<?php if(!empty($tab_item)) : foreach ($tab_item as $k => $item) :  if ($k >= 5) break; ?>

	            		<?php $alt = isset($item['name_author']) && $item['name_author'] ? $item['name_author'] : esc_html__( 'testimonial','mellis' ); ?>
                        
                        <div class="slide-for-content">

			         	    <div class="small-img">
								<img src="<?php echo esc_attr($item['image_author']['url']); ?>" alt="<?php echo esc_attr( $alt ); ?>">
							</div>	

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

						</div>

					<?php endforeach; endif; ?>

				</div>

			<?php endif; ?>

		</div>
		 
		<?php
	}
}

$widgets_manager->register( new Mellis_Elementor_Testimonial() );