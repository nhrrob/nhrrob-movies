<?php 

namespace Nhrrob\Movies\Classes;

use Nhrrob\Movies\Controllers\MovieController;

/**
 * The admin class
 */
class Admin {

    /**
     * Initialize the class
     */
    function __construct() {
        $this->dispatch_actions();

        new Admin\Menu();
    }

    /**
     * Dispatch and bind actions
     *
     * @return void
     */
    public function dispatch_actions( ) {
        // Handle form submissions
        add_action('admin_post_nhrrob_movies_store', [new MovieController(), 'store']);
        add_action('admin_post_nhrrob_movies_update', [new MovieController(), 'update']);
        add_action('admin_post_nhrrob_movies_delete', [new MovieController(), 'destroy']);
    }
}
