<?php declare( strict_types = 1 );

namespace App;
/**
 * CookieService.
 */
class CookieService {
	/**
	 * Delete Cookie
	 *
	 * @param string $name Name
	 * @param boolean $force Default 'false'.
	 * @return void
	 */
	public static function delete_cookie( $name, $force = false ) {
		if ( $force && isset( $_COOKIE[ $name ] ) ) {
			unset( $_COOKIE[ $name ] );
		}

		setcookie( $name, '', -1, '/' );
	}

	/**
	 * Set cookie.
	 *
	 * @param string $name Cookie name.
	 * @param string $value Cookie value.
	 * @param bool   $force Force set cookie.
	 * @param int    $expire Cookie expiration.
	 * @return void
	 */
	public static function set_cookie( $name, $value , $force = false, $expire = 0 ) {
		$time = time() + 3600;

		if ( 0 !== $expire ) {
			$time = time() + $expire;
		}

		setcookie( $name, $value, $time , '/' );

		if ( $force ) {
			$_COOKIE[ $name ] = $value;
		}
	}

	/**
	 * Get cookie.
	 *
	 * @param string $name Cookie name.
	 * @param string $pre_reload_value Pre reload page Default 'false'.
	 * @param string $sanitize Default FILTER_DEFAULT.
	 * @return mixed
	 */
	public static function get_cookie( $key, $pre_reload = false, $sanitize = FILTER_DEFAULT ) {
		if ( $pre_reload && isset( $_COOKIE[ $key ] ) ) {
			return filter_var( $_COOKIE[ $key ], $sanitize );
		}

		return filter_input( INPUT_COOKIE, $key, $sanitize );
	}
}
