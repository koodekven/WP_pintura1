<?php 
    $cat = $settings['portfolio_category'];
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	if(empty($cat)){
    	$best_wp = new wp_Query(array(
				'post_type'      => 'portfolios',
				'posts_per_page' => $settings['per_page'],								
		));	  
    }   
    else{
    	$best_wp = new wp_Query(array(
				'post_type'      => 'portfolios',
				'posts_per_page' => $settings['per_page'],				
				'tax_query'      => array(
			        array(
						'taxonomy' => 'portfolio-category',
						'field'    => 'slug', //can be set to ID
						'terms'    => $cat //if field is ID you can reference by cat/term number
			        ),
			    )
		));	  
    }

	while($best_wp->have_posts()): $best_wp->the_post();
		
		$termsArray  = get_the_terms( $best_wp->ID, "portfolio-category" );  //Get the terms for this particular item
		$termsString = ""; //initialize the string that will contain the terms
		$termsSlug   = " ";

		foreach ( $termsArray as $term ) { 
			$termsString .= 'filter_'.$term->slug.' '; 
			$termsSlug .= strtolower($term->name).' ';
		}

        $termsSlug = rtrim($termsSlug, ' ');
		$portfolio_column  = !empty(get_post_meta( get_the_ID(), 'portfolios_column', true )) ? get_post_meta( get_the_ID(), 'portfolios_column', true ): $settings['portfolio_columns'];
		$cats_show = get_the_term_list( $best_wp->ID, 'portfolio-category', ' ', '<span class="separator">,</span> ');	

	?>	

        <div class="col-lg-<?php echo esc_html($portfolio_column);?> grid-item <?php echo strtolower($termsSlug);?>" data-category="<?php echo strtolower($termsSlug);?>">			
			<div class="portfolio-item content-overlay" style="background: url(<?php the_post_thumbnail_url(); ?>);">			
				<div class="portfolio-content fadeIn-bottom">
					<?php if(get_the_title()):?>
						<h3 class="p-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
					<?php endif;?>
					<p class="p-category"><?php echo wp_kses_post($cats_show); ?></p>
					<a class="arrow-btn" href="<?php the_permalink(); ?>"><i class="ri-arrow-right-up-line"></i></a>
				</div>
			</div>			
        </div>
	<?php	
	endwhile;
	wp_reset_query();