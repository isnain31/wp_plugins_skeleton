<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

spl_autoload_register(function ($class) {
    $prefix = 'Movie_Data';

    $base_dir = trailingslashit( untrailingslashit( plugin_dir_path( __FILE__ ) ) ).'src';

    if (!str_contains($class, $prefix)) {
        return;
    }

    $file_parts = explode( '\\', $class );

    $namespace = '';
    $file_name='';
    for ( $i = count( $file_parts ) - 1; $i > 0; $i-- ) {

        $current = str_ireplace( '_', '-', $file_parts[ $i ] );



        if ( count( $file_parts ) - 1 === $i ) {
            $current = strtolower( $current );


            if ( str_contains( $current, 'interface' ) ) {

                $interface_name = explode( '-', $current );
                array_shift($interface_name);
                $interface_name = implode( '-', $interface_name );
                $file_name = "/interface-$interface_name.php";

            } else {
                $file_name = "/class-$current.php";
            }
        } else {
            $namespace = '/' . $current . $namespace;
        }
    }

    $filepath  =  $base_dir. $namespace ;
    $filepath .= $file_name;



    if (file_exists($filepath)) {
        require $filepath;
    }
});