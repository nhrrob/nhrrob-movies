<?php

namespace Nhrrob\Movies\Classes\Admin;


/**
 * The Menu handler class
 */
class Menu {

    /**
     * Initialize the class
     */
    function __construct( ) {
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    /**
     * Register admin menu
     *
     * @return void
     */
    public function admin_menu() {
        $parent_slug = esc_html( 'nhrrob-movies' );
        $capability = esc_html( 'manage_options' );

        $hook = add_menu_page( __( 'NHR Movies', 'nhrrob-movies' ), __( 'NHR Movies', 'nhrrob-movies' ), $capability, $parent_slug, [ $this, 'nhrrob_movies_route' ], 'dashicons-video-alt2' );

        // add_action( 'admin_head-' . $hook, [ $this, 'enqueue_assets' ] );
        
        $end = 'backend';
        if('backend' === $end) {
            $current_page = ! empty($_GET['page']  ) ? sanitize_text_field($_GET['page']) : '';

            if ($current_page === 'nhrrob-movies') {
                add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));                
            }
		}else if('frontend' === $end){
			// add_action('wp_enqueue_scripts', array($this, 'handle_scripts_and_styles_frontend'));
		}
    }

    public function nhrrob_movies_route() {
        global $nhrrob_movies_routes;
    
        $current_page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : 'nhrrob-movies';
        $action = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : 'index';
        $route_key = $current_page . '/' . $action;
    
        if (isset($nhrrob_movies_routes[$route_key])) {
            $controller_action = $nhrrob_movies_routes[$route_key];
            $controller = new $controller_action[0]();
            $method = $controller_action[1];
    
            if (method_exists($controller, $method)) {
                $controller->$method();
            } else {
                echo 'Error: Method not found.';
            }
        } else {
            echo 'Error: Route not found.';
        }
    }

    /**
     * Enqueue scripts and styles
     *
     * @return void
     */
    public function enqueue_assets() {
        wp_enqueue_style( 'nhrrob-movies-style' );
        // wp_enqueue_style( 'nhrrob-movies-admin-style' );
        // wp_enqueue_script( 'nhrrob-movies-admin-script' );
    }
}
