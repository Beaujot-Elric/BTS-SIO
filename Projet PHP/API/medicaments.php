<?php

include("./db/db_connect.php");

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            getMedicament($id);
            effetT($id);
            effetS($id);
            incompatible($id);
        } else {
            getMedicaments();
        }
        break;
}

function getMedicaments(){
    global $conn;
    $query = "SELECT * FROM medicaments";
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

function getMedicament($id){
    global $conn;
    $query = "SELECT id, description FROM medicaments";
    if($id != 0){
        $query .= " WHERE id =" . $id . " LIMIT 1";
    }

    $conn->query("SET NAMES utf8");
    $result = $conn->query($query);
    $response = array(); // Initialisation de $response

    while($row = $result->fetch()){
        $response[] = $row;
    }

    $result->closeCursor();
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function effetT($id){
    global $conn;
    $query = "SELECT effets_thérapeutiques.id, Descriptif as description FROM effets_thérapeutiques 
            JOIN comporte ON effets_thérapeutiques.id = comporte.idC 
            JOIN Medicaments ON comporte.id_medocT = Medicaments.id 
            WHERE Medicaments.id =" . $id;
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

function effetS($id){
    global $conn;
    $query = "SELECT effets_secondaires.id, Descriptif as description FROM effets_secondaires 
            JOIN contient ON effets_secondaires.id = contient.id 
            JOIN Medicaments ON contient.id_medocC = Medicaments.id 
            WHERE Medicaments.id =" . $id;
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

function incompatible($id){
    global $conn;
    $query = "SELECT medicaments.id, medicaments.nom as description FROM medicaments 
            JOIN incompatibilité ON medicaments.id = incompatibilité.id
            WHERE incompatibilité.id_1 =" . $id;
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
?>