<?php

namespace NHRRob\Movies\Database\Migrations;

use wpdb;

class UpdateReleaseDateNullable
{
    public static function up()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'nhrrob_movies';

        // Alter the table to make `release_date` column nullable
        $wpdb->query("
            ALTER TABLE $table_name
            MODIFY COLUMN release_date DATE DEFAULT NULL
        ");
    }

    public static function down()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'nhrrob_movies';

        // Revert `release_date` column to NOT NULL if needed
        // Adjust this query according to your needs; it's just an example.
        $wpdb->query("
            ALTER TABLE $table_name
            MODIFY COLUMN release_date DATE NOT NULL
        ");
    }
}
