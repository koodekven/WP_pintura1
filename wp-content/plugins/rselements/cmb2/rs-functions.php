<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'rs_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 $cmb CMB2 object.
 *
 * @return bool      True if metabox should show
 */
function rs_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template.
	if ( get_option( 'page_on_front' ) !== $cmb->object_id ) {
		return false;
	}
	return true;
}



/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field $field Field object.
 *
 * @return bool              True if metabox should show
 */
function rs_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function rs_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function rs_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo esc_html( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array      $field_args Array of field parameters.
 * @param  CMB2_Field $field      Field object.
 */
function rs_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}


add_action( 'cmb2_admin_init', 'rs_register_testi_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rs_register_testi_metabox() {
	$prefix = 'rs_'; 
	$cmb_event = new_cmb2_box( array(
		'id'            => $prefix . 'metabox-testi_information',
		'title'         => esc_html__( 'Country Information', 'bootcamp' ),
		'object_types'  => array( 'testimonials' ), // Post type
	) );

	$cmb_event->add_field( array(
		'name' => esc_html__( 'Country, State Name', 'cmb2' ),
		'desc' => esc_html__( 'Write country, state name', 'cmb2' ),
		'id'   => 'country_name',
		'type' => 'text_medium'		
	) );
	$cmb_event->add_field( array(
		'name' => esc_html__( 'Country Flag', 'cmb2' ),
		'id'   => 'country_flag',
		'type' => 'file',
	));
}



add_action( 'cmb2_admin_init', 'rs_register_loaction_details_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rs_register_loaction_details_metabox() {
	$prefix = 'rs_loaction_'; 
	$cmb_service = new_cmb2_box( array(
		'id'            => $prefix . 'metabox-location-details',
		'title'         => esc_html__( 'Location Details', 'rsaddon' ),
		'object_types'  => array( 'rs-service-area' ), // Post type
	) );

	$cmb_service->add_field( array(
		'name' => esc_html__( 'Address:', 'cmb2' ),
		'desc' => esc_html__( 'Enter your address', 'cmb2' ),
		'id'   => 'rs_service_address',
		'type' => 'text_medium'		
	) );

	$cmb_service->add_field( array(
		'name' => esc_html__( 'Address 2:', 'cmb2' ),
		'desc' => esc_html__( 'Enter your address', 'cmb2' ),
		'id'   => 'rs_service_address2',
		'type' => 'text_medium'		
	) );

	$cmb_service->add_field( array(
		'name' => esc_html__( 'City:', 'cmb2' ),
		'desc' => esc_html__( 'Enter your city', 'cmb2' ),
		'id'   => 'rs_service_city',
		'type' => 'text_medium'		
	) );

	$cmb_service->add_field( array(
		'name' => esc_html__( 'State:', 'cmb2' ),
		'desc' => esc_html__( 'Enter your State', 'cmb2' ),
		'id'   => 'rs_service_state',
		'type' => 'text_medium'		
	) );

	$cmb_service->add_field( array(
		'name' => esc_html__( 'Zip Code:', 'cmb2' ),
		'desc' => esc_html__( 'Enter your Zip Code', 'cmb2' ),
		'id'   => 'rs_service_zip_code',
		'type' => 'text_medium'		
	) );

	$cmb_service->add_field( array(
		'name' => esc_html__( 'Country:', 'cmb2' ),
		'desc' => esc_html__( 'Enter your country', 'cmb2' ),
		'id'   => 'rs_service_zip_country',
		'type' => 'text_medium'		
	) );


	$cmb_service->add_field( array(
		'name' => esc_html__( 'Tel:', 'cmb2' ),
		'desc' => esc_html__( 'Enter your tel', 'cmb2' ),
		'id'   => 'rs_service_tel',
		'type' => 'text_medium'		
	) );

	$cmb_service->add_field( array(
		'name' => esc_html__( 'Fax:', 'cmb2' ),
		'desc' => esc_html__( 'Enter your fax', 'cmb2' ),
		'id'   => 'rs_service_fax',
		'type' => 'text_medium'		
	) );

	$cmb_service->add_field( array(
		'name' => esc_html__( 'Email:', 'cmb2' ),
		'desc' => esc_html__( 'Enter your email', 'cmb2' ),
		'id'   => 'rs_service_email',
		'type' => 'text_medium'		
	) );

	$cmb_service->add_field( array(
		'name' => esc_html__( 'Url:', 'cmb2' ),
		'desc' => esc_html__( 'Enter your Url', 'cmb2' ),
		'id'   => 'rs_service_url',
		'type' => 'text_medium'		
	) );
}



