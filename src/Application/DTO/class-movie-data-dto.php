<?php

namespace Movie_Data\Application\DTO;

use Movie_Data\Domain\Model\Movie_Data;

class Movie_Data_DTO
{
    private string $id;
    private string $title;
    private string $starring;

    public function __construct(string $id, string $title, string $starring)
    {
        $this->id = $id;
        $this->title = $title;
        $this->starring = $starring;
    }

    public static function createFromDB(Movie_Data $movie_data): self
    {
        return new self($movie_data->get_id(),$movie_data->get_title(), $movie_data->get_starring());
    }

    public function get_title(): string
    {
        return $this->title;
    }

    public function get_starring(): string
    {
        return $this->starring;
    }

    public function get_id(): string
    {
        return $this->id;
    }
}