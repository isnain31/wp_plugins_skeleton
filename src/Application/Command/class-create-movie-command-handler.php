<?php
namespace Movie_Data\Application\Command;
use Movie_Data\Application\DTO\Movie_Data_DTO;
use Movie_Data\Application\ValueObject\Create_Movie_Command_Data;
use Movie_Data\Domain\Model\Movie_Data;
use Movie_Data\Domain\Repository\Interface_Movie_Data;

class Create_Movie_Command_Handler
{

    private Interface_Movie_Data $movie_data_interface;

    public function __construct(Interface_Movie_Data $movie_data_interface)
    {
        $this->movie_data_interface = $movie_data_interface;
    }

    public function handle(Create_Movie_Command_Data $command): Movie_Data_DTO
    {

        $movie=$this->movie_data_interface->add_movie_data(Movie_Data::create($command->get_title(), $command->get_starring()));
        return Movie_Data_DTO::createFromDB($movie);
    }


}