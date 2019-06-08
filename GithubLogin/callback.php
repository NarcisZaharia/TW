<?php

    $code = $_GET['code'];

    if ($code == "")
    {
        header("Location: http://localhost/GithubLogin/");
        exit;
    }

    else
    {
        define('URL', 'https://github.com/login/oauth/access_token');
        define('CLIENT_ID', '4a6e203eeaa65a09a3c0');
        define('CLIENT_SECRET', '714112ca093bf90b9a7c1ebc96b232474647ae0e');

        $postParams = ['client_id' => CLIENT_ID, 'client_secret' => CLIENT_SECRET, 'code' => $code];

        $c = curl_init ();
        curl_setopt($c, CURLOPT_URL, URL);              // stabilim URL-ul serviciului
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);  // rezultatul cererii va fi disponibil ca șir de caractere
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $postParams);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        $res = curl_exec ($c);
        curl_close ($c);
        $data = json_decode($res);
        if ($data->access_token != "")
        {
            session_start();
            $_SESSION['accessToken'] = $data->access_token;
            header('Location: http://localhost/GithubLogin/');
            exit;
//            echo $_SESSION['accessToken'];
        }
    }

?>
