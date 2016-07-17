<?php
include('../php/conn.php');

$token = $_POST['token'];
$aid = $_POST['aid'];
$secret = $_POST['secret'];

$flag = 1;
$status = " ";
//perform some verification
$query = 'select uid,aid,reqtoken from api where reqtoken = "'.$token.'"';
$result = mysql_query($query);
$rows = mysql_fetch_array($result);

if($rows == false)
{
	$flag = 0;
	$status =  "TOKEN_FAILURE";
}
else
{
	//$rows = mysql_fetch_array($result);
	$uid = $rows['uid'];

	
	$query = 'select id,secret from apiclients where id = "'.$aid.'"';
	$result = mysql_query($query);
	$rows = mysql_fetch_array($result);

	if($secret != $rows['secret'])
	{
		$flag = 0;
		$status =  'SECRET_FAILURE';
	}
}

if($flag == 1)
{

	$query = 'delete from api where reqtoken = "'.$token.'"';
	$result = mysql_query($query);

	$query = 'select * from users where id = "'.$uid.'"';

	$result = mysql_query($query);
	$userdata = mysql_fetch_array($result);


	$query = 'select permissions from apiclients where id = "'.$aid.'"';
	$result = mysql_query($query);
	$rows = mysql_fetch_array($result);
	$permissions = json_decode($rows[0]);


	$dataToSend = array();
	if($permissions->name != '0'){$dataToSend['firstname'] = $userdata['firstname'] ; $dataToSend['lastname'] = $userdata['lastname'];}
	if($permissions->email != '0'){$dataToSend['email'] = $userdata['email'];}
	if($permissions->gender != '0'){$dataToSend['gender'] = $userdata['gender'];}
	if($permissions->bday != '0'){$dataToSend['birthday'] = $userdata['birthday'];}
	if($permissions->phone != '0'){$dataToSend['phone'] = $userdata['phone'];}
	if($permissions->address !='0'){$dataToSend['address'] = $userdata['address'];}
	if($permissions->pincode != '0'){$dataToSend['pincode'] = $userdata['pincode'];}
	if($permissions->country != '0'){$dataToSend['country'] = $userdata['country'];}	
	if($permissions->dp != '0')
	{
		if($userdata['dp']=='Y')
		{
			$dataToSend['dp']='http://localhost/safepass/dp/'.$uid.'.jpg';
		}
		else
		{
			$dataToSend['dp']='http://localhost/safepass/dp/default.png';
		}
	}
	$dataToSend['status']="SUCCESS";
	echo json_encode($dataToSend);
}

else
{	

	$output = array("status"=>$status);
	echo json_encode($output);
}
?>