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
    $x = 1;
	while($best_wp->have_posts()): $best_wp->the_post();	
		$content = get_the_content();
		$client    = get_post_meta( get_the_ID(), 'client', true );
		$location    = get_post_meta( get_the_ID(), 'location', true );
		$surface_area    = get_post_meta( get_the_ID(), 'surface_area', true );
		$created    = get_post_meta( get_the_ID(), 'created', true );
		$date    = get_post_meta( get_the_ID(), 'date', true );
		$project_value    = get_post_meta( get_the_ID(), 'project_value', true );		
		
		$cats_show = get_the_term_list( $best_wp->ID, 'portfolio-category');
		$current_user = get_the_author();

		$thumbnail_id = get_post_thumbnail_id();
		$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
		if ( empty( $thumbnail_alt ) ) {
			$thumbnail_alt = get_the_title( $thumbnail_id );
		}
	?>	

		<div class="col-lg-<?php echo esc_html($settings['portfolio_columns']);?> col-md-6 col-xs-1 grid-item ">
			<div class="portfolio-item">
				<?php if(has_post_thumbnail()):
					echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] );
				endif;?>
				<?php
					if ( 'yes' === $settings['show_logo_'] ) :
						?>
							<div class="portfolio-four-logo">                              
								<a style="text-transform: lowercase;">
									<span class="cat-icon">
									<svg width="22" height="22" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
										<path d="M25.0002 38.8424V25.8097H34.3449V16.4649H25.0002V6.98885H15.6554V16.4649H25.0002V25.8097H15.6554V39.0906C15.6554 42.6127 17.0547 48.6297 21.2946 49.7303C19.3341 49.4476 17.4426 48.9234 15.6554 48.1997C6.47806 44.5051 0 35.5112 0 25.0078C0 10.8829 11.7091 -0.51153 25.9543 0.0177205C38.9105 0.499852 49.477 11.0504 49.9801 24.0065C50.3478 33.3504 45.5812 41.6115 38.2727 46.198C32.5022 49.8195 25.0002 45.6545 25.0002 38.8415V38.8424Z" fill="white"/>
									</svg>
									 <?php echo esc_html( $current_user ); ?>
								</a>
							</div>
						<?php
					endif;
				?>
				
                <div class="portfolio-content">
                	<?php if(get_the_title()):?>
                		<h3 class="p-title">
                			<span class="p-category"><?php echo wp_kses_post( $cats_show ); ?></span>
                			<?php if($settings['grid_popup']=='popup'): ?>
                				<a class="pointer-events" href="#rs_port2_<?php echo esc_attr($x);?>" data-effect="mfp-zoom-in"><?php the_title();?></a>
                			<?php else: ?>
                				<a class="tite-color" href="<?php the_permalink(); ?>"><?php the_title();?></a>
                			<?php endif ?>  
	                    </h3>    
                	<?php endif;?>  
               	</div>
            </div>
		</div>

		<!-- Popup Content Information -->
		<div id="rs_port2_<?php echo esc_attr($x);?>" class="rspopup_style1 mfp-with-anim mfp-hide" <?php echo wp_kses_post($popup_port_background);?>>
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
	
	$paginate = paginate_links( array(
	    'total' => $best_wp->max_num_pages
	));

	if(!empty($paginate ) && ($settings['blog_pagination_show_hide'] == 'yes')){ ?>
		<div class="pagination-area"><div class="nav-links"><?php echo wp_kses_post($paginate); ?></div></div>
	<?php } ?>  
