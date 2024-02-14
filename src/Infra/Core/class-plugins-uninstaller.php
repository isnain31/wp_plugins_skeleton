<?php

namespace Movie_Data\Infra\Core;

use Movie_Data\Infra\DAO\Movie_Database;

class Plugins_Uninstaller
{

    public static function uninstall(): void
    {
        Movie_Database::down();
    }

}