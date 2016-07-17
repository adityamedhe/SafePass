<?php

/*
RECEIVES FOLLOWING OBJECT: 
var dataToSend=
{
	"appname" : appname,				
	"uname" : uname,
	"redirect" : redirect,

	"checkname" : checkname,
	"checkemail" : checkemail,
	"checkgender" : checkgender,
	"checkbday" : checkbday,
	"checkdp" : checkdp,

	"checkphone" : checkphone,
	"checkaddress" : checkaddress,
	"checkpincode" : checkpincode,
	"checkcountry" : checkcountry
}			
*/
$flag=0;
$status = "";

$appname = $_POST['appname'];
$uname = $_POST['uname'];
$redirect = $_POST['redirect'];

$permissions = array(
"name"=> $_POST['checkname'],
"email"=> $_POST['checkemail'],
"gender"=> $_POST['checkgender'],
"bday"=> $_POST['checkbday'],
"dp"=> $_POST['checkdp'],

"phone"=> $_POST['checkphone'],
"address"=> $_POST['checkaddress'],
"pincode"=> $_POST['checkpincode'],
"country"=> $_POST['checkcountry'],
);



//APP NAME VALIDATION
if($appname == "")
{
	$status.="<li>App name field cannot be blank</li>";	
	$flag=1;
}
elseif(strlen($appname) > 50 || strlen($appname) < 5)
{
	$status.="<li>App name must be between 6 - 50 characters</li>";
	$flag=1;
}
elseif(preg_match("/^[a-zA-Z!@#$%^&*()0-9]*$/",$appname)==false)
{

	$status.="<li>App name contains invalid characters</li>";
	$flag=1;
}


//USERNAME VALIDATION
if($uname == "")
{
	$flag=1;
	$status.="<li>User name field cannot be blank</li>";	
}
elseif(preg_match("/^[a-zA-Z]([a-zA-Z]|[0-9]|[_])*$/",$uname)==false)
{
	$status.="<li>User name is invalid</li>";
	$flag=1;
}
elseif(strlen($uname) > 20 || strlen($uname) < 5)
{
	$status.="<li>User name must be between 6 - 20 characters</li>";
	$flag=1;
}

//USERNAME VALIDATION
if($redirect == "")
{
	$flag=1;
	$status.="<li>Redirect URL cannot be blank</li>";	
}
elseif(preg_match("/(https?:\/\/www\.)[a-z0-9&\/.]*[a-z0-9&\/]$/", $redirect)==false)
{
	///$status.="<li>Redirect URL is invalid</li>";
	//$flag=1;
}


//PERMISSIONS VALIDATION
$perflag = 0;
foreach ($permissions as $p)
{
	if($p == 1)
	{
		$perflag = 1;
		break;
	}
}

if($perflag == 0)
{
	$status.="<li>You've to select atleast one permission!</li>";
	$flag=1;
}


if($flag==1)
{
	//Validation has failed
	echo $status;
}
else
{
	//Validation is successful
	include("../../php/conn.php");

	$query = "SELECT count(*) from apiclients where id='".$uname."'";
	$result=mysql_query($query);

	$rows=mysql_fetch_array($result);
	
	if($rows[0] == '1')
	{
		echo 'The username you requested is unavailable';
	}
	else
	{
		$token="";

		for ( $i = 0 ; $i < 32 ; $i++)
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

		$query = "INSERT INTO apiclients values('".$uname."','".$appname."','".json_encode($permissions)."','N','".$token."','".$redirect."')";
		if(mysql_query($query))
		{
			echo '1';
			session_start();
			$_SESSION['aid']=$uname;
		}
		else
			//echo 'An error occured while creating your account';
			echo $query;
	}	
}
?>