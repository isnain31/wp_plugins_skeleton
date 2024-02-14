<?php

namespace Movie_Data\Application\ValueObject;

class Create_Movie_Command_Data
{
    private string $title;
    private string $starring;

    public function __construct(string $title, string $starring)
    {
        $this->title = $title;
        $this->starring = $starring;
    }

    public static function create(string $title, string $starring): self
    {
        return new self($title, $starring);
    }

    public function get_title(): string
    {
        return $this->title;
    }

    public function get_starring(): string
    {
        return $this->starring;
    }
}