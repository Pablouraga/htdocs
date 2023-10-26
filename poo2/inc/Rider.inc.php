<?php

class Rider extends Person
{
    private $number;

    public function __construct(string $name, int $birthday, int $number)
    {
        parent::__construct($name, $birthday);
        $this->number = $number;
        
    }

    public function __toString(){
        return parent::__toString() . ' Driver number: ' . $this->number. '';
    }
}
