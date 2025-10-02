student.php
<?php
include 'persoon.php';

class Student extends Persoon {

    private $pwd;

    public function __construct($naam, $geboortedatum) {
        echo "Een nieuw student object is aangemaakt! <br><br>";
        $this->name = $naam;
        $this->gebdat = $geboortedatum; 
    }




    public function setPwd($password) {
        $this->pwd = $password;
    }

   
    public function getPwd($toon = false) {
        if ($toon === true) {
            return $this->pwd;
        } else {
            return "Wachtwoord verborgen.";
        }
    }
}



?>