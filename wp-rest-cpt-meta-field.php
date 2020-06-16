<?php

/**
 * Plugin Name:         WP REST CustomPostField CPF meta field
 * Description:         Add custom post types with meta field to Wordpress REST API
 * Author:              Fernando Ortuno
 * Version:             1.0
 * GitHub Plugin URI:   https://github.com/
 * Text Domain:         wp-rest-cpf-meta-field
 * Domain Path:         /languages
 */

defined('ABSPATH') || exit;

class WP_REST_CPF_META_FIELD {
    

    public static $cpf_slug = 'my-cpf';
    public static $cpf_name = 'MY CPF';
    public static $cpf_meta = 'my-cpf-meta'; 
    public static $cpf_meta_label = 'My test custom meta';

    public static function init(){
        add_action( 'init', [__CLASS__, 'register_post_types'] );
        add_action( 'save_post_'.self::$cpf_slug, [__CLASS__, 'save_cpf_meta'] );
        add_action( 'rest_api_init', [__CLASS__, 'add_cpf_data'] );
    }    


    public static function register_post_types(){
	    register_post_type( self::$cpf_slug, [
		    'label'  => null,
		    'labels' => [
			    'name'               => __(self::$cpf_slug, 'wp-rest-cpf-meta-field'),
			    'singular_name'      => __('cpf', 'wp-rest-cpf-meta-field'),
			    'add_new'            => __('add new cpf', 'wp-rest-cpf-meta-field'),
			    'add_new_item'       => __('add new cpf', 'wp-rest-cpf-meta-field'),
			    'edit_item'          => __('edit cpf', 'wp-rest-cpf-meta-field'),
			    'new_item'           => __('new cpf', 'wp-rest-cpf-meta-field'),
			    'view_item'          => __('view cpf', 'wp-rest-cpf-meta-field'),
			    'search_items'       => __('search cpf', 'wp-rest-cpf-meta-field'),
			    'not_found'          => __('not found cpf', 'wp-rest-cpf-meta-field'),
			    'not_found_in_trash' => __('not found cpf in trash', 'wp-rest-cpf-meta-field'),
			    'menu_name'          => __(self::$cpf_name, 'wp-rest-cpf-meta-field'),
		    ],
		    'description'           => __('cpf', 'wp-rest-cpf-meta-field'),
		    'public'                => true,
		    'show_in_menu'          => true,
            'show_in_rest'          => true,
            "rest_base"             => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
		    'menu_icon'             => 'dashicons-book-alt',
		    'hierarchical'          => false,
		    'supports'              => ['title', 'editor', 'custom-fields'],
		    'taxonomies'            => [],
		    'has_archive'           => true,
		    'rewrite'               => true,
            'query_var'             => true,
            'register_meta_box_cb'  => [__CLASS__, 'add_cpf_metaboxes'],
	    ] );
    }

    public static function add_cpf_metaboxes(){
        $screens = array(self::$cpf_slug);
        add_meta_box(
           'cpf_fields',
            __('cpf data', 'wp-rest-cpf-meta-field'),
            [__CLASS__, 'display_cpf_fields'],
            self::$cpf_slug,
            'normal',
            'default',
            $screens
        );
    }

   
    public static function display_cpf_fields($post, $meta) {
	    global $post;
	    $cpf_meta = get_post_meta( $post->ID, self::$cpf_meta, true );
        echo '<label>'.self::$cpf_meta_label.'</label><input type="text" name="'.self::$cpf_meta.'" value="' . esc_textarea( $cpf_meta )  . '" class="widefat">';
    }    




    public static function save_cpf_meta( $post_id ) {
        
        if ( wp_is_post_revision( $post_id ) ){
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ):
            return $post_id;
        endif;

	    if (  ! isset( $_POST[self::$cpf_meta] ) ):
            return $post_id;
        endif;
        
        $events_meta[self::$cpf_meta] = esc_textarea( $_POST[self::$cpf_meta] );

	    foreach ( $events_meta as $key => $value ) :

		    if ( get_post_meta( $post_id, $key, false ) ) {
			    update_post_meta( $post_id, $key, $value );
		    } else {
			    add_post_meta( $post_id, $key, $value);
		    }

		    if ( ! $value ) {
			    delete_post_meta( $post_id, $key );
		    }

	    endforeach;

    }

    public static function add_cpf_data() {
        register_rest_field(self::$cpf_slug,
            self::$cpf_meta,
            array(
                'get_callback' => [__CLASS__, 'cpf_get_field'],
                'schema' => null,
            )
        );
    }
     
    public static function cpf_get_field($object = '', $field_name = '', $request = array()) {
      return get_post_meta($object['id'], self::$cpf_meta, true);
  


    }


    // public static function add_cpf_data() {   register_rest_field(self::$cpf_slug,
    //         self::$cpf_meta,
    //         array(
    //             'get_callback' => [__CLASS__, 'cpf_get_field'],
    //             'schema' => null,
    //         )
    //     );
    // }
  


}

WP_REST_CPF_META_FIELD::init();
?>