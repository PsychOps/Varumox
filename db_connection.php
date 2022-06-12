<?php

$servername = "localhost";
$username = "test_user";
$password = "test_password";

$db_conn = new mysqli($servername, $username, $password);

if($db_conn->connect_error){
    die("Connection failed: " . $db_conn->connect_error);
}

