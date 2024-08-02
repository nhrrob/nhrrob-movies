<?php

namespace Nhrrob\Movies\Database\Migrations;

use Nhrrob\Movies\Database\Migration;

class RemoveCreatedByFromMoviesTable extends Migration
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
            $wpdb->query("ALTER TABLE {$table_name} DROP COLUMN created_by");
        }
    }

    public function down()
    {
        //
    }
}
