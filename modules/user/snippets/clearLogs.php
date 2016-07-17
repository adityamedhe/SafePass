<?php
include("../../../php/conn.php");
session_start();
$query = "delete from logs where uid='".$_SESSION['uid']."'";
mysql_query($query);
?>