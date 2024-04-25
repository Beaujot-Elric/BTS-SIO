<?php
    $serveurName = 'localhost';
    $username = 'root';
    $password = '';
    $conn = new PDO("mysql:host=$serveurName;dbname=gsb", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>