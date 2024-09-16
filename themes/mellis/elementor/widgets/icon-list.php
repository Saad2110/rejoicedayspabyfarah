<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Mellis_Elementor_Icon_List extends Widget_Base {

	public function get_name() {
		return 'mellis_elementor_icon_list';
	}

	public function get_title() {
		return esc_html__( 'Ova Icon List', 'mellis' );
	}

	public function get_icon() {
		return 'eicon-bullet-list';
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

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'mellis' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-check',
						'library' => 'all',
					],
				]
			);

			$repeater->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'mellis' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__('Quality Products', 'mellis' ),
				]
			);

            $repeater->add_control(
				'desc',
				[
					'label' 		=> esc_html__( 'Description', 'mellis' ),
					'type' 			=> Controls_Manager::TEXTAREA,
					'default' 		=> esc_html__('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam aperiam', 'mellis' ),
				]
			);

			$repeater->add_control(
				'active_mode',
				[
					'label' 	=> esc_html__( 'Active', 'mellis' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'mellis' ),
					'label_off' => esc_html__( 'No', 'mellis' ),
					'default' 	=> 'no',
				]
			);

			$this->add_control(
				'ico_items',
				[
					'label' 	=> esc_html__( 'Items', 'mellis' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'title' 	=> esc_html__( 'Quality Products', 'mellis' ),
							'active_mode' => 'no',
						],
						[
							'title' 	=> esc_html__( 'Best Pricing & 100% Organic', 'mellis' ),
							'active_mode' => 'yes',
						],
						[
							'title' 	=> esc_html__( 'Professional & Expert Staff', 'mellis' ),
							'active_mode' => 'no',
						],
					
					],
					'title_field' => '{{{ title }}}',
				]
			);

			$this->add_control(
				'show_line_before',
				[
					'label' 	=> esc_html__( 'Line Before', 'mellis' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'mellis' ),
					'label_off' => esc_html__( 'Hide', 'mellis' ),
					'default' 	=> 'yes',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'line_background',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .ova-icon-list .item:before',
					'condition' => [
						'show_line_before' => 'yes'
					]
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'mellis' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'color_icon',
				[
					'label' => esc_html__( 'Color', 'mellis' ),
					'type' 	=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-list .item i' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bg_color_icon',
				[
					'label' 	=> esc_html__( 'Background Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-list .item i' => 'background-color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'mellis' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-icon-list .item .title',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-list .item .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_title',
				[
					'label' 		=> esc_html__( 'Padding', 'mellis' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-list .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_title',
				[
					'label' 		=> esc_html__( 'Margin', 'mellis' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-list .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_desc_style',
			[
				'label' => esc_html__( 'Description', 'mellis' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'desc_typography',
					'selector' 	=> '{{WRAPPER}} .ova-icon-list .item .desc',
				]
			);

			$this->add_control(
				'color_desc',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-list .item .desc' => 'color : {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
	}

	// Render Template Here
	protected function render() {
		$settings = $this->get_settings();

        $items 				= $settings['ico_items'];
		$show_line_before 	= $settings['show_line_before'];

		?>

			<div class="ova-icon-list">
				<?php if( !empty( $items ) ) : ?>
					<?php foreach( $items as $item ): ?>
						<div class="item <?php if ('yes' == $show_line_before) echo 'item-line'; ?> <?php if ('yes' == $item['active_mode']) echo 'active'; ?>">
							<?php if(!empty($item['icon']['value']) ) { ?>
								<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							<?php } ?>
							<div class="info">
								<?php if( !empty($item['title']) ) { ?>
									<h3 class="title">
										<?php echo esc_html( $item['title'] );?>
									</h3>
								<?php } ?>
								<?php if( !empty($item['desc']) ) { ?>
									<p class="desc"><?php echo esc_html( $item['desc'] );?></p>
								<?php } ?>
							</div>
						</div>
					<?php endforeach; 
				endif; ?>
			</div>

		<?php
	}
	
}

$widgets_manager->register( new Mellis_Elementor_Icon_List() );