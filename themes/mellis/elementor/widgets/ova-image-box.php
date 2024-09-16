<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Mellis_Elementor_Ova_Image_Box extends Widget_Base {

	public function get_name() {
		return 'mellis_elementor_ova_image_box';
	}

	public function get_title() {
		return esc_html__( 'Ova Image Box', 'mellis' );
	}

	public function get_icon() {
		return 'eicon-featured-image';
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
						'template1' => esc_html__('Template 1', 'mellis'),
						'template2' => esc_html__('Template 2', 'mellis'),
					]
				]
			);

			$this->add_control(
				'image',
				[
					'label' => esc_html__( 'Image', 'mellis' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'mellis' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'flaticon flaticon-facial-treatment-1',
						'library' 	=> 'flaticon',
					],
				]
			);

			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'mellis' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Professional Facial Treatment For Men & Women', 'mellis' ),
				]
			);

			$this->add_control(
				'link',
				[
					'label' => esc_html__( 'Link Title', 'mellis' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'mellis' ),
					'options' => [ 'url', 'is_external', 'nofollow' ],
					'default' => [
						'url' => '',
						'is_external' => false,
						'nofollow' => false,
					],
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$this->add_control(
				'tag',
				[
					'label' => esc_html__( 'HTML Tag', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'h2',
					'options' => [
						'h1' => esc_html__( 'H1', 'mellis' ),
						'h2' => esc_html__( 'H2', 'mellis' ),
						'h3' => esc_html__( 'H3', 'mellis' ),
						'h4' => esc_html__( 'H4', 'mellis' ),
						'h5' => esc_html__( 'H5', 'mellis' ),
						'h6' => esc_html__( 'H6', 'mellis' ),
						'div' => esc_html__( 'div', 'mellis' ),
						'span' => esc_html__( 'span', 'mellis' ),
						'p' => esc_html__( 'p', 'mellis' ),
					],
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' 	=> esc_html__( 'Alignment', 'mellis' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'start' 	=> [
							'title' => esc_html__( 'Left', 'mellis' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'mellis' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'end' => [
							'title' => esc_html__( 'Right', 'mellis' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-image-box' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'general_section',
			[
				'label' => esc_html__( 'General', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		   $this->add_responsive_control(
				'general_max_width',
				[
					'label' => esc_html__( 'Max Width', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 600,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-image-box' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'general_background_color',
				[
					'label' => esc_html__( 'Background Color', 'mellis' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-image-box' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'general_padding',
				[
					'label' => esc_html__( 'Padding', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-image-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'general_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'mellis' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-image-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'general_border',
					'selector' => '{{WRAPPER}} .ova-image-box',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'general_box_shadow',
					'selector' => '{{WRAPPER}} .ova-image-box',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'icon_options',
				[
					'label' => esc_html__( 'Icon', 'mellis' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);

				$this->add_responsive_control(
					'icon_size',
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
							'{{WRAPPER}} .ova-image-box .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'icon_color',
					[
						'label' => esc_html__( 'Color', 'mellis' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-image-box .icon i' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_responsive_control(
					'icon_margin',
					[
						'label' => esc_html__( 'Margin', 'mellis' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'rem' ],
						'selectors' => [
							'{{WRAPPER}} .ova-image-box .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

			$this->add_control(
				'title_options',
				[
					'label' => esc_html__( 'Title', 'mellis' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'title_typography',
						'selector' => '{{WRAPPER}} .ova-image-box .title',
					]
				);

				$this->add_control(
					'title_color',
					[
						'label' => esc_html__( 'Color', 'mellis' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-image-box .title' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_responsive_control(
					'title_margin',
					[
						'label' => esc_html__( 'Margin', 'mellis' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'rem' ],
						'selectors' => [
							'{{WRAPPER}} .ova-image-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

		$template    =  $settings['template'];

		$title 		 = 	$settings['title'];
		$tag 		 = 	$settings['tag'];

		$image 		 = 	$settings['image'];
		$url		 = 	$settings['image']['url'];
		$image_alt 	 =  ( isset( $settings['image']['alt']) &&  $settings['image']['alt'] != '' ) ?  $settings['image']['alt'] : $title;

		$link        =  $settings['link'];
		$nofollow    =  ( isset( $link['nofollow'] ) && $link['nofollow'] == 'on' ) ? 'nofollow' : '';
		$target      =  ( isset( $link['is_external'] ) && $link['is_external'] == 'on' ) ? '_blank' : '_self';

		?>

		<div class="ova-image-box ova-image-box-<?php echo esc_attr( $template ); ?>">

			<?php if( !empty( $url ) ) : ?>
				<div class="img-wrapper">
					<img src="<?php echo esc_attr( $url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
					<?php if($template == 'template1') { ?>
						<?php if( !empty($link['url'])) : ?>
							<a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($nofollow);?>">
						<?php endif; ?>
						<div class="icon-arrow">
							<i aria-hidden="true" class="fas fa-arrow-right"></i>
						</div>
						<?php if( !empty($link['url'])) : ?>
							</a>
						<?php endif; ?>
					<?php } ?>
				</div>
			<?php endif; ?>	

			<?php if( !empty($settings['icon']['value']) ) { ?>
				<div class="icon">
            		<?php 
				        \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
				    ?>		
            	</div>
			<?php } ?>

			<?php if( !empty($link['url'])) : ?>
				<a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($nofollow);?>">
			<?php endif; ?>

				<?php if( !empty( $title ) ) { ?><<?php echo esc_html( $tag ); ?> class="title"><?php echo esc_html( $title ); ?></<?php echo esc_html( $tag ); ?>><?php } ?>

			<?php if( !empty($link['url'])) : ?>
				</a>
			<?php endif; ?>


		</div>

		<?php
	}
}

$widgets_manager->register( new Mellis_Elementor_Ova_Image_Box() );