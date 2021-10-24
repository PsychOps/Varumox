<!--Don't edit this file-->
 <?php
 $code = $_GET['code'];

 if ($code == "") {
     header('Location: http://varumox.tk');
     exit;
 }
 $CLIENT_ID = "ebdf3797bfd3bae04bda";
 $CLIENT_SECRET = "https://www.google.com/search?q=d080c8362d7c587d82b9e5c05bf48bba61798b79&oq=d080c8362d7c587d82b9e5c05bf48bba61798b79&aqs=chrome..69i57.424j0j1&sourceid=chrome&ie=UTF-8"
 $URL = "https://github.com/login/oauth/access_token";

 $postParams = [
     'client_id' => $CLIENT_ID,
     'client_secret' => $CLIENT_SECRET
     'code' => $code
 ];

 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $URL);
 curl_setopt($ch, CURLOPT_POST, $1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLPOT_HTTPHEADER,array ('Accept: application/json'));
 $response = curl_exec($ch);
 curl_close($ch);
 $data = json_decode($response);

 if ($data->access_token != "") {
     session_start();
     $_SESSION['my_access_token_accessToken'] = $data->access_token;

     header('Location: http://varumox.tk');
     exit;
 }

 var_dump($data);

 echo $data->error_description;

 var_dump($response);

 var_dump($data);

 echo '<br/>';
 ?>