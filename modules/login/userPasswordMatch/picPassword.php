<?php
include("../../../php/conn.php");

$uid = isset($_POST['uid']) ? $_POST['uid'] : NULL;
$n=$_POST['n'];
$points=isset($_POST['points']) ? $_POST['points'] : NULL;
$presses=isset($_POST['presses']) ? $_POST['presses'] : NULL;
$flag=1;
$i=0;

if($n==0)
{
	//if no points are entered
	echo 'Please draw a pattern!';
}
elseif($n < 5 || $n > 10)
{
	//if points are outside min and max limits
	echo 'You must enter atleast 5 points and at the most 10 points';
}
else
{
	$query = "select n,presses,points from picpasswords where id='".$uid."'";
	$result=mysql_query($query);
	$rows=mysql_fetch_array($result);

	$n_act = $rows[0];
	$presses_act = json_decode($rows[1]);
	$points_act = json_decode($rows[2]);

	for($i = 0 ; $i < $n_act ; $i++)
	{
		$points_act[$i]->x=intval($points_act[$i]->x);
		$points_act[$i]->y=intval($points_act[$i]->y);
		$presses_act[$i]=intval($presses_act[$i]);
	}
	
	if($n != $n_act)
	{
		$flag=0;
	}

	for($i = 0 ; $i < $n ; $i++)
	{
		if($presses[$i] != $presses_act[$i])
		{
			$flag = 0;
			break;
		}
	}

	for($i = 0 ; $i < $n ; $i++)
	{
		$dist = sqrt(pow($points_act[$i]->x-$points[$i]['x'],2)+pow($points_act[$i]->y-$points[$i]['y'],2));

		if($dist > 10.0)
		{
			$flag = 0;
			break;
		}
	}

	if($flag == 1)
	{
		session_start();
		$_SESSION['uid']=$uid;

		echo 1;	
	}
	else
	{
		echo 'The password you entered does not match';
	}
	
}
?>