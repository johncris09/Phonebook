<?php

    define('DB_SERVER', 'localhost');       //server name
    define('DB_USERNAME', 'root');          //username
    define('DB_PASSWORD', '');              //password
    define('DB_NAME', 'myphonebook');       //database
    
    /* Attempt to connect to MySQL database */
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>