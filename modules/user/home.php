<!doctype HTML>
<html>
<?php session_start();
include("../../php/conn.php");
$query = "select * from users where id='".$_SESSION['uid']."'";
$result = mysql_query($query);
$rows=mysql_fetch_array($result);
$userdata=array();
foreach ($rows as $key => $value)
{
	$userdata[$key] = $value;
}
?>
<head>
	<title>SafePass</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>
	<script src="../../lib/jquery.js"></script>
	<script src="../../js/ui.js"></script>
	<script src="../../js/forms.js"></script>
	<link rel="stylesheet" href="../../styles/default.css">
	<link rel="stylesheet" href="../../styles/commonui.css">
</head>
<style>
#homeinfo
{
	border-radius: 5px;
	//border: 1px #c8c8c8 solid;
	padding: 10px;
}
</style>
<body class="tstyle3">
	<script>
	 var ua = window.navigator.userAgent;
     var msie = ua.indexOf("MSIE ");
     if (msie > 0)  
            alert("This site is not optimized for Internet Explorer. Please consider using Chrome or Firefox.");   
    </script>
	<img src="../../img/logo.png" width="300">
	<div id="content">
		<div id="sidebar">
			<div id="userdetails">
				<div onmouseover="$('#changedp,#removedp').show()" onmouseout="$('#changedp,#removedp').hide()" id="usercircle" style="background-image:url('<?php if($userdata['dp']=='Y') echo "../../dp/".$_SESSION['uid'].".jpg"; else echo '../../dp/default.png';?>');">					
					
					<div id="changedp" onmousemove="$('#changedp,#removedp').show();">
						<a  class="tstyle3" style="text-decoration:none;" onclick=location.href='snippets/uploadPhoto.php'>change</a>
					</div>

					<?php
					if ($userdata['dp']!='N')
					{
						echo <<< EOD
						<div id="removedp"  onmousemove="$('#changedp,#removedp').show();">
						<a  class="tstyle3" style="text-decoration:none;" onclick="removeDp();">remove</a>
						</div>
EOD;
					}
					?>
					
				</div>
				<p>					
					<span class="tstyle2"><?php echo $_SESSION['uid'];?></span>
					<br>
					<span class="tstyle3"><a onclick="logout();">log out</a></span>
				</p>
			</div>
			<div class="link tstyle2 pressed"><img src="../../img/homeicon.png" class="icon">Home</div>
			<div class="link tstyle2" onclick="location.href='profile.php';"><img src="../../img/profileicon.png" class="icon">Profile</div>
			<div class="link tstyle2" onclick="location.href='password.php';"><img src="../../img/lockicon.png" class="icon">Password</div>
			<div class="link tstyle2" onclick="location.href='logs.php';"><img src="../../img/diaryicon.png" class="icon">Logs</div>
		</div>
		<div id="workarea">
			<div id="workheader" class="theader tstyle1">				
					<?php echo $userdata['firstname']." ".$userdata['lastname']; ?>
			</div>
			<div id="workspace">
				<div id = "welcometext" style = "background-image:url('../../img/graystripe.png');"class = " info">
					<span class="tstyle2">
						Welcome to SafePass!
					</span>
					<br>
					<span class="tstyle3">
						Use this dashboard to modify your profile, change your password, and see what apps have used your data.
					</span>
				</div>
				<div id = "notice" class="info">
				</div>

				<div id = "homeinfo">
					<table class="table" style="background-color:#ebebeb;" align="center" cellpadding="10">
						<tr>
							<td style="background-image:url('../../img/graystripe.png');">
								<div class="badge">1</div>
							</td>
							<td>
								Use the profile screen to edit your profile and add or remove details
							</td>
						</tr>
						<tr>
							<td style="background-image:url('../../img/graystripe.png');">
								<div class="badge">2</div>
							</td>
							<td>
								Use the password screen to change your existing password and switch between map and picture password
							</td>
						</tr>
						<tr class="middletr">
							<td style="background-image:url('../../img/graystripe.png'); ">
								<div class="badge">3</div>
							</td>
							<td>
								To view a record of recent usage of your data by an app, visit the logs screen
							</td>
						</tr>
					</table>
				</div>



				
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
	$(".link").click(function(event){
		$(".link").removeClass("pressed");
		$(this).addClass("pressed");
	});

	$.post("snippets/isBlank.php",{},function(data){
		if(data == "noblank")
		{
			$("#notice").hide();
		}
		else
		{
			$("#notice").html(data);
		}
	})

</script>
</body>