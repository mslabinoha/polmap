<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Статистика</title>
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
                    <a href="/"> <img src="/images/logo.png" alt="Logo" /></a>
                </div>
                <div class="col-md-4">
                    <ul class="nav nav-pills nav-pos">
                        <li><a href="/index.php">Головна</a></li>
                        <li><a href="/about.php">Про проект</a></li>
                        <li><a href="/team.php">Команда</a></li>
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
                            <li class"active"><a href="/stats.php">Статистика</a></li>
                            <li><a href="/testimonials.php">Відгуки</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-6 col-md-pull-1"> <!--Контент блок-->
                    <div class="container-fluid">
                        <h2>Статистика</h2>
                        <?php
include ($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
// Opens a connection to a MySQL server
$connection=mysql_connect ('localhost', $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}
// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}
$ff =mysql_query("SET NAMES utf8"); 
$result = mysql_query("SELECT * FROM users;");
$num_rows = mysql_num_rows($result);
echo 'Зареєстровано користувачів: <b>'.$num_rows.'</b><br>';

$result = mysql_query("SELECT * FROM smitnyk;");
$num_rows = mysql_num_rows($result);
echo 'Додано смітників: <b>'.$num_rows.'</b><br>';

$result = mysql_query("SELECT * FROM smimages;");
$num_rows = mysql_num_rows($result);
echo ' &emsp; а також до них: <br>  &emsp;  <b>'.$num_rows.'</b> фотографій<br>';
$result = mysql_query("SELECT * FROM smcomments;");
$num_rows = mysql_num_rows($result);
echo '    &emsp;  та <b>'.$num_rows.'</b> коментарів<br>';
$result = mysql_query("SELECT * FROM wooddump;");
$num_rows = mysql_num_rows($result);
echo 'Додано пунктів навантаження лісу: <b>'.$num_rows.'</b><br>';
$result = mysql_query("SELECT * FROM wdimages;");
$num_rows = mysql_num_rows($result);
echo ' &emsp; а також до них: <br>  &emsp;  <b>'.$num_rows.'</b> фотографій<br>';
$result = mysql_query("SELECT * FROM wdcomments;");
$num_rows = mysql_num_rows($result);
echo '   &emsp;  та <b>'.$num_rows.'</b> коментарів<br>';
$result = mysql_query("SELECT * FROM routes;");
$num_rows = mysql_num_rows($result);
echo 'Додано ділянок маршрутів: <b>'.$num_rows.'</b><br>';

$result = mysql_query("SELECT * FROM routest;");
$num_rows = mysql_num_rows($result);
echo ' &emsp; а також до них: <br>  &emsp;  <b>'.$num_rows.'</b> уточнень інформації<br>';
$result = mysql_query("SELECT * FROM vrb;");
$num_rows = mysql_num_rows($result);
echo 'Додано вирубок: <b>'.$num_rows.'</b><br>';
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
