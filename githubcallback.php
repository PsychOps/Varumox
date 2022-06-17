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

$tempCode = $_REQUEST["code"];

// use key 'http' even if you send the request to https://...
$authResult = httpPost("https://github.com/login/oauth/access_token", array(
        'client_id' => $GithubClientId,
        'client_secret' => $GithubClientSecret,
        'code' => $tempCode)
);
//if ($authResult === FALSE) { /* Handle error */ }

preg_match('/access_token=(.+)&scope/', $authResult, $output_array);

$_SESSION["github_accesskey"] = $output_array[1];

$userData = httpGet("https://api.github.com/user", array(), array(
    "Accept: application/vnd.github.v3+json",
    "Authorization: token " . $_SESSION["github_accesskey"]
));

// SAVE TO DB HERE
// CHECK IF ACCOUNT EXISTS IF SO GO TO IT
// ELSE MAKE NEW ONE

// redirect to profile page
/*ob_start();
header('Location: '."profile.php");
ob_end_flush();
die();*/
