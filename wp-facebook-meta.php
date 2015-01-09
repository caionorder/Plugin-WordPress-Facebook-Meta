<?php
/*
  Plugin Name: WP Facebook Meta
  Plugin URI: http://www.caionorder.com
  Description: WP Meta Facebook generator.
  Version: 0.1
  Author: Caio Norder
  Author URI: http://www.caionorder.com/
 */


// PLUGIN CODE 
function add_facebook_meta() {
    global $post;

    if (is_page() || is_single()) {

        $post_thumbnail_id = get_post_thumbnail_id($post->ID);
        $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

        $fb_tags_values = array(
            "title" => $post->post_title . " @ " . get_bloginfo("name"),
            "type" => "article",
            "image" => $post_thumbnail_url,//get_the_post_thumbsnail($post->ID, "thumbnail", "src"),
            "url" => get_permalink($post->ID),
            "site_name" => get_bloginfo("name")
        );

        echo "\n<!-- Begin WP Facebook Meta by Caio Norder -->\n";
        foreach ($fb_tags_values as $tags => $value) {
            echo "\t<meta property=\"og:$tags\" content=\"$value\"/> \n";
        }
        echo "<!-- / End WP Facebook Meta -->\n\n";
    }
}

add_action("wp_head", "add_facebook_meta", 1);
?>