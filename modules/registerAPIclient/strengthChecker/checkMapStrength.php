<?php
include("../../../php/conn.php");
session_start();
$n=$_POST['n'];
$points=isset($_POST['points']) ? $_POST['points'] : NULL;
$zooms=isset($_POST['zooms']) ? $_POST['zooms'] : NULL;

if($n < 5 || $n > 10)
{
	echo 'You must enter atleast 5 and at the most 10 points';
}
else
{
	//successfully passed strength check

	//encode json strings for points and zooms arrays
	$zm=json_encode($zooms);
	$pt=json_encode($points);

	//check whether the user has a password
	$query = "select count(id) from apipasswords where id='".$_SESSION['aid']."'";
	$result = mysql_query($query);
	$rows = mysql_fetch_array($result);

	if($rows[0] != 0)
	{
		//user has a password, check whether its a picture password
		$query = "select password_type from apipasswords where id='".$_SESSION['aid']."'";
		$result = mysql_query($query);
		$rows=mysql_fetch_array($result);

		if($rows[0] == 'M')
		{
			//replace the old password with new one
			$query = "delete from apimappasswords where id='".$_SESSION['aid']."'";
			mysql_query($query);
			$query  = <<< EOD
			insert into apimappasswords values('$_SESSION[aid]','$n','$zm','$pt');
EOD;
			mysql_query($query);
			echo '1';
		}

	}
	else
	{
		//create a new password		
		$query = "insert into apipasswords values('".$_SESSION['aid']."','M')";		
		mysql_query($query);
		$query  = <<< EOD
		insert into apimappasswords values('$_SESSION[aid]','$n','$zm','$pt');
EOD;
		mysql_query($query);
		echo '1';
	}
}