<?php

namespace Movie_Data\Infra\Core;

use Movie_Data\Infra\Admin\Admin_Page;
use Movie_Data\Infra\Site\Site_Page;
use Movie_Data\Infra\Core\Hooks_Loader;
class Init_Plugin
{

    private Hooks_Loader $hooksLoader;
    public function __construct()
    {
        $this->hooksLoader = new Hooks_Loader();
        $this->createAdminHooks();
        $this->createSiteHooks();

    }


    private function createSiteHooks(): void
    {
        $site=new Site_Page();
        $this->hooksLoader->add_shortcode('movie_data', $site, 'movie_data_shortcode');
    }

    private function createAdminHooks(): void
    {
        $admin=new Admin_Page();
        $this->hooksLoader->add_action('admin_menu', $admin, 'add_menu');
        $this->hooksLoader->add_action('wp_ajax_movie_data', $admin, 'movie_data_admin_action');
        $this->hooksLoader->add_action('admin_enqueue_scripts', $admin, 'enqueue_scripts');

    }

    public function start(): void
    {
        $this->hooksLoader->load();
    }

}