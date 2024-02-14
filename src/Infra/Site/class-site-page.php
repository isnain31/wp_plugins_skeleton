<?php

namespace Movie_Data\Infra\Site;

use Movie_Data\Application\Query\Movie_Data_Query_Handler;
use Movie_Data\Infra\DAO\Movie_Database;

class Site_Page
{
    const PAGE_ID = 'movie-data-public';

    private Movie_Data_Query_Handler $movie_data_query_handler;
    public function __construct()
    {
        $this->movie_data_query_handler = new Movie_Data_Query_Handler(new Movie_Database());
    }

    public function get_page_id(): string
    {
        return self::PAGE_ID;
    }


    public function movie_data_shortcode(): string
    {
        $movies = $this->movie_data_query_handler->handle();
        $html = '<ul>';
        foreach ($movies as $movie) {
            $html .= '<li>' . $movie->get_title() . ' - ' . $movie->get_starring(). '</li>';
        }
        $html .= '</ul>';
        return $html;
    }
}