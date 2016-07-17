<?php
session_start();
include("../../../php/conn.php");

$query = "update apiclients set dp = 'N' where id='".$_SESSION['aid']."'";
if(mysql_query($query) && unlink("../../../apidp/".$_SESSION['aid'].".jpg"))
{
	echo '1';
}
else
{
	echo  'There was a problem writing the value to the database';
}
?>