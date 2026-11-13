 <?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 Template Name: Service Area
 */

get_header(); ?>

<div class="container">
	<div id="content" class="site-content">
		<div class="searh-form-data">
			<form method="GET">
				<?php 
				$args = array(
	               'taxonomy' => 'rs-service-area-category',
	               'orderby' => 'name',
	               'order'   => 'ASC'
	            );

			    $cats = get_categories($args); ?>

				    <ul class="rs-search-form-area">
				    	<?php $title = !empty($_REQUEST['title']) ? $_REQUEST['title'] : ''; ?>
						<li class="rs-input-serch rs-input-serch-only">
							<i class="ri-search-line"></i>
							<input type="text" name="title" placeholder="<?php esc_attr_e('Enter Service/Zipcode/Location', 'fixhero');?>" value="<?php echo esc_html( $title );?>">
						</li>

						<li class="rs-input-serch select-service-category">
							<select name="cat-service-area">
								<option value=""><?php echo esc_html__( 'Service Category', 'fixhero' );?></option>	
								<?php 

								foreach ( $cats as $cat ) {
									 $selected = '';
									 
									 if( !empty($_REQUEST['cat-service-area']) && $_REQUEST['cat-service-area'] == $cat->term_id){
									 	$selected = 'selected';
									 }
									?>
										<option value="<?php echo  esc_html($cat->term_id); ?>" <?php echo esc_html( $selected );?>><?php echo esc_html($cat->name); ?></option>
									<?php				
								} 
								?>
							</select>
						</li>						
						<li class="rs-input-btn">
							<input type="hidden" name="datashow" value="datashow">
							<input type="submit" name="search" value="search Now">
						</li>
					</ul>

			</form>
		</div>
			<div class="clearfix"></div>

			<div class="rs-service-areas">
				<div class="row">
					<?php
					$title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
					$cat = isset($_REQUEST['cat-service-area']) ? $_REQUEST['cat-service-area'] : '';
					
                    if(empty($cat)){
						$args = array(
						    'post_type' => 'rs-service-area',
						    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
						    'posts_per_page' => 6,
						    'orderby' =>  'post_date',
						    'post_title' => $title,						    
						    'meta_query' => array(
						    	'relation' => 'OR',
						        array(
						            'key' => 'rs_service_address',
						            'value' => $title,
						            'compare' => 'LIKE',
						        ),
						        array(
						            'key' => 'rs_service_state',
						            'value' => $title,
						            'compare' => 'LIKE',
						        ),
						        array(
						            'key' => 'rs_service_zip_code',
						            'value' => $title,
						            'compare' => 'LIKE',
						        ),
						        array(
						            'key' => 'rs_service_city',
						            'value' => $title,
						            'compare' => 'LIKE',
						        ),
						        array(
						            'key' => 'rs_service_zip_country',
						            'value' => $title,
						            'compare' => 'LIKE',
						        )
						    )						    
						);
					}
				    else{
				     	$args = array(
						    'post_type' => 'rs-service-area',
						    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
						    'posts_per_page' => 6,
						    'orderby' =>  'post_date',
						    'post_title' => $title,
					     	'tax_query' => array(
						        array(
						            'taxonomy' => 'rs-service-area-category',
						            'field' => 'ID', //can be set to ID
						            'terms' => $cat//if field is ID you can reference by cat/term number
						        ),
							),
						    
						    'meta_query' => array(
						    	'relation' => 'OR',
						        array(
						            'key' => 'rs_service_address',
						            'value' => $title,
						            'compare' => 'LIKE',
						        ),
						        array(
						            'key' => 'rs_service_state',
						            'value' => $title,
						            'compare' => 'LIKE',
						        ),
						        array(
						            'key' => 'rs_service_zip_code',
						            'value' => $title,
						            'compare' => 'LIKE',
						        ),
						        array(
						            'key' => 'rs_service_city',
						            'value' => $title,
						            'compare' => 'LIKE',
						        ),
						        array(
						            'key' => 'rs_service_zip_country',
						            'value' => $title,
						            'compare' => 'LIKE',
						        )
						    )
						);
				    }

					$service_data = new WP_Query($args);										
					$found_post = $service_data->found_posts;

						if( $found_post > 0){			
							while($service_data->have_posts()): $service_data->the_post();						
								$rs_service_address      = get_post_meta( get_the_ID(), 'rs_service_address', true );
								$rs_service_state 		 = get_post_meta( get_the_ID(), 'rs_service_state', true );	
								$rs_service_city 		 = get_post_meta( get_the_ID(), 'rs_service_city', true );	
								$rs_service_zip_code 		 = get_post_meta( get_the_ID(), 'rs_service_zip_code', true );	
								$rs_service_zip_country 		 = get_post_meta( get_the_ID(), 'rs_service_zip_country', true );	
								$all_cats_show = get_the_term_list( $service_data->ID, 'rs-service-area-category', ' ', '');	
							?>
								<div class="col-lg-4 col-md-6 col-sm-6">
									<div class="service-item">
										<?php $thum_image = (has_post_thumbnail()) ? 'rs-thumb' : 'no-rs-thumb'; ?>	
										<div class="service-item-inner <?php echo esc_attr($thum_image); ?>">
											<?php if ( has_post_thumbnail() ) { ?>
												<div class="rs-service-thumb">
													<a href="<?php the_permalink();?>">
														<?php the_post_thumbnail(); ?>
													</a>											
							                        <div class="rs-service-categorys">
						                            	<?php 
						                                	echo wp_kses_post($all_cats_show);
						                                ?>
									                </div>
									            </div>
											<?php } ?>										
											<div class="service-normal-text">										
												<?php if ( !has_post_thumbnail() ) { ?>
							                        <div class="rs-service-categorys">
							                            <?php echo wp_kses_post($all_cats_show); ?>
									                </div>	
								                <?php } ?>					                

												<h3 class="rs-service-title">
													<a href="<?php the_permalink();?>"> <?php the_title();?> </a>
												</h3>

								                <?php if(!empty($rs_service_address) || !empty($rs_service_state)){ ?>
									                <ul>
									                	<?php if(!empty($rs_service_state)): ?>
									                		<li class="rs-service-state"> <i class="ri-flag-line"></i> <?php echo esc_html( $rs_service_state );?> </li>
									                	<?php endif; ?>

														<?php if(!empty($rs_service_address)): ?>
															<li class="rs-service-location"><i class="ri-map-pin-line"></i> <?php echo esc_html( $rs_service_address );?></li>
														<?php endif; ?>													
													</ul>
												<?php } ?>

												<?php $custom_excerpt = get_post_field('post_excerpt'); ?>
												<?php if(!empty($custom_excerpt)): ?>
													<div class="rs-custom-excerpt"><?php echo esc_html( $custom_excerpt );?> </div>
												<?php endif; ?>	
											</div>
										</div>
								  	</div>
						  		</div>
							<?php endwhile;
							wp_reset_query();
						} else { 
		                    $service_data = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts WHERE post_title LIKE '%" . $wpdb->esc_like( $title ) ."%' AND post_status = 'publish' AND post_type = 'rs-service-area'");
	                  		if(!empty($service_data)){
	                    	$found_post = count($service_data);	                        
		                        if( $found_post > 0){           
		                            foreach ( $service_data as $mypost ) {                   
		                                $post = get_post( $mypost );
		                                $rs_service_address      = get_post_meta( get_the_ID(), 'rs_service_address', true );
		                                $rs_service_state        = get_post_meta( get_the_ID(), 'rs_service_state', true ); 
		                                $all_cats_show = get_the_term_list( $post->ID, 'rs-service-area-category', ' ', '');    
		                            ?>
		                                <div class="col-lg-4 col-md-6 col-sm-6">
		                                    <div class="service-item">
		                                        <?php $thum_image = (has_post_thumbnail()) ? 'rs-thumb' : 'no-rs-thumb'; ?> 
		                                        <div class="service-item-inner <?php echo esc_attr($thum_image); ?>">
		                                            <?php if ( has_post_thumbnail() ) { ?>
		                                                <div class="rs-service-thumb">
		                                                    <a href="<?php the_permalink();?>">
		                                                        <?php the_post_thumbnail(); ?>
		                                                    </a>                                            
		                                                    <div class="rs-service-categorys">
		                                                        <?php 
		                                                            echo wp_kses_post($all_cats_show);
		                                                        ?>
		                                                    </div>
		                                                </div>
		                                            <?php } ?>                                      
		                                            <div class="service-normal-text">                                       
		                                                <?php if ( !has_post_thumbnail() ) { ?>
		                                                    <div class="rs-service-categorys">
		                                                        <?php echo wp_kses_post($all_cats_show); ?>
		                                                    </div>  
		                                                <?php } ?>                                  

		                                                <h3 class="rs-service-title">
		                                                    <a href="<?php the_permalink();?>"> <?php the_title();?> </a>
		                                                </h3>

		                                                <?php if(!empty($rs_service_address) || !empty($rs_service_state)){ ?>
		                                                    <ul>
		                                                        <?php if(!empty($rs_service_state)): ?>
		                                                            <li class="rs-service-state"> <i class="ri-flag-line"></i> <?php echo esc_html( $rs_service_state );?> </li>
		                                                        <?php endif; ?>

		                                                        <?php if(!empty($rs_service_address)): ?>
		                                                            <li class="rs-service-location"><i class="ri-map-pin-line"></i> <?php echo esc_html( $rs_service_address );?></li>
		                                                        <?php endif; ?>                                                 
		                                                    </ul>
		                                                <?php } ?>

		                                                <?php $custom_excerpt = get_post_field('post_excerpt'); ?>
		                                                <?php if(!empty($custom_excerpt)): ?>
		                                                    <div class="rs-custom-excerpt"><?php echo esc_html( $custom_excerpt );?> </div>
		                                                <?php endif; ?> 
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            <?php }
		                        } else { ?>
		                        <?php } 
		                    } else { ?>			                    	        
						<div class="col-lg-12"> <h2><?php echo esc_html__('Not Found Any Entry Related Your Query.', 'fixhero');?></h2> </div>
			            <?php }
						} ?>	 				
				</div>

				<?php 
					if(!empty($service_data->post)){
						?>
						<div class="pagination-area service-pagination-area">
							<div class="nav-links">
								<?php
								$rs__big = 999999999;
								 	echo paginate_links( array(
								    'base' => str_replace( $rs__big, '%#%', get_pagenum_link( $rs__big ) ),
								    'format' => '?paged=%#%',
								    'current' => max( 1, get_query_var('paged') ),
								    'total' => $service_data->max_num_pages
								));
								wp_reset_postdata();
								?>
							</div>
						</div>
					<?php
					}
				?>
		</div>	
	</div>
</div>
<?php
get_footer();
