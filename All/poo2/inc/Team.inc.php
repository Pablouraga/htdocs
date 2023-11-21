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
        $riders[] = $this->riders;
        $this->riders[] = $r;
    }

    public function addMechanic(Mechanic $m)
    {
        $mechanics[] = $this->mechanics;
        $this->mechanics[] = $m;
    }

    public function __toString()
    {
        $teaminfo = "<strong>Team</strong>: " . $this->name . ", country: " . $this->country . "";
        foreach ($this->riders as $rider) {
            $teaminfo .= "\n" . $rider;
        }

        foreach ($this->mechanics as $mechanic) {
            $teaminfo .= "\n" . $mechanic;
        }

        $teaminfo .= '<br><br>';

        return $teaminfo;
    }
}
