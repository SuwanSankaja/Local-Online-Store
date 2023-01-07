<?php

    $server_name="localhost";
    $user_name="root";
    $password="";
    $database="e_bussiness";

    $new_connection = new mysqli($server_name,$user_name,$password,$database);

    if($new_connection -> connect_error){
        die("Connection error\n");
    }
    else{
        //echo "Connection Ok\n";
    }



?>