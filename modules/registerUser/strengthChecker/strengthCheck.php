<?php
include("../../../php/conn.php");
session_start();
$n=$_POST['n'];
$points=isset($_POST['points']) ? $_POST['points'] : NULL;
$presses=isset($_POST['presses']) ? $_POST['presses'] : NULL;

$dist=array();
$distflag = 0;
$i=0;

for($i = 0 ; $i < $n-1 ; $i++)
{
	//calculate distance between each point using distance formula sqrt((x2-x1)^2 + (y2-y1)^2)
	$dist[$i] = sqrt(pow(($points[$i+1]['x']-$points[$i]['x']),2) + pow(($points[$i+1]['y']-$points[$i]['y']),2));
}

for($i=0 ; $i < $n-1 ; $i++)
{
	//check all distances to ensure all points are spaced 25 pixels apart
	if($dist[$i] < 25.0)
	{
		$distflag = 1;
	}
}


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
elseif($distflag == 1)
{
	//if points are spaced within 25 pixels
	echo 'Points must be atleast 25 pixels apart';
}
else
{
	//successfully passed strength check

	//encode json strings for points and presses arrays
	$pr=json_encode($presses);
	$pt=json_encode($points);

	//check whether the user has a password
	$query = "select count(id) from passwords where id='".$_SESSION['uid']."'";
	$result = mysql_query($query);
	$rows = mysql_fetch_array($result);

	if($rows[0] != 0)
	{
		//user has a password, check whether its a picture password
		$query = "select password_type from passwords where id='".$_SESSION['uid']."'";
		$result = mysql_query($query);
		$rows=mysql_fetch_array($result);

		if($rows[0] == 'P')
		{
			//replace the old password with new one
			$query = "delete from picpasswords where id='".$_SESSION['uid']."'";
			mysql_query($query);
			$query  = <<< EOD
			insert into picpasswords values('$_SESSION[uid]','$n','$pr','$pt');
EOD;
			mysql_query($query);
			echo '1';
		}

	}
	else
	{
		//create a new password		
		$query = "insert into passwords values('".$_SESSION['uid']."','P')";		
		mysql_query($query);
		$query  = <<< EOD
		insert into picpasswords values('$_SESSION[uid]','$n','$pr','$pt');
EOD;
		mysql_query($query);
		echo '1';
	}
}
?>