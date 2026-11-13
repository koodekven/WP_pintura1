<?php 
	use Elementor\Icons_Manager;
    $cat = $settings['portfolio_category'];
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	if(empty($cat)){
    	$best_wp = new wp_Query(array(
			'post_type'      => 'portfolios',
			'posts_per_page' => $settings['per_page'],	
			'orderby' => 'menu_order',
			'order' 			=> $settings['pre_posts_sort'],							
		));	  
    }   
    else{
    	$best_wp = new wp_Query(array(
				'post_type'      => 'portfolios',
				'posts_per_page' => $settings['per_page'],	
				'orderby' => 'menu_order',
				'order' 			=> $settings['pre_posts_sort'],			
				'tax_query'      => array(
			        array(
						'taxonomy' => 'portfolio-category',
						'field'    => 'slug', //can be set to ID
						'terms'    => $cat //if field is ID you can reference by cat/term number
			        ),
			    )
		));	  
    }

    $x=1;

	while($best_wp->have_posts()): $best_wp->the_post();	
		
		$content       = get_the_content();
		$client        = get_post_meta( get_the_ID(), 'client', true );
		$location      = get_post_meta( get_the_ID(), 'location', true );
		$surface_area  = get_post_meta( get_the_ID(), 'surface_area', true );
		$created       = get_post_meta( get_the_ID(), 'created', true );
		$date          = get_post_meta( get_the_ID(), 'date', true );
		$project_value = get_post_meta( get_the_ID(), 'project_value', true );

		$cats_show = get_the_term_list( $best_wp->ID, 'portfolio-category', ' ', '<span class="separator">,</span> ');

		$thumbnail_id = get_post_thumbnail_id();
		$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
		if ( empty( $thumbnail_alt ) ) {
			$thumbnail_alt = get_the_title( $thumbnail_id );
		}
	?>

		<div class="col-lg-<?php echo esc_html($settings['portfolio_columns']);?> col-md-<?php echo esc_html($settings['portfolio_md_columns']);?> col-xs-1 grid-item">
			<div class="portfolio-item content-overlay">
				<?php if(has_post_thumbnail()): ?>
					<a href="<?php the_permalink(); ?>">
                    <div class="portfolio-img">
						<?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
                    	<?php if ( 'yes' === $settings['show_button'] ):?>
			            	<div class="p-icon">
			        	        <a href="<?php the_permalink(); ?>"><?php echo esc_html($settings['read_more_text']);?> <i class="glyph-icon flaticon-next"></i></a>  
			        	    </div>
			        	<?php endif;?>
                    </div>
                    </a>
                <?php endif;?>

                <div class="portfolio-details">
                	<p class="p-category"><?php echo wp_kses_post( $cats_show ); ?></p>
                	<?php if(get_the_title()):?>
                		<h4 class="p-title">
                			<a href="<?php the_permalink() ?>" >
                				<?php the_title();?>
                				<span class="title-icons">
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"><path d="M6 6V0H8V6H14V8H8V14H6V8H0V6H6Z" fill="#071230"></path></svg>
								</span>
                			</a>
                		</h4>
                	<?php endif;?>
					<div class="portfolio-icon">
			        	<a href="<?php the_permalink(); ?>"><i class="glyph-icon flaticon-next"></i></a>  
			        </div>
                	
                </div>
            </div>
		</div>

		<!-- Popup Content Information -->
		<div id="rs_port_<?php echo esc_attr($x);?>" class="rspopup_style1 mfp-with-anim mfp-hide" <?php echo wp_kses_post($popup_port_background);?>>
							
			<div class="rsteam_content">
				<h3 class="title" <?php echo wp_kses_post($popup_port_title_color);?>><?php the_title();?></h3>
				<div class="team-des" <?php echo wp_kses_post($popup_port_content_color);?>>
					<?php the_content();?>
				</div>

				<ul class="project-info" <?php echo wp_kses_post($popup_port_info_color);?>>
					<?php if(!empty($client)):?>
						<li><span><?php echo esc_html('client:', 'rsaddon');?></span> <?php echo esc_html($client);?></li>
					<?php endif;?>

					<?php if(!empty($location)):?>
						<li><span><?php echo esc_html('Location:', 'rsaddon');?></span> <?php echo esc_html($location);?></li>
					<?php endif;?>
					
					<?php if(!empty($surface_area)):?>
						<li><span><?php echo esc_html('Surface Area:', 'rsaddon');?></span> <?php echo esc_html($surface_area);?></li>
					<?php endif;?>
					
					<?php if(!empty($created)):?>
						<li><span><?php echo esc_html('Architect:', 'rsaddon');?></span> <?php echo esc_html($created);?></li>
					<?php endif;?>
					
					<?php if(!empty($date)):?>
						<li><span><?php echo esc_html('Year Of Complited:', 'rsaddon');?></span> <?php echo esc_html($date);?></li>
					<?php endif;?>
					
					<?php if(!empty($project_value)):?>
						<li><span><?php echo esc_html('Project Value:', 'rsaddon');?></span> <?php echo esc_html($project_value);?></li>
					<?php endif;?>
				</ul>
			</div>			
			
		</div>
	<?php
	$x++;	
	endwhile;
	wp_reset_query();  
	
	// Pagination
    $paginate = paginate_links(array(
                'total' => $best_wp->max_num_pages,
                'prev_text' => __('<i class="ri-arrow-left-fill"></i>', 'rsaddon'),
                'next_text' => __('<i class="ri-arrow-right-fill"></i>', 'rsaddon'),
                'type'      => 'plain',
                'format'    => '?paged=%#%',
               'before_page_number' => '0',
    ));

	if(!empty($paginate ) && ($settings['blog_pagination_show_hide'] == 'yes')){ ?>
		<div class="pagination-area col-lg-12"><div class="nav-links"><?php echo wp_kses_post($paginate); ?></div></div>
	<?php } ?>