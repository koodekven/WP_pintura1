<div class="product-list">
 	<div class="single-details">
 		<div class="images-product">
			<?php
				global $product;
				global $fixhero_option;
				woocommerce_show_product_loop_sale_flash();
				woocommerce_template_loop_product_thumbnail();
			?>
			<div class="overley">
				<div class="winners-details">
					<div class="product-info">
						<ul>			
							<li><a href="<?php echo esc_url($product->add_to_cart_url())?>"><?php esc_html_e( 'Add to cart','fixhero' );?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>