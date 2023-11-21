<?php

class Mechanic extends Person
{
    private $speciality;

    public function __construct(string $name, int $birthday, string $speciality)
    {
        parent::__construct($name, $birthday);
        $this->speciality = $speciality;
    }

    public function __toString(){
        return parent::__toString() . ' Speciality: ' . $this->speciality. '';
    }
}
