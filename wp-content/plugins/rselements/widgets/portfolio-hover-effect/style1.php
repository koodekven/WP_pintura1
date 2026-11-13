<?php
use Elementor\Icons_Manager;

$cat = $settings['portfolio_category'];
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if (empty($cat)) {
	$best_wp = new wp_Query(array(
		'post_type'      => 'portfolios',
		'posts_per_page' => $settings['per_page'],
		'orderby' => 'menu_order',
		'order' 			=> $settings['pre_posts_sort'],
	));
} else {
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

$x = 1;

while ($best_wp->have_posts()) : $best_wp->the_post();
	$cats_show = get_the_term_list($best_wp->ID, 'portfolio-category', ' ', '<span class="separator">,</span> ');

?>
	<div class="rs-grid-item wow skewIn bg-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>); visibility: visible;">
		<div class="rs-item--meta">
			<div class="portfolio-left">
				<div class="rs-item--category">
					<?php echo wp_kses_post($cats_show); ?>
				</div>
				<?php if (get_the_title()) : ?>
					<h3 class="rs-item--title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php endif; ?>
			</div>
		</div>
		<?php if ('yes' == $settings['button_show_hide']) { ?>
			<div class="btn-part">
				<a class="portfolio-btn" href="<?php the_permalink(); ?>">
					<?php
					Icons_Manager::render_icon($settings['btn__selected_icon'], ['aria-hidden' => 'true']);
					?>
				</a>
			</div>
		<?php } ?>
	</div>

<?php
	$x++;
endwhile;
wp_reset_query();

?>

<script type="text/javascript">
	jQuery(document).ready(function() {
		// Get all menu items
		const portfolio_items = document.querySelectorAll('.rs-grid-item');

		// Add event listeners to each item
		portfolio_items.forEach((item) => {
			item.addEventListener('mouseenter', () => {
				// Remove the 'active' class from all items
				portfolio_items.forEach((portfolio_item) => {
					portfolio_item.classList.remove('active');
				});

				// Add the 'active' class to the hovered item
				item.classList.add('active');
			});
		});

		portfolio_items[1].classList.add("active");

	});
</script>