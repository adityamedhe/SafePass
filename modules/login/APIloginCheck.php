<?php
include("../../php/conn.php");
$aid = $_POST['aid'];


if(preg_match("/^[a-zA-Z][a-zA-Z0-9_]*$/", $aid)==0)
{
	echo 'Username contains invalid characters';
}
else
{
	$query = "select count(id) from apiclients where id='".$aid."'";
	$result=mysql_query($query);
	$rows=mysql_fetch_array($result);
	if($rows[0] > 0)
	{
		$query = "select password_type from apipasswords where id='".$aid."'";
		$result=mysql_query($query);
		$rows=mysql_fetch_array($result);
		echo $rows[0];
	}
	else
	{
		echo 'This username was not found. Please check again';
	}
}


