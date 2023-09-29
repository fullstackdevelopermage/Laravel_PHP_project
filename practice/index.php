<?php
session_start();
?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<form action="" method="post">
Email : <input type="text" name="email" id="email">
password:<input type="password" id="password" name="password">
<button type="submit" id="login"> submit</button>

Your token is : <span id="token"></span>
<input type="text" name="token1" id="token1">
<button id="list"> Get List</button>
</form>
<?php
if(isset($_POST['email']) && $_POST['email']) {
    $url = "https://candidate-testing.api.royal-apps.io/api/v2/token";
 
    //initialize CURL
    $ch = curl_init();
   
    //setup json data and using json_encode() encode it into JSON string
    $data = array(
      'email' => $_POST['email'],
      'password' => $_POST['password'],
      );
    $new_data = json_encode($data);
    //options for curl
    $array_options = array(
       
      //set the url option
      CURLOPT_URL=>$url,
       
      //switches the request type from get to post
      CURLOPT_POST=>true,
       
      //attach the encoded string in the post field using CURLOPT_POSTFIELDS
      CURLOPT_POSTFIELDS=>$new_data,
       
      //setting curl option RETURNTRANSFER to true
      //so that it returns the response
      //instead of outputting it
      CURLOPT_RETURNTRANSFER=>true,
       
      //Using the CURLOPT_HTTPHEADER set the Content-Type to application/json
      CURLOPT_HTTPHEADER=>array('Content-Type:application/json')
    );
   
    //setting multiple options using curl_setopt_array
    curl_setopt_array($ch,$array_options);
   
    // using curl_exec() is used to execute the POST request
    $resp = curl_exec($ch);
   
      //decode the response
      $final_decoded_data = json_decode($resp);
     echo "<PRE>";
      print_r($final_decoded_data);

    echo "</PRE>";
    //close the cURL and load the page
    curl_close($ch);

    echo "<br>";
    echo "<br>";
    echo "<hr>";

    echo "<br>";
    echo "LIST OF AUTHORS : ";
    echo "<br>";
    echo "<form method='post'><input type='hidden' name='author'><input type='submit' value='GET authors'></form>";
    session_start();
    $_SESSION["token"] = $final_decoded_data->token_key;
} 
 if(isset($_POST['author'])) {
     echo "here".$_SESSION["token"];
//if(isset($final_decoded_data->token_key)) {
$url = "https://candidate-testing.api.royal-apps.io/api/v2/authors?orderBy=id&direction=ASC&limit=12&page=1
";


$cURLConnection = curl_init();

curl_setopt($cURLConnection, CURLOPT_URL, "https://candidate-testing.api.royal-apps.io/api/v2/authors?orderBy=id&direction=ASC&limit=12&page=1
");
curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
    'Content-Type : application/json',
    'Authorization : Bearer 5a2c3c1327eed4b1666f0eb034bf96adb054f0f0f212b27a0f4419421f24565fa011917d975abed5',
    'access-control-allow-credentials: true',
    'access-control-allow-headers: content-type,*', 
    'access-control-allow-origin: https://candidate-testing.api.royal-apps.io', 
    'api-current-version:  ',
    'api-last-version: v2', 
    'api-status: supported', 
    'api-sunset: 0', 
    'api-supported: 1', 
    'cache-control: no-cache,private', 
    'connection: keep-alive', 
    'content-type: application/json', 
    'date: Fri,29 Sep 2023 15:36:55 GMT', 
    'server: nginx/1.18.0 (Ubuntu)', 
    'transfer-encoding: chunked', 
    'vary: Accept-Language', 
));
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

curl_setopt($cURLConnection, CURLOPT_TIMEOUT, 180);
curl_setopt($cURLConnection, CURLOPT_CONNECTTIMEOUT, 60);
$phoneList = curl_exec($cURLConnection);
print_r($phoneList);
//curl_close($cURLConnection);

$jsonArrayResponse = json_decode($phoneList);
print_r($jsonArrayResponse);
}

  ?>