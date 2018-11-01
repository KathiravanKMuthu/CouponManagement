<?php
/*include('config/app_config.php');
		$where_condition = $table_column_array['member']['mem_firstname']." = '".$_SESSION['login_user']."'";
        $where_condition .= ' AND '.$table_column_array['member']['id']." = '".$_SESSION['user_id']."'";
		$response_array = $db->get($table_name, $where_condition);
				
		$dts=json_encode($response_array['return_message']);
		//echo $dts."\n";
			
		if(preg_match('.first_name.',$dts)){ 
		$sd=preg_split('/"/',$dts);
		//echo $sd[7];
		}
		*/
?>
<div class="section checkout-area panel col-lg-6 col-lg-offset-2">
    <h2 class="h2 mb-20 h-title">Profile</h2>
        <form class="mb-30" method="post" action="">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter you First Name" value="<?php echo $_SESSION['first_name'];?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Enter your Last Name" value="<?php echo $_SESSION['last_name'];?>">
                    </div>
                </div>
                                        
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Email Id </label>
                        <input type="text" class="form-control" name="email" placeholder="Enter your Email Id" value="<?php echo $_SESSION['mailid'];?>" disabled="disabled">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Country</label>
                        <select name="country" class="form-control">
                            <option>Select country</option>
                            <option value="1">AFGHANISTAN</option>
                            <option value="2">ALBANIA</option>
                            <option value="3">ALGERIA</option>
                            <option value="4">AMERICAN SAMOA</option>
                            <option value="5">ANDORRA</option>
                            <option value="6">ANGOLA</option>
                            <option value="7">ANGUILLA</option>
                            <option value="8">ANTARCTICA</option>
                            <option value="9">ANTIGUA AND BARBUDA</option>
                            <option value="10">ARGENTINA</option>
                            <option value="11">ARMENIA</option>
                                                                                                        <option value="12">ARUBA</option>
                                                                                                        <option value="13">AUSTRALIA</option>
                                                                                                        <option value="14">AUSTRIA</option>
                                                                                                        <option value="15">AZERBAIJAN</option>
                                                                                                        <option value="16">BAHAMAS</option>
                                                                                                        <option value="17">BAHRAIN</option>
                                                                                                        <option value="18">BANGLADESH</option>
                                                                                                        <option value="19">BARBADOS</option>
                                                                                                        <option value="20">BELARUS</option>
                                                                                                        <option value="21">BELGIUM</option>
                                                                                                        <option value="22">BELIZE</option>
                                                                                                        <option value="23">BENIN</option>
                                                                                                        <option value="24">BERMUDA</option>
                                                                                                        <option value="25">BHUTAN</option>
                                                                                                        <option value="26">BOLIVIA</option>
                                                                                                        <option value="27">BOSNIA AND HERZEGOVINA</option>
                                                                                                        <option value="28">BOTSWANA</option>
                                                                                                        <option value="29">BRAZIL</option>
                                                                                                        <option value="30">BRITISH INDIAN OCEAN TERRITORY</option>
                                                                                                        <option value="31">BRUNEI DARUSSALAM</option>
                                                                                                        <option value="32">BULGARIA</option>
                                                                                                        <option value="33">BURKINA FASO</option>
                                                                                                        <option value="34">BURUNDI</option>
                                                                                                        <option value="35">CAMBODIA</option>
                                                                                                        <option value="36">CAMEROON</option>
                                                                                                        <option value="37">CANADA</option>
                                                                                                        <option value="38">CAPE VERDE</option>
                                                                                                        <option value="39">CAYMAN ISLANDS</option>
                                                                                                        <option value="40">CENTRAL AFRICAN REPUBLIC</option>
                                                                                                        <option value="41">CHAD</option>
                                                                                                        <option value="42">CHILE</option>
                                                                                                        <option value="43">CHINA</option>
                                                                                                        <option value="44">CHRISTMAS ISLAND</option>
                                                                                                        <option value="45">COCOS (KEELING) ISLANDS</option>
                                                                                                        <option value="46">COLOMBIA</option>
                                                                                                        <option value="47">COMOROS</option>
                                                                                                        <option value="48">CONGO</option>
                                                                                                        <option value="49">CONGO, THE DEMOCRATIC REPUBLIC OF THE</option>
                                                                                                        <option value="50">COOK ISLANDS</option>
                                                                                                        <option value="51">COSTA RICA</option>
                                                                                                        <option value="52">COTE D'IVOIRE</option>
                                                                                                        <option value="53">CROATIA</option>
                                                                                                        <option value="54">CUBA</option>
                                                                                                        <option value="55">CYPRUS</option>
                                                                                                        <option value="56">CZECH REPUBLIC</option>
                                                                                                        <option value="57">DENMARK</option>
                                                                                                        <option value="58">DJIBOUTI</option>
                                                                                                        <option value="59">DOMINICA</option>
                                                                                                        <option value="60">DOMINICAN REPUBLIC</option>
                                                                                                        <option value="61">ECUADOR</option>
                                                                                                        <option value="62">EGYPT</option>
                                                                                                        <option value="63">EL SALVADOR</option>
                                                                                                        <option value="64">EQUATORIAL GUINEA</option>
                                                                                                        <option value="65">ERITREA</option>
                                                                                                        <option value="66">ESTONIA</option>
                                                                                                        <option value="67">ETHIOPIA</option>
                                                                                                        <option value="68">FALKLAND ISLANDS (MALVINAS)</option>
                                                                                                        <option value="69">FAROE ISLANDS</option>
                                                                                                        <option value="70">FIJI</option>
                                                                                                        <option value="71">FINLAND</option>
                                                                                                        <option value="72">FRANCE</option>
                                                                                                        <option value="73">FRENCH GUIANA</option>
                                                                                                        <option value="74">FRENCH POLYNESIA</option>
                                                                                                        <option value="75">GABON</option>
                                                                                                        <option value="76">GAMBIA</option>
                                                                                                        <option value="77">GEORGIA</option>
                                                                                                        <option value="78">GERMANY</option>
                                                                                                        <option value="79">GHANA</option>
                                                                                                        <option value="80">GIBRALTAR</option>
                                                                                                        <option value="81">GREECE</option>
                                                                                                        <option value="82">GREENLAND</option>
                                                                                                        <option value="83">GRENADA</option>
                                                                                                        <option value="84">GUADELOUPE</option>
                                                                                                        <option value="85">GUAM</option>
                                                                                                        <option value="86">GUATEMALA</option>
                                                                                                        <option value="87">GUINEA</option>
                                                                                                        <option value="88">GUINEA-BISSAU</option>
                                                                                                        <option value="89">GUYANA</option>
                                                                                                        <option value="90">HAITI</option>
                                                                                                        <option value="91">HEARD ISLAND AND MCDONALD ISLANDS</option>
                                                                                                        <option value="92">HOLY SEE (VATICAN CITY STATE)</option>
                                                                                                        <option value="93">HONDURAS</option>
                                                                                                        <option value="94">HONG KONG</option>
                                                                                                        <option value="95">HUNGARY</option>
                                                                                                        <option value="96">ICELAND</option>
                                                                                                        <option value="97">INDIA</option>
                                                                                                        <option value="98">INDONESIA</option>
                                                                                                        <option value="99">IRAN, ISLAMIC REPUBLIC OF</option>
                                                                                                        <option value="100">IRAQ</option>
                                                                                                        <option value="101">IRELAND</option>
                                                                                                        <option value="102">ISRAEL</option>
                                                                                                        <option value="104">ITALY</option>
                                                                                                        <option value="105">JAMAICA</option>
                                                                                                        <option value="106">JAPAN</option>
                                                                                                        <option value="108">JORDAN</option>
                                                                                                        <option value="109">KAZAKHSTAN</option>
                                                                                                        <option value="110">KENYA</option>
                                                                                                        <option value="111">KIRIBATI</option>
                                                                                                        <option value="112">KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF</option>
                                                                                                        <option value="113">KOREA, REPUBLIC OF</option>
                                                                                                        <option value="114">KUWAIT</option>
                                                                                                        <option value="115">KYRGYZSTAN</option>
                                                                                                        <option value="116">LAO PEOPLE'S DEMOCRATIC REPUBLIC</option>
                                                                                                        <option value="117">LATVIA</option>
                                                                                                        <option value="118">LEBANON</option>
                                                                                                        <option value="119">LESOTHO</option>
                                                                                                        <option value="120">LIBERIA</option>
                                                                                                        <option value="121">LIBYAN ARAB JAMAHIRIYA</option>
                                                                                                        <option value="122">LIECHTENSTEIN</option>
                                                                                                        <option value="123">LITHUANIA</option>
                                                                                                        <option value="124">LUXEMBOURG</option>
                                                                                                        <option value="125">MACAO</option>
                                                                                                        <option value="126">MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF</option>
                                                                                                        <option value="127">MADAGASCAR</option>
                                                                                                        <option value="128">MALAWI</option>
                                                                                                        <option value="129">MALAYSIA</option>
                                                                                                        <option value="130">MALDIVES</option>
                                                                                                        <option value="131">MALI</option>
                                                                                                        <option value="132">MALTA</option>
                                                                                                        <option value="133">MARSHALL ISLANDS</option>
                                                                                                        <option value="134">MARTINIQUE</option>
                                                                                                        <option value="135">MAURITANIA</option>
                                                                                                        <option value="136">MAURITIUS</option>
                                                                                                        <option value="137">MAYOTTE</option>
                                                                                                        <option value="138">MEXICO</option>
                                                                                                        <option value="139">MICRONESIA, FEDERATED STATES OF</option>
                                                                                                        <option value="140">MOLDOVA, REPUBLIC OF</option>
                                                                                                        <option value="141">MONACO</option>
                                                                                                        <option value="142">MONGOLIA</option>
                                                                                                        <option value="144">MONTSERRAT</option>
                                                                                                        <option value="145">MOROCCO</option>
                                                                                                        <option value="146">MOZAMBIQUE</option>
                                                                                                        <option value="147">MYANMAR</option>
                                                                                                        <option value="148">NAMIBIA</option>
                                                                                                        <option value="149">NAURU</option>
                                                                                                        <option value="150">NEPAL</option>
                                                                                                        <option value="151">NETHERLANDS</option>
                                                                                                        <option value="152">NETHERLANDS ANTILLES</option>
                                                                                                        <option value="153">NEW CALEDONIA</option>
                                                                                                        <option value="154">NEW ZEALAND</option>
                                                                                                        <option value="155">NICARAGUA</option>
                                                                                                        <option value="156">NIGER</option>
                                                                                                        <option value="157">NIGERIA</option>
                                                                                                        <option value="158">NIUE</option>
                                                                                                        <option value="159">NORFOLK ISLAND</option>
                                                                                                        <option value="160">NORTHERN MARIANA ISLANDS</option>
                                                                                                        <option value="161">NORWAY</option>
                                                                                                        <option value="162">OMAN</option>
                                                                                                        <option value="163">PAKISTAN</option>
                                                                                                        <option value="164">PALAU</option>
                                                                                                        <option value="165">PALESTINIAN TERRITORY, OCCUPIED</option>
                                                                                                        <option value="166">PANAMA</option>
                                                                                                        <option value="167">PAPUA NEW GUINEA</option>
                                                                                                        <option value="168">PARAGUAY</option>
                                                                                                        <option value="169">PERU</option>
                                                                                                        <option value="170">PHILIPPINES</option>
                                                                                                        <option value="171">PITCAIRN</option>
                                                                                                        <option value="172">POLAND</option>
                                                                                                        <option value="173">PORTUGAL</option>
                                                                                                        <option value="174">PUERTO RICO</option>
                                                                                                        <option value="175">QATAR</option>
                                                                                                        <option value="176">ROMANIA</option>
                                                                                                        <option value="177">RUSSIAN FEDERATION</option>
                                                                                                        <option value="178">RWANDA</option>
                                                                                                        <option value="179">REUNION</option>
                                                                                                        <option value="181">SAINT HELENA</option>
                                                                                                        <option value="182">SAINT KITTS AND NEVIS</option>
                                                                                                        <option value="183">SAINT LUCIA</option>
                                                                                                        <option value="185">SAINT PIERRE AND MIQUELON</option>
                                                                                                        <option value="186">SAINT VINCENT AND THE GRENADINES</option>
                                                                                                        <option value="187">SAMOA</option>
                                                                                                        <option value="188">SAN MARINO</option>
                                                                                                        <option value="189">SAO TOME AND PRINCIPE</option>
                                                                                                        <option value="190">SAUDI ARABIA</option>
                                                                                                        <option value="191">SENEGAL</option>
                                                                                                        <option value="192">SERBIA AND MONTENEGRO</option>
                                                                                                        <option value="193">SEYCHELLES</option>
                                                                                                        <option value="194">SIERRA LEONE</option>
                                                                                                        <option value="195">SINGAPORE</option>
                                                                                                        <option value="196">SLOVAKIA</option>
                                                                                                        <option value="197">SLOVENIA</option>
                                                                                                        <option value="198">SOLOMON ISLANDS</option>
                                                                                                        <option value="199">SOMALIA</option>
                                                                                                        <option value="200">SOUTH AFRICA</option>
                                                                                                        <option value="201">SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS</option>
                                                                                                        <option value="202">SPAIN</option>
                                                                                                        <option value="203">SRI LANKA</option>
                                                                                                        <option value="204">SUDAN</option>
                                                                                                        <option value="205">SURINAME</option>
                                                                                                        <option value="206">SVALBARD AND JAN MAYEN</option>
                                                                                                        <option value="207">SWAZILAND</option>
                                                                                                        <option value="208">SWEDEN</option>
                                                                                                        <option value="209">SWITZERLAND</option>
                                                                                                        <option value="210">SYRIAN ARAB REPUBLIC</option>
                                                                                                        <option value="211">TAIWAN, PROVINCE OF CHINA</option>
                                                                                                        <option value="212">TAJIKISTAN</option>
                                                                                                        <option value="213">TANZANIA, UNITED REPUBLIC OF</option>
                                                                                                        <option value="214">THAILAND</option>
                                                                                                        <option value="215">TIMOR-LESTE</option>
                                                                                                        <option value="216">TOGO</option>
                                                                                                        <option value="217">TOKELAU</option>
                                                                                                        <option value="218">TONGA</option>
                                                                                                        <option value="219">TRINIDAD AND TOBAGO</option>
                                                                                                        <option value="220">TUNISIA</option>
                                                                                                        <option value="221">TURKEY</option>
                                                                                                        <option value="222">TURKMENISTAN</option>
                                                                                                        <option value="223">TURKS AND CAICOS ISLANDS</option>
                                                                                                        <option value="224">TUVALU</option>
                                                                                                        <option value="225">UGANDA</option>
                                                                                                        <option value="226">UKRAINE</option>
                                                                                                        <option value="227">UNITED ARAB EMIRATES</option>
                                                                                                        <option value="228" selected="selected">UNITED KINGDOM</option>
                                                                                                        <option value="229">UNITED STATES</option>
                                                                                                        <option value="230">URUGUAY</option>
                                                                                                        <option value="231">UZBEKISTAN</option>
                                                                                                        <option value="232">VANUATU</option>
                                                                                                        <option value="233">VENEZUELA</option>
                                                                                                        <option value="234">VIET NAM</option>
                                                                                                        <option value="235">VIRGIN ISLANDS, BRITISH</option>
                                                                                                        <option value="236">VIRGIN ISLANDS, U.S.</option>
                                                                                                        <option value="237">WALLIS AND FUTUNA</option>
                                                                                                        <option value="238">YEMEN</option>
                                                                                                        <option value="239">ZAMBIA</option>
                                                                                                        <option value="240">ZIMBABWE</option>
                                                                                                    </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>City / Town</label>
                        <input type="text" class="form-control" name="city" placeholder="Enter your City" value="<?php if($_SESSION['city']!=':null,'){echo $_SESSION['city'];}?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" name="mobile" placeholder="(XXX) - XXXX - XXX" value="<?php echo $_SESSION['phone'];?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Postal Code</label>
                        <input type="text" class="form-control" name="zipcode" placeholder="Enter Postal Code" value="<?php if($_SESSION['pcode']!=':null,'){echo $_SESSION['pcode'];}?>">
                    </div>
                </div>

            </div>

            <div class="form-group">
                <label>Address </label>
                <input type="text" class="form-control" name="address" placeholder="Enter your Address" value="<?php if(isset($_SESSION['address'])){echo $_SESSION['address'];}?>">
            </div>

            <div class="form-group">
                <label>Location<span class="color-mid"></span></label>
				<input type="text" class="form-control" name="location" placeholder="Enter your Location" value="<?php echo $_SESSION[''];?>">
            </div>
                                    
            <div class="form-group">
                <input type="submit" class="btn btn-defaul btn-lg btn-prof" name="submit" value="update"> 
				<a href="index.php" class="btn btn-lg btn-rounded mr-10">Skip</a>
            </div>
                                    
		</form> 
    </div>