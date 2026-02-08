<?php
class user {  
            //Prperties
            public $name;                
            public $email;
            public $password;


              public function __construct($name, $email, $password){  #function __construct output which you give in the register
                $this->name = $name;
                $this->email = $email;
                $this->password = $password;
                }

            public function displayInfo() {
                    echo "Name: " . $this->name . "<br>"; # $this > to specify any user or any class
                    echo "Email: " . $this->email . "<br>";  
                    echo "Password: " . $this->hashPassword($this->password) . "<br>";  #output : $2y$10$oyWZzg2jnHXAYZm2uY6mue5dQeHXT88x8Akuryu708n1FNN2QhGA
                }
                public function hashPassword($password) {               # to hashing the password
                   return password_hash($password, PASSWORD_DEFAULT);
                }    
        }


