student_main.php

<?php

require_once 'student.php';


$student1 = new Student("Pancake", "1956-05-10");
$student1->setPwd("Jan");
echo "Het wachtwoord is: " . $student1->getPwd() . "<br>";
$student1->printName();
$student1->printAge();



$student2 = new Student("Waffle", "1958-02-01");
$student2->setPwd("wachtwoord123");
echo "Het wachtwoord is: " . $student2->getPwd(true) . "<br>";
$student2->printName();
$student2->printAge();


$student3 = new Student("Bernardo", "24-04-2008");
$student3->setPwd("supergeheim");
echo "Het wachtwoord is: " . $student3->getPwd() . "<br>";
$student3->printName();
$student3->printAge();

?>