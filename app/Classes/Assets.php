<?php

namespace Nhrrob\Movies\Classes;

/**
 * Assets handler class
 */
class Assets {

    /**
     * Class constructor
     */
    function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    /**
     * All available scripts
     *
     * @return array
     */
    public function get_scripts() {
        return [
            // 'nhrrob-movies-script' => [
            //     'src'     => NHRROB_MOVIES_PUBLIC . '/js/frontend.js',
            //     'version' => filemtime( NHRROB_MOVIES_PUBLIC_PATH . '/js/frontend.js' ),
            //     'deps'    => [ 'jquery' ]
            // ],
            // 'nhrrob-movies-admin-script' => [
            //     'src'     => NHRROB_MOVIES_PUBLIC . '/js/admin.js',
            //     'version' => filemtime( NHRROB_MOVIES_PUBLIC_PATH . '/js/admin.js' ),
            //     'deps'    => [ 'jquery', 'wp-util' ]
            // ],
        ];
    }

    /**
     * All available styles
     *
     * @return array
     */
    public function get_styles() {
        return [
            'nhrrob-movies-style' => [
                'src'     => NHRROB_MOVIES_PUBLIC . '/css/style.css',
                'version' => filemtime( NHRROB_MOVIES_PUBLIC_PATH . '/css/style.css' )
            ],
            // 'nhrrob-movies-admin-style' => [
            //     'src'     => NHRROB_MOVIES_PUBLIC . '/css/admin.out.css',
            //     'version' => filemtime( NHRROB_MOVIES_PUBLIC_PATH . '/css/admin.out.css' )
            // ],
            // 'nhrrob-movies-tailwind-style' => [
            //     'src'     => NHRROB_MOVIES_PUBLIC . '/css/admin.out.css',
            //     'version' => filemtime( NHRROB_MOVIES_PUBLIC_PATH . '/css/admin.out.css' )
            // ],
        ];
    }

    /**
     * Register scripts and styles
     *
     * @return void
     */
    public function register_assets() {
        $scripts = $this->get_scripts();
        $styles  = $this->get_styles();

        foreach ( $scripts as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;

            wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
        }

        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_register_style( $handle, $style['src'], $deps, $style['version'] );
        }

        // wp_localize_script( 'nhrrob-movies-admin-script', 'nhrrobMovies', [
        //     'nonce' => wp_create_nonce( 'nhrrob-movies-admin-nonce' ),
        //     'confirm' => __( 'Are you sure?', 'nhrrob-movies' ),
        //     'error' => __( 'Something went wrong', 'nhrrob-movies' ),
        // ] );
    }
}
