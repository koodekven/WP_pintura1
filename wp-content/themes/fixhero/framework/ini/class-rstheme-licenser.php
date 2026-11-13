<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RSTheme_Licenser {

	private $slug = 'fixhero';

	private $product_id = '683';

	private $product_name = 'Fixhero - Handyman & Repair Services WordPress Theme';

	private $api_url = 'https://rstheme.com/products/api/verify';

	private $db_license_key = 'FixheroWordPressTheme_lic_Key';

	private $db_email_key = 'FixheroWordPressTheme_lic_Email';

	private $welcome_text = 'Welcome to Fixhero - Handyman & Repair Services WordPress Theme';

	private $menu_title = 'About Fixhero';

	private $doc_url = 'https://rstheme.com/docs/fixhero-wordpress-theme/';

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'register_menu' ] );
		add_action( 'admin_notices', [ $this, 'show_notices' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'admin_post_rstheme_license_activate', [ $this, 'handle_activation' ] );
		add_action( 'admin_post_rstheme_license_deactivate', [ $this, 'handle_deactivation' ] );
		add_action( 'admin_post_rstheme_license_refresh', [ $this, 'handle_activation' ] );

		if ( $this->has_license() ) {
			$this->load_pro_files();
		}

		// Theme Redirect
		add_action( 'after_switch_theme', function () {
			add_option( 'rstheme_needs_redirect', true );
		} );

		add_action( 'admin_init', [ $this, 'maybe_redirect_after_activation' ] );
	}

	public function register_menu() {
		add_menu_page(
			$this->menu_title,
			$this->menu_title,
			'manage_options',
			$this->slug,
			[ $this, 'render_page' ],
			'dashicons-megaphone',
		);
	}

	public function show_notices() {
		$this->render_message();

		if ( ! $this->has_license() ) {
			$this->render_activation_notice();

			return;
		}

		if ( ! $this->has_email() ) {
			$this->render_refresh_notice();
		}
	}

	public function enqueue_styles() {
		wp_enqueue_style(
			'rstheme-license',
			get_theme_file_uri( 'framework/assets/css/rstheme-license.css' ),
			[],
			'6.0.0'
		);
	}

	public function render_page() {
		?>
        <div class="wrap">
            <div class="rstheme-welcome-page">
                <h1><?php echo esc_html( $this->welcome_text ); ?></h1>
				<?php
				if ( $this->has_license() ) {
					$this->render_active_page();
				} else {
					$this->render_activation_form();
				}
				?>
            </div>
        </div>
		<?php
	}

	private function render_activation_form() {
		?>
        <div class="rstheme-form-wrapper activation-form">
            <h3><?php esc_html_e( 'License Activation', 'fixhero' ); ?></h3>
            <p><?php esc_html_e( 'Enter your purchase code to unlock all features and receive updates.', 'fixhero' ); ?></p>

            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="rstheme_license_activate">
				<?php wp_nonce_field( 'rstheme_license', 'nonce' ); ?>
                <p class="input-field">
                    <label for="license_key"><?php esc_html_e( 'Purchase Code', 'fixhero' ); ?> *</label>
                    <input
                            type="text"
                            id="license_key"
                            name="license_key"
                            class="regular-text"
                            placeholder="xxxxxxxx-xxxxxxxx-xxxxxxxx-xxxxxxxx"
                            required
                    />
                    <span class="description">
                        <a href="https://help.market.envato.com/hc/en-us/articles/202822600" target="_blank">
                            <?php esc_html_e( 'Where to find your purchase code?', 'fixhero' ); ?>
                        </a>
                    </span>
                </p>
                <p class="input-field">
                    <label for="license_email"><?php esc_html_e( 'Email Address', 'fixhero' ); ?></label>
                    <input
                            type="email"
                            id="license_email"
                            name="license_email"
                            class="regular-text"
                            placeholder="your@email.com"
                            required
                    />
                    <span class="description"><?php esc_html_e( 'Receive update notifications', 'fixhero' ); ?></span>
                </p>
				<?php submit_button( __( 'Activate License', 'fixhero' ) ); ?>
            </form>
        </div>
		<?php
	}

	private function render_active_page() {
		$masked_license = $this->get_masked_license();
		$email          = $this->get_email();
		?>
        <div class="rstheme-form-wrapper activation-status">
            <h3><?php esc_html_e( 'Your License', 'fixhero' ); ?></h3>

            <ul class="license-info-list">
                <li>
                    <span class="info-title"><?php esc_html_e( 'Status', 'fixhero' ); ?></span>
                    <span class="info-value status"><?php esc_html_e( 'Active', 'fixhero' ); ?></span>
                </li>
                <li>
                    <span class="info-title"><?php esc_html_e( 'Purchase Code', 'fixhero' ); ?></span>
                    <span class="info-value code"><?php echo esc_html( $masked_license ); ?></span>
                </li>
                <li>
                    <span class="info-title"><?php esc_html_e( 'Email', 'fixhero' ); ?></span>
                    <span class="info-value email">
                        <?php if ( $email ): ?>
	                        <?php echo esc_html( $email ); ?>
                        <?php else: ?>
                            <span class="email-no-set"><?php esc_html_e( 'Not set - Please refresh your license below', 'fixhero' ); ?></span>
                        <?php endif; ?>
                    </span>
                </li>
            </ul>
			<?php if ( ! $email ): ?>
                <div class="refresh-from">
                    <h3><?php esc_html_e( 'Refresh Your License', 'fixhero' ); ?></h3>
                    <p><?php esc_html_e( 'Please add your email address to complete your license registration.', 'fixhero' ); ?></p>

                    <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                        <input type="hidden" name="action" value="rstheme_license_refresh">
						<?php wp_nonce_field( 'rstheme_license', 'nonce' ); ?>
                        <p class="input-field">
                            <label for="license_key"><?php esc_html_e( 'Purchase Code', 'fixhero' ); ?> *</label>
                            <input
                                    type="text"
                                    id="license_key"
                                    name="license_key"
                                    class="regular-text"
                                    value="<?php echo esc_attr( $masked_license ); ?>"
                                    required
                                    disabled
                            />
                        </p>
                        <p class="input-field">
                            <label for="license_email"><?php esc_html_e( 'Email Address', 'fixhero' ); ?></label>
                            <input
                                    type="email"
                                    id="license_email"
                                    name="license_email"
                                    class="regular-text"
                                    placeholder="your@email.com"
                                    required
                            />
                            <span class="description"><?php esc_html_e( 'Receive update notifications', 'fixhero' ); ?></span>
                        </p>
						<?php submit_button( __( 'Refresh License', 'fixhero' ) ); ?>
                    </form>
                </div>
			<?php endif; ?>

            <div class="deactivate-form">
                <form id="deactivateFormHidden" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display: none;">
                    <input type="hidden" name="action" value="rstheme_license_deactivate">
					<?php wp_nonce_field( 'rstheme_license', 'nonce' ); ?>
                </form>
                <div class="buttons-wrapper">
                    <a href="#"
                       class="button button-primary deactivate-button"
                       onclick="if(confirm('<?php esc_attr_e( 'Are you sure you want to deactivate?', 'fixhero' ); ?>')) document.getElementById('deactivateFormHidden').submit(); return false;">
						<?php esc_html_e( 'Deactivate License', 'fixhero' ); ?>
                    </a>
                    <a href="<?php echo esc_url( $this->doc_url ); ?>" class="button button-primary document-button" target="_blank">
						<?php esc_html_e( 'View Documentation', 'fixhero' ); ?>
                    </a>
                </div>
            </div>
        </div>
		<?php
	}

	private function render_activation_notice() {
		if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] === $this->slug ) {
			return;
		}
		?>
        <div class="notice notice-warning is-dismissible">
            <p>
				<?php esc_html_e( 'Please activate your purchase code to unlock all features.', 'fixhero' ); ?>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=' . $this->slug ) ); ?>">
					<?php esc_html_e( 'Activate Now!', 'fixhero' ); ?>
                </a>
            </p>
        </div>
		<?php
	}

	private function render_refresh_notice() {
		if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] === $this->slug ) {
			return;
		}
		?>
        <div class="notice notice-info is-dismissible">
            <p>
				<?php esc_html_e( 'Please add your email address with purchase code for getting update notification.', 'fixhero' ); ?>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=' . $this->slug ) ); ?>">
					<?php esc_html_e( 'Update License', 'fixhero' ); ?>
                </a>
            </p>
        </div>
		<?php
	}

	private function render_message() {
		$msg  = get_transient( 'rstheme_license_msg' );
		$type = get_transient( 'rstheme_license_msg_type' );

		if ( $msg ) {
			$class = $type === 'error' ? 'notice-error' : 'notice-success';
			echo '<div class="notice ' . esc_attr( $class ) . ' is-dismissible"><p>' . esc_html( $msg ) . '</p></div>';
			delete_transient( 'rstheme_license_msg' );
			delete_transient( 'rstheme_license_msg_type' );
		}
	}

	public function handle_activation() {
		check_admin_referer( 'rstheme_license', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'Unauthorized', 'fixhero' ) );
		}

		$is_refresh = isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] === 'rstheme_license_refresh';

		if ( $is_refresh ) {
			$license_key = $this->get_license();
		} else {
			$license_key = $_POST[ 'license_key' ];
		}

		$license = sanitize_text_field( $license_key ?? '' );
		$email   = sanitize_email( $_POST[ 'license_email' ] ?? '' );

		if ( empty( $license ) ) {
			$this->set_message( __( 'Purchase Code is required', 'fixhero' ), 'error' );
			$this->redirect();
		}

		if ( empty( $email ) ) {
			$this->set_message( __( 'Email is required', 'fixhero' ), 'error' );
			$this->redirect();
		}

		$response = $this->api_request( $license, $email, 1 );

		if ( $response[ 'success' ] ) {
			update_option( $this->db_license_key, $license );
			update_option( $this->db_email_key, $email );
			$this->set_message( __( 'License activated successfully!', 'fixhero' ), 'success' );
		} else {
			$this->set_message( $response[ 'message' ], 'error' );
		}

		$this->redirect();
	}

	public function handle_deactivation() {
		check_admin_referer( 'rstheme_license', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'Unauthorized', 'fixhero' ) );
		}

		$license = $this->get_license();

		if ( $license ) {
			$response = $this->api_request( $license, '', 0 );

			if ( $response[ 'success' ] ) {
				delete_option( $this->db_license_key );
				delete_option( $this->db_email_key );
				$this->set_message( __( 'License deactivated', 'fixhero' ), 'success' );
			} else {
				$this->set_message( $response[ 'message' ], 'error' );
			}
		}

		$this->redirect();
	}

	/**
	 * API request handler
	 */
	private function api_request( $license, $email, $state ) {
		$response = wp_remote_post( $this->api_url, [
			'timeout' => 30,
			'body'    => [
				'pcode' => $license,
				'host'  => site_url(),
				'pid'   => $this->product_id,
				'pname' => $this->product_name,
				'state' => $state,
				'email' => $email,
			]
		] );

		if ( is_wp_error( $response ) ) {
			return [
				'success' => false,
				'message' => __( 'Connection error. Please try again.', 'fixhero' )
			];
		}

		$body = wp_remote_retrieve_body( $response );

		if ( $body === 'Valid' || $body === 'true' ) {
			return [ 'success' => true, 'message' => '' ];
		}

		return [
			'success' => false,
			'message' => __( 'Invalid license key', 'fixhero' )
		];
	}

	private function get_license() {
		return get_option( $this->db_license_key, '' );
	}

	private function get_email() {
		return get_option( $this->db_email_key, '' );
	}

	private function get_masked_license() {
		$license = $this->get_license();

		if ( empty( $license ) ) {
			return '';
		}

		$masked_key = '';
		$mask_char  = 'x';
		$length     = strlen( $license );

		if ( $length <= 8 ) {
			return str_repeat( $mask_char, $length - 1 ) . substr( $license, - 1 );
		}

		for ( $i = 0; $i < $length; $i ++ ) {
			if ( $i < 4 || $i >= ( $length - 4 ) ) {
				$masked_key .= $license[ $i ];
			} else {
				$masked_key .= $mask_char;
			}
		}

		return $masked_key;
	}

	private function has_license() {
		return ! empty( $this->get_license() );
	}

	private function has_email() {
		return ! empty( $this->get_email() );
	}

	private function set_message( $msg, $type = 'success' ) {
		set_transient( 'rstheme_license_msg', $msg, 45 );
		set_transient( 'rstheme_license_msg_type', $type, 45 );
	}

	private function redirect() {
		wp_safe_redirect( admin_url( 'admin.php?page=' . $this->slug ) );
		exit;
	}

	private function load_pro_files() {
		require_once get_template_directory() . '/framework/ini/class-rstheme-updater.php';
	}

	public function maybe_redirect_after_activation() {
		if ( get_option( 'rstheme_needs_redirect', false ) ) {
			delete_option( 'rstheme_needs_redirect' );

			if ( is_network_admin()) {
				return;
			}

			wp_safe_redirect( admin_url( 'admin.php?page=' . $this->slug ) );
			exit;
		}
	}
}

new RSTheme_Licenser();