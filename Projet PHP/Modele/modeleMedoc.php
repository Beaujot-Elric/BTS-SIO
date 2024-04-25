<?php

function checkLogin($login, $password)
{
    $url = "http://localhost/phpgroupe/api/check_login";
    $data = array('login' => $login, 'password' => $password);
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);
    if ($response['status'] == 'success') {
        return true;
    } else {
        return false;
    }
}

?>