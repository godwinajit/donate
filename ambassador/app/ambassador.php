<?php
include ('../../wp-load.php');
?>

<?php //get_header();?>
	<?php get_template_part( 'ambassadorheader' ); ?>
<main class="main maxwidth-100">
<div class="breadcrumbs">
	<div class="wrapper container-fluid">
		<div class="row center-xs">
			<div class="col-xs-10">
				<ul class="breadcrumbs-nav">
					<li><a href="https://globallymealliance.org/">Home</a></li>
					<li>Ambassador program</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="inner-banner"
	style="background-image: url(http://globallymealliance.org/wp-content/uploads/2017/11/ambassador-hero.jpg)"></div>
<div class="container-section">
	<div class="wrapper container-fluid">
		<div class="row center-xs">
			<div class="col-xs-12 col-sm-11 col-md-10">
				<div class="page-title" id="page-title">
					<h2>Get Involved! Become A Lyme Education Ambassador</h2>
					<p>If you are interested in joining the Lyme Education Ambassador
						Program, please answer the questions below carefully. We ask you
						to consider the time and energy you will be able to commit to
						supporting this program before applying. All applicants will be
						carefully screened prior to acceptance as an Ambassador
						representing GLA. A representative from GLA will follow-up with
						each applicant within 2 weeks. We truly appreciate your interest.</p>
				</div>
			</div>
		<div id="step-change-scroll-to"></div>
		</div>
	</div>
