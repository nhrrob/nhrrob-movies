<?php

namespace Nhrrob\Movies\Database\Migrations;

use Nhrrob\Movies\Database\Migration;

class AddUpdatedAtToMoviesTable extends Migration
{
    public function up()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'nhrrob_movies';

        $existing_table_name = $wpdb->get_var(
            $wpdb->prepare(
                "SHOW TABLES LIKE %s",
                stripslashes( $table_name ),
            )
        );

        if ($existing_table_name === $table_name) {
            $wpdb->query("ALTER TABLE {$table_name} ADD COLUMN updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER release_date");
        }
    }

    public function down()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'nhrrob_movies';

        if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") === $table_name) {
            $wpdb->query("ALTER TABLE {$table_name} DROP COLUMN updated_at");
        }
    }
}
