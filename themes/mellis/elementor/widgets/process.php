<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Mellis_Elementor_Process extends Widget_Base {

	
	public function get_name() {
		return 'mellis_elementor_process';
	}

	
	public function get_title() {
		return esc_html__( 'Process', 'mellis' );
	}

	
	public function get_icon() {
		return 'eicon-number-field';
	}

	
	public function get_categories() {
		return [ 'mellis' ];
	}

	public function get_script_depends() {
		// appear js
		wp_enqueue_script( 'mellis-counter-appear', get_theme_file_uri('/assets/libs/appear/appear.js'), array('jquery'), false, true);
		return [ 'mellis-elementor-process' ];
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
				'number_column',
				[
					'label' => esc_html__( 'Number Column', 'mellis' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'three_column',
					'options' => [
						'one_column' => esc_html__('Single Column', 'mellis'),
						'two_column' => esc_html__('2 Columns', 'mellis'),
						'three_column' => esc_html__('3 Columns', 'mellis'),
					]
				]
			);
            
            $repeater = new \Elementor\Repeater();

		    $repeater->add_control(
				'image',
				[
					'label'   => esc_html__( 'Image', 'mellis' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					]
				]
			);

			$repeater->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'mellis' ),
					'type' => Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => esc_html__( 'https://your-link.com', 'mellis' ),
					'show_label' => true,
				]
			);

			$repeater->add_control(
				'text_number',
				[
					'label' => esc_html__( 'Text Number', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( '01', 'mellis' ),
				]
			);

			$repeater->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'default' => 'Meeting',
				]
			);

			$repeater->add_control(
				'description',
				[
					'label' 	=> esc_html__( 'Description', 'mellis' ),
					'type' 		=> Controls_Manager::TEXTAREA,
					'default' 	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur notted adipisicing elit sed do eiusmod.', 'mellis' ),
				]
			);

			$repeater->add_responsive_control(
				'animation_content',
				[
					'label' => esc_html__( 'Animation Content', 'mellis' ),
					'type' 	=> Controls_Manager::ANIMATION,
				]
			);

			$repeater->add_control(
				'animation_duration_content',
				[
					'label' 	=> esc_html__( 'Animation Duration', 'mellis' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> '',
					'options' 	=> [
						'slow' 	=> esc_html__( 'Slow', 'mellis' ),
						'' 		=> esc_html__( 'Normal', 'mellis' ),
						'fast' 	=> esc_html__( 'Fast', 'mellis' ),
					],
					'condition' => [
						'animation_content!' => '',
					],
				]
			);

			$repeater->add_control(
				'animation_delay_content',
				[
					'label' 	=> esc_html__( 'Animation Delay', 'mellis' ) . ' (ms)',
					'type' 		=> Controls_Manager::NUMBER,
					'default' 	=> '',
					'min' 		=> 0,
					'step' 		=> 100,
					'condition' => [
						'animation_content!' => '',
					],
				]
			);

			$this->add_control(
				'items',
				[
					'label' => esc_html__( 'Items', 'mellis' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[	
							'text_number'  => esc_html__( '01', 'mellis' ),
							'title'        => 'Meeting', 'mellis',
						],
						[	
							'text_number'  => esc_html__( '02', 'mellis' ),
							'title'        => 'Treatment',
						],
						[	
							'text_number'  => esc_html__( '03', 'mellis' ),
							'title'        => 'Finalizing',
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

		/* Begin text number Style */
		$this->start_controls_section(
            'textnumber_style',
            [
                'label' => esc_html__( 'Text Number', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'textnumber_typography',
					'selector' 	=> '{{WRAPPER}} .ova-process .item-process .image-process .text_number',
				]
			);

			$this->add_control(
				'textnumber_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-process .item-process .image-process .text_number' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'textnumber_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-process .item-process .image-process .text_number' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'textnumber_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-process .item-process:hover .image-process .text_number' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'textnumber_bgcolor_hover',
				[
					'label' 	=> esc_html__( 'Background Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-process .item-process:hover .image-process .text_number' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'textnumber_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-process .item-process .image-process .text_number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'text_number_border',
					'label' => esc_html__( 'Border', 'mellis' ),
					'selector' => '{{WRAPPER}} .ova-process .item-process .image-process .text_number',
				]
			);

        $this->end_controls_section();

		/* Begin title Style */
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
					'selector' 	=> '{{WRAPPER}} .ova-process .item-process .info .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-process .item-process .info .title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-process .item-process:hover .info .title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-process .item-process .info .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End title style */

		/* Begin description Style */
		$this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__( 'Description', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_typography',
					'selector' 	=> '{{WRAPPER}} .ova-process .item-process .info .description',
				]
			);

			$this->add_control(
				'description_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-process .item-process .info .description' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'description_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-process .item-process:hover .info .description' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'description_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-process .item-process .info .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End description style */

		/* Begin Item Process Style */
		$this->start_controls_section(
            'item_process_style',
            [
                'label' => esc_html__( 'Item Process', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_control(
				'circle_border_color',
				[
					'label' 	=> esc_html__( 'Color Circle', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-process .item-process .image-process:before' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'line_process_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Line', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-process .item-process:before, {{WRAPPER}} .ova-process .item-process:first-child:after, {{WRAPPER}} .ova-process .item-process:last-child:after' => 'background-color: {{VALUE}};',
					],
				]
			);

         $this->end_controls_section();
		
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

		$number_column    =    $settings['number_column'];
		$items            =    $settings['items']; 

		?>

		 	<div class="ova-process <?php echo esc_attr( $number_column ); ?>">

		 		<?php 

		           foreach( $items as $item ) {

	                $title            =    $item['title'];
					$text_number      =    $item['text_number'];
					$description      =    $item['description'];
					$link             =    $item['link'];
					$nofollow         =    ( isset( $link['nofollow'] ) && $link['nofollow'] ) ? 'rel=nofollow' : '';
					$target           =    ( isset( $link['is_external'] ) && $link['is_external'] !== '' ) ? 'target=_blank' : '';

					// get url image
					$url 	 = $item['image']['url'];
					if ( empty( $url ) ) {
						return;
					}
					$alt_img = ( isset( $item['image']['alt'] ) &&  $item['image']['alt'] !== '' ) 
					           ? $item['image']['alt'] : $title ;

					//Animation Content
					$animation_content 	= $item['animation_content'];
					$duration_content 	= $item['animation_duration_content'];
					$delay_content		= $item['animation_delay_content'];

					$data_animation_content = array(
						'animation' => $animation_content,
						'duration' 	=> $duration_content,
						'delay' 	=> $delay_content,
					);
				  
			    ?>

				    <div class="item-process<?php if ( $animation_content ) echo ' ova-invisible'; ?>" data-animation='<?php echo json_encode( $data_animation_content ); ?>'>

	                    <div class="image-process">
				 			<?php if (!empty( $text_number )): ?>
				            	<span class="text_number"><?php echo esc_html( $text_number ); ?></span>
				          	<?php endif;?>
			                
			                <?php if(!empty( $link['url'])) : ?>
							  <a href="<?php echo esc_url( $link['url'] ); ?> " <?php echo esc_attr( $target ); ?> <?php echo esc_attr( $nofollow ); ?> title="<?php echo esc_attr( $title ); ?>">
						    <?php endif; ?>
								<img src="<?php echo esc_url( $url );?>" alt="<?php echo esc_attr( $alt_img ); ?>">
				            <?php if(!empty( $link['url'])) : ?>
								</a>
							<?php endif; ?>
				 		</div>

				 		<div class="info">

				 			<?php if(!empty( $link['url'])) : ?>
							  <a href="<?php echo esc_url( $link['url'] ); ?> " <?php echo esc_attr( $target ); ?> <?php echo esc_attr( $nofollow ); ?> title="<?php echo esc_attr( $title ); ?>">
						    <?php endif; ?>
					            <?php if (!empty( $title )): ?>
									<h4 class="title">
										<?php printf( $title ); ?>
									</h4>
								<?php endif;?>
							<?php if(!empty( $link['url'])) : ?>
								</a>
							<?php endif; ?>

							<?php if (!empty( $description )): ?>
								<p class="description">
									<?php echo esc_html( $description ); ?>
								</p>
							<?php endif;?>  
				 		</div>

	                </div>

	            <?php } ?>

		    </div>

		<?php
	}

	
}
$widgets_manager->register( new Mellis_Elementor_Process() );