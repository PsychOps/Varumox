<?php

require_once 'secret_config.php';

$db_conn = new mysqli($MySQLServerName, $MySQLUsername, $MySQLPassword);

if($db_conn->connect_error){
    die("Connection failed: " . $db_conn->connect_error);
}

mysqli_query($db_conn, "CREATE DATABASE IF NOT EXISTS " . $MySQLDatabase);

mysqli_select_db($db_conn, $MySQLDatabase);

mysqli_query($db_conn, "CREATE TABLE IF NOT EXISTS users (
                                     Id char(20) NOT NULL UNIQUE PRIMARY KEY,
                                     Username TEXT NOT NULL,
                                     Bio TEXT,
                                     Socials JSON
                                    );
");