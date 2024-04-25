<?php

include("./db/db_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // if password not null 
    if ((getPW($login, $conn) == $password) && $password != null) {
        $response = [
            'status' => 'success',
            'message' => 'Login successful'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Invalid login or password'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = [
        'status' => 'error',
        'message' => 'Invalid request method'
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}

function getPW($login, $conn){
    $query = "SELECT MDP FROM utilisateurs WHERE adresse_mail = :login";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $result = $stmt->fetch();

    if (isset($result['MDP'])) {
        return $result['MDP'];
    } else {
        return null; // or handle the case when 'MDP' doesn't exist
    }
}
?>
