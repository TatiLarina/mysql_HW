<?php
    $connection = mysqli_connect('localhost', 'root', '', 'my_database');

    if (!$connection) {
        die('Connection failed');
    } 

?>