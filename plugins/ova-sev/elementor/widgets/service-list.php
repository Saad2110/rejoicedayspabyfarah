<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Ovasev_Elementor_Service_List extends Widget_Base {

	
	public function get_name() {
		return 'ovasev_elementor_service_list';
	}

	
	public function get_title() {
		return esc_html__( 'Service List', 'ova-sev' );
	}

	
	public function get_icon() {
		return 'eicon-bullet-list';
	}

	
	public function get_categories() {
		return [ 'ovasev' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'ova-sev' ),
			]
		);	
				
			// Add Class control

			$this->add_control(
				'template',
				[
					'label' => esc_html__( 'Template', 'ova-sev' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'template1',
					'options' => [
						'template1' => esc_html__('Template 1', 'ova-sev'),
						'template2' => esc_html__('Template 2', 'ova-sev'),
					]
				]
			);

			$this->add_control(
				'posts_per_page',
				[
					'label'   => esc_html__( 'Post Per Page', 'ova-sev' ),
					'type'    => Controls_Manager::NUMBER,
					'min'     => 1,
					'default' => 5
				]
			);

			$this->add_control(
				'order_by',
				[
					'label'   => esc_html__( 'Order By', 'ova-sev' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'date',
					'options' => [
						'title' => esc_html__( 'Title', 'ova-sev' ),
						'date' 	=> esc_html__( 'Date', 'ova-sev' ),
						'ID' 	=> esc_html__( 'ID', 'ova-sev' ),			
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label'   => esc_html__( 'Order', 'ova-sev' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'DESC',
					'options' => [
						'DESC' => esc_html__( 'Descending', 'ova-sev' ),
						'ASC'  => esc_html__( 'Ascending', 'ova-sev' ),
					],
				]
			);

			$this->add_control(
				'target_blank',
				[
					'label' 		=> esc_html__( 'Target Blank', 'ova-sev' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Yes', 'ova-sev' ),
					'label_off' 	=> esc_html__( 'No', 'ova-sev' ),
					'default' 		=> 'no',
				]
			);

			$this->add_control(
				'title_limit',
				[
					'label'   		=> esc_html__( 'Title Limit', 'ova-sev' ),
					'type'    		=> Controls_Manager::NUMBER,
					'min'     		=> -1,
					'default' 		=> 10,
					'description' 	=> esc_html__( 'Limit words to display "Title Service"', 'ova-sev' ),
				]
			);

		$this->end_controls_section();

		 //******Service List style*****/
		$this->start_controls_section(
			'section_service_list_style',
			[
				'label' => esc_html__( 'Service List', 'ova-sev' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'bgcolor_service_list',
				[
					'label' => esc_html__( 'Background Color', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-list li.item a' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bgcolor_service_list_hover',
				[
					'label' => esc_html__( 'Background Color Hover', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-list li.item a:hover' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_service_list',
				[
					'label' => esc_html__( 'Padding', 'ova-sev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-service-list li.item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_service_list',
				[
					'label' => esc_html__( 'Margin', 'ova-sev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-service-list li.item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'border_radius_service_list',
				[
					'label' => esc_html__( 'Border Radius', 'ova-sev' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-service-list li.item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();
		
		//******Title Service style*****/
		$this->start_controls_section(
			'section_title_service_style',
			[
				'label' => esc_html__( 'Service Title', 'ova-sev' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_service_typography',
					'selector' => '{{WRAPPER}} .ova-service-list .service-title-list li.item a',
					'condition' => [
						'template' => 'template1'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_service_typography_2',
					'selector' => '{{WRAPPER}} .ova-service-list.template2 .service-title-list li.item a .service-title',
					'condition' => [
						'template' => 'template2'
					]
				]
			);

			$this->add_control(
				'color_title_service',
				[
					'label' => esc_html__( 'Color', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-list .service-title-list li.item a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_title_service_hover',
				[
					'label' => esc_html__( 'Color Hover', 'ova-sev' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-service-list .service-title-list li.item:hover a' => 'color : {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();

		
	}

	// Render Template Here
	protected function render() {

		$settings       = $this->get_settings();

		// template
    	$template 	 	= $settings['template'];


		$posts_per_page = $settings['posts_per_page'];
		$order_by       = $settings['order_by'];
		$order          = $settings['order'];
		$limit          = $settings['title_limit'];
		$target 	    = 'yes' == $settings['target_blank'] ? ' target="_blank"' : '';

		$args_posts = array(
			'post_type'      => 'ova_sev',
            'post_status'    => 'publish',
            'posts_per_page' => $posts_per_page,
			'orderby'        => $order_by,
			'order'          => $order
		);

		$posts   = new \WP_Query( $args_posts );

		$post_id = get_the_ID();

		?>
             
            <div class="ova-service-list <?php echo esc_attr($template);?>">

				<ul class="service-title-list">

					<?php if ( $posts->have_posts() ) : $count = 0; ?>

						<?php while ( $posts->have_posts() ) : $posts->the_post(); 
							$id       = get_the_ID();
							$title    = get_the_title( $id );
							$excerpt  = wp_trim_words( $title, $limit, '' );

							$class_icon = get_post_meta( $id, 'ova_sev_met_icon', true );

							$categories = get_the_terms( $id, 'cat_sev' );
							if( $categories ) {
								$first_category = $categories[0]->name;
							}

							$count += 1;
						?>
							<?php if ( $post_id && $post_id == $id ): ?>
							 	<li class="item active">
							<?php else: ?>
							  	<li class="item">
							<?php endif; ?>
								<a href="<?php echo esc_url( get_post_permalink( $id ) ); ?>" <?php echo esc_html( $target ); ?>>

									<div class="info">
										<?php if ( $template == 'template2' ): ?>
											<div class="icon_count">
												<?php if ( !empty( $class_icon ) ): ?>
													<div class="icon-service">
														<i class="<?php echo esc_attr( $class_icon ); ?>"></i>
													</div>
												<?php endif;?>
												<span class="count">
													<?php printf('%02s', $count); ?>
												</span>
											</div>
											<div class="category-title">
												<?php if ( isset($first_category) ): ?>
													<span class="category">
														<?php echo esc_html( $first_category ); ?>
													</span>
												<?php endif;?>
												<span class="service-title">
													<?php if ( !empty( $title )) { 
						                                	echo esc_html( $excerpt ); 
						                                }
						                                else { 
						                                	echo esc_html_e('Untitled', 'ova-sev'); 
						                                }
						                            ?>
												</span>
											</div>
										<?php endif;?>

										<?php if ( $template == 'template1' ): ?>
											<span class="service-title">
												<?php if ( !empty( $title )) { 
					                                	echo esc_html( $excerpt ); 
					                                }
					                                else { 
					                                	echo esc_html_e('Untitled', 'ova-sev'); 
					                                }
					                            ?>
											</span>
										<?php endif;?>
									</div>
									<div class="icon-arrow">
										<?php if ( $template == 'template1' ): ?>
			                                <i class="ovaicon ovaicon-fast-forward"></i>
			                            <?php else: ?>
			                            	<i aria-hidden="true" class="fas fa-arrow-right"></i>
			                            <?php endif;?>
		                            </div>
								</a>
							</li>
						<?php endwhile; wp_reset_postdata();  ?>

			        <?php endif; ?>

				</ul>

			</div>
		 	
		<?php
	}

	
}

$widgets_manager->register( new Ovasev_Elementor_Service_List() );