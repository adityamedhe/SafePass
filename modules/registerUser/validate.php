<?php

/*
RECEIVES FOLLOWING OBJECT: 
var dataToSend=
{
	"fname" : fname,
	"lname" : lname,
	"uname" : uname,
	"email" : email,

	"gender" : gender,
	"bday" : bday,
	"phone" : phone,
	"address" : address,
	"pin" : pin,
	"country" : country
}
*/
$flag=0;
$status = "";
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$uname = $_POST['uname'];
$gender = $_POST['gender'];
$bday = $_POST['bday'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$pin = $_POST['pin'];
$country = $_POST['country'];


//FIRST NAME VALIDATION
if($fname == "")
{
	$status.="<li>First name field cannot be blank</li>";	
	$flag=1;
}
elseif(strlen($fname) > 50 || strlen($fname) < 5)
{
	$status.="<li>First name must be between 6 - 50 characters</li>";
	$flag=1;
}
elseif(preg_match("/^[a-zA-Z]*$/",$fname)==false)
{

	$status.="<li>First name contains invalid characters</li>";
	$flag=1;
}

//LAST NAME VALIDATION
if($lname == "")
{
	$status.="<li>Last name field cannot be blank</li>";	
	$flag=1;
}
elseif(strlen($lname) > 50 || strlen($lname) < 5)
{
	$status.="<li>Last name must be between 6 - 50 characters</li>";
	$flag=1;
}
elseif(preg_match("/^[a-zA-Z]*$/",$lname)==false)
{

	$status.="<li>Last name contains invalid characters</li>";
	$flag=1;
}

//EMAIL VALIDATION
if($email == "")
{
	$status.="<li>Email field cannot be blank</li>";	
	$flag=1;
}
elseif(preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/",$email)==false)
{

	$status.="<li>Email address is invalid</li>";
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

//DOB VALIDATION
if($bday=="")
{
	$bday="N";
}

//PHONE VALIDATION
if($phone!="")
{
	if(preg_match("/^[0-9]*$/", $phone)==0)
	{
		$status.="<li>Phone number is invalid</li>";
		$flag=1;
	}
	else if(strlen($phone) > 30 || strlen($phone) < 10)
	{
		$status.="<li>Phone number must be between 10 to 30 digits</li>";
		$flag=1;
	}
}
else
{
	$phone="N";
}

//ADDRESS VALIDATION
if($address!="")
{	
	if(strlen($address) <15)
	{
		$status.="<li>Please provide an elaborated address</li>";
		$flag=1;
	}
}
else
{
	$address="N";
}

//PIN CODE VALIDATION
if($pin!="")
{
	if(preg_match("/^[0-9]*$/", $pin)==0)
	{
		$status.="<li>Pin code is invalid</li>";
		$flag=1;
	}
	else if(strlen($pin) > 10 || strlen($pin) < 4)
	{
		$status.="<li>Pin code must be between 4 to 10 digits</li>";
		$flag=1;
	}
}
else
{
	$pin="N";
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


	$query = "SELECT count(*) from users where id='".$uname."'";
	$result=mysql_query($query);

	$rows=mysql_fetch_array($result);
	
	if($rows[0] == '1')
	{
		echo 'The username you requested is unavailable';
	}
	else
	{
		$query = "INSERT INTO users values('".$uname."','".$fname."','".$lname."','".$email."','".$phone."','".$address."','".$country."','".$pin."','".$gender."','".$bday."','N')";
		if(mysql_query($query))
		{
			echo '1';
			session_start();
			$_SESSION['uid']=$uname;
		}
		else
			//echo 'An error occured while creating your account';
			echo $query;
	}	
}
?>