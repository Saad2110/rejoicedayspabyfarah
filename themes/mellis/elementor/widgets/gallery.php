<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Mellis_Elementor_Gallery extends Widget_Base {

	
	public function get_name() {
		return 'mellis_elementor_gallery';
	}

	public function get_title() {
		return esc_html__( 'Gallery', 'mellis' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'mellis' ];
	}

	public function get_script_depends() {
		wp_enqueue_style('fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.css');
		wp_enqueue_script('fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.umd.js', array('jquery'),null,true);
		wp_enqueue_script('masonry', get_template_directory_uri().'/assets/libs/masonry.min.js', array('jquery'), false, true );
		return ['mellis-elementor-gallery'];
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
					'label' => __( 'Icon', 'mellis' ),
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'flaticon flaticon-add',
						'library' => 'flaticon',
					],

				]
			);

			// Add Class control
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'caption',
				[
					'label'   => esc_html__( 'Caption Image', 'mellis' ),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__( 'Caption', 'mellis' ),
				]
			);

			$repeater->add_control(
				'image',
				[
					'label'   => esc_html__( 'Gallery Image', 'mellis' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'image_popup',
				[
					'label'   => esc_html__( 'Popup Image', 'mellis' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_responsive_control(
				'image_width',
				[
					'label' 		=> esc_html__( 'Width', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'default' => [
						'unit' => '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1000,
							'step' 	=> 10,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}}!important',
					],
				]
			);

			$repeater->add_responsive_control(
				'image_height',
				[
					'label' 		=> esc_html__( 'Height', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'default' => [
						'unit' => '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1000,
							'step' 	=> 10,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid {{CURRENT_ITEM}} img' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$repeater->add_responsive_control(
				'image_padding',
				[
					'label'      => esc_html__( 'Padding', 'mellis' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-gallery .grid {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'tab_item',
				[
					'label'		=> esc_html__( 'Items Gallery', 'mellis' ),
					'type'		=> Controls_Manager::REPEATER,
					'fields'  	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'caption' 	=>  esc_html__( 'Gallery 01', 'mellis' ),
						],
						[
							'caption' 	=>  esc_html__( 'Gallery 02', 'mellis' ),
						],
						[
							'caption' 	=>  esc_html__( 'Gallery 03', 'mellis' ),
						],
						[
							'caption' 	=>  esc_html__( 'Gallery 04', 'mellis' ),
						],
					],
					'title_field' => '{{{ caption }}}',
				]
			);

			$this->add_responsive_control(
				'grid_sizer',
				[
					'label' 		=> esc_html__( 'Grid Sizer', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'default' => [
						'unit' => '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 500,
							'step' 	=> 10,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-sizer, {{WRAPPER}} .ova-gallery .grid .grid-item' => 'width: {{SIZE}}{{UNIT}}',
					],
					'description' => esc_html__('Default grid sizer is 25% (4 columns)','mellis'),
					'separator'   => 'before'
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' => esc_html__( 'Image', 'mellis' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'image_margin',
				[
					'label'      => esc_html__( 'Margin', 'mellis' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'image_padding',
				[
					'label'      => esc_html__( 'Padding', 'mellis' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'mellis' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'content_bg_hover',
				[
					'label'     => esc_html__( 'Background Hover', 'mellis' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container:before' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'content_opacity',
				[
					'label' => esc_html__( 'Opacity', 'mellis' ),
					'type' 	=> Controls_Manager::SLIDER,
					
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1,
							'step' 	=> 0.1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item:hover .gallery-fancybox .gallery-container:before' => 'opacity: {{SIZE}}',
					],
				]
			);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon', 'mellis' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'icon_typography',
					'selector' => '{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-icon i',
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label'     => esc_html__( 'Color', 'mellis' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-icon i' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'icon_border',
					'label' 	=> esc_html__( 'Border', 'mellis' ),
					'selector' 	=> '{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-icon',
				]
			);
			
			$this->add_responsive_control(
				'icon_top',
				[
					'label' => esc_html__( 'Top', 'mellis' ),
					'type' 	=> Controls_Manager::SLIDER,
					'size_units' => [ '%', 'px' ],
					'default' => [
						'unit' => 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 500,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-icon' => 'top: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'icon_right',
				[
					'label' => esc_html__( 'Right', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ '%', 'px' ],
					'default' => [
						'unit' => 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-icon' => 'right: {{SIZE}}{{UNIT}}',
					],
				]
			);

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		// Get list item
		$tabs 		= $settings['tab_item'];
		$icon 		= $settings['class_icon']['value'];

		?>

		<?php if ( $tabs && is_array( $tabs ) ): ?>
	        <div class="ova-gallery">
	        	<div class="grid">
	        		<div class="grid-sizer"></div>
	        		
	  				<?php foreach ( $tabs as $key => $items ): 
	  					$img_url 	= $items['image']['url'];
	  					$img_popup 	= $items['image_popup']['url'];
	  					$img_alt 	= isset( $items['image']['alt'] ) ? $items['image']['alt'] : $items['caption'];
	  					$caption 	= $items['caption'];
	  					$item_id 	= 'elementor-repeater-item-' . $items['_id'];

	  					if ( ! $caption ) {
	  						$caption = $img_alt;
	  					}
	  				?>
	  					<div class="grid-item <?php echo esc_attr( $item_id ); ?>">
	  						<a class="gallery-fancybox" data-src="<?php echo esc_url( $img_popup ); ?>"
	  							data-fancybox="gallery"
	  							data-caption="<?php echo esc_attr( $caption ); ?>">

	  							<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $caption ); ?>">
	  							<div class="gallery-container">
		  							<?php if ( $icon ): ?>
		  								<div class="gallery-icon">
			  								<i class="<?php echo esc_attr( $icon ); ?>"></i>
			  							</div>
		  							<?php endif; ?>
		  						</div>
	  						</a>
	  					</div>
	  				<?php endforeach; ?>
	        	</div>

			</div>
		<?php
		endif;
	}

	
}
$widgets_manager->register( new Mellis_Elementor_Gallery() );