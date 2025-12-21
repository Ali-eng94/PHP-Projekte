<?php

$fname = "ALi";
$sname = "Haji";
$fullname = $fname . " " . $sname; //Distance via ponit 
$fullname = "$fname  $sname"; //Distance via a text Variable
$age = 24; //intger variable
$gpa = 3.9; // Float variable
$isplaying = true; //Boolean Variable

$age = $age +10; //($age += 10) this is also true, it gives you the same output

echo "Hello $fullname, in 10 years you will be $age <br>";

// if($isplaying) {
//     echo "Hello $fullname, in 10 years you will be $age";
// } else {
//     echo "You are not playing"
// }

$age = 15;
// echo $age; //it will give the output of line 21 and forget the rest of the variables 


if ($age >= 21) {
    echo "You can drive, and you can drink";
}elseif ($age >= 18) {
    echo "You can drive";
} else {
    echo "you are underage <br>";
}

for ($i = 1; $i<=10; $i++) {
    echo $i . "<br>"; // <br> So that each number is on each line
}


$x = 0;
while ($x < 5){
    echo $x ;
    $x++;
}



$colors = ["red" , "green" , "bule"];
// echo $colors;          you can't print like this
// print_r($colors);      with this proprty, we programmers can see it 
// echo $colors[1];       this way we can print it, but with a object number

for ($i = 0; $i <= count($colors); $i++) {
    echo $colors[$i] . "<br>"; // or this way 
}

foreach($colors as $color){
    echo $color ."<br>"; // or this way 
}

function sayHi(){
    echo "Hello Ali!  <br>";
}

sayHi(); // Call Function

function addten($n){
    return $n + 10;
}

$ans = addten(20);
echo "<br> The answer is $ans <br>";



$color = "blue";

switch($color){
    case "blue":
        echo "The color is blue";
        break;
    case "black":
        echo "The color is black";
        break;
    case "red":
        echo " The color is red";
        break;
    default:
        echo "I don't know this color";
        break;
}