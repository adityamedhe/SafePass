<?php
include("../../../php/conn.php");
session_start();
$query = "delete from logs where aid='".$_SESSION['aid']."'";
mysql_query($query);
?>