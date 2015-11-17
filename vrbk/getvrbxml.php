<?php
require($_SERVER['DOCUMENT_ROOT']."/dbconnect.php");

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

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
// Select all the rows in the markers table
$query = "SELECT * FROM vrb WHERE 1";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml; charset=UTF-8");
// Start XML file, echo parent node
echo '<polygons>';
// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  echo '<polygon ';
  echo 'id="' . $row['vid'] . '" ';
  echo 'file="' . $row['vfile'] . '" ';
  echo 'vopt="' . $row['vopt'] . '" ';
  echo 'wood="' . $row['wood'] . '" ';
  echo 'approved="' . $row['approved'] . '" ';
  echo '/>';
}

// End XML file
echo '</polygons>';

?>
