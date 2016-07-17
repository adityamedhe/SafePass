<!doctype HTML>
<html>
<?php session_start();
include("../../php/conn.php");
$query = "select * from apiclients where id='".$_SESSION['aid']."'";
$result = mysql_query($query);
$rows=mysql_fetch_array($result);
$userdata=array();
foreach ($rows as $key => $value)
{
	$userdata[$key] = $value;
}
?>
<head>
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>
	<title>SafePass</title>
	<script src="../../lib/jquery.js"></script>
	<script src="../../js/ui.js"></script>
	<script src="../../js/forms.js"></script>
	<link rel="stylesheet" href="../../styles/default.css">
	<link rel="stylesheet" href="../../styles/commonui.css">
</head>
<style>
.permissions
{
	float:left;
	width: 260px;
	padding: 10px;
	border: 1px #c8c8c8 solid;
	border-radius: 5px;
	//ext-align: center;
	min-height:400px;
}

.instructions
{
	min-height:400px;
	padding: 10px;
	margin-left: 10px;
	width:470px;
	float: left;
	border: 1px #c8c8c8 solid;
	border-radius: 5px;

}

.table
{
	//margin:auto;
	width:250px;
}
.permname
{
	text-align: center;
	padding: 5px;
	width:20%
}

.perminfo
{
	padding:5px;
	width:80%;
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
				<div onmouseover="$('#changedp,#removedp').show()" onmouseout="$('#changedp,#removedp').hide()" id="usercircle" style="background-image:url('<?php if($userdata['dp']=='Y') echo "../../apidp/".$_SESSION['aid'].".jpg"; else echo '../../dp/default.png';?>');">					
					
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
					<span class="tstyle2"><?php echo $_SESSION['aid'];?></span>
					<br>
					<span class="tstyle3"><a onclick="logout();">log out</a></span>
				</p>
			</div>
			<div class="link tstyle2 pressed"><img src="../../img/homeicon.png" class="icon">Home</div>
			<div class="link tstyle2" onclick="location.href='password.php';"><img src="../../img/lockicon.png" class="icon">Password</div>
			<div class="link tstyle2" onclick="location.href='logs.php';"><img src="../../img/diaryicon.png" class="icon">Logs</div>
		</div>
		<div id="workarea">
			<div id="workheader" class="theader tstyle1">				
					<?php echo $userdata['appname']; ?>
			</div>
			<div id="workspace">
				<div id="info" style="text-align:left; padding: 10px; margin-bottom:20px;">
					<span class="tstyle4">CLIENT SECRET IDENTIFICATION KEY</span><br>
					<input type="Text" align = "center" disabled class="tstyle3" style="width:350px; font-family:Consolas" value="<?php echo $userdata['secret']; ?>">
					<span style="float:right">Keep this key in a safe place to avoid misuse!</span>
				</div>

				<div class="permissions">
					Permissions used by your app<hr>

					<table border="0" class="table">
						<tr class="tstyle2">
							<td class="permname" style="background-color:#ebebeb;">
								
							</td>
							<td class="perminfo" style="background-color:#ebebeb;">
								Permission name									
							</td>
						</tr>
						<?php
						$pertext = array("Name","Email address","Gender","Birthday","Profile picture","Phone number","Street address","Pincode","Country");
						$i = 0;
						$perms=json_decode($userdata['permissions']);
						foreach ($perms as $key => $value) 
						{
						if($value == 1)
						echo <<< EOD
						<tr class="tstyle2">
							<td class="permname" style="background-color:;">
								<input type="checkbox" checked disabled>
							</td>
							<td class="perminfo" style="background-color:;">
								$pertext[$i]								
							</td>
						</tr>
EOD;
						else
						echo <<< EOD
						<tr class="tstyle2">
							<td class="permname" style="background-color:#;">
								<input type="checkbox" disabled>
							</td>
							<td class="perminfo" style="background-color:#;">
								$pertext[$i]								
							</td>
						</tr>
EOD;
						$i++;
							# code...
						}
						
?>

					</table> 
				</div>

				<div class="instructions">
					SafePass API - The ultimate in security and convenience	<hr>
					<img src="../../img/apiinst.png" width="470">
					<br>
					<ul>
						<li>To learn the API structure and it's usage in detail,<br> visit the <a>SafePass Developer Documentation</a>
						<Br><Br>
						<li>Always follow security protocols to safeguard<br> the identity of your users. For more visit <a>SafePass best practices</a>
					</ul> 
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
	$(".link").click(function(event){
		$(".link").removeClass("pressed");
		$(this).addClass("pressed");
	});

	$.post("snippets/isBlank.php",{},function(data){
		if(data == "noblank")
		{
			$("#info").hide();
		}
		else
		{
			$("#info").html(data);
		}
	})

</script>
</body>