<?php
session_start();
if(!isset($_SESSION['session_username'])){header( "Location: log/login.php" );}else{
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
    if(IsChecked('rd','A'))
    {
        $trashtype+=100000;
    }
    if(IsChecked('rd','B'))
    {
        $trashtype+=10000;
    }
    if(IsChecked('rd','C'))
    {
        $trashtype+=1000;
    }
    if(IsChecked('rd','D'))
    {
        $trashtype+=100;
    }
    if(IsChecked('rd','E'))
    {
        $trashtype+=10;
    }
    if(IsChecked('rd','F'))
    {
        $trashtype+=1;
    }

    $result = mysql_query ("INSERT INTO routest(rid,width,mcond,rtype,rcond,trash,edate) VALUES(".intval($_POST['tid']).",".floatval($_POST['width']).",".intval($_POST['mcond']).",".intval($_POST['rcond']).",".intval($trashtype).",".intval($_POST['trash']).",CURDATE());");
    $url='/rt/rtdetails.php?rid='.$_POST['tid'];
    header( "Location: $url" );
}
?>