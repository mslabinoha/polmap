
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Реєстрація</title>
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
                            <li><?php
session_start();
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
                       <?php
	include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
	$connection=mysql_connect ('localhost', $username, $password);
	$db_selected = mysql_select_db($database, $connection);
	$ff =mysql_query("SET NAMES utf8"); 
	if(isset($_POST["register"])){
	if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
	    if (strcmp($_POST['password'],$_POST['password_conf'])==0){
  $full_name= htmlspecialchars($_POST['full_name']);
	$email=htmlspecialchars($_POST['email']);
 $username=htmlspecialchars($_POST['username']);
 $password=htmlspecialchars($_POST['password']);
 $query=mysql_query("SELECT * FROM users WHERE login='".$username."';");
if(mysql_num_rows($query)==0)
   {
	 $result=mysql_query("INSERT INTO users (login, password, fullname, email, permissions) VALUES ('".$username."', '".md5($password)."', '".$full_name."', '".$email."', 0);");
 if($result){
	$message = "Аккаунт успішно створено. Ви можете <a href= '/log/login.php'>увійти</a>.";
} else {
 $message = "Помилка запису до бази даних";
  }
	} else {
	$message = "Користувач з таким логіном вже зареєстрований";
   }
	        
	    }
	else {$message="Пароль та його підтвердження не співпадають";
	}
	} else {
	$message = "Всі поля обов’язкові для заповнення";
	}
	} else{ echo '
	

<div id="login">
 <h1>Реєстрація</h1>
<form action="/log/register.php" id="registerform" method="post"name="registerform">
   
   
 <p><label for="user_login">Ваше ім’я<br>
 <input class="input" id="full_name" name="full_name"size="32"  type="text" value=""></label></p>
<p><label for="user_pass">Ваш E-mail<br>
<input class="input" id="email" name="email" size="32"type="email" value=""></label></p>
<p><label for="user_pass">Ваш логін<br>
<input class="input" id="username" name="username"size="20" type="text" value=""></label></p>
<p><label for="user_pass">Пароль<br>
<input class="input" id="password" name="password"size="32"   type="password" value=""></label></p>
<p><label for="pass_confirm">Підтвердження паролю<br>
<input class="input" id="password_conf" name="password_conf" size="32"   type="password" value=""></label></p>
<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Зареєструватися"></p>
	  <p class="regtext">Уже зареєстровані? <a href= "/log/login.php">Введіть ім’я користувача</a>!</p>
 </form>
</div>
';}?>
 <?php if (!empty($message)) {echo "<p class=\"error\">" . $message . "</p>";} ?>
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
