<!DOCTYPE html>

<html>
<head>

		<meta charset="UTF-8">
		
		<title>Deal Dio | Coupons, Deals, Discounts</title>
        
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="images/favicon.ico" type="image/x-icon">       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
		<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    

	<noscript>
         For full functionality of this site it is necessary to enable JavaScript. Here are the <a href="http://www.enable-javascript.com/" target="_blank">
		 instructions how to enable JavaScript in your web browser</a>.
        
    </noscript>
	<script type="text/javascript">
	
		
		
	</script>
    <style type="text/css">
	
		@font-face {
			font-family: Poppins-Medium;
			src: url('fonts/poppins/Poppins-Medium.ttf'); 
		}

		
		@font-face {
			font-family: Raleway-SemiBold;
			src: url('fonts/raleway/Raleway-SemiBold.ttf'); 
		}

	
	
	
			body{
				background-color:#f00;
			}
			.navbar-custom{
				background-color:#000;
				border-color:#000;
			}
			.navbar-custom a {
				font-size:16px;
				color:#f11;						
			}
			.navbar-custom ul > li.active a {
					font-size:20px;
					color:#fff; 
					background-color:#f22; 
					border-radius:3px;					
					
			}
			.navbar-custom ul > li.active a:hover{
					font-size:20px;
					color:#af0000;
					background-color:lightwhite;
					border-radius:3px;
					
			}
			.navbar-custom ul > li a:hover{
					font-size:20px;
					color:#af0000;
					background-color:lightwhite;
					border-radius:3px;
			}
			.navbar-custom .navbar-toggle{
				border:1px solid #fff;
			}
			.navbar-custom .navbar-toggle .icon-bar{
				background-color:#fff;
				
			}
			
			.sign-area{
				padding-bottom: 50px;
				background-color:#fff;
			}
			.sign-area .sign-title {
				margin-bottom: 20px;
				padding-left: 3%;;
				padding-bottom: 10px;
				border-bottom: 1px solid #eee;
			}
			.sign-area .col-top {
				margin-bottom:20px;
				border-bottom: 1px dotted #eee;
			}
			.sign-area label {
				font-weight: normal;
			}
			.sign-area .col-top .or {
				text-align: center;
				position: relative;
				top: 20px;
				left: 50%;
				width: 40px;
				line-height: 40px;
				line-width: 40px;
				background-color: #fff;
				margin-right: -20px;
				color: #97a4ad;
				text-transform: uppercase;
			}
			.btn-signup{
				background-color:#3d3;
				color:#000;
				width:80%;
				margin-left:10%;
				font-family: Poppins-Medium;
				font-size: 18px;
			}
			.btn-signup:hover,
			.btn-signup:focus{
				background-color:#1f1;
				color:#fff;
			}
			
			.btn-social {
				font-family: Poppins-Medium;
				font-size: 18px;
			}
			.btn-social .fa {		
				font-size: 20px;
				position: relative;
				right:2px;
			}
			.btn-facebook{
				text-transform: capitalize;
				text-align:center;
				margin-bottom:3%;
				margin-left:38%;
				position: relative;
				border: 0;
				width:60%;
				color:#010;
				background-color: #344e87;
			}
			.btn-facebook:hover,
			.btn-facebook:focus {
				background-color: #0000aa;
				color:#fff;
			}	
			.btn-googleplus{
				text-transform: capitalize;
				margin-bottom:3%;
				margin-left:8%;
				position: relative;
				letter-spacing: 0.5px;
				border: 0;
				width:60%;
				color:#000;
				background-color: #aa4444;
			}
			.btn-googleplus:hover,
			.btn-googleplus:focus {
				background-color: #ff4444;
				color:#fff;
			}
			
			
			.mycheckbox{
				display: block;
				position: relative;
				padding-top:3px;
				padding-left: 15%;
				margin-bottom: 12px;
				cursor: pointer;
				font-size: 16px;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}
			/* Hide the browser's default checkbox */
			.mycheckbox input {
				position: absolute;
				opacity: 0;
				cursor: pointer;
				
			}
			.mycheckbox b{
				margin-left:10%;
				//position: relative;
				opacity: 9;
				cursor: pointer;
				
			}
			/* Create a custom checkbox */
			.checkmark {
				margin-left:10%;
				margin-top:2px;
				position: absolute;
				top: 0;
				left: 0;
				height: 20px;
				width: 20px;
				background-color: #eee;
				border-radius:5px;
			}
			/* On mouse-over, add a grey background color */
			.mycheckbox:hover input ~ .checkmark {
				background-color: #ccc;
				border:1px solid #f1f1f1;
			}
			/* When the checkbox is checked, add a blue background */
			.mycheckbox input:checked ~ .checkmark {
				background-color: #00ff00;
			}
			/* Create the checkmark/indicator (hidden when not checked) */
			.checkmark:after {
				content: "";
				position: absolute;
				display: none;
			}
			/* Show the checkmark when checked */
			.mycheckbox input:checked ~ .checkmark:after {
				display: block;
			}
			/* Style the checkmark/indicator */
			.mycheckbox .checkmark:after {
				left: 8px;
				top: 4px;
				width: 5px;
				height: 10px;
				border: solid white;
				border-width: 0 3px 3px 0;
				-webkit-transform: rotate(45deg);
				-ms-transform: rotate(45deg);
				transform: rotate(45deg);
			}
			
			.input100 {
				display: block;				
				margin-left:10%;				
				height: 50px;
				width: 80%;				
				padding: 0 0 0 10px;
				background: #e6e6e6;
				color: #686868;
				border-radius: 3px;
				border:0px solid #686868;
				font-family: Raleway-SemiBold;
				font-size: 18px;
				line-height: 10;//.2		
				cursor:pointer;
				
			}
			.input100:focus{
				display: block;				
				margin-left:10%;				
				height: 50px;
				width: 80%;				
				padding: 0 0 0 10px;
				background: #e6e6e6;
				color: #000;
				border-radius: 3px;
				border:2px solid rgba(211,63,141, 0.6);
				font-family: Raleway-SemiBold;
				font-size: 18px;
				//line-height: 10;//.2		
				
			}
			
			
	</style>
