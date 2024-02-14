<?php

namespace Movie_Data\Infra\Admin;


use Movie_Data\Application\Command\Create_Movie_Command_Handler;
use Movie_Data\Application\ValueObject\Create_Movie_Command_Data;
use Movie_Data\Infra\Core\HTTP_STATUS_CODE;
use Movie_Data\Infra\DAO\Movie_Database;
use Movie_Data\Infra\FE\View\Admin_Form_View;

class Admin_Page
{

    const PAGE_ID = 'movie-data-admin';

    private Create_Movie_Command_Handler $create_movie_command_handler;

    public function __construct()
    {
        $this->create_movie_command_handler = new Create_Movie_Command_Handler(new Movie_Database());
    }


    public function get_page_id(): string
    {
        return self::PAGE_ID;
    }

    public function add_menu(): void
    {
        add_menu_page(
            'Movie Data',
            'Movie Data',
            'manage_options',
            self::PAGE_ID,
            array($this, 'render'),
            'dashicons-video-alt2'
        );
    }

    public function enqueue_scripts(): void{

       $params = array ( 'ajaxurl' => admin_url( 'admin-ajax.php' ) );
       wp_enqueue_script('movie-data-admin', (plugin_dir_url( __FILE__ )) . '../FE/JS/movie-data-admin.js', array('jquery'), '1.0', false);
       wp_localize_script( 'movie-data-admin', 'params', $params );

    }

    function movie_data_admin_action(): void
    {

        if ( ! isset( $_POST['movie_data_nonce'] ) || ! wp_verify_nonce( $_POST['movie_data_nonce'], 'movie_data_nonce' ) ) {
            wp_die( 'Security check',$this->get_page_id(), ['response'=> HTTP_STATUS_CODE::HTTP_FORBIDDEN] );
        }

        $title = sanitize_text_field( $_POST['title'] );
        $starring = sanitize_text_field( $_POST['starring'] );

        $movie=$this->create_movie_command_handler->handle(Create_Movie_Command_Data::create($title, $starring));

        if(!$movie->get_id())
            wp_die( 'Error adding movie',$this->get_page_id(), ['response'=> HTTP_STATUS_CODE::HTTP_BAD_REQUEST] );

        wp_die();
    }

    public function render(): void{
        Admin_Form_View::create();
    }

}