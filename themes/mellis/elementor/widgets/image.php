<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Mellis_Elementor_Image extends Widget_Base {

	
	public function get_name() {
		return 'mellis_elementor_image';
	}

	
	public function get_title() {
		return esc_html__( 'Ova Image', 'mellis' );
	}

	
	public function get_icon() {
		return 'eicon-image';
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
						'template_3' => esc_html__( 'Template 3', 'mellis' ),
					]
				]
			);
			
			$this->add_control(
				'ova_image',
				[
					'label' => esc_html__( 'Choose Image', 'mellis' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'background_image',
					'label' => esc_html__( 'Background', 'mellis' ),
					'types' => [ 'classic'],
					'selector' => '{{WRAPPER}} .ova-img',
					'condition' =>[
						'template' =>'template_1',
					]
				]
			);

			$this->add_control(
				'show_line_left',
				[
					'label' => esc_html__( 'Show Line Left', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'mellis' ),
					'label_off' => esc_html__( 'Hide', 'mellis' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'condition' =>[
						'template' =>'template_2',
					]
				]
			);

			$this->add_control(
				'show_line_right',
				[
					'label' => esc_html__( 'Show Line Right', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'mellis' ),
					'label_off' => esc_html__( 'Hide', 'mellis' ),
					'return_value' => 'yes',
					'default' => 'yes',
					'condition' =>[
						'template' =>'template_2',
					]
				]
			);


		$this->end_controls_section();

		/* Begin  Image style template 1 */
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'General', 'mellis' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' =>[
					'template' =>'template_1',
				]
			]
		);
			$this->add_control(
				'color_price',
				[
					'label'	 	=> esc_html__( 'Background', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-img:before' => 'background-color : {{VALUE}};'	
					],

				]
			);

			$this->add_control(
				'background_width',
				[
					'label' => esc_html__( 'Width', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px','%' ],
					'range' => [
						'px' => [
							'min' => 450,
							'max' => 500,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-img:before' => 'width: {{SIZE}}{{UNIT}};',
					],
				
				]
			);

			$this->add_responsive_control(
	            'image_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );      

		$this->end_controls_section();
		/* End General style */


		/* Begin  Image style template 2 */
		$this->start_controls_section(
			'section_style_2',
			[
				'label' => esc_html__( 'General', 'mellis' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' =>[
					'template' =>'template_2',
				]
			]
		);

			$this->add_responsive_control(
				'height_img',
				[
					'label' => esc_html__( 'Height (px)', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 200,
							'max' => 500,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .image-box.template_2 .ova-img img' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'template' => 'template_2',
					],
				]
			);
			

			$this->start_controls_tabs(
				'style_tabs'
			);

				$this->start_controls_tab(
					'style_left_tab',
					[
						'label' => esc_html__( 'Line Left', 'mellis' ),
					]
				);
					$this->add_control(
						'line_color_left',
						[
							'label' => esc_html__( 'Color', 'mellis' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .image-box.template_2 .ova-img .line-left' => 'background-color : {{VALUE}};',
							],
							'condition' => [
								'show_line_left' => 'yes',
								'template' => 'template_2',
							],
						]
					);

					$this->add_responsive_control(
						'line_width_left',
						[
							'label' => esc_html__( 'Width (px)', 'mellis' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
							'range' => [
								'px' => [
									'min' => 1,
									'max' => 50,
									'step' => 1,
								]
							],
							'selectors' => [
								'{{WRAPPER}} .ova-img .line.line-left' => 'width: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'show_line_left' => 'yes',
								'template' => 'template_2',
							],
						]
					);
					
				$this->end_controls_tab();

				$this->start_controls_tab(
					'style_right_tab',
					[
						'label' => esc_html__( 'Line Right', 'mellis' ),
					]
				);
					$this->add_control(
						'line_color_right',
						[
							'label' => esc_html__( 'Color', 'mellis' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .image-box.template_2 .ova-img .line-right' => 'background-color : {{VALUE}};',
							],
							'condition' => [
								'show_line_right' => 'yes',
								'template' => 'template_2',
							],
						]
					);

					$this->add_responsive_control(
						'line_width_right',
						[
							'label' => esc_html__( 'Width (px)', 'mellis' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
							'range' => [
								'px' => [
									'min' => 1,
									'max' => 50,
									'step' => 1,
								]
							],
							'selectors' => [
								'{{WRAPPER}} .ova-img .line.line-right' => 'width: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'show_line_right' => 'yes',
								'template' => 'template_2',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();


		$this->end_controls_section();
		/* End General style */
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$template 		= $settings['template'];
		$image 			= $settings['ova_image']['url'];
		$alt 	    	= isset( $settings['ova_image']['alt'] ) ? $settings['ova_image']['alt'] : '';
		$show_line_l 	= $settings['show_line_left'];
		$show_line_r 	= $settings['show_line_right'];

		?>


		<?php if( !empty( $image) ): ?>
			<div class="image-box <?php echo esc_html( $template); ?>">
				<div class="ova-img">
				 	<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_html( $alt );  ?>">
				 	<?php if($template == 'template_2' && $show_line_l == 'yes' ):  ?>
				 		<div class="line-left line"></div>
				 	<?php endif; ?>
				 	<?php if($template == 'template_2' && $show_line_r == 'yes' ):  ?>
				 		<div class="line-right line"></div>
				 	<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Mellis_Elementor_Image() );