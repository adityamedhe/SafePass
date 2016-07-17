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

	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=true">
	</script>
	<link rel="stylesheet" href="../../styles/wizard.css">
	<link rel="stylesheet" href="../../styles/commonui.css">

</head>

<body>
	<img src="../../img/logo.png" width="300">
	<div id="content" style="width:55%;">
		<div id="workheader" class="tstyle1" style="">	
			Create a map password
		</div>
		<div id="workspace" class="tstyle3"  align="center">
			<p class="tstyle3" align="left">
				<ul align="left" style="text-align:left;">
					<li>Click on the map at desired locations to create a map password.</li>
					<li>You must select atleast 5 and at the most 10 locations.</li>
					<li>Your password depends upon:</li>
					<ol align="left">
						<li>The no. of locations</li>
						<li>The order in which each location is selected</li>
						<li>The zoom level at which the point is selected (This will be remembered for you when you login)</li>
					</ol>
				</ul>
			</p>
			
			<div id="picpattinfo">
				<div id="noofpoints">
					<span class="tstyle4">NO. OF POINTS</span><br>
					<span class="tstyle1" id="pttext">0</span>
				</div>
				<div id="picpatttext">
					<span class="tstyle4">INSTRUCTIONS</span><br>
					<span class="tstyle2" id="helptext">Start by clicking your first point</span>
				</div>
			</div>
	
			<div id="googleMap" style="margin-top:125px; width:550px; height:550px; outline:5px #c8c8c8 solid;">
			</div>		
					
		</div>
		
		<div id="footer">			
			<button class="posbutton" style="float:right;" onclick="submitPattern()">Done</button>
			
			<button class="negbutton" onclick="mapReset();">Reset</button>
			<button class="posbutton" onmousedown="viewPattern();" onmouseup="hidePattern();">View points</button>
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




<script>
var n=0;
var points=new Array();
var zoom=new Array();
var objs=new Array();
var markers=new Array();
var i=0;
var map;
google.maps.event.addDomListener(window, 'load', initialize);
function initialize()
{
	var mapProp=
	{
		center:new google.maps.LatLng(18.9750,72.8258),
		zoom:5,
		mapTypeId:google.maps.MapTypeId.ROADMAP,
		disableDefaultUI:true,
		panControl:true,
		zoomControl:true
	};

	map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	$("#zoominfo").text("Zoom level: "+map.getZoom());	

	google.maps.event.addListener(map, "click", function(event) {
		var mapx=event.latLng.lat();
		var mapy=event.latLng.lng();

		var pt={x : mapx, y : mapy};

		objs[n]=event.latLng;
		points[n]=pt;
		zoom[n]=map.getZoom();

		n++;

		$("#pttext").text(n);

		
		var marker=new google.maps.Marker({
	 	position:objs[n-1]
	 	});		
	 	marker.setMap(map);

	 	setTimeout(function(){
	 		marker.setMap(null)},3000);
	 });

	google.maps.event.addListener(map, "zoom_changed", function(event) {
		$("#helptext").text("Zoom level: "+map.getZoom());		
	 });
}
function viewPattern()
{
	for(i=0;i<n;i++)
	{
		var marker=new google.maps.Marker({
	 	position:objs[i]
	 	});

		markers[i]=marker;
	 	marker.setMap(map);

	 	var text=i+1;
	 	var infowindow = new google.maps.InfoWindow({
  		content:"<p><font size=6>"+text+"</p>"
 		});

		infowindow.open(map,marker);

	 	
	}	
}

function hidePattern()
{
	for(i=0;i<n;i++)
	{
		markers[i].setMap(null);
	}
	markers=[];
}


function mapReset()
{
	$("#dialogposbut").click(function(){
		n=0;
		points=[];
		zoom=[];
		objs=[];
		$("#pttext").text("0");
    	$("#helptext").text("Start by clicking your first point");
    	showNotif("Please enter the password again",function(){});
	});
	showDialog("Are you sure?","You will have to enter the password again.",1);
    
}


function submitPattern()
{
	var dataToSend=
	{
		"n" : n,
		"points" : points,
		"zooms" : zoom
	}

	$.post("strengthChecker/checkMapStrength.php",dataToSend,function(data){
		if(data == '1')
		{
			$("#dialogposbut").click(function(){
				window.location = "../../index.html";
				});
			showDialog("Done!","Congratulations, your profile has been created! Login using your brand-new user ID and password",0);
		}
		else
		{
			showDialog("Strength check failed",data,0);			
		}
	});
}


</script>
</body>
