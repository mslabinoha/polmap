<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Детальніше про ділянку маршруту</title>
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
                        <li><a href="/about.php">Про проект </a></li>
                        <li><a href="/team.php">Команда </a></li>
                    </ul>

                </div>
            </div>
        </div>
    </header>
<?php
 require($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");
                                $rid=$_GET['rid'];
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
?>
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
                <div class="col-md-8 col-md-pull-2">
                    <!--Контент блок-->
                    <div class="container-fluid">
                        <!--Tab list-->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#info" role="tab" data-toggle="tab">Інформація про маршрут</a></li>
                            <li><a href="#update" role="tab" data-toggle="tab">Оновити інформацію</a></li>
                        </ul>

                        <!--Tab content-->
                        <div class="tab-content">
                            <div class="active tab-pane fade in" id="info">
                                <?php
                               

                                $ff =mysql_query("SET NAMES utf8");
                                $query = "SELECT * FROM routes WHERE rid=".$rid;
                                $result = mysql_query($query);
                                if (!$result) {
                                die('Invalid query: ' . mysql_error());
                                }
                                 while ($row = @mysql_fetch_assoc($result)){
                                 echo "<h2>Ділянка маршруту ".$row['start']." - ".$row['finish']."</h2><br>";
                                 echo "<b>Маркування: </b><img src='/images/".$row['mark']."_mark.png'><br>";
                                 
                                     
                                 }
                                $query = "SELECT * FROM routest WHERE rid=".$rid;
                                $result = mysql_query($query);
                                if (!$result) {
                                die('Invalid query: ' . mysql_error());
                                }
                                $mest=0;
                                $mcount=0;
                                $rtype=0;
                                $rcount=0;
                                $test=0;
                                $tcount=0;
                                $west=0;
                                $wcount=0;
                                $k1=0;$k2=0;$k3=0;$k4=0;$k5=0;$k6=0;
                                while ($row = @mysql_fetch_assoc($result)){
                                  if ($row['width']>0){$west+=$row['width']; $wcount++;}
                                  if ($row['mcond']>0){$mest+=$row['mcond']; $mcount++;}
                                  if ($row['rtype']>0){$rtype+=$row['rtype']; $rcount++;}
                                  if ($row['trash']>0){$test+=$row['trash']; $tcount++;}
                                $rcond=$row['rcond'];
                                $rcontent="<b>Складності при русі:</b> <br>";
                                if(($rcond%200000)>=100000){$k1++;}
                                if(($rcond%20000)>=10000){$k2++;}
                                if(($rcond%2000)>=1000){$k3++;}
                                if(($rcond%200)>=100){$k4++;}
                                if(($rcond%20)>=10){$k5++;}
                                if(($rcond%2)>=1){$k6++;}}
                             
                                if($k1>=2){$rcontent=  $rcontent.'Рух ускладнений коліями від коліс лісовозів. <br>';}
                                if($k2>=2){$rcontent= $rcontent.'Рух ускладнений наслідками повеней/лавин/буреломів/селів.<br>';}
                                if($k3>=2){$rcontent= $rcontent.'Стежка заросла і важко розрізняється в траві.<br>';}
                                if($k4>=2){$rcontent= $rcontent.'Рух ускладнений мокрим і слизьким глиняним покриттям стежки.<br>';}
                                if($k5>=2){$rcontent= $rcontent.'Рух ускладнений підйомом/спуском по великому камінню.<br>';}
                                if($k6>=2){$rcontent= $rcontent.'Рух ускладнений доланням водних перешкод убрід.<br>';}
                                if($west>0){ $west=$west/$wcount;
                                echo '<b>Ширина стежки: </b>'.$west.' м <br>';}
                                if($rtype>0){  $rtype=$rtype/$rcount;
                                if ($rtype>4){echo 'Дорога, прохідна для легкових автомобілів. ';}
                                else if ($rtype>3){echo 'Грунтова дорога, прохідна для позашляховиків. ';}
                                else if ($rtype>2){echo 'Стежка зі слідами руху транспортних засобів. ';}
                                else if ($rtype>1){echo 'Чітка пішохідна стежка. ';}
                                else {echo 'Ледь помітна заросла стежка. ';}
                                }
                                if($mest>0){  $mest=$mest/$mcount;
                                if ($mest>3){echo 'Маркування чітке, зрозуміле і зустрічається достатньо часто. ';}
                                else if ($mest>2){echo 'Маркування відсутнє в деяких ключових місцях (повороти, розвилки). ';}
                                else if ($mest>1){echo 'Маркування зустрічається рідко/знищене. ';}
                                else {echo 'Маркування не зустрічається. ';}
                                }
                                if($test>0){  $test=$test/$tcount;
                                if ($test>3){echo 'Ділянка засмічена, місцями зустрічаються цілі купи сміття. ';}
                                else if ($test>2){echo 'Регулярно зустрічається сміття вздовж стежки. ';}
                                else if ($test>1){echo 'Поодинокі обгортки/пляшки, однак дуже рідко. ';}
                                else {echo 'Сміття на ділянці маршруту немає. ';}
                                }
                                echo '<br>';
                                echo $rcontent;
                                    ?>
                                   
                                   
                                 

</div>
                            <div class="tab-pane fade" id="update">
                                Будь ласка, надавайте перевірену інформацію, підтверджену фотографіями та коментарями на рахунок. Пам’ятайте, ми віримо в вашу компетентність та добросовісність :) <br>
                                <form action="/rt/rtprocessor.php" method="post" name="infoupdate" id ="infoupdate" enctype="multipart/form-data">
                                    <b>Ширина стежки (м): </b> <input type="text" name="width" id="width" value=""><br>
                                    <b>Тип стежки: </b><select name="rcond" form="infoupdate">
                                      <option value="0">Виберіть варіант...</option>
                                      <option value="1">Ледь помітна заросла стежка</option>
                                      <option value="2">Чітка пішохідна стежка</option>
                                      <option value="3">Стежка зі слідами руху транспортних засобів</option>
                                      <option value="4">Грунтова дорога, прохідна для позашляховиків</option>
                                      <option value="5">Дорога, прохідна для легкових автомобілів</option>
                                    </select><br>
                                   <b>Стан маркування: </b><select name="mcond" form="infoupdate">
                                      <option value="0">Виберіть варіант...</option>
                                      <option value="1">Маркування не зустрічається</option>
                                      <option value="2">Маркування зустрічається рідко/знищене</option>
                                      <option value="3">Маркування відсутнє в деяких ключових місцях (повороти, розвилки)</option>
                                      <option value="4">Маркування чітке, зрозуміле і зустрічається достатньо часто</option>
                                    </select><br>
                                     <b>Засміченість маршруту: </b><select name="trash" form="infoupdate">
                                      <option value="0">Виберіть варіант...</option>
                                      <option value="1">Сміття на ділянці маршруту немає</option>
                                      <option value="2">Поодинокі обгортки/пляшки, однак дуже рідко</option>
                                      <option value="3">Регулярно зустрічається сміття вздовж стежки</option>
                                      <option value="4">Ділянка засмічена, місцями зустрічаються цілі купи сміття</option>
                                    </select><br>
                                     <b>Інші фактори</b><br>
                            <input type="checkbox" name="rd[]" value="A" />Рух ускладнений коліями від коліс лісовозів<br />
                            <input type="checkbox" name="rd[]" value="B" />Рух ускладнений наслідками повеней/лавин/буреломів/селів<br />
                            <input type="checkbox" name="rd[]" value="C" />Стежка заросла і важко розрізняється в траві<br />
                            <input type="checkbox" name="rd[]" value="D" />Рух ускладнений мокрим і слизьким глиняним покриттям стежки<br />
                            <input type="checkbox" name="rd[]" value="E" />Рух ускладнений підйомом/спуском по великому камінню<br />
                            <input type="checkbox" name="rd[]" value="F" />Рух ускладнений доланням водних перешкод убрід<br />
                                    <input type="hidden" name="tid" value="<?php echo $rid;?>">
                                    <input type=submit value="Додати дані">
                                </form>
                            </div>
                            
                            </div>
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