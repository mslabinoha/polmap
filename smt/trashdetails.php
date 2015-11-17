<?php
	session_start();
    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Детальніше про смітник</title>
    <link href="/Content/bootstrap.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="/Content/style.css" />
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
                 <?php
 require($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
                                $smid=$_GET['tid'];
                                $connection=mysql_connect ('localhost', $username, $password);
                                if (!$connection) {
                                die('Not connected : ' . mysql_error());
                                }

                                // Set the active MySQL database
                                $db_selected = mysql_select_db($database, $connection);
                                if (!$db_selected) {
                                die ('Can\'t use db : ' . mysql_error());
                                }
                                $ff =mysql_query("SET NAMES utf8;"); 
?>
                               
                <div class="col-md-8 col-md-pull-2">
                    <!--Контент блок-->
                    <div class="container-fluid">
                        <!--Tab list-->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#info" role="tab" data-toggle="tab">Інформація про смітник</a></li>
                            <li><a href="#update" role="tab" data-toggle="tab">Оновити інформацію</a></li>
                            <li><a href="#foto" role="tab" data-toggle="tab">Фотографії</a></li>
                            <li><a href="#comment" role="tab" data-toggle="tab">Коментарі</a></li>
                        </ul>

                        <!--Tab content-->
                        <div class="tab-content">
                            <div class="active tab-pane fade in" id="info">
                                
                                <?php 
                            
                                $query = "SELECT * FROM smitnyk INNER JOIN users ON smitnyk.authorid=users.uid WHERE id=".$smid.";";
                                $result = mysql_query($query);
                                
                                if (!$result) {
                                die('Invalid query: ' . mysql_error());
                                }
                            
                                while ($row = @mysql_fetch_assoc($result)){

                                echo '<b>Додав користувач з ніком </b>' . $row['login'] . ' <br> ';
                                echo '<b>Координати: широта </b> - ' . $row['lat'];
                                echo ', <b>довгота </b>- ' . $row['lng'] . '<br> ' ;
                                echo '<b>Розміри: ширина: </b>' . $row['width'] . '';
                                echo 'м, <b>довжина</b>: ' . $row['length'] . ' ';
                                echo 'м, <b>глибина/висота:</b> ' . $row['depth'] . ' м<br>';
                                $trashtype=$row['trashtype'];
                                $trashcontent="<b>Склад сміття:</b> <br>";
                                if(($trashtype%200000)>=100000){$trashcontent=$trashcontent."органіка <br>";}
                                if(($trashtype%20000)>=10000){$trashcontent=$trashcontent."пластик <br>";}
                                if(($trashtype%2000)>=1000){$trashcontent=$trashcontent."скло <br>";}
                                if(($trashtype%200)>=100){$trashcontent=$trashcontent."метал <br>";}
                                if(($trashtype%20)>=10){$trashcontent=$trashcontent."папір <br>";}
                                if(($trashtype%2)>=1){$trashcontent=$trashcontent."поліетилен <br>";}
                                echo $trashcontent;
                                echo "<b>Коментар від автора: </b>".$row['comment'].'<br>';
                                $approved=$row['approved'];
                                if ($approved>=2){echo '<b>Статус: </b>підтверджений';} else if ($approved<0){echo '<b>Статус: </b>Очищений/Ліквідований';}else{ echo '<b>Статус: </b>непідтверджений';}
                                    }
                                    ?>
                                   
                                   
                                 

</div>
                            <div class="tab-pane fade" id="update">
                                Будь ласка, надавайте перевірену інформацію, підтверджену фотографіями та коментарями на рахунок. Пам’ятайте, ми віримо в вашу компетентність та добросовісність :) <br>
                                <form action="/smt/processor.php" method="post" name="infoupdate" enctype="multipart/form-data">
                                    Виберіть один із варіантів, якщо ви володієте актуальною інформацією: <br>
                                    <input type="radio" name="app" value="1">Смітник в даному місці існує<br>
                                    <input type="radio" name="app" value="2">Смітника у вказаному місці немає<br>
                                    <input type="radio" name="app" value="3">Смітник в даному місці було ліквідовано/прибрано<br>
                                    <b>Додайте фотографію</b><br><input type="FILE" name="imgupload"><br>
                                    <input type="hidden" name="tid" value="<?php echo $smid;?>">
                                    <input type="hidden" name="approved" value="<?php echo $approved;?>">
                                    <b>Коментар: </b><br><textarea rows="4" cols="50" id="commenta" name="commenta"></textarea><br>
                                    <input type=submit value="Додати дані">
                                </form>
                            </div>
                            <div class="tab-pane fade" id="foto">                                
                                <?php
                                $result = mysql_query("SELECT * FROM smimages INNER JOIN users ON smimages.authid=users.uid where smitnid=".$smid.";");
                                if($result)
                                {
                                while ($myrow = mysql_fetch_array($result)){
                                $path = $myrow['path'];
                                echo"
                                <p><b>Додав: </b>".$myrow["login"]."</p>
                                <p><b>Дата додавання: </b>".$myrow["data"]."</p>
                                <img src='".$path."'><br>";
                                }
                                mysql_free_result($result);
                                }
                                ?>                                
                            </div>
                            <div class="tab-pane fade" id="comment">                               
                                <?php
                                $result = mysql_query("SELECT * FROM smcomments INNER JOIN users ON smcomments.authid=users.uid where smitnid=".$smid.";");
                                if($result)
                                {
                                while ($myrow = mysql_fetch_array($result)){
                                $path = $myrow['ctext'];
                                echo"
                                <p><b>Додав: </b>".$myrow["login"]."</p>
                                <p><b>Дата додавання: </b>".$myrow["data"]."</p>".$path."<br>";
                                }
                                mysql_free_result($result);
                                }
                                ?>
                            </div>
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