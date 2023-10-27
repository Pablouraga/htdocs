<?php

class Grandprix
{
    private $date;
    private $ridersInRace;
    private $circuit;

    public function __construct(Circuit $circuit, int $date)
    {
        $this->date = $date;
        $this->circuit = $circuit;
    }
    

    public function addRider(Rider $r)
    {
        $this->ridersInRace[] = $r;
    }

    public function results()
    {
        ksort($this->ridersInRace);
        $results = 'Results: ';
        foreach ($this->ridersInRace as $pos => $rider) {
            $results .= '\nPosicion: ' . $pos . ' ' . $rider->__toString . '';
        }
        return $results;
    }

    public function __toString()
    {
        $circuitInfo = $this->circuit;
        return $circuitInfo . ' date: ' . $this->date . '';
    }
}
