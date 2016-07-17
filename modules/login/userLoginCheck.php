<?php
include("../../php/conn.php");
$uid = $_POST['uid'];


if(preg_match("/^[a-zA-Z][a-zA-Z0-9_]*$/", $uid)==0)
{
	echo 'Username contains invalid characters';
}
else
{
	$query = "select count(id) from users where id='".$uid."'";
	$result=mysql_query($query);
	$rows=mysql_fetch_array($result);
	if($rows[0] > 0)
	{
		$query = "select password_type from passwords where id='".$uid."'";
		$result=mysql_query($query);
		$rows=mysql_fetch_array($result);
		echo $rows[0];
	}
	else
	{
		echo 'This username was not found. Please check again';
	}
}


