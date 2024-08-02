<?php

namespace Nhrrob\Movies\Database\Migrations;

class AddReleaseDateToMoviesTable
{
    public static function up()
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
            $wpdb->query("ALTER TABLE {$table_name} ADD COLUMN release_date DATE NULL AFTER description");
        }
    }

    public static function down()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'nhrrob_movies';

        if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") === $table_name) {
            $wpdb->query("ALTER TABLE {$table_name} DROP COLUMN release_date");
        }
    }
}
