<?php
include("../../../php/conn.php");

$uid = isset($_POST['uid']) ? $_POST['uid'] : NULL;
$aid = isset($_POST['aid']) ? $_POST['aid'] : NULL;
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
	$return = array("status" => "Please draw a pattern");
	echo json_encode($return);
}
elseif($n < 5 || $n > 10)
{
	//if points are outside min and max limits
	$return = array("status"=>"You must enter atleast 5 points and at the most 10 points");
	echo json_encode($return);
}
elseif($n != $n_act)
{
	$return  = array("status"=>"The password you entered does not match!");
	echo json_encode($return);
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
		//session_start();
		//$_SESSION['uid']=$uid;

		$token="acc";

		for ($i = 0 ; $i < 16 ; $i++)
		{
			$caps = rand(0,2);

			if($caps == 1)
			{
				$token.=chr(rand(65,90));
			}
			elseif($caps == 0)
			{
				$token.=chr(rand(97,122));
			}
			elseif($caps == 2)
			{
				$token.=rand(0,9);
			}			
		}

		
		$query = "delete from api where aid = '".$aid."' AND uid = '".$uid."'";
		mysql_query($query);
		
		
		$query = "insert into api values('".$uid."','".$aid."','".$token."','N')";
		mysql_query($query);

		$query = "select redirect from apiclients where id='".$aid."'";
		//echo $query;
		$result=mysql_query($query);
		$rows = mysql_fetch_array($result);

		$query = 'insert into logs values("'.$uid.'","'.$aid.'","'.date('d/M/Y, h:i:s').'","'.$_SERVER['REMOTE_ADDR'].'")';
		//echo '{"status":"'.$query.'"}';
		mysql_query($query);
		
		$return  = array("status"=>"1","reqtoken"=>$token,"redirect"=>$rows[0]);
		echo json_encode($return);	
	}
	else
	{
		$return  = array("status"=>"The password you entered does not match!");
		echo json_encode($return);
	}
	
}
?>