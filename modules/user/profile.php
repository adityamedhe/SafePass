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
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet' type='text/css'>
	<title>SafePass</title>
	<script src="../../lib/jquery.js"></script>
	<script src="../../js/ui.js"></script>
	<script src="../../js/forms.js"></script>
	<link rel="stylesheet" href="../../styles/default.css">
	<link rel="stylesheet" href="../../styles/commonui.css">
</head>
<body class="tstyle3">
<style>
.container
{

	float:left;
	text-align: center;
	width:47%;
	//height:200px;
	padding:5px;
	margin:auto;
	margin-left: 10px;
	//background-color: #ebebeb;
	//border-radius: 5px;	
	//border-top:1px #c8c8c8 solid;
	
}



table
{
	position: relative;
	margin: auto;
}

td
{
	text-align: left;
	vertical-align: top;
	padding: 10px;
	border:none;
}
tr:hover
{
	background-color: #ebebeb;
}
td:first-child
{
	text-align: right;
}

table input,table textarea,table select
{
	border:none;
}
input:focus,textarea:focus,select:focus
{
	border-width: 2px;
	border-radius: 5px;
	border-style: solid;
	border-color:#72b8dc;
	background-color: #ebebeb;
}


</style>
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
			<div class="link tstyle2" onclick="location.href='home.php';"><img src="../../img/homeicon.png" class="icon">Home</div>
			<div class="link tstyle2 pressed"><img src="../../img/profileicon.png" class="icon">Profile</div>
			<div class="link tstyle2" onclick="location.href='password.php';"><img src="../../img/lockicon.png" class="icon">Password</div>
			<div class="link tstyle2" onclick="location.href='logs.php';"><img src="../../img/diaryicon.png" class="icon">Logs</div>
		</div>
		<div id="workarea">
			<div id="workheader" class="theader tstyle1">				
					<?php echo $userdata['firstname']." ".$userdata['lastname']; ?>
			</div>
			

			<div id="workspace" align="center">
				<div class="parent">
					<div class="container" id="perscont">
						<span class="tstyle2">Personal</span><br><br>
						<table>
							<tr>
								<td><label for="editfirstname" >First name</label></td>
								<td><input type="text" id="editfirstname" class="tstyle3" value="<?php echo $userdata['firstname']?>"></td>
							</tr>

							<tr>
								<td><label for="editlastname">Last name</label></td>
								<td><input type="text" id="editlastname" class="tstyle3" value="<?php echo $userdata['lastname']?>"></td>
							</tr>
							<tr>
								<td><label for="editbday">Birthday</label><br><span class="tstyle4">MM/DD/YYYY</span></td>
								<td><button class="negbutton" id="bdayclearbut" onclick="clearBday();" style="<?php if($userdata['birthday']=='N') echo 'display:none;';?>"><B>X</B></button>
								<input type="date" id="editbday" class="tstyle3" value="<?php echo $userdata['birthday']=='N' ? "Not specified" : $userdata['birthday']; ?>">
								</td>
							</tr>

							<tr>
								<td>Gender<br><?php if($userdata['gender']=='N') echo '<span class="tstyle4" id="gns">NOT SPECIFIED</span>'; ?></td>
								<td> 
								<button class="negbutton" id="genclearbut" onclick="clearGen();" style="<?php if($userdata['gender']=='N') echo 'display:none;';?>"><B>X</B></button>
								<input type="radio" name="editgender" id="editgendermale" <?php if($userdata['gender']=='M') echo 'checked';?> onclick="setGen('M');">Male
								<input type="radio" name="editgender" id="editgenderfemale" <?php if($userdata['gender']=='F') echo 'checked';?> onclick="setGen('F');">Female
								
								</td>
							</tr>
						</table>				
						
					</div>

					<div class="container" id="contcont">
						<span class="tstyle2">Contact</span><br><br>

						<table border="0">
							<tr>
								<td><label for="editemail">Email</label></td>
								<td><input disabled type="text" id="editemail" class="tstyle3" value="<?php echo $userdata['email'];?>"></td>
							</tr>

							<tr>
								<td><label for="editphone">Phone</label></td>
								<td><input type="text" id="editphone" class="tstyle3" placeholder="Not specified" <?php if($userdata['phone']!='N') echo 'value="'.$userdata['phone'].'"'; ?>></td>
							</tr>

							<tr>
								<td><label for="editaddress">Address</label></td>
								<td><textarea id="editaddress" class="tstyle3" placeholder="Not specified"><?php if($userdata['address']!='N') echo $userdata['address']; ?></textarea>
								</td>
							</tr>

							<tr>
								<td><label for="editpin">Pincode</label></td>
								<td><input type="text" id="editpincode" class="tstyle3"  placeholder="Not specified" <?php if($userdata['pincode']!='N') echo 'value="'.$userdata['pincode'].'"'; ?>>
								</td>
							</tr>

							<tr>
								<td><label for="editcountry">Country</label></td>
								<td>
								<select id="editcountry" class="tstyle3" value="">

								<option value="N">Not specified</option>
								<option value="Afghanistan">Afghanistan</option>
								<option value="Albania">Albania</option>
								<option value="Algeria">Algeria</option>
								<option value="American Samoa">American Samoa</option>
								<option value="Andorra">Andorra</option>
								<option value="Angola">Angola</option>
								<option value="Anguilla">Anguilla</option>
								<option value="Antarctica">Antarctica</option>
								<option value="Antigua and Barbuda">Antigua and Barbuda</option>
								<option value="Argentina">Argentina</option>
								<option value="Armenia">Armenia</option>
								<option value="Aruba">Aruba</option>
								<option value="Australia">Australia</option>
								<option value="Austria">Austria</option>
								<option value="Azerbaijan">Azerbaijan</option>
								<option value="Bahamas">Bahamas</option>
								<option value="Bahrain">Bahrain</option>
								<option value="Bangladesh">Bangladesh</option>
								<option value="Barbados">Barbados</option>
								<option value="Belarus">Belarus</option>
								<option value="Belgium">Belgium</option>
								<option value="Belize">Belize</option>
								<option value="Benin">Benin</option>
								<option value="Bermuda">Bermuda</option>
								<option value="Bhutan">Bhutan</option>
								<option value="Bolivia">Bolivia</option>
								<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
								<option value="Botswana">Botswana</option>
								<option value="Bouvet Island">Bouvet Island</option>
								<option value="Brazil">Brazil</option>
								<option value="Brunei Darussalam">Brunei Darussalam</option>
								<option value="Bulgaria">Bulgaria</option>
								<option value="Burkina Faso">Burkina Faso</option>
								<option value="Burundi">Burundi</option>
								<option value="Cambodia">Cambodia</option>
								<option value="Cameroon">Cameroon</option>
								<option value="Canada">Canada</option>
								<option value="Cape Verde">Cape Verde</option>
								<option value="Cayman Islands">Cayman Islands</option>
								<option value="Central African Republic">Central African Republic</option>
								<option value="Chad">Chad</option>
								<option value="Chile">Chile</option>
								<option value="China">China</option>
								<option value="Christmas Island">Christmas Island</option>
								<option value="Cocos Islands">Cocos Islands</option>
								<option value="Colombia">Colombia</option>
								<option value="Comoros">Comoros</option>
								<option value="Congo">Congo</option>
								<option value="Cook Islands">Cook Islands</option>
								<option value="Costa Rica">Costa Rica</option>
								<option value="Cote D'ivoire">Cote D'ivoire</option>
								<option value="Croatia">Croatia</option>
								<option value="Cuba">Cuba</option>
								<option value="Cyprus">Cyprus</option>
								<option value="Czech Republic">Czech Republic</option>
								<option value="Denmark">Denmark</option>
								<option value="Djibouti">Djibouti</option>
								<option value="Dominica">Dominica</option>
								<option value="Dominican Republic">Dominican Republic</option>
								<option value="Ecuador">Ecuador</option>
								<option value="Egypt">Egypt</option>
								<option value="El Salvador">El Salvador</option>
								<option value="Equatorial Guinea">Equatorial Guinea</option>
								<option value="Eritrea">Eritrea</option>
								<option value="Estonia">Estonia</option>
								<option value="Ethiopia">Ethiopia</option>
								<option value="Falkland Islands">Falkland Islands</option>
								<option value="Faroe Islands">Faroe Islands</option>
								<option value="Fiji">Fiji</option>
								<option value="Finland">Finland</option>
								<option value="France">France</option>
								<option value="French Guiana">French Guiana</option>
								<option value="French Polynesia">French Polynesia</option>
								<option value="Gabon">Gabon</option>
								<option value="Gambia">Gambia</option>
								<option value="Georgia">Georgia</option>
								<option value="Germany">Germany</option>
								<option value="Ghana">Ghana</option>
								<option value="Gibraltar">Gibraltar</option>
								<option value="Greece">Greece</option>
								<option value="Greenland">Greenland</option>
								<option value="Grenada">Grenada</option>
								<option value="Guadeloupe">Guadeloupe</option>
								<option value="Guam">Guam</option>
								<option value="Guatemala">Guatemala</option>
								<option value="Guernsey">Guernsey</option>
								<option value="Guinea">Guinea</option>
								<option value="Guinea-bissau">Guinea-bissau</option>
								<option value="Guyana">Guyana</option>
								<option value="Haiti">Haiti</option>
								<option value="Honduras">Honduras</option>
								<option value="Hong Kong">Hong Kong</option>
								<option value="Hungary">Hungary</option>
								<option value="Iceland">Iceland</option>
								<option value="India">India</option>
								<option value="Indonesia">Indonesia</option>
								<option value="Iran">Iran</option>
								<option value="Iraq">Iraq</option>
								<option value="Ireland">Ireland</option>
								<option value="Isle of Man">Isle of Man</option>
								<option value="Israel">Israel</option>
								<option value="Italy">Italy</option>
								<option value="Jamaica">Jamaica</option>
								<option value="Japan">Japan</option>
								<option value="Jersey">Jersey</option>
								<option value="Jordan">Jordan</option>
								<option value="Kazakhstan">Kazakhstan</option>
								<option value="Kenya">Kenya</option>
								<option value="Kiribati">Kiribati</option>
								<option value="Korea, Republic of">Korea, Republic of</option>
								<option value="Kuwait">Kuwait</option>
								<option value="Kyrgyzstan">Kyrgyzstan</option>
								<option value="Latvia">Latvia</option>
								<option value="Lebanon">Lebanon</option>
								<option value="Lesotho">Lesotho</option>
								<option value="Liberia">Liberia</option>
								<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
								<option value="Liechtenstein">Liechtenstein</option>
								<option value="Lithuania">Lithuania</option>
								<option value="Luxembourg">Luxembourg</option>
								<option value="Macao">Macao</option>
								<option value="Madagascar">Madagascar</option>
								<option value="Malawi">Malawi</option>
								<option value="Malaysia">Malaysia</option>
								<option value="Maldives">Maldives</option>
								<option value="Mali">Mali</option>
								<option value="Malta">Malta</option>
								<option value="Marshall Islands">Marshall Islands</option>
								<option value="Martinique">Martinique</option>
								<option value="Mauritania">Mauritania</option>
								<option value="Mauritius">Mauritius</option>
								<option value="Mayotte">Mayotte</option>
								<option value="Mexico">Mexico</option>
								<option value="Moldova, Republic of">Moldova, Republic of</option>
								<option value="Monaco">Monaco</option>
								<option value="Mongolia">Mongolia</option>
								<option value="Montenegro">Montenegro</option>
								<option value="Montserrat">Montserrat</option>
								<option value="Morocco">Morocco</option>
								<option value="Mozambique">Mozambique</option>
								<option value="Myanmar">Myanmar</option>
								<option value="Namibia">Namibia</option>
								<option value="Nauru">Nauru</option>
								<option value="Nepal">Nepal</option>
								<option value="Netherlands">Netherlands</option>
								<option value="Netherlands Antilles">Netherlands Antilles</option>
								<option value="New Caledonia">New Caledonia</option>
								<option value="New Zealand">New Zealand</option>
								<option value="Nicaragua">Nicaragua</option>
								<option value="Niger">Niger</option>
								<option value="Nigeria">Nigeria</option>
								<option value="Niue">Niue</option>
								<option value="Norfolk Island">Norfolk Island</option>
								<option value="Northern Mariana Islands">Northern Mariana Islands</option>
								<option value="Norway">Norway</option>
								<option value="Oman">Oman</option>
								<option value="Pakistan">Pakistan</option>
								<option value="Palau">Palau</option>
								<option value="Panama">Panama</option>
								<option value="Papua New Guinea">Papua New Guinea</option>
								<option value="Paraguay">Paraguay</option>
								<option value="Peru">Peru</option>
								<option value="Philippines">Philippines</option>
								<option value="Pitcairn">Pitcairn</option>
								<option value="Poland">Poland</option>
								<option value="Portugal">Portugal</option>
								<option value="Puerto Rico">Puerto Rico</option>
								<option value="Qatar">Qatar</option>
								<option value="Reunion">Reunion</option>
								<option value="Romania">Romania</option>
								<option value="Russian Federation">Russian Federation</option>
								<option value="Rwanda">Rwanda</option>
								<option value="Saint Helena">Saint Helena</option>
								<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
								<option value="Saint Lucia">Saint Lucia</option>
								<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
								<option value="Samoa">Samoa</option>
								<option value="San Marino">San Marino</option>
								<option value="Sao Tome and Principe">Sao Tome and Principe</option>
								<option value="Saudi Arabia">Saudi Arabia</option>
								<option value="Senegal">Senegal</option>
								<option value="Serbia">Serbia</option>
								<option value="Seychelles">Seychelles</option>
								<option value="Sierra Leone">Sierra Leone</option>
								<option value="Singapore">Singapore</option>
								<option value="Slovakia">Slovakia</option>
								<option value="Slovenia">Slovenia</option>
								<option value="Solomon Islands">Solomon Islands</option>
								<option value="Somalia">Somalia</option>
								<option value="South Africa">South Africa</option>
								<option value="South Georgia">South Georgia </option>
								<option value="Spain">Spain</option>
								<option value="Sri Lanka">Sri Lanka</option>
								<option value="Sudan">Sudan</option>
								<option value="Suriname">Suriname</option>
								<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
								<option value="Swaziland">Swaziland</option>
								<option value="Sweden">Sweden</option>
								<option value="Switzerland">Switzerland</option>
								<option value="Syrian Arab Republic">Syrian Arab Republic</option>
								<option value="Taiwan, Province of China">Taiwan, Province of China</option>
								<option value="Tajikistan">Tajikistan</option>
								<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
								<option value="Thailand">Thailand</option>
								<option value="Timor-leste">Timor-leste</option>
								<option value="Togo">Togo</option>
								<option value="Tokelau">Tokelau</option>
								<option value="Tonga">Tonga</option>
								<option value="Trinidad and Tobago">Trinidad and Tobago</option>
								<option value="Tunisia">Tunisia</option>
								<option value="Turkey">Turkey</option>
								<option value="Turkmenistan">Turkmenistan</option>
								<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
								<option value="Tuvalu">Tuvalu</option>
								<option value="Uganda">Uganda</option>
								<option value="Ukraine">Ukraine</option>
								<option value="United Arab Emirates">United Arab Emirates</option>
								<option value="United Kingdom">United Kingdom</option>
								<option value="United States">United States</option>
								<option value="Uruguay">Uruguay</option>
								<option value="Uzbekistan">Uzbekistan</option>
								<option value="Vanuatu">Vanuatu</option>
								<option value="Venezuela">Venezuela</option>
								<option value="Viet Nam">Viet Nam</option>
								<option value="Virgin Islands, British">Virgin Islands, British</option>
								<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
								<option value="Wallis and Futuna">Wallis and Futuna</option>
								<option value="Western Sahara">Western Sahara</option>
								<option value="Yemen">Yemen</option>
								<option value="Zambia">Zambia</option>
								<option value="Zimbabwe">Zimbabwe</option>
								</select>
								<?php 
								echo '<script>$("#editcountry").val("'.$userdata['country'].'");</script>';
								?>
								</td>
							</tr>
						</table>
					</div>					
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

	var prevVal;

	$(".link").click(function(event){
		$(".link").removeClass("pressed");
		$(this).addClass("pressed");
	});

	function clearBday()
	{
		var dataToSend = {"toUpdate" : 'editbday' , "newVal" : ""};
		$.post("snippets/update.php",dataToSend,function(data){
			$("#editbday").val("");
			showNotif("Done!");
			$("#bdayclearbut").hide();
		});
	}

	function setGen(gender)
	{
		var dataToSend = {"toUpdate" : 'editgender' , "newVal" : gender};
		$("#editgenbut").show();
		$.post("snippets/update.php",dataToSend,function(data){
			showNotif("Done!");
			$("#genclearbut").show();
			$("#gns").hide();
		});

	}
	function clearGen()
	{
		var dataToSend = {"toUpdate" : 'editgender' , "newVal" : ""};
		$("#editgenbut").show();
		$.post("snippets/update.php",dataToSend,function(data){
			showNotif("Done!");
			$("#genclearbut").hide();

			location.reload();
		});
	}
	$("input,textarea").click(function(){
		prevVal=$(this).val();
	})
	$("input,textarea,select").blur(function(){
		var cur=this;
		var toUpdate = this.id;
		var newVal = $(this).val();

		if(prevVal != newVal)
		{
			showWorking();
			var dataToSend = {"toUpdate" : toUpdate , "newVal" : newVal};
			
			$.post("snippets/update.php",dataToSend,function(data){
				if(data == '1')
				{
					if(toUpdate=="editbday")
					{
						$("#bdayclearbut").show();
					}
					$(cur).val(newVal);
					showNotif("Done!",function(){});
				}
				else
				{
					$(cur).val(prevVal);
					showNotif(data,function(){});
				}

			});
			hideWorking();
		}
		
	});


</script>
</body>