<?php
session_start();
include("../../../php/conn.php");
$query = "select * from users where id='".$_SESSION['uid']."'";
$result=mysql_query($query);
$rows=mysql_fetch_array($result);
$flag=1;
foreach($rows as $data)
{
	if($data=='N')
	{
		$flag=0;
		echo 'Some details in your profile are missing. Please complete your profile! <a onclick=$("#notice").fadeOut(100)>Dismiss</a> | <a onclick=location.href="profile.php";>Do it now</a>';
		break;
	}
}

if($flag == 1)
{
	echo 'noblank';
}
?>