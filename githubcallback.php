<?php
session_start();
include 'db_connection.php';
require_once 'secret_config.php';

function httpPost($url, $data, $headers = array())
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0");
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function httpGet($url, $data, $headers = array())
{
    $curl = curl_init($url);
    //curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0");
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function generateId(){
    $min = 10000;
    $max = 99999;
    return strval(rand($min, $max)) . strval(rand($min, $max)) . strval(rand($min, $max)) . strval(rand($min, $max));
}

$tempCode = $_REQUEST["code"];

// use key 'http' even if you send the request to https://...
$authResult = httpPost("https://github.com/login/oauth/access_token", array(
        'client_id' => $GithubClientId,
        'client_secret' => $GithubClientSecret,
        'code' => $tempCode)
);

preg_match('/access_token=(.+)&scope/', $authResult, $output_array);

$githubAccesskey = $output_array[1];

$userData = json_decode(httpGet("https://api.github.com/user", array(), array(
    "Accept: application/vnd.github.v3+json",
    "Authorization: token " . $_SESSION[$githubAccesskey]
)));

if(strval($userData->id) == ""){
    echo "This isn't supposed to happen, <a href='/'>begone</a>!";
    echo "On a sidenote, for some reason, we didn't get your Github Id.";
    die();
}

$generatedId = generateId();

$userStmt = $db_conn->prepare("INSERT IGNORE INTO users (Id, Username, GithubId) VALUES (?, ?, ?);");
$userStmt->bind_param("sss", $generatedId, $userData->name, strval($userData->id));
$userStmt->execute();
$userStmt->close();

// GET THE USER, IT SHOULD EXIST NOW!
// THEN SAVE THE ID IN THE SESSION VARIABLES
// THEN DO THE NEXT REDIRECT THING

// redirect to profile page
/*ob_start();
header('Location: '."profile.php");
ob_end_flush();
die();*/
