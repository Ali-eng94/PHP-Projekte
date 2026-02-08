<?php
    require "User.php";
    $newUser = new User(); 
    
    
    $newUser->name = "ALi Haji";
    $newUser->email = "alihaci55553@gmail.com";
    $newUser->password = "12345678910";

        $newUser->displayInfo();   #output:     Name: ALi Haji
                                               #Email: alihaci55553@gmail.com
                                               #Password: 12345678910       

 