add_action( 'cmb2_admin_init', 'speaker_register_repeatable_opening_hours' );

/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function speaker_register_repeatable_opening_hours() {
	$prefix = 'speaker_group_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Opening Hours', 'rs-function' ),
		'object_types' => array( 'rs-service-area' ),
		'priority'     => 'low',  //  'high', 'core', 'default' or 'low'
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => 'opening_hours',
		'type'        => 'group',
		'description' => esc_html__( 'Opening Hours Info', 'rs-function' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Day', 'rs-function' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More Day', 'rs-function' ),
			'remove_button' => esc_html__( 'Remove Day', 'rs-function' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */

	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Day Title', 'rs-function' ),
		'id'         => 'day_title',
		'type'       => 'text',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Start Time', 'rs-function' ),
		'id'         => 'start_hours',
		'type'       => 'text_time',
		'desc' => esc_html__( 'add start hour', 'rs-function' ),
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'End Time', 'rs-function' ),
		'id'         => 'end_hours',
		'type'       => 'text_time',
		'desc' => esc_html__( 'add end hour', 'rs-function' ),
	) );		

}

/**
 * Callback to define the optionss-saved message.
 *
 * @param CMB2  $cmb The CMB2 object.
 * @param array $args {
 *     An array of message arguments
 *
 *     @type bool   $is_options_page Whether current page is this options page.
 *     @type bool   $should_notify   Whether options were saved and we should be notified.
 *     @type bool   $is_updated      Whether options were updated with save (or stayed the same).
 *     @type string $setting         For add_settings_error(), Slug title of the setting to which
 *                                   this error applies.
 *     @type string $code            For add_settings_error(), Slug-name to identify the error.
 *                                   Used as part of 'id' attribute in HTML output.
 *     @type string $message         For add_settings_error(), The formatted message text to display
 *                                   to the user (will be shown inside styled `<div>` and `<p>` tags).
 *                                   Will be 'Settings updated.' if $is_updated is true, else 'Nothing to update.'
 *     @type string $type            For add_settings_error(), Message type, controls HTML class.
 *                                   Accepts 'error', 'updated', '', 'notice-warning', etc.
 *                                   Will be 'updated' if $is_updated is true, else 'notice-warning'.
 * }
 */
function rs_options_page_message_callback( $cmb, $args ) {
	if ( ! empty( $args['should_notify'] ) ) {

		if ( $args['is_updated'] ) {

			// Modify the updated message.
			$args['message'] = sprintf( esc_html__( '%s &mdash; Updated!', 'rs-framework' ), $cmb->prop( 'title' ) );
		}

		add_settings_error( $args['setting'], $args['code'], $args['message'], $args['type'] );
	}
}

/**
 * Only show this box in the CMB2 REST API if the user is logged in.
 *
 * @param  bool                 $is_allowed     Whether this box and its fields are allowed to be viewed.
 * @param  CMB2_REST_Controller $cmb_controller The controller object.
 *                                              CMB2 object available via `$cmb_controller->rest_box->cmb`.
 *
 * @return bool                 Whether this box and its fields are allowed to be viewed.
 */
function rs_limit_rest_view_to_logged_in_users( $is_allowed, $cmb_controller ) {
	if ( ! is_user_logged_in() ) {
		$is_allowed = false;
	}

	return $is_allowed;
}