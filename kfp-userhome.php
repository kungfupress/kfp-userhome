<?php
/**
 * KFP UserHome
 *
 * @package kfp_userhome
 *
 * Plugin Name: KFP UserHome
 * Plugin URI: https://github.com/kungfupress/kfp-userhome
 * Description: Lleva a un usuario a una página concreta tras autenticarse
 * Version: 0.0.1
 * Author: Juanan Ruiz
 * Author URI: https://kungfupress.com
 */

defined( 'ABSPATH' ) || die();

add_filter( 'login_redirect', 'kfp_login_redirect', 10, 3 );
/**
 * Redirige al usuario actual a su home.
 *
 * @param string $redirect_to URL a la que redirige por defecto.
 * @param string $request URL de la que viene el usuario.
 * @param Object $user Usuario actual.
 * @return string
 */
function kfp_login_redirect( $redirect_to, $request, $user ) {
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		if ( in_array( 'administrator', $user->roles, true ) ) {
			return 'wp-admin';
		}
		if ( post_exists( $user->user_login ) ) {
			return $user->user_login;
		}
		return home_url();
	}
}
