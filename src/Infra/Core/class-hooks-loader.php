<?php

namespace Movie_Data\Infra\Core;

class Hooks_Loader
{

    private  array $actions;
    private  array  $filters;

    private  array $shortcodes;

    public function __construct()
    {
        $this->actions = array();
        $this->filters = array();
        $this->shortcodes = array();
    }

    public function add_action($hook, $component, $callback): void
    {
        $this->actions = $this->add($this->actions, $hook, $component, $callback);
    }

    public function add_filter($hook, $component, $callback): void
    {
        $this->filters = $this->add($this->filters, $hook, $component, $callback);
    }

    public function add_shortcode($hook, $component, $callback): void
    {
        $this->shortcodes = $this->add($this->shortcodes, $hook, $component, $callback);
    }


    public function add($hooks, $hook, $component, $callback): array
    {
        $hooks[] = [

            'hook' => $hook,
            'component' => $component,
            'callback' => $callback
        ];


        return $hooks;
    }

    public function load(): void
    {
        foreach ($this->filters as $hook) {
            add_filter($hook['hook'], array($hook['component'], $hook['callback']));
        }
        foreach ($this->actions as $hook) {
            add_action($hook['hook'], array($hook['component'], $hook['callback']));
        }

        foreach ($this->shortcodes as $hook) {
            add_shortcode($hook['hook'], array($hook['component'], $hook['callback']));
        }
    }
}