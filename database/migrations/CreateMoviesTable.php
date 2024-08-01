<?php

namespace Nhrrob\Movies\Database\Migrations;

class CreateMoviesTable
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

        if ($existing_table_name != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $table_name (
                id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description TEXT,
                release_date DATE NULL,
                created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

    public static function down()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'nhrrob_movies';
        //
    }
}
