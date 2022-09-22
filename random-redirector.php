<?php
/*
Plugin Name: Random Post Redirector
Plugin URI: https://github.com/cogdog/wp-random-redirector
Description: Makes a /random url work as a redirector to a random post 
Version: 0.2
License: GPLv2
Author: Alan Levine
Author URI: https://cog.dog
*/

/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// change if you want a different slug to generate the randomness
// one day ths can be plugin option but I am lazy today ;-)
define("RANDOMSLUG", "random");

/* set up rewrite rules */

function randypost_redirect_rewrite_rules() {
	// let's create a rewrite rule for our random link and slug
	add_rewrite_rule(RANDOMSLUG . '/?$', 'index.php?' . RANDOMSLUG  . '=y', 'top');
}

add_action('init','randypost_redirect_rewrite_rules');


// -----  set up on activation

function randypost_redirect_activate() { 
	// Trigger our function that adds our rewrite rule
	randypost_redirect_rewrite_rules();
	
	// Clear the permalinks after rewrite has been added.
	flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'randypost_redirect_activate' );

// -----  clean up on de-activation
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );

// -----  add an allowable url parameter
function randypost_redirect_queryvars( $qvars ) {
	$qvars[] = RANDOMSLUG; // flag for random generator, define in constant
	return $qvars;
}

add_filter('query_vars', 'randypost_redirect_queryvars' );


// -----  add an allowable url parameter

function randypost_redirect_redirector() {

 	// manage redirect for /random
   if ( get_query_var(RANDOMSLUG) == 'y' ) {
		 // set arguments for WP_Query on published posts to get one post at random
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 1,
			'ignore_sticky_posts' => 1,
			'orderby' => 'rand'
		);

		// It's time! Go someplace random
		$my_random_post = new WP_Query ( $args );

		// die(print_r($my_random_post) );
		while ( $my_random_post->have_posts() ) {
		  $my_random_post->the_post();

		  // redirect to the random post
		  wp_redirect ( get_permalink() );
		  exit;
		}
   }
 }
 
 add_action('template_redirect', 'randypost_redirect_redirector');

 ?>