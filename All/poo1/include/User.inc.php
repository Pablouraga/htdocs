<?php
//clase User con las siguientes propiedades:
//id, name, surname1, surname2, email, birthday y phone.
class User
{
    private $id;
    private $name;
    private $surname1;
    private $surname2;
    private $email;
    private $birthday;
    private $phone;

    public function __construct($id, $email, $name = '', $surname1 = '', $surname2, $birthday = '01/01/1970', $phone = '666666666')
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->surname1 = $surname1;
        $this->surname2 = $surname2;
        $this->birthday = $birthday;
        $this->phone = $phone;
    }

    // - Los getters y los setters.
    public function __set($property, $value)
    {
        if (isset($this->$property)) {
            $this->$property = $value;
        }
    }

    public function __get($property)
    {
        if (isset($this->$property)) {
            return $this->$property;
        }
    }

    public function __toString(): String
    {
        return '<article class="user"><h1>' . $this->name . ' ' . $this->surname1 . ' ' . $this->surname2 . ' (' . $this->id . ')</h1>
        <div>' . $this->calcAge($this->birthday) . ' años - ' . $this->betterBirthday($this->birthday) . '<br>Email: <a href="mailto:#">' . $this->email . '</a><br>Telefono: ' . $this->phone . '</div></article>';
    }

    private function calcAge($birthday)
    {
        $now = new DateTime();
        $birthday = new DateTime();
        $birthday->setTimestamp($this->birthday);
        return $now->diff($birthday)->y;
    }

    private function betterBirthday($birthday)
    {
        $meses = array(
            1 => "enero", 2 => "febrero", 3 => "marzo", 4 => "abril",
            5 => "mayo", 6 => "junio", 7 => "julio", 8 => "agosto",
            9 => "septiembre", 10 => "octubre", 11 => "noviembre", 12 => "diciembre"
        );
        $day = date("j", $this->birthday);
        $month = $meses[date("n", $this->birthday)];
        $year = date("Y", $this->birthday);
        return $day . ' de ' . $month . ' de ' . $year;
    }
}
