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
                    $trashtype+=10000;
                }
               if(IsChecked('trashtype','B'))
                {
                    $trashtype+=1000;
                }
               if(IsChecked('trashtype','C'))
                {
                    $trashtype+=100;
                }
               if(IsChecked('trashtype','D'))
                {
                    $trashtype+=10;
                }
                if(IsChecked('trashtype','E'))
                {
                    $trashtype+=1;
                }

$result = mysql_query ("INSERT INTO wooddump(authorid,lng,lat,length,width, depth, trashtype, approved, comment) VALUES(".intval($_POST['authorid']).",".floatval($_POST['lng']).",".floatval($_POST['lat']).",".floatval($_POST['length']).",".floatval($_POST['width']).",".floatval($_POST['height']).",".intval($trashtype).",0,'".$_POST['commenta']."');");
header( "Location: /wddp/wooddump.php" );
?>