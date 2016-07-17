<!doctype HTML>

<html>
<?php session_start(); 
include("../../../php/conn.php");
?>
<head>
	<title>SafePass</title>
	<script src="../../../lib/jquery.js"></script>
	<script src="../../../js/ui.js"></script>
	<script src="../../../js/forms.js"></script>
	<script src="../../../lib/jquery-ui.js"></script>
	<link rel="stylesheet" href="../../../styles/wizard.css">
	<link rel="stylesheet" href="../../../styles/commonui.css">

</head>

<body>
	<img src="../../../img/logo.png" width="300">
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
			<button class="negbutton" id="but_uname_done" style="float:left;" onclick=window.location='../home.php'>Return</button>
		</div>
	</div>

		
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
		window.location="../../../../";
	});
	showDialog("Login error","There was an error logging you in. Please re-login",0);
	</script>
EOD;
}
?>


</body>
