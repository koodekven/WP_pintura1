<?php 
	$phone_contact_on_off = $settings['phone_contact_on_off'];
?>
<div class="rs-team-grid color_<?php echo esc_html($settings['choose_color_scheme']);?> <?php echo esc_html($settings['team_grid_popup']);?> rs-team team-grid-<?php echo esc_html($settings['team_grid_style']);?> <?php echo esc_html($settings['team_grid_popup']);?> rsaddon_pro_box">
	<div class="row">
		 	<?php
		        $cat = $settings['team_category'];		       
		        $team_ordering = $settings['team_ordering'];		       
		        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				if(empty($cat)){
		        	$best_wp = new wp_Query(array(
							'post_type'      => 'teams',
							'posts_per_page' => $settings['per_page'],
							'paged'          => $paged,
                            'order' => $team_ordering					
					));	  
		        }   
		        else{
		        	$best_wp = new wp_Query(array(
							'post_type'      => 'teams',
							'posts_per_page' => $settings['per_page'],
							'paged'          => $paged,
                            'order' => $team_ordering,
							'tax_query'      => array(
						        array(
									'taxonomy' => 'team-category',
									'field'    => 'slug', //can be set to ID
									'terms'    => $cat //if field is ID you can reference by cat/term number
						        ),
						    )
					));	  
		        }
		        
				while($best_wp->have_posts()): $best_wp->the_post();					

				    $designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';		
				    $unique = rand(2012,3554120);										   
					//retrive social icon values	
					$content = get_the_content();		
					$facebook    = get_post_meta( get_the_ID(), 'facebook', true );
					$twitter     = get_post_meta( get_the_ID(), 'twitter', true );
					$google_plus = get_post_meta( get_the_ID(), 'google_plus', true );
					$linkedin    = get_post_meta( get_the_ID(), 'linkedin', true );
					$show_phone  = get_post_meta( get_the_ID(), 'phone', true );
					$show_email  = get_post_meta( get_the_ID(), 'email', true );
					$phone_number  = get_post_meta( get_the_ID(), 'phone_number', true );
					
					$fb   ='';
					$tw   ='';
					$gp   ='';
					$ldin ='';
				
					if($facebook!=''){
						$fb='<a href="'.$facebook.'" class="social-icon"><i class="ri-facebook-fill"></i></a> ';
					}
					if($twitter!=''){
						$tw='<a href="'.$twitter.'" class="social-icon"><i class="ri-twitter-fill"></i></a>';
					}
					if($google_plus!=''){
						$gp='<a href="'.$google_plus.'" class="social-icon"><i class="ri-instagram-line"></i></a> ';
					}
					if($linkedin!=''){
						$ldin='<a href="'.$linkedin.'" class="social-icon"><i class="ri-linkedin-fill"></i></a>';
					}

					$thumbnail_id = get_post_thumbnail_id();
					$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
					if ( empty( $thumbnail_alt ) ) {
						$thumbnail_alt = get_the_title( $thumbnail_id );
					}
				?>

					
				<div class="col-lg-<?php echo esc_html($settings['team_columns']);?> col-md-6 col-xs-1">
					<div class="team-item">
						<div class="team-inner-wrap">
							<div class="image-wrap">
									<?php if( $fb || $gp || $tw || $ldin ){ ?>
										<div class="social-icons1">
											<?php 
												echo wp_kses_post($fb);
												echo wp_kses_post($gp);
												echo wp_kses_post($tw);
												echo wp_kses_post($ldin);
											?>
										</div>
									<?php } ?> 
								<?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
							</div>
							<div class="team-content">
								<div class="inner-ctn">
									<h3 class="team-name">
										<a class="first-word" href="<?php the_permalink(); ?>" ><?php the_title();?></a>
									</h3>
									<span class="team-title"><?php echo esc_html( $designation );?></span>
								</div>
							</div>			
						</div>
			  		</div>
				</div>

				<?php
			endwhile;
			wp_reset_query();  
	     ?>  
	</div>
</div>