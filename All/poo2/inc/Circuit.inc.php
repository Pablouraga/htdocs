<?php

class Circuit
{
    private $name;
    private $country;
    private $laps;

    public function __construct(string $name, string $country, int $laps)
    {
        $this->name = $name;
        $this->country = $country;
        $this->laps = $laps;
    }

    public function __toString()
    {
        return 'Circuit name: ' . $this->name . ', country: ' . $this->country . ', laps: ' .$this->laps . '';
    }
}
