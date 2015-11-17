<?php
require_once($_SERVER['DOCUMENT_ROOT']."/dbconnect.php"); 	 
          include($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
          $connection=mysql_connect ('localhost', $username, $password);
          $db_selected = mysql_select_db($database, $connection);
          $ff =mysql_query("SET NAMES utf8"); 
          
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $message = $_POST['message'];
    // Check if name has been entered
    if (!$_POST['name']) {
        $errName = "Введіть своє ім'я";
    }
    //Check if message has been entered
    if (!$_POST['message']) {
        $errMessage = 'Введіть повідомлення';
    }

    // If there are no errors, send the email
    if (!$errName && !$errMessage) {
        
        	$result = mysql_query ("INSERT INTO testimonials (comment,data,author) VALUES('".$_POST["message"]."',CURDATE(),'".$_POST['name']."');");  
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Відгуки</title>
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
                        <li class"active"><a href="/about.php">Про проект </a></li>
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
                        <div id="testimonial">
                            <h1>Залиште свій відгук</h1>
                            <?php if (!empty($message)) {echo "<p class=\"error\"> Дякуємо за відгук!</p>";} ?>
                             <form class="form-horizontal" role="form" method="post" action="/testimonials.php">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Ваше Ім'я</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Ім'я та прізвище" value="<?php echo htmlspecialchars($_POST['name']); ?>">
                                            <?php echo "<p class='text-danger'>$errName</p>";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="message" class="col-sm-2 control-label">Ваш відгук</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
                                            <?php echo "<p class='text-danger'>$errMessage</p>";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <input id="submit" name="submit" type="submit" value="Відправити" class="btn btn-default">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-10 col-sm-offset-2">
                                        </div>
                                    </div>
                                </form>
                     
         
                        </div>
                        <?php
                            $result = mysql_query("SELECT * FROM testimonials;"); 
                        if($result)
                        {
                            echo '<table>';
                            while ($myrow = mysql_fetch_array($result)){
                                $path = $myrow['comment'];
                                echo"
<tr><td><p><b>Додав: </b>".$myrow["author"]."</p>
<p><b>Дата додавання: </b>".$myrow["data"]."</p>".$path."<br></td></tr>";

                            }
                            echo '</table>';
                            mysql_free_result($result);
                        }
                        ?>
                    </div>


                </div>
            </div>
            </div>
        </div>



    </section>
<div><br><br><br></div>
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
