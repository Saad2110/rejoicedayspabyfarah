<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Mellis_Elementor_Price_List extends Widget_Base {

	
	public function get_name() {
		return 'mellis_elementor_price_list';
	}

	
	public function get_title() {
		return esc_html__( 'Price List', 'mellis' );
	}

	
	public function get_icon() {
		return 'eicon-price-list';
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
				'heading',
				[
					'label' => esc_html__( 'Heading', 'mellis' ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => esc_html__('Massages & Prices', 'mellis')
				]
			);
            
            $repeater = new \Elementor\Repeater();

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
				'image',
				[
					'label' => esc_html__( 'Image on Hover', 'mellis' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
				]
			);

		    $repeater->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'mellis' ),
					'type' 		=> Controls_Manager::TEXTAREA,
					'default' 	=> 'Relaxation'
				]
			);

			$repeater->add_control(
				'time',
				[
					'label' => esc_html__( 'Time', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'default' => '20 Minutes',
				]
			);

			$repeater->add_control(
	            'currency_symbol',
	            [
	                'label' => esc_html__( 'Currency Symbol', 'mellis' ),
	                'type' => Controls_Manager::SELECT,
	                'options' => [
	                    '' => esc_html__( 'None', 'mellis' ),
	                    'dollar' => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'mellis' ),
	                    'euro' => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'mellis' ),
	                    'baht' => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'mellis' ),
	                    'franc' => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'mellis' ),
	                    'guilder' => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'mellis' ),
	                    'krona' => 'kr ' . _x( 'Krona', 'Currency Symbol', 'mellis' ),
	                    'lira' => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'mellis' ),
	                    'peseta' => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'mellis' ),
	                    'peso' => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'mellis' ),
	                    'pound' => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'mellis' ),
	                    'real' => 'R$ ' . _x( 'Real', 'Currency Symbol', 'mellis' ),
	                    'ruble' => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'mellis' ),
	                    'rupee' => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'mellis' ),
	                    'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'mellis' ),
	                    'shekel' => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'mellis' ),
	                    'yen' => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'mellis' ),
	                    'won' => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'mellis' ),
	                    'custom' => esc_html__( 'Custom', 'mellis' ),
	                ],
	                'default' => 'dollar',
	            ]
	        );

			$repeater->add_control(
				'currency_symbol_custom',
				[
					'label' => esc_html__( 'Custom Symbol', 'mellis' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
	                    'currency_symbol' => 'custom',
	                ],
				]
			);

			$repeater->add_control(
				'price',
				[
					'label' 	=> esc_html__( 'Price', 'mellis' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> '2.20',
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
							'title' => 'Relaxation',
							'time'  => esc_html__( '20 Minutes', 'mellis' ),
                            'price' => '2.20',	
						],
						[	
							'title' => 'Athlete Recovery',
							'time'  => esc_html__( '30 Minutes', 'mellis' ),
                            'price' => '4.00',	
						],
						[	
							'title' => 'Thai',
							'time'  => esc_html__( '40 Minutes', 'mellis' ),
                            'price' => '3.99',	
						],
						[	
							'title' => 'Hot Stones',
							'time'  => esc_html__( '50 Minutes', 'mellis' ),
                            'price' => '6.20',	
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

		/* Begin heading Style */
		$this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__( 'Heading', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'heading_typography',
					'selector' 	=> '{{WRAPPER}} .ova-price-list .heading',
				]
			);

			$this->add_control(
				'heading_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price-list .heading' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'heading_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-price-list .heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
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
					'selector' 	=> '{{WRAPPER}} .ova-price-list .item-price-list .title-time .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price-list .item-price-list .title-time .title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price-list .item-price-list:hover .title-time .title' => 'color: {{VALUE}};',
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
	                    '{{WRAPPER}} .ova-price-list .item-price-list .title-time .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End title style */

		/* Begin time Style */
		$this->start_controls_section(
            'time_style',
            [
                'label' => esc_html__( 'Time', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'time_typography',
					'selector' 	=> '{{WRAPPER}} .ova-price-list .item-price-list .title-time .time',
				]
			);

			$this->add_control(
				'time_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price-list .item-price-list .title-time .time' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'time_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-price-list .item-price-list .title-time .time' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();

        /* Begin title and time Style */
		$this->start_controls_section(
            'title_and_time_style',
            [
                'label' => esc_html__( 'Title & Time', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_responsive_control(
				'title_and_time_max_width',
				[
					'label' => esc_html__( 'Max Width', 'mellis' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 120,
							'max' => 300,
							'step' => 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-price-list .item-price-list .title-time' => 'max-width: {{SIZE}}{{UNIT}};',
						
					],
				]
			);

        $this->end_controls_section();

		/* Begin price Style */
		$this->start_controls_section(
            'price_style',
            [
                'label' => esc_html__( 'Price', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'price_typography',
					'selector' 	=> '{{WRAPPER}} .ova-price-list .item-price-list .price-wrapper .price',
				]
			);

			$this->add_control(
				'price_color',
				[
					'label' 	=> esc_html__( 'Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price-list .item-price-list .price-wrapper .price' => 'color: {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
		/* End price style */

		/* Begin Item price list Style */
		$this->start_controls_section(
            'item_price_list_style',
            [
                'label' => esc_html__( 'Item Price List', 'mellis' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_control(
				'price_list_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'mellis' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-price-list' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'item_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-price-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_responsive_control(
	            'item_price_list_padding',
	            [
	                'label' 		=> esc_html__( 'List Padding', 'mellis' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-price-list .item-price-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'item_price_list_border',
					'label' => esc_html__( 'Border', 'mellis' ),
					'selector' => '{{WRAPPER}} .ova-price-list .item-price-list',
				]
			);

         $this->end_controls_section();
		
	}

	private function get_currency_symbol( $symbol_name ) {
        $symbols = [
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'pound' => '&#163;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'baht' => '&#3647;',
            'yen' => '&#165;',
            'won' => '&#8361;',
            'guilder' => '&fnof;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'rupee' => '&#8360;',
            'indian_rupee' => '&#8377;',
            'real' => 'R$',
            'krona' => 'kr',
        ];

        return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
    }

	// Render Template Here
	protected function render() {

		$settings	 = 	$this->get_settings();

		$items       =  $settings['items']; 
		$heading     =  $settings['heading'];

		?>

		 	<div class="ova-price-list">
                
                <?php if (!empty( $heading )): ?>
					<h3 class="heading">
						<?php echo esc_html( $heading ); ?>
					</h3>
				<?php endif;?>

		 		<?php foreach( $items as $item ) {
	                $title    =  $item['title'];
					$time     =  $item['time'];
					$price    =  $item['price'];
					$link     =  $item['link'];
					$nofollow =  ( isset( $link['nofollow'] ) && $link['nofollow'] ) ? 'rel=nofollow' : '';
					$target   =  ( isset( $link['is_external'] ) && $link['is_external'] !== '' ) ? 'target=_blank' : '';

					// replace % to %% avoid printf error
					if(strpos($title, '%') !== false){
					    $title = str_replace('%', '%%', $title);
					}

					$url		 = 	$item['image']['url'];
					$image_alt 	 =  ( isset( $item['image']['alt']) &&  $item['image']['alt'] != '' ) ?  $item['image']['alt'] : $title;

					$symbol = '';

					if ( ! empty( $item['currency_symbol'] ) ) {
			            if ( 'custom' !== $item['currency_symbol'] ) {
			                $symbol = $this->get_currency_symbol( $item['currency_symbol'] );
			            } else {
			                $symbol = $item['currency_symbol_custom'];
			            }
			        } 
			    ?>
                
                <?php if(!empty( $link['url'])) : ?>
				  <a href="<?php echo esc_url( $link['url'] ); ?>" <?php echo esc_attr( $target ); ?> <?php echo esc_attr( $nofollow ); ?>>
			    <?php endif; ?>

				    <div class="item-price-list">

	                    <div class="title-time">
	                    	<?php if (!empty( $title )): ?>
								<h4 class="title">
									<?php printf( $title ); ?>
								</h4>
							<?php endif;?>
				 			<?php if (!empty( $time )): ?>
				            	<span class="time"><?php echo esc_html( $time ); ?></span>
				          	<?php endif;?>
				 		</div>

				 		<div class="price-wrapper">
							<?php if (!empty( $price )): ?>
								<span class="price">
									<?php echo  esc_html( $symbol ) . esc_html( $price ); ?>
								</span>
							<?php endif;?>  
				 		</div>

				 		<?php if( !empty( $url ) ) : ?>
							<div class="img-wrapper">
								<img src="<?php echo esc_attr( $url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
							</div>
						<?php endif; ?>	

	                </div>

	                <?php if(!empty( $link['url'])) : ?>
						</a>
					<?php endif; ?>

	            <?php } ?>

		    </div>

		<?php
	}

	
}
$widgets_manager->register( new Mellis_Elementor_Price_List() );