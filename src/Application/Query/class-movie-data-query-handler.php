<?php

namespace Movie_Data\Application\Query;

use Movie_Data\Application\DTO\Movie_Data_DTO;
use Movie_Data\Domain\Repository\Interface_Movie_Data;

class Movie_Data_Query_Handler
{
    private Interface_Movie_Data $movie_data_interface;

    public function __construct(Interface_Movie_Data $movie_data_interface)
    {
        $this->movie_data_interface = $movie_data_interface;
    }

    /**
     * @return Movie_Data_DTO[]
     */
    public function handle(): array
    {
        $allMovies=[];
        $movies= $this->movie_data_interface->get_movie_data();

        foreach($movies as $movie){
            $allMovies[]= Movie_Data_DTO::createFromDB($movie);
        }

        return $allMovies;
    }

}