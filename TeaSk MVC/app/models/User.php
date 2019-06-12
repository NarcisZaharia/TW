<?php


class User
{
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $imagename;
    private $image;
    private $TokenGithub;
    private $isAdmin;

    public function __construct($params){
        if (isset($params['email']))
            $this->email = $params['email'];
        if (isset($params['password']))
            $this->password = $params['password'];
        if (isset($params['firstname']))
            $this->firstname = $params['firstname'];
        if (isset($params['lastname']))
            $this->lastname = $params['lastname'];
        if (isset($params['isAdmin']))
            $this->isAdmin = $params['isAdmin'];
        if (isset($params['imagename']))
            $this->imagename = $params['imagename'];
        if (isset($params['image']))
            $this->image = $params['image'];
        if (isset($params['TokenGithub']))
            $this->TokenGithub = $params['TokenGithub'];
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setTokenGithub($token){
        $this->TokenGithub = $token;
    }
    public function getTokenGithub(){
        return $this->TokenGithub;
    }
    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }
    public function getFirstname() {
        return $this->firstname;
    }
    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }
    public function getLastname() {
        return $this->lastname;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getImage(){
        return $this->image;
    }
    public function setImage($image){
        $this->image = $image;
    }
    public function setImageName($imagename){
        $this->imagename = $imagename;
    }
    public function isUserAdmin(){
        return $this->isAdmin;
    }


    public function getTotalPoints()
    {
        $con = DataBase::getConection();
        if ($con->connect_error)
            die("Connection error: ".$con->connect_error);
        $stmt = $con->prepare("Select sum(points) from userpoints where email like ?");
        $stmt->bind_param("s", $this->email);
        $stmt->bind_result($totalPoints);
        $stmt->execute();
        $stmt->fetch();
        if ($totalPoints)
            return $totalPoints;
        else return 0;
    }

    public function getPoints($type)
    {
        $con = DataBase::getConection();
        if ($con->connect_error)
            die("Connection error: ".$con->connect_error);
        $stmt = $con->prepare("Select points from userpoints where email like ? and type like ?");
        $stmt->bind_param("ss", $this->email, $type);
        $stmt->bind_result($points);
        $stmt->execute();
        $stmt->fetch();
        if ($points)
            return $points;
        else return 0;
    }

    public function incrementPoints($type)
    {
        $con = DataBase::getConection();
        if ($con->connect_error)
            die("Connection error: ".$con->connect_error);
        $stmt = $con->prepare("Select points from userpoints where email like ? and type like ?");
        $stmt->bind_param("ss", $this->email, $type);
        $stmt->bind_result($points);
        $stmt->execute();
        if ($stmt->fetch())
        {
            $stmt->free_result();
            $stmt1 = $con->prepare("Update userpoints set points = ? where email like ? and type like ?");
            $points = $points+1;
            $stmt1->bind_param("iss", $points, $this->email, $type);
            $stmt1->execute();
        }
        else
        {
            $stmt1 = $con->prepare("Insert into userpoints (email, type, points) values(?, ?, ?)");
            $points = 1;
            $stmt1->bind_param("ssi", $this->email, $type, $points);
            $stmt1->execute();
        }
    }
    public function decrementPoints($type){
        $con = DataBase::getConection();
        if ($con->connect_error)
            die("Connection error: ".$con->connect_error);
        $stmt = $con->prepare("Select points from userpoints where email like ? and type like ?");
        $stmt->bind_param("ss", $this->email, $type);
        $stmt->bind_result($points);
        $stmt->execute();
        if ($stmt->fetch())
        {
            if ($points != 0) {
                $stmt1 = $con->prepare("Update userpoints set points = ? where email like ? and type like ?");
                $points = $points + 1;
                $stmt1->bind_param("iss", $points, $this->email, $type);
                $stmt1->execute();
            }
        }
    }

    public function updateDatabase()
    {
        $con = DataBase::getConection();
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        $stmt = $con->prepare("Update users set password = ?, imagename = ?, image = ?, TokenGithub = ? where email like ? limit 1");
        $stmt->bind_param("sssss", $this->password, $this->imagename, $this->image, $this->TokenGithub, $this->email);
        $stmt->execute();
    }

    public function getGithubHref() {
        $URL = 'https://api.github.com/user';

        $authToken = 'Authorization: token '.$this->TokenGithub;
        $userAgent = 'User-Agent: TeaSk';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $URL);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
        $res = curl_exec ($c);
        curl_close ($c);
        $github_data = json_decode($res);

        return $github_data->html_url;
    }

    public function getGithubLogin() {
        $URL = 'https://api.github.com/user';

        $authToken = 'Authorization: token '.$this->TokenGithub;
        $userAgent = 'User-Agent: TeaSk';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $URL);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
        $res = curl_exec ($c);
        curl_close ($c);
        $github_data = json_decode($res);

        return $github_data->login;
    }

    public function getGithubFollowing()
    {
        $URL = 'https://api.github.com/user';

        $authToken = 'Authorization: token '.$this->TokenGithub;
        $userAgent = 'User-Agent: TeaSk';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $URL);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
        $res = curl_exec ($c);
        curl_close ($c);
        $github_data = json_decode($res);

        $following_url = explode('{', $github_data->following_url);
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $following_url[0]);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
        $res = curl_exec ($c);
        curl_close ($c);
        $following_data = json_decode($res);
        $following = [];
        foreach ($following_data as $followin)
        {
            $following[$followin->login] = $followin->html_url;
        }
        return $following;
    }

    public function getGithubFollowers()
    {
        $URL = 'https://api.github.com/user';

        $authToken = 'Authorization: token '.$this->TokenGithub;
        $userAgent = 'User-Agent: TeaSk';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $URL);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
        $res = curl_exec ($c);
        curl_close ($c);
        $github_data = json_decode($res);

        $following_url = explode('{', $github_data->followers_url);
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $following_url[0]);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
        $res = curl_exec ($c);
        curl_close ($c);
        $followers_data = json_decode($res);
        $followers = [];
        foreach ($followers_data as $follower)
        {
            $followers[$follower->login] = $follower->html_url;
        }
        return $followers;
    }

    public function getGithubLanguages()
    {
        $languages = [];
        $URL = 'https://api.github.com/user';

        $authToken = 'Authorization: token '.$this->TokenGithub;
        $userAgent = 'User-Agent: TeaSk';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $URL);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
        $res = curl_exec ($c);
        curl_close ($c);
        $github_data = json_decode($res);

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $github_data->repos_url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
        $res = curl_exec ($c);
        curl_close ($c);
        $repos_data = json_decode($res);

        foreach ($repos_data as $repo)
        {
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $repo->languages_url);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
            $res = curl_exec ($c);
            curl_close ($c);
            $languages_data = json_decode($res);

            foreach ($languages_data as $lang_name => $lang_value)
            {
                if (isset($languages[$lang_name]))
                    $languages[$lang_name] += $lang_value;
                else $languages[$lang_name] = $lang_value;
            }
        }
        return $languages;
    }

    public function getGithubImage()
    {
        $URL = 'https://api.github.com/user';

        $authToken = 'Authorization: token '.$this->TokenGithub;
        $userAgent = 'User-Agent: TeaSk';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $URL);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
        $res = curl_exec ($c);
        curl_close ($c);
        $github_data = json_decode($res);

        return $github_data->avatar_url;
    }

    public function insertInDatabase()
    {
        $con = DataBase::getConection();
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        $stmt = $con->prepare("Insert into `users`(firstname, lastname, email, password) values(?, ?, ?, ?)");
        $stmt->bind_param("ssss", $this->firstname, $this->lastname, $this->email, $this->password);
        $stmt->execute();
        printf("%d Row inserted.\n", $stmt->affected_rows);
        echo $stmt->error;
        $stmt->close();
        $con->close();
    }

    public function updateUsertests($question)
    {
        $con = DataBase::getConection();
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        $stmt = $con->prepare("Insert into userstests (email, question) values(?, ?)");
        $stmt->bind_param("ss", $this->email, $question);
        $stmt->execute();
    }
}