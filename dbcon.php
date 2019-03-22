<?php

function DBcon () {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "blog";
    
    $link = mysqli_connect($host, $user, $pass, $db);
    
    if(!$link) {
        echo "Hiba a csatlakozásban!";
        exit;
    }
    
    return $link;
}