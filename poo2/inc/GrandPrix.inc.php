<?php

class Grandprix
{
    private $date;
    private $ridersInRace = [];
    private $circuit;

    public function __construct(Circuit $circuit, int $date)
    {
        $this->circuit = $circuit;
        $this->date = $date;
    }


    public function addRider(Rider $r, $pos)
    {
        $this->ridersInRace[] = $r;

        if (!isset($this->ridersInRace[$pos])) {
            $this->ridersInRace[$pos] = $r;
            echo $pos;
        } else {
            echo 'Posicion ' . $pos . ' ocupada';
        }
    }

    public function results()
    {
        ksort($this->ridersInRace);
        $results = 'Results: ';
        foreach ($this->ridersInRace as $pos => $rider) {
            $results .= "\nPosicion: $pos " . $rider->__toString();
        }
        return $results;
    }

    public function __toString()
    {
        return $this->circuit->__toString() . ' date: ' . $this->date . '';
    }
}
