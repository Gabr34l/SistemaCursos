<?php
    $user = "root";
    $password = "jesuscristo";
    $database = "web1";  
    $host = "localhost";  

    
    $db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


?>
