<?php

/*
Plugin Name: My cictation shortcode
Plugin URL: https://www.mycitation-shorcode.com
Description: This plugin will allow you to generate quotes from your authors and call them through shortcode
Version: 1.0
Author: Luis Angel Martinez
Author URL: https://www.mycitation-shorcode2.com
license: GPI v2
*/

/*Add Metabox for Cication*/ 
function my_citation() { 
    add_meta_box( 'my_citation','Citation','the_citation','post','normal','high' );  
}

/*Add Editor, Show citation in Editor*/

function the_citation() {
	global $post;
	$mycitation_get  = get_post_meta($post->ID, 'citation', true);
	wp_editor( $mycitation_get, 'citation', array() );	
}

/*Save Citation in Database*/

function save_mycitation() {
    global $wpdb, $post;
    if (!$post_id) $post_id = $_POST['post_ID'];
    if (!$post_id) return $post;
    $price= $_POST['citation'];
    update_post_meta($post_id, 'citation', $price);
	
}
add_action( 'add_meta_boxes', 'my_citation' );                                  
add_action('save_post', 'save_mycitation');
add_action('publish_post', 'save_mycitation');


/*Shortcode to generate citations*/

function return_citation($atts){
	
    global $post;
    ob_start();
	$the_post = get_post_meta($post->ID, 'citation', true);
    	return $the_post;
	
		$atts = shortcode_atts( array(
'post_id' => "",), $atts );
	
	$args = array(
			'post_type' => 'post',
			'citation' => $atts['post_ID']
				);
	}
add_shortcode('mc-citacion', 'return_citation'); 

?>
