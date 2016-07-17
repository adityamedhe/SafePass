<!doctype HTML>
<html>
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
				Create a SafePass account
			</div>

			<div id="workspace" align="center">
				<table class="tstyle2 table" border="0" cellpadding="10" style=" margin-top:15px; margin-bottom:15px;">
					
					<tr>
						<td class="badgetd">
							<div class="badge">1</div>
						</td>

						<td class="infotd">							
							Select a username*
						</td>

						<td class="inptd">	
							<input type="text" id="inputname" class="tstyle2">
							
							<ul class="tstyle3"	>
								<li>6-20 characters</li>
								<li>Letters, numbers, and underscores allowed</li>
								<li>Special characters not allowed</li>
							</ul>						
						</td>
					</tr>

					<tr>
						<td class="badgetd">
							<div class="badge">2</div>
						</td>
						<td class="infotd">							
							Enter your email address*
						</td>
						<td class="inptd">	
							<input type="text" id="inputemail" class="tstyle2"><br>	
							<span class="tstyle3">
								Please note that you will not be able to change the email address after you create the account					
							</span>
							
						</td>
					</tr>
					
					<tr class="middletr">
						<td class="badgetd">
							<div class="badge">3</div>
						</td>
						<td class="infotd">							
							Personal details
						</td>
						<td class="inptd">	
						</td>
					</tr>

					<tr class="middletr tstyle3">
						<td class="badgetd">
							
						</td>
						<td class="infotd">							
							First name*
						</td>
						<td class="inptd">	
							
							<input type="text" id="inputfirstname" class="tstyle2"><br><br>
							
						</td>
					</tr>
					
					<tr class="middletr tstyle3">
						<td class="badgetd">
							
						</td>
						<td class="infotd">							
							Last name*
						</td>
						<td class="inptd">	
							
							<input type="text" id="inputlastname" class="tstyle2"><br><br>
							
						</td>
					</tr>


					<tr class="middletr tstyle3">
						<td class="badgetd">							
						</td>
						<td class="infotd">							
							Gender
						</td>
						<td class="inptd">							
							<input type="radio" name="inputgender" id="inputgendermale" class="tstyle2">Male<br><br>
							<input type="radio" name="inputgender" id="inputgenderfemale" class="tstyle2">Female<br><br>
						</td>
					</tr>

					<tr class=" tstyle3">
						<td class="badgetd">
							
						</td>
						<td class="infotd">							
							Date of birth	<br>
							<span class="tstyle4">MM/DD/YYYY</span>
						</td>
						<td class="inptd">							
							<input type="date" id="inputbirthday" class="tstyle2"><br><br>							
						</td>
					</tr>

						

					<tr class="middletr">
						<td class="badgetd">
							<div class="badge">4</div>
						</td>
						<td class="infotd">							
							Contact details
						</td>
						<td class="inptd">	
						</td>
					</tr>

					<tr class="middletr tstyle3">
						<td class="badgetd">
							
						</td>
						<td class="infotd">							
							Phone number
						</td>
						<td class="inptd">							
							<input type="text" id="inputphone" class="tstyle2"><br><br>
						</td>
					</tr>

					<tr class="middletr tstyle3">
						<td class="badgetd">
							
						</td>
						<td class="infotd">							
							Address
						</td>
						<td class="inptd">							
							<textarea style="height:150px; width:300px;" id="inputaddress" class="tstyle2"></textarea><br><br>
						</td>
					</tr>

					<tr class="middletr tstyle3">
						<td class="badgetd">
							
						</td>
						<td class="infotd">							
							Pin code
						</td>
						<td class="inptd">							
							<input id="inputpin" class="tstyle2"></input><br><br>
						</td>
					</tr>

					<tr class="middletr tstyle3">
						<td class="badgetd">
							
						</td>
						<td class="infotd">							
							Country
						</td>
						<td class="inptd">							
							<select id="inputcountry" class="tstyle3">
								<option value="N">Select your country</option>
								<option value="Afghanistan">Afghanistan</option>
								<option value="Åland Islands">Åland Islands</option>
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
								<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
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
								<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
								<option value="Colombia">Colombia</option>
								<option value="Comoros">Comoros</option>
								<option value="Congo">Congo</option>
								<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
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
								<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
								<option value="Faroe Islands">Faroe Islands</option>
								<option value="Fiji">Fiji</option>
								<option value="Finland">Finland</option>
								<option value="France">France</option>
								<option value="French Guiana">French Guiana</option>
								<option value="French Polynesia">French Polynesia</option>
								<option value="French Southern Territories">French Southern Territories</option>
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
								<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
								<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
								<option value="Honduras">Honduras</option>
								<option value="Hong Kong">Hong Kong</option>
								<option value="Hungary">Hungary</option>
								<option value="Iceland">Iceland</option>
								<option value="India">India</option>
								<option value="Indonesia">Indonesia</option>
								<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
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
								<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
								<option value="Korea, Republic of">Korea, Republic of</option>
								<option value="Kuwait">Kuwait</option>
								<option value="Kyrgyzstan">Kyrgyzstan</option>
								<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
								<option value="Latvia">Latvia</option>
								<option value="Lebanon">Lebanon</option>
								<option value="Lesotho">Lesotho</option>
								<option value="Liberia">Liberia</option>
								<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
								<option value="Liechtenstein">Liechtenstein</option>
								<option value="Lithuania">Lithuania</option>
								<option value="Luxembourg">Luxembourg</option>
								<option value="Macao">Macao</option>
								<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
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
								<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
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
								<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
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
								<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
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
								<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
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
								<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
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
						</td>
					</tr>
				</table>
			</div>
		
		<div id="footer">			
			<button class="negbutton" id="but_uname_cancel" style="float:left;" onclick="window.location='../../'">Cancel</button>
			<button class="posbutton" id="but_uname_done" style="float:right;" onclick='validate();'>Done</button>
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
			<button class="posbutton" style="float:right;" onclick='hideDialog();'>Okay</button>

		</div>
		</div>

	</div>

	

	<script>

	function validate()
		{
			showWorking();			
			
			var fname=$("#inputfirstname").val();
			var lname=$("#inputlastname").val();
			var uname=$("#inputname").val();
			var email=$("#inputemail").val();

			var gender;
			if(document.getElementById("inputgendermale").checked==true)
				gender="M";
			else if (document.getElementById("inputgenderfemale").checked==true)
			 	gender="F";
			else
				gender="N";
			
			var bday=$("#inputbirthday").val();
			var phone=$("#inputphone").val();
			var address=$("#inputaddress").val();
			var pin=$("#inputpin").val();
			var country=$("#inputcountry").val();

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

			$.post("validate.php",dataToSend,function(data){
				if(data=='1')
				{
					showNotif("Your account has been created successfully! Please wait...",function(){
						window.location="uploadPhoto.php";
					});
				}
				else
				{
					showDialog("Something went wrong there!",data,1);
				}
			});
			hideWorking();			
		}
	</script>
</body>
