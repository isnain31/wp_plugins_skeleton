<?php

namespace Movie_Data\Infra\Core;

use Movie_Data\Infra\DAO\Movie_Database;
class Plugins_Installer
{

    public static function install(): void
    {
        Movie_Database::up();
    }

}