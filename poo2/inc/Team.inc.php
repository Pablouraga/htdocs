<?php

class Team
{
    private $name;
    private $country;
    private $riders;
    private $mechanics;

    public function __construct(string $name, string $country)
    {
        $this->name = $name;
        $this->country = $country;
    }

    public function addRider(Rider $r)
    {
        $this->riders[] = $r;
    }

    public function addMechanic(Mechanic $m)
    {
        $this->mechanics[] = $m;
    }

    public function __toString()
    {
        
    }
}
