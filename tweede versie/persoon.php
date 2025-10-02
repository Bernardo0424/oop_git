persoon.php
<?php


class Persoon {
    public  $name;
    public  $bsn;
    protected  $gebdat; 


    public function __construct($naam, $geboortedatum) {
        echo "Een nieuw student object is aangemaakt! <br><br>";
        $this->name = $naam;
        $this->gebdat = $geboortedatum; 
    }

    public function printName() {
        echo "persoon; Mijn naam is: " . $this->name . "<br>";
    }
public function bepaalLeeftijd() {

    $geboorte = new DateTime($this->gebdat);
    $vandaag = new DateTime();

   
    $leeftijd = $geboorte->diff($vandaag)->y;

    return $leeftijd;


    }

    public function printAge() {
        echo "Mijn leeftijd is: " . $this->bepaalLeeftijd() . "<br><br>";
    }
    
}



?>