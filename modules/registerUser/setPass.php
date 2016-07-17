<!doctype HTML>

<html>
<?php session_start(); 
include("../../php/conn.php");
?>
<style type="text/css">
#picpassinfo
{
	float:left;
	position:relative;
	left:0px;
	clear:left;
	width:49.5%;
	background-color: white;
	border:1px #c8c8c8 solid;
	height:400px;
	border-top-left-radius:5px;
	border-bottom-left-radius: 5px;
	text-align: center;
}
#mappassinfo
{
	text-align: center;
	float:left;
	position:relative;
	left:0px;
	clear:right;
	width:50%;
	background-color: white;
	height:400px;
	border:1px #c8c8c8 solid;
	border-left:none;
	border-top-right-radius:5px;
	border-bottom-right-radius: 5px;
}
#mappassinfo:hover,#picpassinfo:hover
{
	background-color: #ebebeb;
}
</style>
<head>
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>
	<title>SafePass</title>
	<script src="../../lib/jquery.js"></script>
	<script src="../../js/ui.js"></script>
	<script src="../../js/forms.js"></script>
	<script src="../../lib/jquery-ui.js"></script>
	<link rel="stylesheet" href="../../styles/wizard.css">
	<link rel="stylesheet" href="../../styles/commonui.css">

</head>

<body>
	<img src="../../img/logo.png" width="300">
	<div id="content" style="min-width:650px; width:55%;">
		<div id="workheader" class="theader tstyle1">	
				Select a password type
		</div>


		<div id="workspace" class="tstyle2" style="height:400px;" align="">
			<div id="picpassinfo" onclick="window.location='picPass.php';"><br>
				<img src="../../img/picpassicon.png" style="height:50%;"><br>
				Picture pattern password
				<p class="tstyle3">You draw a pattern on a picture of<br> your choice to identify yourself</p>
			</div>

			<div id="mappassinfo" onclick="window.location='mapPass.php';"><br>
				<img src="../../img/mappassicon.png" style="height:50%;"><br>
				Map password
				<p class="tstyle3">You draw route on a Google Map to<br> identify yourself</p>
			</div>
					
		</div>
		
		<div id="footer">			
			
		</div>
	</div>

	<div id="usercard">
		
			<?php
				$query = "select dp from users where id='".$_SESSION['uid']."'";
				$result=mysql_query($query);
				$rows=mysql_fetch_array($result);

				if($rows[0] == 'Y')
				{
					echo <<< EOT
					<div id="usercircle" style="background-image:url('http://localhost/safepass/dp/$_SESSION[uid].jpg');"></div>
EOT;
				}
				else
				{

					echo '<div id = usercircle></div>';
				}
			?>		
		<br>
		<span class="tstyle3">
			<a onclick="dispWarning();">log out</a>
		</span>
	</div>


	<div id="notification" class="tstyle2"></div>
	<div id="working" class="tstyle2">Working...</div>

	<div id="overlay" style="display:none;">
		<div id="dialog">
		<div id="workheader" class="tstyle1">
			
		</div>
		<div id="workspace" class="tstyle3"  style="text-align:left;">
			
		</div>
		<div id="footer">
			<button class="negbutton" id="dialognegbut" style="float:left;" onclick='hideDialog();'>Return</button>

			<button class="posbutton" id="dialogposbut" style="float:right;" onclick='hideDialog();'>Okay</button>
		</div>
		</div>

	</div>


<?php



if(!isset($_SESSION['uid']))
{
	echo <<< EOD
	<script>
	$("#dialogposbut").click(function(){
		window.location="../../";
	});
	

	showDialog("Login error","There was an error logging you in. Please re-login",0);
	</script>
EOD;
}
?>

<script>
function dispWarning()
{
	$("#dialogposbut").click(function(){
		logout();
	});

	$("#dialognegbut").click(function(){
		hideDialog();
	});
	showDialog("Are you sure?","Logging out at this point will delete your account as the password has not been yet set up!",1);


}
</script>
</body>
