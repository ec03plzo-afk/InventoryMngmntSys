<?php
    $con = mysqli_connect('localhost','root','','kada');

    if(!$con){
        die('Connection Failed'.mysqli_connect_error());
    }
    
?>