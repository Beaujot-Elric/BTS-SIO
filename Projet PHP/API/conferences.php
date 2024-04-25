<?php

include("./db/db_connect.php");

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
        } else {
            getConferences();
        }
        break;
    case 'POST':
        inscriptAct();
        break;
}

function getConferences(){
    global $conn;
    $query = "SELECT * FROM activités";
    $response = array();

    $conn->query("SET NAMES utf8");
    $result = $conn->query($query);
    while($row = $result->fetch()){
        $response[] = $row;
    }

    $result->closeCursor();
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function inscriptAct(){
    global $conn;
    $id_user = $_POST["id_user"];
    $id_act = $_POST["id_act"];
    $query = "INSERT INTO rejoint VALUES ($id_user, $id_act)";
    $conn->query("SET NAMES utf8");

    if($conn->query($query)){
        $response = array('status' => 1, 'status_message' => 'Insertion reussis');     
    } else {
        $response = array('status' => 0, 'status_message' => 'Erreur d insertion');
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
}
