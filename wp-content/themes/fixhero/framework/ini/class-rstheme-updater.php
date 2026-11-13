<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RSTheme_Updater {

	private $theme_slug;

	private $version;

	private $update_url = 'https://updater.rstheme.com/wp-json/rstheme-updater/v1/info';

	private $db_license_key = "FixheroWordPressTheme_lic_Key";

	public function __construct() {
		$theme            = wp_get_theme();
		$current_theme    = $theme->parent() ? $theme->parent() : $theme;
		$this->theme_slug = $current_theme->get_template();
		$this->version    = $current_theme->get( 'Version' );

		add_filter( 'pre_set_site_transient_update_themes', [ $this, 'check_for_update' ] );
		add_filter( 'themes_api', [ $this, 'theme_info' ], 10, 3 );
		add_action( 'upgrader_process_complete', [ $this, 'clear_update_transient' ], 10, 2 );
	}

	/**
	 * Check for theme updates
	 */
	public function check_for_update( $transient ) {
		if ( empty( $transient->checked ) ) {
			return $transient;
		}

		// Get update info from your server
		$remote = $this->get_remote_info();

		if ( $remote && ! empty( $remote->version ) && version_compare( $this->version, (string) $remote->version, '<' ) ) {
			$transient->response[ $this->theme_slug ] = [
				'theme'       => $this->theme_slug,
				'new_version' => $remote->version,
				'url'         => $remote->details_url ?? '',
				'package'     => $remote->download_url ?? '',
			];
		}

		return $transient;
	}

	/**
	 * Get theme information for the update screen
	 */
	public function theme_info( $false, $action, $args ) {
		if ( $action !== 'theme_information' ) {
			return $false;
		}

		if ( $args->slug !== $this->theme_slug ) {
			return $false;
		}

		$remote = $this->get_remote_info();

		if ( ! $remote ) {
			return $false;
		}

		return (object) [
			'name'          => $remote->name,
			'slug'          => $this->theme_slug,
			'version'       => $remote->version,
			'author'        => $remote->author,
			'download_link' => $remote->download_url,
			'sections'      => [
				'description' => $remote->description ?? '',
				'changelog'   => $remote->changelog ?? '',
			],
		];
	}

	/**
	 * Clear update transient after theme update
	 */
	public function clear_update_transient( $upgrader_object, $options ) {
		if ( $options[ 'type' ] === 'theme' && isset( $options[ 'themes' ] ) && in_array( $this->theme_slug, $options[ 'themes' ] ) ) {
			wp_clean_themes_cache();

			$theme         = wp_get_theme( $this->theme_slug );
			$this->version = $theme->get( 'Version' );
		}
	}

	private function get_remote_info() {
		$request_url = add_query_arg( [
			'slug' => $this->theme_slug,
			'code' => get_option( $this->db_license_key, '' ),
		], $this->update_url );

		$request = wp_remote_get( $request_url, [ 'timeout' => 15 ] );

		if ( is_wp_error( $request ) ) {
			error_log( print_r( $request, true ) );

			return false;
		}

		$body = wp_remote_retrieve_body( $request );

		return json_decode( $body );
	}
}

new RSTheme_Updater();