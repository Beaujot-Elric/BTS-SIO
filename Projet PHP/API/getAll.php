<?php

$url = "http://127.0.0.1/API/medicaments.php";
    $options = array('http' => array('header' => "Content-Type: application/x-www-form-urlencoded\r\n", 'method' => 'GET'));

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    $string = substr($result, 1);

    $string_decode=json_decode($string, true);
    echo "<ul>";
    for($i = 0; $i < count($string_decode); $i++){
        echo "<li>".$string_decode[$i]["nom"]."</li>";
    }
    echo "</ul>";

?>