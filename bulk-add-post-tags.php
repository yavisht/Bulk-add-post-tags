<?php
/**
 * Plugin Name: Bulk add post tags
 * Plugin URI: http://www.ykat.com.au
 * Description: Bulk add tags to posts in any post type. Use with caution.
 * Version: 1.0.0
 * Author: Yavisht Katgara
 * Author URI: http://www.ykat.com.au
 * License: GPL2
 */

class options_page {

        function __construct() {
                add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        }

        function admin_menu() {
                add_options_page(
                        'Page Title',
                        'Mass Tag Add',
                        'manage_options',
                        'mass_tag_add',
                        array(
                                $this,
                                'settings_page'
                        )
                );
        }

        function settings_page() {
        $args = array (
        //Feel free to use this with your custom post type. Edit post array ('post_type')
        'post_type'              => array( 'post' ),
        'post_status'            => array( 'published' ),
        'posts_per_page'         => '-1',
);

// The Query
$archives = new WP_Query( $args );

// The Loop
if ( $archives->have_posts() ) {
        while ( $archives->have_posts() ) {
                $archives->the_post();
                 $id = get_the_ID();
                
                //Change 'archived' to the tag you want to bulk add
                wp_set_post_tags( $id, 'archived', true );
                echo 'Tag added for post ' . $id . '<br />';

        }
} else {
        // no posts found
}

// Restore original Post Data
wp_reset_postdata();

        }
}

new options_page;
?>