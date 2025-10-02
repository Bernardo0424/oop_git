<?php

class student{

    //properties
    public $name;
    private $pwd;

    //methodes

    public function __construct($naam){
        echo "nieuw object aangemaakt <br>";
        $this->name = $naam;
    }
    public function printName(){
echo "mijn naam is: " . $this->name . "<br>";
    }

    public function setPwd($password){
        $this->pwd = $password;
    }

    public function getPwd(){
        return $this->pwd;
    }
}

    
    //main


$student1 = new student("pietje");
//$student1->name = "pietje";
$student1->setPwd = ("geheim");
//var_dump($student1); 
//echo "mijn naam is: " . $student1->name . "<br>";
$student1->printName();
echo "mijn password is;" . $student1->getPwd();  "<br>";

$student2 = new student("jansen");
//$student2->name = "jansen";
//var_dump($student2); 
//echo "mijn naam is: " . $student2->name . "<br>";
$student2->printName();


$student3 = new student("Bernardo");
//$student3->name ="Bernardo";
$student3->printName();
?>