<?php
session_start();
include("conn.php");

if(isset($_SESSION['uid']))
{
	$query="select count(id) from passwords where id='".$_SESSION['uid']."'";
	$result=mysql_query($query);
	$rows=mysql_fetch_array($result);
	if($rows[0]==0)
	{
		$query="delete from users where id='".$_SESSION['uid']."'";
		echo $query;
		mysql_query($query);

		unlink("../imgpasswords/".$_SESSION['uid'].".jpg");
	}
}
elseif(isset($_SESSION['aid']))
{
	$query="select count(id) from apipasswords where id='".$_SESSION['aid']."'";
	$result=mysql_query($query);
	$rows=mysql_fetch_array($result);
	if($rows[0]==0)
	{
		$query="delete from apiclients where id='".$_SESSION['aid']."'";
		echo $query;
		mysql_query($query);

		unlink("../apiimgpasswords/".$_SESSION['aid'].".jpg");
	}

}
session_destroy();

?>