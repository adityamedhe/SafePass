<?php
session_start();
include("../../../php/conn.php");
$toUpdate  = $_POST['toUpdate'];
$newVal = $_POST['newVal'];

if($toUpdate == 'editfirstname')
{
	$flag=0;
	$status = "";
	if($newVal == "")
	{
		$status="First name field cannot be blank";	
		$flag=1;
	}
	elseif(strlen($newVal) > 50 || strlen($newVal) < 5)
	{
		$status="First name must be between 6 - 50 characters";
		$flag=1;
	}
	elseif(preg_match("/^[a-zA-Z]*$/",$newVal)==false)
	{

		$status="First name contains invalid characters";
		$flag=1;
	}

	if($flag == 0)
	{
		$query = "update users set firstname = '".$newVal."' where id='".$_SESSION['uid']."'";
		if(mysql_query($query))
		{
			echo '1';
		}
		else
		{
			echo  'There was a problem writing the value to the database';
		}
	}
	else
	{
		echo $status;
	}
}

if($toUpdate == 'editlastname')
{
	$flag=0;
	$status = "";
	if($newVal == "")
	{
		$status="Last name field cannot be blank";	
		$flag=1;
	}
	elseif(strlen($newVal) > 50 || strlen($newVal) < 5)
	{
		$status="Last name must be between 6 - 50 characters";
		$flag=1;
	}
	elseif(preg_match("/^[a-zA-Z]*$/",$newVal)==false)
	{

		$status="Last name contains invalid characters";
		$flag=1;
	}

	if($flag == 0)
	{
		$query = "update users set lastname = '".$newVal."' where id='".$_SESSION['uid']."'";
		if(mysql_query($query))
		{
			echo '1';
		}
		else
		{
			echo  'There was a problem writing the value to the database';
		}
	}
	else
	{
		echo $status;
	}
}


if($toUpdate == 'editphone')
{
	$flag=0;
	$status = "";
	if($newVal!="")
	{
		if(preg_match("/^[0-9]*$/", $newVal)==0)
		{
			$status="Phone number is invalid";
			$flag=1;
		}
		else if(strlen($newVal) > 30 || strlen($newVal) < 10)
		{
			$status="Phone number must be between 10 to 30 digits";
			$flag=1;
		}
	}
	else
	{
		$newVal="N";
	}

	if($flag == 0)
	{
		$query = "update users set phone = '".$newVal."' where id='".$_SESSION['uid']."'";
		if(mysql_query($query))
		{
			echo '1';
		}
		else
		{
			echo  'There was a problem writing the value to the database';
		}
	}
	else
	{
		echo $status;
	}
}


if($toUpdate == 'editpincode')
{
	$flag=0;
	$status = "";
	if($newVal!="")
	{
		if(preg_match("/^[0-9]*$/", $newVal)==0)
		{
			$status="Pin code is invalid";
			$flag=1;
		}
		else if(strlen($newVal) > 10 || strlen($newVal) < 4)
		{
			$status="Pin code must be between 4 to 10 digits";
			$flag=1;
		}
	}
	else
	{
		$newVal="N";
	}

	if($flag == 0)
	{
		$query = "update users set pincode = '".$newVal."' where id='".$_SESSION['uid']."'";
		if(mysql_query($query))
		{
			echo '1';
		}
		else
		{
			echo  'There was a problem writing the value to the database';
		}
	}
	else
	{
		echo $status;
	}
}




if($toUpdate == 'editaddress')
{
	$flag=0;
	$status = "";
	if($newVal!="")
	{	
		if(strlen($newVal) <15)
		{
			$status="Please provide an elaborated address";
			$flag=1;
		}
	}
	else
	{
		$newVal="N";
	}
	if($flag == 0)
	{
		$query = "update users set address = '".$newVal."' where id='".$_SESSION['uid']."'";
		if(mysql_query($query))
		{
			echo '1';
		}
		else
		{
			echo  'There was a problem writing the value to the database';
		}
	}
	else
	{
		echo $status;
	}
}



if($toUpdate == 'editbday')
{
	$flag=0;
	$status = "";
	if($newVal=="")
	{
		$newVal="N";
	}
	if($flag == 0)
	{
		$query = "update users set birthday = '".$newVal."' where id='".$_SESSION['uid']."'";
		if(mysql_query($query))
		{
			echo '1';
		}
		else
		{
			echo  'There was a problem writing the value to the database';
		}
	}
	else
	{
		echo $status;
	}
}


if($toUpdate == 'editgender')
{
	$flag=0;
	$status = "";
	if($newVal=="")
	{
		$newVal="N";
	}
	if($flag == 0)
	{
		$query = "update users set gender = '".$newVal."' where id='".$_SESSION['uid']."'";
		if(mysql_query($query))
		{
			echo '1';
		}
		else
		{
			echo  'There was a problem writing the value to the database';
		}
	}
	else
	{
		echo $status;
	}
}


if($toUpdate == 'editcountry')
{
	$flag=0;
	$status = "";
	if($flag == 0)
	{
		$query = "update users set country = '".$newVal."' where id='".$_SESSION['uid']."'";
		if(mysql_query($query))
		{
			echo '1';
		}
		else
		{
			echo  'There was a problem writing the value to the database';
		}
	}
	else
	{
		echo $status;
	}
}
//echo '1';
?>