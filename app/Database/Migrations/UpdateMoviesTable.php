<?php

namespace NHRRob\Movies\Database\Migrations;

use wpdb;

class UpdateMoviesTable
{
    public static function up()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'nhrrob_movies';

        // Alter the table to allow NULL for description and release_date
        $wpdb->query("
            ALTER TABLE $table_name
            MODIFY COLUMN description TEXT DEFAULT NULL,
            MODIFY COLUMN release_date DATE DEFAULT NULL
        ");
    }

    public static function down()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'nhrrob_movies';

        // Revert changes if necessary (make fields NOT NULL again if required)
        $wpdb->query("
            ALTER TABLE $table_name
            MODIFY COLUMN description TEXT NOT NULL,
            MODIFY COLUMN release_date DATE NOT NULL
        ");
    }
}
