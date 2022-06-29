<?php
session_start();
include "db_connection.php";

$newUsername = $_POST["Username"];
$newBio = $_POST["Bio"];
$newSocials = json_encode([["Twitter", $_POST["SocialsTwitter"]], ["Discord", $_POST["SocialsDiscord"]]]);

$stmt = $db_conn->prepare("UPDATE users SET Username = ?, Bio = ?, Socials = ? WHERE Id = " . $_SESSION["userId"]);
$stmt->bind_param("sss", $newUsername, $newBio, $newSocials);
$stmt->execute();
$stmt->close();

// Redirect to profile.php
ob_start();
header('Location: '."profile.php");
ob_end_flush();
die();