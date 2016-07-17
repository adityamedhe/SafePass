<!doctype HTML>

<html>
<?php session_start(); 
$uid = $_GET['id'];
include("../../php/conn.php");
?>

<head>
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>
	<title>SafePass</title>
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
<?php
	//get the zoom levels from the database
	$query = "select zooms from apimappasswords where id='".$uid."'";
	$result = mysql_query($query);
	$rows = mysql_fetch_array($result);
	$zoomstring = $rows[0];
	echo '<script> var zooms = '.$zoomstring.';</script>';
?>

	<img src="../../img/logo.png" width="300">
	<div id="content" style="width:55%;">
		<div id="workheader" class="tstyle1" style="">	
			Enter your map password
		</div>
		<div id="workspace" class="tstyle3"  align="center">
			<p class="tstyle3" align="left" style="text-align:left;">
				<ul align="left"style="text-align:left;">
					<li align="left">Your password depends upon:</li>
					<ol align="left">
						<li>The no. of locations</li>
						<li>The no. of locations</li>
						<li>The order in which each location is selected</li>
						<li>The zoom level at which the point is selected (This will be remembered for you)</li>
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
<script>
var n=0;
var points=new Array();
var zoom=new Array();
var objs=new Array();
var markers=new Array();
var i=0;
var zoomLegal=0;
var map;

for(i = zooms.length ; i < 100 ; i++)
{
	zooms[i]=6;
}
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
	
	map.setZoom(parseInt(zooms[0]));
	$("#helptext").text("First point is at zoom level "+zooms[0]);

	google.maps.event.addListener(map, "click", function(event) {
		if(zoomLegal == 0)
		{
			map.setZoom(parseInt(zooms[n]));
			$("#helptext").text("You've been returned to required zoom level. Please click now");
			return;
		}
		var mapx=event.latLng.lat();
		var mapy=event.latLng.lng();

		var pt={x : mapx, y : mapy};

		objs[n]=event.latLng;
		points[n]=pt;
		zoom[n]=map.getZoom();

		n++;

		if(n <= zooms.length-1)
		{
			map.setZoom(parseInt(zooms[n]));
			$("#helptext").text("Next point is at zoom level "+zooms[n]);
		}
		else
		{
			$("#helptext").text("Next point is at zoom level 6");
		}

		$("#pttext").text(n);

		
		var marker=new google.maps.Marker({
	 	position:objs[n-1]
	 	});		
	 	marker.setMap(map);

	 	setTimeout(function(){
	 		marker.setMap(null)},3000);
	 });

	var systemchange=0;
	 google.maps.event.addListener(map, "zoom_changed", function(event) {
	 	//$("#helptext").text("Zoom level: "+map.getZoom());
	 	if(map.getZoom() == zooms[n])
	 	{
	 		$("#googleMap").css("outline","5px #c8c8c8 solid");
	 		$("#helptext").css("color","black");
	 		$("#helptext").text("Next point is at zoom level "+zooms[n]);
	 		zoomLegal=1;

	 	}
	 	else
	 	{
	 		if(n<=zooms.length-1)
	 			$("#helptext").text("You need to be on zoom level "+zooms[n]+" to click this point");
	 		else
	 			$("#helptext").text("You need to be on zoom level 6 to click this point");

	 		$("#googleMap").css("outline","5px red solid");
	 		$("#helptext").css("color","red");
	 		zoomLegal=0;

	 	}
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
    	$("#helptext").text("First point is at zoom level "+zooms[0]);
    	map.setZoom(parseInt(zooms[0]));
    	showNotif("Please enter the password again",function(){});
	});
	showDialog("Are you sure?","You will have to enter the password again.",1);
    
}


function submitPattern()
{
	var dataToSend=
	{
		"uid":"<?php echo $uid; ?>",
		"n" : n,
		"points" : points,
		"zooms" : zoom
	}

	$.post("APIpasswordMatch/mapPassword.php",dataToSend,function(data){
		if(data == '1')
		{
			//PASSWORD MATCHED
			showNotif("Logging you in...",function(){
				window.location="../apiclient/home.php";
			});	
		}
		else
		{
			showDialog("Something went wrong there!",data,0);			
		}
	});
}


</script>
</body>
