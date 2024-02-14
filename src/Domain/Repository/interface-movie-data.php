<?php

namespace Movie_Data\Domain\Repository;

use Movie_Data\Domain\Model\Movie_Data;

interface Interface_Movie_Data
{
    /*
     * @return Movie_Data[]
     */
    public function get_movie_data(): array;
    public function add_movie_data(Movie_Data $data): Movie_Data;

    public static function up(): void;
    public static function down(): void;

}