<?php 

namespace Nhrrob\Movies\Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use Nhrrob\Movies\Database\Migrations\AddReleaseDateToMoviesTable;
use Nhrrob\Movies\Database\Migrations\AddUpdatedAtToMoviesTable;
use Nhrrob\Movies\Database\Migrations\CreateMoviesTable;

class Connection {

    public static function up(){
        global $wpdb;

        // Initialize Eloquent ORM
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => DB_HOST,
            'database'  => DB_NAME,
            'username'  => DB_USER,
            'password'  => DB_PASSWORD,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => $wpdb->prefix,
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}