<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Mellis_Elementor_Pricing_Tab extends Widget_Base {

	public function get_name() {
		return 'mellis_elementor_pricing_tab';
	}

	public function get_title() {
		return esc_html__( 'Pricing Tab', 'mellis' );
	}

	public function get_icon() {
		return 'eicon-tabs';
	}

	public function get_categories() {
		return [ 'mellis' ];
	}

	public function get_script_depends() {
		return [ 'mellis-elementor-pricing-tab' ];
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
				'label_month',
				[
					'label' => esc_html__( 'Label', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Monthly', 'mellis' ),
				]
			);

			$this->add_control(
	            'tab_content_month',
	            [
	                'label' => esc_html__( 'Shortcode Pricing 1', 'mellis' ),     
	                'type' => Controls_Manager::TEXTAREA,
	                'description' => esc_html__( 'Shortcode Pricing', 'mellis' ),
	            ]
	        );

			$this->add_control(
				'label_year',
				[
					'label' => esc_html__( 'Label', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Yearly', 'mellis' ),
				]
			);

			$this->add_control(
	            'tab_content_year',
	            [
	                'label' => esc_html__( 'Shortcode Pricing 2', 'mellis' ),
	                'type' => Controls_Manager::TEXTAREA,
	                'description' => esc_html__( 'Shortcode Pricing 2', 'mellis' ),
	            ]
	        );	

		$this->end_controls_section();

		/* Begin label Style */
		$this->start_controls_section(
            'label_style',
            [
                'label' => esc_html__( 'Label', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'label_typography',
					'selector' 	=> '{{WRAPPER}} .ova-pricing-tab .tab-pricing-switch .price-label',
				]
			);

			$this->add_control(
				'label_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing-tab .tab-pricing-switch .price-label' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'label_color_active',
				[
					'label' 	=> esc_html__( 'Color Active', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing-tab .tab-pricing-switch .price-label.label-active' => 'color: {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
		/* End label style */

		/* Begin switch button Style */
		$this->start_controls_section(
            'switch_button_style',
            [
                'label' => esc_html__( 'Switch Button', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_control(
				'switch_button_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing-tab .tab-pricing-switch .slider:before' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'switch_button_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-pricing-tab .tab-pricing-switch .slider' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'switch_button_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-pricing-tab .tab-pricing-switch .switch' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'switch_button_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radisu', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-pricing-tab .tab-pricing-switch .switch .slider.round' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End switch button style */

	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

		$label_month = $settings['label_month'];
		$label_year  = $settings['label_year'];

		$tab_content_month = $settings['tab_content_month'];
		$tab_content_year  = $settings['tab_content_year'];

		?>

		    <div class="ova-pricing-tab">

			    <div class="tab-pricing-switch">
			    	<label class="price-label pricing-tab1 label-active">
			    		<?php echo esc_html($label_month); ?>
			    	</label>

			    	<div class="switch" data-active="pricing-tab1">
					    <span class="slider round"></span>
					</div>

					<label class="price-label pricing-tab2">
						<?php echo esc_html($label_year); ?>
					</label>
			    </div>

				<div class="tab-pricing-content">
					<div class="tab-pane pricing-tab1 active">
                        <?php echo do_shortcode( $tab_content_month ); ?>
					</div>
					<div class="tab-pane pricing-tab2">
                        <?php echo do_shortcode( $tab_content_year ); ?>
					</div>
				</div>

			</div>

		<?php
	}
	
}
$widgets_manager->register( new Mellis_Elementor_Pricing_Tab() );