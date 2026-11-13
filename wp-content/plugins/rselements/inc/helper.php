<?php

 function rselemetns_woocommerce_product_categories(){
    $terms = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
    ));

    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $options[$term->slug] = $term->name;
        }
        return $options;
    }
}

/**
 * 
 */
if ( ! function_exists( 'redox_page_breadcrumb_meta' ) ) {
    function redox_page_breadcrumb_meta() {
        add_meta_box( 'additional-page-metabox-options', esc_html__( 'Page Breadcrumb', 'redox' ), 'redox_page_breadcrumb_field', 'page', 'normal', 'low' );
    }
}
add_action( 'add_meta_boxes', 'redox_page_breadcrumb_meta' );

if ( ! function_exists( 'redox_page_breadcrumb_field' ) ) {
    function redox_page_breadcrumb_field( $post ) {
        $meta_id = get_post_meta( $post->ID );
        $redox_page_breadcrumb_val = ( isset( $meta_id['redox_page_breadcrumb_val'][0] ) &&  '1' === $meta_id['redox_page_breadcrumb_val'][0] ) ? 1 : 0;
        wp_nonce_field( 'redox_control_meta_box', 'redox_control_meta_box_nonce' );
        ?>
            <p>
                <label>
          <?php esc_attr_e( 'Hide Breadcrumb', 'redox' ); ?>
          <input type="checkbox" name="redox_page_breadcrumb_val" value="1" <?php checked( $redox_page_breadcrumb_val, 1 ); ?> />
        </label>
            </p>
        <?php
    }
}

if ( ! function_exists( 'redox_save_breadcrumb_meta' ) ) {
    function redox_save_breadcrumb_meta( $post_id ) {
        if ( ! isset( $_POST['redox_control_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['redox_control_meta_box_nonce'] ), 'redox_control_meta_box' ) ) { // Input var okay.
            return $post_id;
        }
        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
    //Save the data
        $redox_page_breadcrumb_val = ( isset( $_POST['redox_page_breadcrumb_val'] ) && '1' === $_POST['redox_page_breadcrumb_val'] ) ? 1 : 0;
        update_post_meta( $post_id, 'redox_page_breadcrumb_val', esc_attr( $redox_page_breadcrumb_val ) );
    }
}
add_action( 'save_post', 'redox_save_breadcrumb_meta' );