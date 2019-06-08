<?php
    session_start();
    $accessToken = $_SESSION['accessToken'];
    header('Content-type: text/javascript');
?>

<?php

    if ($accessToken != "")
    {
        header('Content-type: text/javascript');
//        echo '<p><code>'.$accessToken.'</code></p>';

        $URL = 'https://api.github.com/user';

        $authToken = 'Authorization: token '.$accessToken;
        $userAgent = 'User-Agent: Demo';

        $c = curl_init ();
        curl_setopt($c, CURLOPT_URL, $URL);              // stabilim URL-ul serviciului
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);  // rezultatul cererii va fi disponibil ca șir de caractere
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
        $res = curl_exec ($c);
        curl_close ($c);
        $data = json_decode($res);

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $data->repos_url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);  // rezultatul cererii va fi disponibil ca șir de caractere
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
        $res = curl_exec ($c);
        curl_close ($c);
        $data = json_decode($res);

        foreach ($data as $repo)
        {
            echo "Repository: \n";
            var_dump($repo);
            $commit_url = explode('{',$repo->commits_url);
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $commit_url[0]);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);  // rezultatul cererii va fi disponibil ca șir de caractere
            curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
            $res = curl_exec ($c);
            curl_close ($c);
            $data1 = json_decode($res);
            var_dump($data1);
        }

//        var_dump($data);


    }
    else
    {
        echo '<p><a href="https://github.com/login/oauth/authorize?client_id=4a6e203eeaa65a09a3c0&scope=repo">Login with github</a> </p>';
    }



?>