</head>

<body id="body">
		
		<div id="header" style="background-color:#dd1100;">            
                <div class="container-fluid">					
						<div class="col-lg-3" style="height:140px; padding-left:50px;">
							<a  class="navbar-brand" href="index.php"><img src="images/logo.png" alt="" width="200"></a>						
						</div>
						<div class="col-lg-5"  style="height:140px;padding-top:20px;">							
								<form class="" role="search">
									<div class="form-group">
									<center>
										<input type="text" class="form-control search-input" name="keyword" placeholder="Search Deals/merchants..." value="" style="width:90%;margin-top:2px;">
										<select class="form-control search-select" name="category" style="width:90%;margin-top:2px;">
												<option value="">Select Your Category</option>
												<option value="27">Beauty &amp; Spa</option>
												<option value="29">Cakes</option>
												<option value="23">Estate Agents &amp; Home Sales</option>
												<option value="11">Fashion &amp; Clothing</option>
												<option value="25">Healthcare &amp; Well-being</option>
												<option value="10">Off Licence &amp; Groceries</option>
												<option value="22">Parcels, Shipping &amp; Deliveries</option>
												<option value="20">Parties &amp; Services </option>
												<option value="28">Pubs &amp; Leisure</option>
												<option value="7">Restaurants &amp; Fast Food</option>
												<option value="14">Technology &amp; Printing </option>
												<option value="19">Transportation &amp; Minicabs</option>
												<option value="5">Others</option>   
										</select>
										<button type="submit" name="submit" class="form-control btn btn-search btn-danger" style="width:20%;margin-top:2px;color:#fff;"><i class="fa fa-search font-16"></i></button></center>
									</div>
							</form>
						</div>
						<div class="col-lg-4"  style="padding-top:30px;">
								<div class="col-lg-3" style="padding-top:10px;"><center>
									<a href="wishlist" style="color:#fff;"><span class="fa fa-heart font-16" style="color:pink;padding-right:3px;"></span><span class="title" onclick="loginAlert('');">Wishlist</span></a>
								</center>	</div>
								<div class="col-lg-offset-2 col-lg-5" style="padding-top:10px;">						
									<center>
							<?php if(isset($_SESSION['login_user'])){ 										
									echo '<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle profile-btn" data-toggle="dropdown">'.$_SESSION['login_user'].'
										<span class="caret"></span></button>
										<ul class="dropdown-menu">
										<li><a href="profile.php">profile</a></li>
										<li><a href="signout.php">LogOut</a></li>
										</ul>
										</div>';
							 
										 }//
									else{
										echo '<a href="signin.php" style="color:#00c;">Sign In</a>&nbsp;&nbsp;|&nbsp;
										<a href="signup.php" style="color:#00c;">Sign Up</a>';
										}
                                                  ?>                    
									</center>
								</div>              				          
						</div>
				</div>
		</div>
	    
			<nav class="navbar navbar-custom" role="navigation" id="mainmenu">
			<div class="container">					
			<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
			</div>
			<center>
			<div class="collapse navbar-collapse" id="example-navbar-collapse">
                <ul class="nav navbar-nav navbar-left navbar-text" >						
                    <li><a href="index.php">Home</a></li>
                    <li><a href="deals_expired">Expire Deals</a></li>
                    <li><a href="deals">Deals</a></li>
                    <li><a href="agents">Merchants</a></li>
                    <li><a href="aboutus">About Us</a></li>
                    <li><a href="contact_us">Contact Us</a></li>
                    <li><a href="faq">FAQ</a></li>                              
                </ul>				
				<ul class="nav navbar-nav navbar-right navbar-text" style="padding-right:20px;" >
                <li><a href="download">DOWNLOAD</a></li>
            </ul>
			</div>			
			</center>		
			</div>
        </nav>
    
	<div class="container">
		 
                    <div class="sign-area panel col-lg-offset-3 col-lg-6">
                        <h3 class="sign-title">Sign Up <small>Or <a href="signin.php" class="color-green">Sign In</a></small></h3>
                        <div class="row col-top">
                            <!--<div class="col-sm-6 col-md-7 col-left">    -->
                                <form class="p-40" action="api/singup.php" method="post">
                                    <div class="form-group">
                                        <input type="text" class="input100" name="name" placeholder="First Name" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="input100" name="last_name" placeholder="Last Name">
                                    </div>
									<div class="form-group">
                                        <input type="email" class="input100" name="email" placeholder="Email" required="required">
                                    </div>
							
                                    <div class="form-group">
										<select name="country" class="input100" required="required">
                                            <option value="">Select country</option>
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
									<div class="form-group">
                                        <input type="text" class="input100" name="mobile" placeholder="(XXX) - XXXX - XXX" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="input100" name="password" placeholder="Password" required="required">
                                    </div>
									<div class="form-group">
                                        <input type="password" class="input100" name="cpassword" placeholder="Confirm Password" required="required">
                                    </div>
									<div class="custom-checkbox">
									<label class="mycheckbox"  for="agree_terms">
                                        <input type="checkbox"id="agree_terms" required="required"><span class="checkmark"></span>
                                        I agree to the <a href="https://www.dealdio.com/terms_conditions" class="color-green" target="_blank">Terms of Use</a> and <a href="https://www.dealdio.com/privacy" class="color-green" target="_blank">Privacy Statement</a>.</label>
										
                                    </div>

                                    <input type="submit" class="btn btn-defaul btn-lg btn-signup" name="submit" value="Sign Up">
                                </form>
                                <span class="or">Or</span>
							</div>
							<div class="row">
								    <div class="col-lg-6">
                                        <a href="https://www.facebook.com/v2.2/dialog/oauth?client_id=1634558113321584&amp;state=a28d6649dff6a14e31d06d980c566ebe&amp;response_type=code&amp;sdk=php-sdk-5.6.2&amp;redirect_uri=https%3A%2F%2Fwww.dealdio.com%2Ffb-callback.php&amp;scope=email" class="btn btn-social btn-facebook">
										<i class="fa fa-facebook-square"></i>Facebook</a>
                                    </div>
                                    <div class="col-lg-6">
                                    	<a href="login.php" class="btn btn-social btn-googleplus"><i class="fa fa-google-plus"></i>Google</a>
                                    </div>
                            </div>                            
                                                       
                        </div>
                    </div>
		<div id="backTop" class="back-top is-hidden-sm-down">
			<i class="fa fa-angle-up" aria-hidden="true"></i>
		</div>
        <div class="row-fluid" style="paddig-top:20px;border:1px solid #000;">
		Footer<br>
		</div>   
		
		
		
		
		
		
	</div>
                 
        
		            
    
	<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    
</body>

</html>