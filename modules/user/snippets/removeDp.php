<?php
session_start();
include("../../../php/conn.php");

$query = "update users set dp = 'N' where id='".$_SESSION['uid']."'";
if(mysql_query($query) && unlink("../../../dp/".$_SESSION['uid'].".jpg"))
{
	echo '1';
}
else
{
	echo  'There was a problem writing the value to the database';
}
?>