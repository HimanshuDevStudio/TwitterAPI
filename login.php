<?php
 session_start();
include('inc/twitteroauth.php');
$CONSUMER_KEY = "EdmjGXeIYhpyfbJpLY55lVB5E";
$CONSUMER_SECRET = "NpAnzDp3uRCuaw6iv8tsNR1CmVQG04Wqw1IdzncCcfaY1FchtN";
$OAUTH_CALLBACK='http://localhost/Sites/twitter/profile.php';
 
$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
$request_token = $connection->getRequestToken($OAUTH_CALLBACK); //get Request Token
 
$_SESSION['vtk'] = $request_token;

if($request_token)
{
    $token = $request_token['oauth_token'];
    $_SESSION['request_token'] = $token ;
    $_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
 
    switch ($connection->http_code) 
    {
        case 200:
            $url = $connection->getAuthorizeURL($token);
            //redirect to Twitter .
            header('Location: ' . $url); 
            break;
        default:
            echo "Conection with twitter Failed";
            break;
    }
 
}
else //error receiving request token
{
    echo "Error Receiving Request Token";
}





?>