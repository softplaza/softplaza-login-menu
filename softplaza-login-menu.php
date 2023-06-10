<?php
/**
 * Plugin Name: Login Menu
 * Plugin URI: http://wordpress.org/plugins/softplaza-login-menu/
 * Description: Simple Login and Logout Menu items.
 * Author: SoftPlaza.NET
 * Version: 1.0.0
 * Author URI: https://softplaza.net/
 * 
 * Login Menu is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Login Menu is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Login Menu. If not, see <https://www.gnu.org/licenses/>.
 */

defined( 'ABSPATH' ) OR die();

add_filter( 'wp_nav_menu_items', function($items, $args)
{
    $protocol = (empty($_SERVER['HTTPS']) || strtolower($_SERVER['HTTPS']) == 'off') ? 'http://' : 'https://';
	$port = (isset($_SERVER['SERVER_PORT']) && (($_SERVER['SERVER_PORT'] != '80' && $protocol == 'http://') || ($_SERVER['SERVER_PORT'] != '443' && $protocol == 'https://')) && strpos($_SERVER['HTTP_HOST'], ':') === false) ? ':'.$_SERVER['SERVER_PORT'] : '';

	$url = $protocol.$_SERVER['HTTP_HOST'].$port.$_SERVER['REQUEST_URI'];

	if (is_user_logged_in())
	{
		$items .= '<li><a href="'. wp_logout_url( $url ) .'">Log Out</a></li>';
	} else {
		$items .= '<li><a href="'. wp_login_url( $url ) .'">Log In</a></li>';
	}

    return $items;
}, 10, 3 );