</div>
<form id="ambassador-form" action="src/process-ambassador-form.php"
	class="ambassador-form" method="post">
	<ul class="ambassador-form-nav">
		<li class="step-active"><a href="#"> <span class="title">About You</span>
				<span class="number">1</span>
		</a></li>
		<li><a href="#"> <span class="title">Professional and Personal Achievements</span> <span
				class="number">2</span>
		</a></li>
		<li><a href="#"> <span class="title">Your Role as An Education Ambassador</span> <span
				class="number">3</span>
		</a></li>
	</ul>
	<div class="ambassador-form-step active">
		<div class="wrapper container-fluid">
			<div class="row center-xs">
				<div class="col-xs-11 col-md-10">
					<div class="row">
						<div class="col-xs-12 col-md-6 col-md-short">
							<div class="row">
								<div class="col-xs-12 col-sm-6">
									<label>* First name</label> <input type="text"
										name="first_name" required>
								</div>
								<div class="col-xs-12 col-sm-6">
									<label>* Last name</label> <input type="text" name="last_name"
										required>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label>* Birthdate (applicants must be over 18 years old)</label>
								</div>
								<div class="col-xs-4">
									<select name="day" required="" class=""
										aria-required="true" aria-invalid="false">
										<option value="" class="hideme">Day</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
										<option value="24">24</option>
										<option value="25">25</option>
										<option value="26">26</option>
										<option value="27">27</option>
										<option value="28">28</option>
										<option value="29">29</option>
										<option value="30">30</option>
										<option value="31">31</option>
									</select>
								</div>
								<div class="col-xs-4">
									<select name="month" required="" class=""
										aria-required="true" aria-invalid="false">
										<option value="" class="hideme">Month</option>
										<option value="January">January</option>
										<option value="February">February</option>
										<option value="March">March</option>
										<option value="April">April</option>
										<option value="May">May</option>
										<option value="June">June</option>
										<option value="July">July</option>
										<option value="August">August</option>
										<option value="September">September</option>
										<option value="October">October</option>
										<option value="November">November</option>
										<option value="December">December</option>
									</select>
								</div>
								<div class="col-xs-4">
									<select name="year" required="" class=""
										aria-required="true" aria-invalid="false">
										<option value="" class="hideme">Year</option>
										<option value="2007">2007</option>
										<option value="2006">2006</option>
										<option value="2005">2005</option>
										<option value="2004">2004</option>
										<option value="2003">2003</option>
										<option value="2002">2002</option>
										<option value="2001">2001</option>
										<option value="2000">2000</option>
										<option value="1999">1999</option>
										<option value="1998">1998</option>
										<option value="1997">1997</option>
										<option value="1996">1996</option>
										<option value="1995">1995</option>
										<option value="1994">1994</option>
										<option value="1993">1993</option>
										<option value="1992">1992</option>
										<option value="1991">1991</option>
										<option value="1990">1990</option>
										<option value="1989">1989</option>
										<option value="1988">1988</option>
										<option value="1987">1987</option>
										<option value="1986">1986</option>
										<option value="1985">1985</option>
										<option value="1984">1984</option>
										<option value="1983">1983</option>
										<option value="1982">1982</option>
										<option value="1981">1981</option>
										<option value="1980">1980</option>
										<option value="1979">1979</option>
										<option value="1978">1978</option>
										<option value="1977">1977</option>
										<option value="1976">1976</option>
										<option value="1975">1975</option>
										<option value="1974">1974</option>
										<option value="1973">1973</option>
										<option value="1972">1972</option>
										<option value="1971">1971</option>
										<option value="1970">1970</option>
										<option value="1969">1969</option>
										<option value="1968">1968</option>
										<option value="1967">1967</option>
										<option value="1966">1966</option>
										<option value="1965">1965</option>
										<option value="1964">1964</option>
										<option value="1963">1963</option>
										<option value="1962">1962</option>
										<option value="1961">1961</option>
										<option value="1960">1960</option>
										<option value="1959">1959</option>
										<option value="1958">1958</option>
										<option value="1957">1957</option>
										<option value="1956">1956</option>
										<option value="1955">1955</option>
										<option value="1954">1954</option>
										<option value="1953">1953</option>
										<option value="1952">1952</option>
										<option value="1951">1951</option>
										<option value="1950">1950</option>
										<option value="1949">1949</option>
										<option value="1948">1948</option>
										<option value="1947">1947</option>
										<option value="1946">1946</option>
										<option value="1945">1945</option>
										<option value="1944">1944</option>
										<option value="1943">1943</option>
										<option value="1942">1942</option>
										<option value="1941">1941</option>
										<option value="1940">1940</option>
										<option value="1939">1939</option>
										<option value="1938">1938</option>
										<option value="1937">1937</option>
										<option value="1936">1936</option>
										<option value="1935">1935</option>
										<option value="1934">1934</option>
										<option value="1933">1933</option>
										<option value="1932">1932</option>
										<option value="1931">1931</option>
										<option value="1930">1930</option>
										<option value="1929">1929</option>
										<option value="1928">1928</option>
										<option value="1927">1927</option>
										<option value="1926">1926</option>
										<option value="1925">1925</option>
										<option value="1924">1924</option>
										<option value="1923">1923</option>
										<option value="1922">1922</option>
										<option value="1921">1921</option>
										<option value="1920">1920</option>
										<option value="1919">1919</option>
										<option value="1918">1918</option>
										<option value="1917">1917</option>
										<option value="1916">1916</option>
										<option value="1915">1915</option>
										<option value="1914">1914</option>
										<option value="1913">1913</option>
										<option value="1912">1912</option>
										<option value="1911">1911</option>
										<option value="1910">1910</option>
										<option value="1909">1909</option>
										<option value="1908">1908</option>
										<option value="1907">1907</option>
										<option value="1906">1906</option>
										<option value="1905">1905</option>
										<option value="1904">1904</option>
										<option value="1903">1903</option>
										<option value="1902">1902</option>
										<option value="1901">1901</option>
										<option value="1900">1900</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label>* Phone Number</label> <input type="tel" data-rule-number="true" required
										name="telephone_1">
								</div>
								<!-- <div class="col-xs-12 col-sm-6">
									<label>Cellphone</label> <input type="tel" name="cellphone_1">
								</div> -->
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label>* Email</label> <input type="email" name="email"
										placeholder="me@email.com" required>
								</div>
							</div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label>* Address</label> <input type="text" name="address1"
                                                                    required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label>* Country</label>
                                    <select name="country" id="country" required="" aria-required="true" class="jcf-hidden">
                                        <option value="US">United States</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="AG">Antigua And Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA">Bosnia And Herzegovina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="BN">Brunei Darussalam</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CI">Cote Divoire</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GG">Guernsey</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard Islands</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IM">Isle Of Man</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JE">Jersey</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KP">Korea, North</option>
                                        <option value="KR">Korea, South</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Lao</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macao</option>
                                        <option value="MK">Macedonia</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia</option>
                                        <option value="MD">Moldova</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="ME">Montenegro</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN">Netherlands Antilles</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Reunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russian Federation</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="SH">Saint Helena</option>
                                        <option value="KN">Saint Kitts</option>
                                        <option value="LC">Saint Lucia</option>
                                        <option value="MF">Saint Martin</option>
                                        <option value="PM">Saint Pierre</option>
                                        <option value="VC">Saint Vincent</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">Sao Tome And Principe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="RS">Serbia</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syrian Arab Republic</option>
                                        <option value="TW">Taiwan</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad And Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks And Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Viet Nam</option>
                                        <option value="VI">Virgin Islands</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select>
                                </div>
                            </div>
							<div class="row">
								<div class="col-xs-12">
									<label id="cityLabel1">* City</label> <input type="text" name="city" required>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-6" id="stateProvince1">
									<label>* State</label> 
									<select name="state" required="" class="" aria-required="true" aria-invalid="false">
										<option value="" class="hideme">Select one</option>
										<option value="AL">Alabama</option>
										<option value="AK">Alaska</option>
										<option value="AZ">Arizona</option>
										<option value="AR">Arkansas</option>
										<option value="CA">California</option>
										<option value="CO">Colorado</option>
										<option value="CT">Connecticut</option>
										<option value="DE">Delaware</option>
										<option value="DC">District of Columbia</option>
										<option value="FL">Florida</option>
										<option value="GA">Georgia</option>
										<option value="HI">Hawaii</option>
										<option value="ID">Idaho</option>
										<option value="IL">Illinois</option>
										<option value="IN">Indiana</option>
										<option value="IA">Iowa</option>
										<option value="KS">Kansas</option>
										<option value="KY">Kentucky</option>
										<option value="LA">Louisiana</option>
										<option value="ME">Maine</option>
										<option value="MD">Maryland</option>
										<option value="MA">Massachusetts</option>
										<option value="MI">Michigan</option>
										<option value="MN">Minnesota</option>
										<option value="MS">Mississippi</option>
										<option value="MO">Missouri</option>
										<option value="MT">Montana</option>
										<option value="NE">Nebraska</option>
										<option value="NV">Nevada</option>
										<option value="NH">New Hampshire</option>
										<option value="NJ">New Jersey</option>
										<option value="NM">New Mexico</option>
										<option value="NY">New York</option>
										<option value="NC">North Carolina</option>
										<option value="ND">North Dakota</option>
										<option value="OH">Ohio</option>
										<option value="OK">Oklahoma</option>
										<option value="OR">Oregon</option>
										<option value="PA">Pennsylvania</option>
										<option value="RI">Rhode Island</option>
										<option value="SC">South Carolina</option>
										<option value="SD">South Dakota</option>
										<option value="TN">Tennessee</option>
										<option value="TX">Texas</option>
										<option value="UT">Utah</option>
										<option value="VT">Vermont</option>
										<option value="VA">Virginia</option>
										<option value="WA">Washington</option>
										<option value="WV">West Virginia</option>
										<option value="WI">Wisconsin</option>
										<option value="WY">Wyoming</option>
										<option value="AA">Armed Forces Americas</option>
										<option value="AE">Armed Forces Europe</option>
										<option value="AP">Armed Forces Pacific</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-6" id="zippostal1">
									<label>* Zip</label> <input type="text" name="zip"
										required>
								</div>
							</div>
							<!-- <div class="row">
								<div class="col-xs-12">
									<label>Address 2</label> <input type="text" name="address2">
								</div>
							</div> -->							
							<div class="row">
								<div class="col-xs-12">
									<label>* Have you been diagnosed with Lyme and/or other
										tick-borne disease? </label>
									<ul class="options-list">
										<li><input type="radio" id="diagnosed" name="diagnosed"
											value="YES"> <label for="diagnosed1">YES</label></li>
										<li><input type="radio" id="diagnosed2" name="diagnosed"
											checked="checked" required value="NO"> <label for="diagnosed2">NO</label>
										</li>
									</ul>
								</div>
							</div>							
							<div class="row">
								<div class="col-xs-12">
									<label>Has a family member or close friend been diagnosed with Lyme and/or other tick-borne disease? </label>
									<ul class="options-list">
										<li><input type="radio" id="friend_diagnosed" name="friend_diagnosed"
											value="YES"> <label for="friend_diagnosed1">YES</label></li>
										<li><input type="radio" id="friend_diagnosed2" name="friend_diagnosed"
											checked="checked" value="NO"> <label for="friend_diagnosed">NO</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6 col-md-short">
							<div class="row">
								<div class="col-xs-12">
									<label>* Why are you interested in becoming a Lyme Education Ambassador?</label>
									<textarea name="why_inter_edu_amb" required></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label>* How did you hear about Global Lyme Alliance? </label> <select name="how_did"
										class="" aria-invalid="false" required="" aria-required="true" >
										<option value="" class="hideme">Select one</option>
										<option value="opt1">Family member or Friend</option>
										<option value="opt2">Online (article/other website)</option>
										<option value="opt3">Social media (Facebook, Twitter,<br> Instagram, etc.)</option>
										<option value="opt4">Doctor/other medical professional<br> recommendation</option>
										<option value="opt5">The Mighty blog</option>
										<option value="opt6">Google/Search Engine</option>
										<option value="opt7">Another non-profit</option>
										<option value="opt8">Newspaper/Magazine</option>
										<option value="opt9">Health Conference/Expo</option>
										<option value="opt10">Other</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label>How far are you willing to travel to do a presentation or other volunteer opportunity? </label> <select name="how_far"
										class="" aria-invalid="false">
										<option value="" class="hideme">Select one</option>
										<option value="10 miles">10 miles</option>
										<option value="20 miles">20 miles</option>
										<option value="30 miles">30 miles</option>
										<option value="40 miles">40 miles</option>
										<option value="50 miles">50 miles</option>
										<option value="60 miles">60 miles</option>
										<option value="70 miles">70 miles</option>
										<option value="80 miles">80 miles</option>
										<option value="90 miles">90 miles</option>
										<option value="100 miles">100 miles</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label>Do you speak another language fluently?</label>
									<ul class="options-list">
										<li><input type="radio" id="lang1" name="lang" value="YES"> <label
											for="lang1">YES</label></li>
										<li><input type="radio" id="lang2" name="lang"
											checked="checked" value="NO"> <label for="lang2">NO</label></li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label>If yes, what language? (separate with comma)</label> <input
										type="text" name="language_1">
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label>Check any of the following areas that you would also
										like to help with:</label>
									<div class="checkbox-row">
										<input type="checkbox" id="ambassador-check01" name="check01">
										<label for="ambassador-check01">Endurance events</label>
									</div>
									<div class="checkbox-row">
										<input type="checkbox" id="ambassador-check02" name="check02">
										<label for="ambassador-check02">Grassroots events</label>
									</div>
									<div class="checkbox-row">
										<input type="checkbox" id="ambassador-check03" name="check03">
										<label for="ambassador-check03">Local community events (health fairs, etc.)</label>
									</div>
									<div class="checkbox-row">
										<input type="checkbox" id="ambassador-check04" name="check04">
										<label for="ambassador-check04">School presentations</label>
									</div>
									<div class="checkbox-row">
										<input name="check05" placeholder="Other please describe" type="text">
									</div>
								</div>
							</div>
							<div class="form-note" style="display: none">* Complete the
								required fields</div>
						</div>
					</div>

					<div class="row center-xs">
						<div class="col-xs-11 col-md-10">
							<div class="action">
								<button type="submit"
									class="btn btn-primary btn-primary-green btn-continue js-btn-step-next">Continue</button>
							</div>
						</div>
						<div class="col-xs-11 col-md-10">
							If you have trouble submitting the form, please send us an email to <a href="mailto:education@gla.org" target="_top">education@gla.org</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="ambassador-form-step">
		<div class="wrapper container-fluid">
			<div class="row center-xs">
				<div class="col-xs-11 col-md-10">
					<div class="row">
						<div class="col-xs-12 col-md-6 col-md-short">							
							<div class="row">
								<div class="col-xs-12">
									<label>Education</label> <select name="education"
										class="" aria-invalid="false">
										<option value="" class="hideme">Select one</option>
										<option value="opt1">High School/GED</option>
										<option value="opt2">Some College</option>
										<option value="opt3">Associate Degree</option>
										<option value="opt4">Bachelor Degree</option>
										<option value="opt5">Graduate Degree</option>
										<option value="opt6">Doctorate</option>
										<option value="opt7">Other</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label>* Current occupation</label> <input required type="text"
										name="current_occupation_1">
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<label>Office skills? (please list)</label>
									<textarea name="office_skills"></textarea>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6 col-md-short">
							<div class="row">
								<div class="col-xs-12">
									<label>Please list community, civic, professional, political, business, cultural, religious, athletic, social or other organizations you are volunteering or have volunteered your time for which you have not received monetary compensation. Indicate your role and length of time for each.</label>
									<textarea name="please_list_community"></textarea>
								</div>
							</div>
							<div class="form-note" style="display: none">* Complete the
								required fields</div>
						</div>
					</div>
					<div class="row center-xs">
						<div class="col-xs-11 col-md-10">
							<div class="action">
                                <button type="submit" class="btn btn-primary btn-primary-green js-btn-step-prev">Go back</button>
								<button type="submit"
									class="btn btn-primary btn-primary-green btn-continue js-btn-step-next">Continue</button>
							</div>
						</div>
						<div class="col-xs-11 col-md-10">
							If you have trouble submitting the form, please send us an email to <a href="mailto:education@gla.org" target="_top">education@gla.org</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="ambassador-form-step">
		<div class="wrapper container-fluid">
			<div class="row center-xs">
				<div class="col-xs-11 col-md-10">
				<div class="panel">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>* Why do you want to be a GLA Education Ambassador?</label>
								<textarea name="why_gla_edu_amb" required></textarea>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>* Why do you think you would be a good Ambassador?</label>
								<textarea name="msg2" required></textarea>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>* Please describe your comfort level speaking publicly:</label>
								<select name="speaking_publicly" class="" aria-invalid="false" required="" >
									<option value="" class="hideme">Select one</option>
									<option value="opt1">Very comfortable</option>
									<option value="opt2">Somewhat comfortable</option>
									<option value="opt3">Comfortable</option>
									<option value="opt4">Somewhat uncomfortable</option>
									<option value="opt5">Uncomfortable</option>
									<option value="opt6">Not sure</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>Anything else that you would like us to know about you?</label>
								<textarea name="anything_else"></textarea>
							</div>
						</div>
					</div>
					<div class="row"><h2>&nbsp;</h2></div>
					<p style="color: #000 !important;">Please provide at least 2 references, excluding family members and friends, who can speak on behalf of your character, work ethic, and experience.</p>
					<div class="panel">
						<h3>Reference #1:</h3>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>* Full name</label> <input name="ref1_full_name"
									type="text" required>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>* Telephone</label> <input name="ref1_telephone"
									type="text" data-rule-number="true" required>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>* Relationship</label> <input name="ref1_relationship"
									type="text" required>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>* Email</label> <input name="ref1_email" type="email"
									required>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>* Occupation</label> <input name="ref1_occupation"
									type="text" required>
							</div>
						</div>
					</div>
					<div class="panel">
						<h3>Reference #2:</h3>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>* Full name</label> <input name="ref2_full_name"
									type="text" required>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>* Telephone</label> <input name="ref2_telephone"
									type="text" data-rule-number="true" required>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>* Relationship</label> <input name="ref2_relationship"
									type="text" required>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>* Email</label> <input name="ref2_email" type="email"
									required>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>* Occupation</label> <input name="ref2_occupation"
									type="text" required>
							</div>
						</div>
					</div>
					<div class="panel">
						<h3>Reference #3:</h3>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>Full name</label> <input name="ref3_full_name"
									type="text">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>Telephone</label> <input name="ref3_telephone"
									type="text" data-rule-number="true">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>Relationship</label> <input name="ref3_relationship"
									type="text">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>Email</label> <input name="ref3_email" type="email">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-short">
								<label>Occupation</label> <input name="ref3_occupation"
									type="text">
							</div>
						</div>
					</div>
					<div class="form-note" style="display: none">* Complete the
						required fields</div>
				</div>
			</div>
			<div class="row center-xs">
				<div class="col-xs-11 col-md-10">
					<div class="action">
						<button type="submit" class="btn btn-primary btn-primary-green js-btn-step-prev">Go back</button>
						<input type="submit" value="Continue"
							class="btn btn-default btn-continue">
					</div>
				</div>
				<div class="col-xs-11 col-md-10">
							If you have trouble submitting the form, please send us an email to <a href="mailto:education@gla.org" target="_top">education@gla.org</a>
				</div>
			</div>
		</div>
	</div>
</form>
</main>
<!-- Subscribe CTA 
<section class="section-subscribe">
	<div class="wrapper container-fluid">
		<div class="row center-xs">
			<div class="col-xs-12 col-sm-11 col-md-10">
				<div class="subscribe-form">
					<span class="icon icon-mail sm-visible"></span>
					<h2><?php echo get_field('educational_pages_newsletter_text', 4185); ?></h2>
					<div class="form-row">
	                                         <?php echo do_shortcode('[ctct form="7979"]'); ?> 
                                    </div>
				</div>
			</div>
		</div>
	</div>
</section> -->
<script src="js/jquery-1.11.2.min.js"></script>
<script src="/ambassador/app/js/main.js"></script>
<?php get_template_part( 'ambassadorfooter' ); ?>
