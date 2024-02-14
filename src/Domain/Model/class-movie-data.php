<?php
namespace Movie_Data\Domain\Model;

class Movie_Data
{
    private string $id;
    private string $title;
    private string $starring;

    public function __construct(string $title, string $starring)
    {
        $this->id = uniqid(); // custom unique id generation was not added for simplicity
        $this->title = $title;
        $this->starring = $starring;
    }

    public function get_id(): string
    {
        return $this->id;
    }

    public function get_title(): string
    {
        return $this->title;
    }

    public function get_starring(): string
    {
        return $this->starring;
    }

    public static function create( string $title, string $starring): self
    {
        return new self($title, $starring);
    }

}