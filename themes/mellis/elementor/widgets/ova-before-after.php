<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Mellis_Elementor_Before_After extends Widget_Base {

	public function get_name() {
		return 'mellis_elementor_before_after';
	}

	public function get_title() {
		return esc_html__( 'Before After', 'mellis' );
	}

	public function get_icon() {
		return 'eicon-image-before-after';
	}

	public function get_categories() {
		return [ 'mellis' ];
	}

	public function get_script_depends() {
		return [ 'mellis-elementor-before-after' ];
	}

	protected function register_controls() {


		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'mellis' ),
			]
		);

			$this->add_control(
				'image_before',
				[
					'label'   => esc_html__( 'Before Image', 'mellis' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'image_after',
				[
					'label'   => esc_html__( 'After Image', 'mellis' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_responsive_control(
				'image_height',
				[
					'label' 		=> esc_html__( 'Height', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' 	=> 300,
							'max' 	=> 1000,
							'step' 	=> 10,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova_before_after #comparison' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);


		$this->end_controls_section();
	
	}

	protected function render() {

		$settings = $this->get_settings();	

		?>

			<div class='ova_before_after'>

				<div id="comparison">
					<figure style="background-image: url(<?php echo esc_attr($settings['image_after']['url'])?>);">
						<div id="handle">
							<i aria-hidden="true" class="flaticon flaticon-caret-right left"></i>
							<i aria-hidden="true" class="flaticon flaticon-caret-right"></i>
						</div>
						<div id="divisor" style="background-image: url(<?php echo esc_attr($settings['image_before']['url'])?>);"></div>
					</figure>
					<input type="range" min="0" max="100" value="50" id="slider">
				</div>

			</div>

		<?php
	}

}

$widgets_manager->register( new Mellis_Elementor_Before_After() );