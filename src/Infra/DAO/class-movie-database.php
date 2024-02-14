<?php

namespace Movie_Data\Infra\DAO;

use Movie_Data\Domain\Model\Movie_Data;
use Movie_Data\Domain\Repository\Interface_Movie_Data;

class Movie_Database implements Interface_Movie_Data
{
    /**
     * @return Movie_Data[]
     */
    public function get_movie_data(): array
    {
        global $wpdb;
        $movies = [];
        $table_name = $wpdb->prefix . 'movie_data';
        $results = $wpdb->get_results("SELECT * FROM $table_name");

        foreach ($results as $result)
            $movies[]= Movie_Data::create($result->title, $result->starring);


        return $movies;
    }

    public function add_movie_data(Movie_Data $data): Movie_Data
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'movie_data';
        $wpdb->insert(
            $table_name,
            array(
                'id' => $data->get_id(),
                'title' => $data->get_title(),
                'starring' => $data->get_starring()
            )
        );

        return $data;
    }

    static function up(): void
    {
        global $wpdb;

        if(! current_user_can('activate_plugins')) return;

        $table_name = $wpdb->prefix . 'movie_data';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id VARCHAR(255) NOT NULL,
            title text NOT NULL,
            starring text NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

    }

    static function down(): void
    {
        global $wpdb;
        if(! current_user_can('activate_plugins')) return;

        $table_name = $wpdb->prefix . 'movie_data';
        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql);
    }

}
