<?php

$student2 = ['Ali Haji', 31, 3.4, true];

echo "The student is " . $student2[0] . " and his GPA is " . $student2[2];


$courses = ['Web Dev', "Database", "logic Design"];
$student = ["name" => "ALi Haji", "age" => 31, "gba" => 3.4, "isRegistered" => true, "registeredCourses" => $courses];

echo "<hr>";

echo "The student is " . $student['name'] . " and his gba is " . $student['gba'];

echo "<br>";

foreach($student['registeredCourses'] as $course){
    echo $course . "<br>";
}

echo "<hr>";

//Associative Array

$student1 = [
    "name" => "ALi Haji",
    "age" => 31, "gba" => 3.4,
    "isRegistered" => true,
    "registeredCourses" => [
        ["name" => "Web dev ", "Instructor" => "Dennis"],
        ["name" => "Introduction To Porgramming", "Instructor" => "Christean"]
    ] ];

    $studentCourses = $student1['registeredCourses'];
    foreach($studentCourses as $course){
    echo $course['Instructor'] . "<br>";
}