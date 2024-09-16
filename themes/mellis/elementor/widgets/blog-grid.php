<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Mellis_Elementor_Blog_Grid extends Widget_Base {

	public function get_name() {
		return 'mellis_elementor_blog_grid';
	}

	public function get_title() {
		return esc_html__( 'Blog Grid', 'mellis' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'mellis' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}

	protected function register_controls() {

		$args = array(
		  'orderby' => 'name',
		  'order' => 'ASC'
		);

		$categories=get_categories($args);
		$cate_array = array();
		$arrayCateAll = array( 'all' => esc_html__( 'All categories', 'mellis' ) );
		if ($categories) {
			foreach ( $categories as $cate ) {
				$cate_array[$cate->cat_name] = $cate->slug;
			}
		} else {
			$cate_array[ esc_html__( 'No content Category found', 'mellis' ) ] = 0;
		}

		//SECTION CONTENT
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
					]
				]
			);	

			$this->add_control(
				'template_2_style',
				[
					'label' => esc_html__( 'Template 2 Style', 'mellis' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'template_2_style1',
					'options' => [
						'template_2_style1' => esc_html__( 'Style 1', 'mellis' ),
						'template_2_style2' => esc_html__( 'Style 2', 'mellis' ),
					],
					'condition' => [
						'template' => 'template_2'
					]
				]
			);	

			$this->add_control(
				'category',
				[
					'label' => esc_html__( 'Category', 'mellis' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => array_merge($arrayCateAll,$cate_array),
				]
			);

			$this->add_control(
				'number_column',
				[
					'label' => esc_html__( 'Columns', 'mellis' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'column_3',
					'options' => [
						'column_2' => esc_html__( '2 Columns', 'mellis' ),
						'column_3' => esc_html__( '3 Columns', 'mellis' ),
						'column_4' => esc_html__( '4 Columns', 'mellis' ),
					]
				]
			);

			$this->add_control(
				'total_count',
				[
					'label' => esc_html__( 'Post Total', 'mellis' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 3,
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' 	=> esc_html__('Order By', 'mellis'),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'ID',
					'options' 	=> [
						'ID' 		=> esc_html__('ID', 'mellis'),
						'title' 	=> esc_html__('Title', 'mellis'),
						'date' 		=> esc_html__('Date', 'mellis'),
						'modified' 	=> esc_html__('Modified', 'mellis'),
						'rand' 		=> esc_html__('Rand', 'mellis'),
					]
				]
			);

			$this->add_control(
				'order_by',
				[
					'label' => esc_html__('Order', 'mellis'),
					'type' => Controls_Manager::SELECT,
					'default' => 'desc',
					'options' => [
						'asc' => esc_html__('Ascending', 'mellis'),
						'desc' => esc_html__('Descending', 'mellis'),
					]
				]
			);

			$this->add_control(
				'text_readmore',
				[
					'label' => esc_html__( 'Text Read More', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__('Read More', 'mellis'),
				]
			);

			$this->add_control(
				'show_short_desc',
				[
					'label' => esc_html__( 'Show Short Description', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'mellis' ),
					'label_off' => esc_html__( 'Hide', 'mellis' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'show_comment',
				[
					'label' => esc_html__( 'Show Comment', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'mellis' ),
					'label_off' => esc_html__( 'Hide', 'mellis' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'order_text',
				[
					'label' => esc_html__( 'Description Words Total', 'mellis' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 10,
					'condition' => [
						'show_short_desc' => 'yes',
					]
				]
			);

			
			$this->add_control(
				'show_date',
				[
					'label' => esc_html__( 'Show Date', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'mellis' ),
					'label_off' => esc_html__( 'Hide', 'mellis' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'show_author',
				[
					'label' => esc_html__( 'Show Author', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'mellis' ),
					'label_off' => esc_html__( 'Hide', 'mellis' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'show_title',
				[
					'label' => esc_html__( 'Show Title', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'mellis' ),
					'label_off' => esc_html__( 'Hide', 'mellis' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'show_category',
				[
					'label' => esc_html__( 'Show Category', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'mellis' ),
					'label_off' => esc_html__( 'Hide', 'mellis' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);

			$this->add_control(
				'show_read_more',
				[
					'label' => esc_html__( 'Show Read More', 'mellis' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'mellis' ),
					'label_off' => esc_html__( 'Hide', 'mellis' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

		$this->end_controls_section();
		//END SECTION CONTENT


		/* Begin General Style */
		$this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_responsive_control(
				'general_align',
				[
					'label' 	=> esc_html__( 'Alignment', 'mellis' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' => [
							'title' => esc_html__( 'Left', 'mellis' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'mellis' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'mellis' ),
							'icon' 	=> 'eicon-text-align-right',
						],
						
					],
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-blog .item .content' => 'text-align: {{VALUE}};',
						
					],
				]
			);

        	$this->add_responsive_control(
				'general_padding',
				[
					'label' => esc_html__( 'Padding', 'mellis' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-blog .item .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        	//version 3
			$this->add_responsive_control(
				'general_margin',
				[
					'label' => esc_html__( 'Margin', 'mellis' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-blog .item .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'template_3_general_background',
				[
					'label'	 	=> esc_html__( 'Background', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-blog .item .content' => 'background-color : {{VALUE}};'	
					],
				]
			);

        $this->end_controls_section();
		/* End General style */



		//SECTION TAB STYLE TITLE
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ova-blog .item .content .post-title a',
				
			]
		);

		$this->add_control(
			'color_title',
			[
				'label' => esc_html__( 'Color', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-title a' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_title_hover',
			[
				'label' => esc_html__( 'Color Hover', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-title a:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_title',
			[
				'label' => esc_html__( 'Margin', 'mellis' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_title',
			[
				'label' => esc_html__( 'Padding', 'mellis' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE


		$this->start_controls_section(
			'section_short_desc',
			[
				'label' => esc_html__( 'Short Description', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'short_desc_typography',
				'selector' => '{{WRAPPER}} .ova-blog .item .content .short_desc p',
				
			]
		);

		$this->add_control(
			'color_short_desc',
			[
				'label' => esc_html__( 'Color', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .short_desc p' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_short_desc',
			[
				'label' => esc_html__( 'Margin', 'mellis' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .short_desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_short_desc',
			[
				'label' => esc_html__( 'Padding', 'mellis' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .short_desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE


		$this->start_controls_section(
			'section_meta',
			[
				'label' => esc_html__( 'Meta', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'selector' => '{{WRAPPER}} .ova-blog .item .content .post-meta .item-meta .right a, .ova-blog .item .content .post-meta .item-meta .left i',
				
			]
		);

		$this->add_control(
			'text_color_meta',
			[
				'label' => esc_html__( 'Text Color', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-meta .item-meta .right a' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_color_meta_hover',
			[
				'label' => esc_html__( 'Link Color hover', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .post-meta .item-meta .right a:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color_meta',
			[
				'label' => esc_html__( 'Icon Color', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .post-meta .item-meta .left' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_meta',
			[
				'label' => esc_html__( 'Margin', 'mellis' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Category style TAB
		$this->start_controls_section(
			'category_section',
			[
				'label' => esc_html__( 'Category', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'selector' => '{{WRAPPER}} .ova-blog .item .content .post-meta .category',
			]
		);

		$this->add_control(
			'category_color',
			[
				'label' => esc_html__( 'Color', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-meta .category a' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'category_bgcolor',
			[
				'label' => esc_html__( 'Background', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-meta .category' => 'background-color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'category_padding',
			[
				'label' => esc_html__( 'Padding', 'mellis' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-meta .category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' 		=> 'border_category',
				'label' 	=> esc_html__( 'Border', 'mellis' ),
				'selector' 	=> '{{WRAPPER}} .ova-blog .item .content .post-meta .category',
			]
		);

		$this->end_controls_section(); // END Category Tab

		// DATE TAB
		$this->start_controls_section(
			'date_section',
			[
				'label' => esc_html__( 'Date', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'selector' => '{{WRAPPER}} .ova-blog .item .content .post-date',
				
			]
		);

		$this->add_control(
			'date_color',
			[
				'label' => esc_html__( 'Color', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-date' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'date_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-date:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'date_cat_color',
			[
				'label' => esc_html__( 'Background', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-date' => 'background-color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_date_color_hover',
			[
				'label' => esc_html__( 'Background Hover', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-date:hover' => 'background-color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'date_padding',
			[
				'label' => esc_html__( 'Padding', 'mellis' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'date_margin',
			[
				'label' => esc_html__( 'Margin', 'mellis' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .post-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		//SECTION TAB STYLE READMORE
		$this->start_controls_section(
			'section_readmore',
			[
				'label' => esc_html__( 'Read More', 'mellis' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'readmore_typography',
				'selector' => '{{WRAPPER}} .ova-blog .item .content .read-more',
				
			]
		);

		$this->add_control(
			'color_readmore',
			[
				'label' => esc_html__( 'Color', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .read-more' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_readmore_hover',
			[
				'label' => esc_html__( 'Color Hover', 'mellis' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .read-more:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_readmore',
			[
				'label' => esc_html__( 'Margin', 'mellis' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .content .read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE READMORE

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$template 		=   $settings['template'];
		$category 		= 	$settings['category'];
		$total_count 	= 	$settings['total_count'];
		$order 			= 	$settings['order_by'];
		$orderby 		= $settings['orderby'];
		$number_column 	= 	$settings['number_column'];
		$order_text	 	= 	$settings['order_text'] ? $settings['order_text'] : '10';

		$text_readmore 		= 	$settings['text_readmore'];
		$show_date 			= 	$settings['show_date'];
		$show_author 		= 	$settings['show_author'];
		$show_title 		= 	$settings['show_title'];
		$show_category      =   $settings['show_category'];
		$show_short_desc 	= 	$settings['show_short_desc'];
		$show_read_more	 	= 	$settings['show_read_more'];
		$show_comment 	 	=   $settings['show_comment'];

		$template_2_style   =   isset($settings['template_2_style']) ? $settings['template_2_style'] : '';

		$args = [];

		if ($category == 'all') {
			$args = [
				'post_type' => 'post',
				'posts_per_page' => $total_count,
				'order' => $order,
				'orderby' => $orderby,
			];
		} else {
			$args = [
				'post_type' => 'post', 
				'category_name' => $category,
				'posts_per_page' => $total_count,
				'order' => $order,
				'orderby' => $orderby,
				'fields' => 'ids'
			];
		}

		$blog = new \WP_Query($args);

		?>
		
		<ul class="ova-blog ova-blog-<?php echo esc_attr($template); ?> ova-<?php echo esc_attr( $number_column ) ?> <?php echo esc_attr($template_2_style); ?>">
			<?php
				if($blog->have_posts()) : while($blog->have_posts()) : $blog->the_post();

				$thumbnail = wp_get_attachment_image_url(get_post_thumbnail_id() , 'mellis_thumbnail' );
			    $url_thumb = $thumbnail ? $thumbnail : \Elementor\Utils::get_placeholder_image_src();

				// get first category from post
				$first_category  = wp_get_post_terms( get_the_ID(), 'category' )[0]->name;
			    $category_id     = get_cat_ID($first_category);
			    $category_link   = get_category_link( $category_id );
			?>
				<li class="item">

					<?php if( $template_2_style != 'template_2_style1' ){ ?>
					    <div class="media">
				        	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				        		<img src="<?php echo esc_url( $url_thumb ) ?>" alt="<?php the_title(); ?>">
				        	</a>
				        </div>
			        <?php } ?>

			        <div class="content">

			        	<?php if( $show_date == 'yes' && $template == 'template_1' ){ ?>
							<div class="post-date">
								<span class="date-j"><?php the_time('j' );?></span>
								<span class="date-f"><?php the_time('F' );?></span>
							</div>
						<?php } ?>

					    <ul class="post-meta">

					    	<?php if( $show_category == 'yes' ){ ?>
				        		<li class="item-meta category">
						        	<a href="<?php echo esc_url($category_link); ?>">
										<?php echo esc_html($first_category); ?>
									</a>
							    </li>
							<?php } ?>

				        	<?php if( $show_date == 'yes' && $template == 'template_2' ){ ?>
								<li class="item-meta post-date">
									<span><?php the_time('j F Y');?></span>
								</li>
							<?php } ?>

						    <?php if( $show_author == 'yes' ){ ?>
								<li class="item-meta wp-author">
							    	<span class="left author">
							    	 	<i class="far fa-user-circle"></i>
							    	</span>
								    <span class="right post-author">
							        	<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							        		<?php the_author_meta( 'display_name' ); ?>
							        	</a>
								    </span>
							    </li>
							<?php } ?>

							<?php if($show_comment == 'yes'): ?>

								<li class="item-meta post-comment">
									<span class="left comment">
							        	<i class="far fa-comments"></i>
							        </span>
							        <span class="right comment">
										<?php
										comments_popup_link(
											esc_html__('0 Comments', 'mellis'), 
											esc_html__('1 Comments', 'mellis'), 
											'(%)Comments',
											'',
											esc_html__( 'Comment off', 'mellis' ) )
										; ?> 
									</span>            
								</li>

							<?php endif; ?>

					    </ul>

						<?php if( $show_title == 'yes' ){ ?>
				            <h2 class="post-title">
						        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
						          <?php the_title(); ?>
						        </a>
						    </h2>
					    <?php } ?>

					    <?php if( $template_2_style == 'template_2_style1' ){ ?>
						    <div class="media">
					        	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					        		<img src="<?php echo esc_url( $url_thumb ) ?>" alt="<?php the_title(); ?>">
					        	</a>
					        </div>
				        <?php } ?>

					    <?php if( $show_short_desc == 'yes' ){ ?>
						    <div class="short_desc">
						    	<p><?php echo wp_trim_words(get_the_excerpt(), $order_text); ?></p>
						    </div>
						<?php } ?>

					    <?php if( $show_read_more == 'yes' ){ ?>
						    <a class="read-more" href="<?php the_permalink(); ?>">
						    	<?php echo esc_html( $text_readmore ); ?>
						    	<i class="flaticon flaticon-right-arrow"></i>
						    </a>
					    <?php }?>	
			        </div>
					
				</li>	
					
			<?php
				endwhile; endif; wp_reset_postdata();
			?>
		</ul>
		
		
		<?php
	}
}

$widgets_manager->register( new Mellis_Elementor_Blog_Grid() );