<?php 
    $cat = $settings['portfolio_category']; 
    $select_portfolio = $settings['select_portfolio_item'];
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	if(empty($cat)){
    	$best_wp = new wp_Query(array(
			'post_type'      => 'portfolios',
			'posts_per_page' => $settings['per_page'],	
			'post__in' => $select_portfolio,						
		));	  
    }   
    else{
    	$best_wp = new wp_Query(array(
				'post_type'      => 'portfolios',
				'posts_per_page' => $settings['per_page'],
				'post__in' => $select_portfolio,				
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
		$cats_show = get_the_term_list( $best_wp->ID, 'portfolio-category', ' ', '<span class="separator">,</span> ');

		$thumbnail_id = get_post_thumbnail_id();
		$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
		if ( empty( $thumbnail_alt ) ) {
			$thumbnail_alt = get_the_title( $thumbnail_id );
		}
	?>	

	<div class="grid-item">
		<div class="portfolio-item">
			<?php if(has_post_thumbnail()): ?>
                <div class="portfolio-img">
					<?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
                </div>
            <?php endif;?>
            <div class="portfolio-content">
            	<div class="content-details">
	            	<?php if(get_the_title()):?>
	            		<h3 class="p-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
	            	<?php endif;?>
					<?php if('yes' == $settings['cat_show_hide']){ ?>
	            		<p class="p-category"><?php echo wp_kses_post($cats_show); ?></p>
					<?php } ?>
	            </div>
            </div>
        </div>
	</div>
	<?php	
	endwhile;
	wp_reset_query();  
