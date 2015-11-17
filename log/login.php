<?php
	session_start();
    ?>

    <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Вхід</title>
    <link href="/Content/bootstrap.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="/Content/style.css" />
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>
</head>
<body>
    <script src="/Scripts/jquery-2.1.4.js"></script>
    <script src="/Scripts/bootstrap.js"></script>

    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <a href="/">
                        <img src="/images/logo.png" alt="Logo" /></a>
                </div>
                <div class="col-md-4">
                    <ul class="nav nav-pills nav-pos">
                        <li><a href="/index.php">Головна</a></li>
                        <li><a href="/about.php">Про проект </a></li>
                        <li><a href="/team.php">Команда </a></li>
                    </ul>

                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">

                    <nav class="navmenu navmenu-default navmenu-fixed-left" role="navigation">
                        <ul class="nav navmenu-nav">
                            <li class="active"><?php
if(!isset($_SESSION['session_username'])){echo'<a href="/log/login.php">Увійти</a>';}else{ echo'<a href="/log/logout.php">Вийти</a>';}?></li>
                            <li><a href="/helpus.php">Чим ви можете допомогти проекту?</a></li>
                            <li><a href="/stats.php">Статистика</a></li>
                            <li><a href="/testimonials.php">Відгуки</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-8 col-md-pull-1">
                    <!--Контент блок-->
                    <div class="container-fluid">
                        <div id="login">
                            <h1>Вхід</h1>
                            <?php if (!empty($message)) {echo "<p class=\"error\">" . $message . "</p>";} ?>
                            <form action="" id="loginform" method="post" name="loginform">
                                <p>
                                    <label for="user_login">
                                        Логін<br>
                                        <input class="input" id="username" name="username" size="20"
                                            type="text" value=""></label>
                                </p>
                                <p>
                                    <label for="user_pass">
                                        Пароль<br>
                                        <input class="input" id="password" name="password" size="20"
                                            type="password" value=""></label>
                                </p>
                                <p class="submit">
                                    <input class="button" name="login" type="submit" value="Увійти">
                                </p>
                                <p class="regtext">Ще не зареєстровані?<a href="/log/register.php">Зареєструйтеся</a>!</p>
                            </form>
                         <?php require_once($_SERVER['DOCUMENT_ROOT']."/dbconnect.php"); 	 
          include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
          $connection=mysql_connect ('localhost', $username, $password);
          $db_selected = mysql_select_db($database, $connection);
          $ff =mysql_query("SET NAMES utf8"); 
          if(isset($_SESSION["session_username"])){
              header("Location: /index.php");
          }
            $userid=1;
          if(isset($_POST["login"])){

              if(!empty($_POST['username']) && !empty($_POST['password'])) {
                  $username=htmlspecialchars($_POST['username']);
                  $password=htmlspecialchars($_POST['password']);
                  $query =mysql_query("SELECT * FROM users WHERE login='".$username."' AND password='".md5($password)."'");
                  $numrows=mysql_num_rows($query);
                  if($numrows!=0)
                  {
                      while($row=mysql_fetch_assoc($query))
                      {
                          $dbusername=$row['username'];
                          $dbpassword=$row['password'];
                          $userid=$row['uid'];

                      }
                      if(strcmp(md5($password), $dbpassword)==0)
                      {
                          $_SESSION['session_username']=$username;	 
                           $_SESSION['session_userid']=$userid;
                          $message = "Ви успішно авторизувались!";
                          header("Location: /index.php");
                      }
                  } else {
                      echo  "Неправильне ім’я користувача або пароль";
                  }
              } else {
                  $message = "Обидва поля обов’язкові для заповнення!";
              }
          }
    //тут я пробую додати авторизацію через соцмережі
    $client_id = '867079114418-lae0cgdp2k7p4rhkk1472kli1gheqia5.apps.googleusercontent.com'; // Client ID
	$client_secret = 'JOum5F9MW1-UGKn91IbNtHZM'; // Client secret
	$redirect_uri = 'https://polmap-slabinoha.c9.io'; // Redirect URIs
	$url = 'https://accounts.google.com/o/oauth2/auth';
	$params = array(
	    'redirect_uri'  => $redirect_uri,
	    'response_type' => 'code',
	    'client_id'     => $client_id,
	    'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
	);

	//echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Ввійти через Google</a></p>';

	if (isset($_GET['code'])) {

	    $result = false;

	    $params = array(
        'client_id'     => $client_id,
	        'client_secret' => $client_secret,
	        'redirect_uri'  => $redirect_uri,
	        'grant_type'    => 'authorization_code',
	        'code'          => $_GET['code']
	    );
	 
	    $url = 'https://accounts.google.com/o/oauth2/token';
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_POST, 1);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	    $result = curl_exec($curl);
	    curl_close($curl);
	    $tokenInfo = json_decode($result, true);

	    if (isset($tokenInfo['access_token'])) {
	        $params['access_token'] = $tokenInfo['access_token'];
	        $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
	        if (isset($userInfo['id'])) {
	            $userInfo = $userInfo;
	            $result = true;
	            $_SESSION['session_username']=$userInfo['name'];	 
                $_SESSION['session_userid']=$userInfo['id'];
                $message = "Ви успішно авторизувались!";
                          header("Location: /index.php");
	        }
	    }
	}
    ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="navbar-fixed-bottom row-fluid">
            <div class="navbar-inner">
                <div class="container-fluid">

                    <h4>©ecomap 2015</h4>

                </div>
            </div>
        </div>
    </footer>
</body>
</html>


   