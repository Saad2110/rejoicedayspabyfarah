<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Mellis_Elementor_Counter extends Widget_Base {

	
	public function get_name() {
		return 'mellis_elementor_counter';
	}

	
	public function get_title() {
		return esc_html__( 'Ova Counter', 'mellis' );
	}

	
	public function get_icon() {
		return 'eicon-counter';
	}

	
	public function get_categories() {
		return [ 'mellis' ];
	}

	public function get_script_depends() {
		// appear js
		wp_enqueue_script( 'mellis-counter-appear', get_theme_file_uri('/assets/libs/appear/appear.js'), array('jquery'), false, true);
		// Odometer for counter
		wp_enqueue_style( 'odometer', get_template_directory_uri().'/assets/libs/odometer/odometer.min.css' );
		wp_enqueue_script( 'odometer', get_template_directory_uri().'/assets/libs/odometer/odometer.min.js', array('jquery'), false, true );
		return [ 'mellis-elementor-counter' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Ova Counter', 'mellis' ),
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
						'template3' => esc_html__('Template 3', 'mellis'),
					]
				]
			);

		    $this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'mellis' ),
					'type' => Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'flaticon flaticon-massage-1',
						'library' 	=> 'flaticon',
					],
				]
			);

		    $this->add_control(
				'number',
				[
					'label' 	=> esc_html__( 'Number', 'mellis' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => esc_html__( '23', 'mellis' ),
				]
			);

			$this->add_control(
				'suffix',
				[
					'label'  => esc_html__( 'Suffix', 'mellis' ),
					'type'   => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Plus', 'mellis' ),
				]
			);

			$this->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'mellis' ),
					'type' 	=> Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Years Experience', 'mellis' ),
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' 	=> esc_html__( 'Alignment', 'mellis' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'flex-start' 	=> [
							'title' => esc_html__( 'Left', 'mellis' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'mellis' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'flex-end' => [
							'title' => esc_html__( 'Right', 'mellis' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-counter' => 'justify-content: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'show_star',
				[
					'label' => esc_html__( 'Show Star', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'mellis' ),
					'label_off' => esc_html__( 'Hide', 'mellis' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);
			
		$this->end_controls_section();

		/* Begin Counter Style */
		$this->start_controls_section(
            'counter_style',
            [
               'label' => esc_html__( 'Ova Counter', 'mellis' ),
               'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_responsive_control(
				'order_column',
				[
					'label' 	=> esc_html__( 'Column Content', 'mellis' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'column' => [
							'title' => esc_html__( 'Default', 'mellis' ),
							'icon' 	=> 'eicon-h-align-left',
						],
						
						'column-reverse' => [
							'title' => esc_html__( 'Reverse', 'mellis' ),
							'icon' 	=> 'eicon-h-align-right',
						],
					],
				
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .counter-content' => 'display: flex;flex-direction: {{VALUE}}',

					],
				]
			);

            $this->add_control(
				'counter_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter' => 'background-color: {{VALUE}};',
					],
				]
			);

		    $this->add_responsive_control(
	            'counter_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_responsive_control(
				'counter_max_width',
				[
					'label' 		=> esc_html__( 'Max Width', 'mellis' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> ['px'],
					'range' => [
						'px' => [
							'min' => 200,
							'max' => 900,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-counter' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();
		/* End counter style */

		/* Begin icon Style */
		$this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Icon', 'mellis' ),
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
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-counter .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-counter .icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

            $this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .icon i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-counter .icon svg path' => 'fill : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .icon i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-counter:hover .icon svg path' => 'fill : {{VALUE}};',
					],
				]
			);
		
        $this->end_controls_section();
		/* End icon style */

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
					'selector' 	=> '{{WRAPPER}} .ova-counter .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .title' => 'color: {{VALUE}};',
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
	                    '{{WRAPPER}} .ova-counter .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'title_border',
					'label' => esc_html__( 'Border', 'mellis' ),
					'selector' => '{{WRAPPER}} .ova-counter .title',
				]
			);

        $this->end_controls_section();
		/* End title style */

		/* Begin number (odometer) Style */
		$this->start_controls_section(
            'number_style',
            [
                'label' => esc_html__( 'Number', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			 $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'number_typography',
					'selector' 	=> '{{WRAPPER}} .ova-counter .odometer',
				]
			);

			$this->add_control(
				'number_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .odometer' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'number_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .odometer' => 'color: {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
		/* End number style */

		/* Begin suffix Style */
		$this->start_controls_section(
            'suffix_style',
            [
                'label' => esc_html__( 'Suffix', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'suffix_typography',
					'selector' 	=> '{{WRAPPER}} .ova-counter .suffix',
				]
			);

			$this->add_control(
				'suffix_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .suffix' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'suffix_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .suffix' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'suffix_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-counter .suffix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End suffix style */
		
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

        $template    = $settings['template'];
        $icon  		 = $settings['icon'];
		$number      = isset( $settings['number'] ) ? $settings['number'] : '100';
		$suffix      = $settings['suffix'];
		$title       = $settings['title'];

		// replace % to %% avoid printf error
		if(strpos($title, '%') !== false){
		    $title = str_replace('%', '%%', $title);
		}

		$show_star   = $settings['show_star'];

		?>
           
           <div class="ova-counter ova-counter-<?php echo esc_attr( $template ); ?>" 
                data-count="<?php echo esc_attr( $number ); ?>">
        
                <?php if (!empty( $icon['value'] )): ?>
                	<div class="icon">
	            	    <?php 
						    \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
						?>	
	            	</div>
	            <?php endif;?>
            
	            <div class="counter-content">

	            	<?php if ( $template === "template2" ) : ?>
			      	    <?php if (!empty( $title )): ?>
							<h4 class="title"><?php printf( $title ); ?></h4>
						<?php endif;?>
					<?php endif;?>
		 			
		 			<div class="counter">
	            		<span class="odometer">0</span><span class="suffix"><?php echo esc_html( $suffix ); ?></span>
	            	</div>

	            	<div class="title-star">
	            		<?php if ( $template !== "template2" ) : ?>
				      	    <?php if (!empty( $title )): ?>
								<h4 class="title"><?php printf( $title ); ?></h4>
							<?php endif;?>
						<?php endif;?>

						<?php if ( $show_star === "yes" ) : ?>
							<div class="icon-star">
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
							</div>
						<?php endif;?>
	            	</div>

	            </div>

           </div>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Mellis_Elementor_Counter() );