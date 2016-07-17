<!doctype HTML>

<html>
<?php session_start(); 
include("../../php/conn.php");
?>
<head>
	<title>SafePass</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>
	<script src="../../lib/jquery.js"></script>
	<script src="../../js/ui.js"></script>
	<script src="../../js/forms.js"></script>
	<script src="../../lib/jquery-ui.js"></script>
	<link rel="stylesheet" href="../../styles/wizard.css">
	<link rel="stylesheet" href="../../styles/commonui.css">

</head>

<body>
	<img src="../../img/logo.png" width="300">
	<div id="content" style="width:55%;">
		<div id="workheader" class="theader tstyle1">	
				Upload a profile photo
		</div>


		<div id="workspace" align="center">
			<p class="tstyle3">This photo will be used across all client sites that use SafePass</p>
			<form action="upload.php" method="post" enctype="multipart/form-data">
			    <input type="file" name="fileToUpload" id="fileToUpload" class="tstyle3"><br><br>
    			<input type="submit" value="Upload Image" name="submit" class="posbutton">
			</form>
					
		</div>
		
		<div id="footer">			
			<button class="posbutton" id="but_uname_done" style="float:right;" onclick=window.location='setPass.php'>Skip</button>
		</div>
	</div>

	<div id="usercard">
		
			<?php
				$query = "select dp from users where id='".$_SESSION['aid']."'";
				$result=mysql_query($query);
				$rows=mysql_fetch_array($result);

				if($rows[0] == 'Y')
				{
					echo <<< EOT
					<div id="usercircle" style="background-image:url('http://localhost/safepass/apidp/$_SESSION[aid].jpg');"></div>
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



if(!isset($_SESSION['aid']))
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
