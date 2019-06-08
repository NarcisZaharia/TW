<?php
    session_start();
    $code = $_GET['code'];
    $email = $_SESSION['email'];

    if ($code == "")
    {
        echo "<script type='text/javascript'>
            alert('Login didn\'t work!');
            window.location='MainPage/TeaSkMain.php';
            </script>";
    }
    else {
        define('URL', 'https://github.com/login/oauth/access_token');
        define('CLIENT_ID', '2bab198cc3ef8092fc31');
        define('CLIENT_SECRET', '0bf148757c876b2e081854ab8e673eac88c9b060');

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
            echo $email;
            echo $data->access_token;
            $_SESSION['accessToken'] = $data->access_token;
            $con = mysqli_connect('localhost' , 'root', '');
            mysqli_select_db($con , 'login');
            $sql = "UPDATE users set TokenGithub = '".$data->access_token."' where email = '".$email."'";
            if ($con->query($sql) !== TRUE)
                echo $con->error;
            echo "<script type='text/javascript'>
                alert('Ai fost logat cu github, tokenul este ". $data->access_token."');
                window.location='MainPage/TeaSkMain.php';
                </script>";
        }


    }

?>