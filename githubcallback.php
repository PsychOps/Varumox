<?php
session_start();

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
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0");
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

$GithubClientSecret = "dae4b4a22c4eba90a2c8b3158e101edd43e92bc3";
$GithubClientId = "0bea0b16ef7a5564ae58"; // These need to be correct as well

$tempCode = $_REQUEST["code"];

// use key 'http' even if you send the request to https://...
$authResult = httpPost("https://github.com/login/oauth/access_token", array(
        'client_id' => $GithubClientId,
        'client_secret' => $GithubClientSecret,
        'code' => $tempCode)
);
//if ($authResult === FALSE) { /* Handle error */ }

preg_match('/access_token=(.+)&scope/', $authResult, $output_array);

$accessKey = $output_array[1];

$userData = httpGet("https://api.github.com/user", array(), array(
    "Authorization", "token " . $accessKey
));

var_dump($userData);
?>