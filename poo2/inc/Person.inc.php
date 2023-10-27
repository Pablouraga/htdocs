<?php

class Person
{
    private $name;
    private $birthday;

    public function __construct(string $name, int $birthday)
    {
        $this->name = $name;
        $this->birthday = $birthday;
    }

    public function __toString() {

        return '<br>Name: ' . $this->name . ' Birthday: ' . date('j F Y', $this->birthday) .'';
    }
}
