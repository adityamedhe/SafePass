<?php
include("../../../php/conn.php");

$uid = isset($_POST['uid']) ? $_POST['uid'] : NULL;
$n=$_POST['n'];
$points=isset($_POST['points']) ? $_POST['points'] : NULL;
$zooms=isset($_POST['zooms']) ? $_POST['zooms'] : NULL;
$flag=1;
$i=0;

$query = "select n,zooms,points from mappasswords where id='".$uid."'";
$result=mysql_query($query);
$rows=mysql_fetch_array($result);

$n_act = $rows[0];
$zooms_act = json_decode($rows[1]);
$points_act = json_decode($rows[2]);

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
elseif($n != $n_act)
{
	echo 'The password you entered does not match';
}
else
{
	

	for($i = 0 ; $i < $n_act ; $i++)
	{	
		$points_act[$i]->x=floatval($points_act[$i]->x);
		$points_act[$i]->y=floatval($points_act[$i]->y);
		$zooms_act[$i]=intval($zooms_act[$i]);
	}
	
	

	for($i = 0 ; $i < $n ; $i++)
	{
		if($zooms[$i] != $zooms_act[$i])
		{
			$flag = 0;
			break;
		}
	}

	for($i = 0 ; $i < $n ; $i++)
	{
		$dist = sqrt(pow($points_act[$i]->x-$points[$i]['x'],2)+pow($points_act[$i]->y-$points[$i]['y'],2));
		//echo var_dump($dist);
		if($dist > 0.1)
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