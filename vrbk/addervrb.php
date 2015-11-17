<?php
session_start();
if(!isset($_SESSION['session_username'])){header( "Location: /log/login.php" );}else{
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
    $trashtype=0;
    function IsChecked($chkname,$value)
    {
        if(!empty($_POST[$chkname]))
        {
            foreach($_POST[$chkname] as $chkval)
            {
                if($chkval == $value)
                {
                    return true;
                }
            }
        }
        return false;
    }
    if(IsChecked('trashtype','A'))
    {
        $trashtype+=1000;
    }
    if(IsChecked('trashtype','B'))
    {
        $trashtype+=100;
    }
    if(IsChecked('trashtype','C'))
    {
        $trashtype+=10;
    }
    if(IsChecked('trashtype','D'))
    {
        $trashtype+=1;
    }
     $path_directory = 'polygons/';
     $date=time();
     $filepath = $path_directory.$date.'.xml';
     $fp=fopen($filepath,'a+');
     fwrite($fp,$_POST['info']);
    $result = mysql_query ("INSERT INTO vrb(vfile,vopt,wood,approved) VALUES('".$filepath."',".intval($trashtype).",".intval($_POST['wood']).",0);");
    header( "Location: /vrbk/reload.php" );
}
?>