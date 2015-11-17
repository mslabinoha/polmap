<?php
session_start();
if(!isset($_SESSION['session_username'])){header( "Location: /log/login.php" );}else{
    //блок підключення до бази
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
    //блок завантаження зображення
    $ff =mysql_query("SET NAMES utf8"); 
    if ($_GET['vid']>0){// якщо значення більше 0, то смітник ліквідований, якщо більше 2 - підтверджений

        $result = mysql_query ("UPDATE vrb SET approved='1' WHERE vid=".$_GET['vid'].";");
        
}

    }
header( "Location: /vrbk/virubka.php" );   
    
?>