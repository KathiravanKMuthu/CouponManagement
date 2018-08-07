<?php
include 'config/dbconfig.php';
$error="";
session_start();

if(filter_input(INPUT_SERVER,'REQUEST_METHOD')=="POST"){
	$fname=  mysqli_real_escape_string($mysqli_connection,  filter_input(INPUT_POST,'fname'));
    $lname=  mysqli_real_escape_string($mysqli_connection,  filter_input(INPUT_POST,'lname'));
	$mobil=  mysqli_real_escape_string($mysqli_connection,  filter_input(INPUT_POST,'mobile'));
	$passw=  mysqli_real_escape_string($mysqli_connection,  filter_input(INPUT_POST,'password'));
    
    	$sql="UPDATE user_info SET first_name='$fname',last_name='$lname',phone_number='$mobil',encrypted_password='$passw' WHERE email='$_SESSION[email]'";
		$result=  mysqli_query($mysqli_connection, $sql);
		if(!$result) {   $msg=mysqli_error($mysqli_connection); }
        else { $msg="Entered Data Successfully"; }
	
       
        //header("location:index.php");      ?>
		<meta http-equiv="refresh" content="0;URL='profile.php'"/>
        
    <?php }
	
    else{
        $error="Your login name or password is invalid";
    }
    
?>
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
	function showpas(){
		var x=document.getElementById("passw");
		var y=document.getElementById("passws");
		if(x.type==="password"){x.type="text"; y.classList.remove('fa-eye'); y.classList.add('fa-eye-slash');  }
		else{x.type="password"; y.classList.remove('fa-eye-slash'); y.classList.add('fa-eye');}
	}
	
		
		
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
			
			
			.prof-area{
				background-color:#fff;
			}
			.prof-area .prof-title {
				margin-bottom: 20px;
				padding-left: 3%;;
				padding-bottom: 10px;
				border-bottom: 1px solid #eee;
			}
			.prof-area .col-top {
				margin-bottom:10px;
				border-bottom: 1px dotted #eee;
			}
			.prof-area .lblitem{
				font-weight: normal;
				display: block;				
				margin-left:5%;
				margin-right:10%;
				width: 30%;		
				font-family: Raleway-SemiBold;
				font-size: 20px;
				
			}
			.btn-update{
				margin-left:5%;
				font-family: Poppins-Medium;
				font-size: 18px;
				background-color:#3d3;
				color:#000;
			}
			.btn-update:hover,
			.btn-update:focus{
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
				padding-left: 14%;
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
				margin-top:70%;
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
				background-color: #2196F3;
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
				left: 7px;
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
				margin-left:5%;
				height: 50px;
				width: 90%;				
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
				background: #e6e6e6;
				color: #000;
				border-radius: 3px;
				border:2px solid rgba(211,63,141, 0.6);
				font-family: Raleway-SemiBold;
				font-size: 18px;
				//line-height: 10;//.2		
				
			}
			.field-icon{
				float:right;
				margin-right:40px;
				margin-top:-30px;
				position:relative;
				z-index:2;
													
			}
			.profile-btn{
				width:150px;
				text-align:left;
				text-transform:capitalize;
			}
			.profile-btn .caret{
				position:relative;
				top:calc(50% - 1px);
				left:calc(50%);
				border-top:5px solid red;
				text-transform:capitalize;
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
						<span class="sr-only">Toggle Navigation</span>
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
		 <div class="row">
                    <div class="prof-area panel col-lg-offset-3 col-lg-6">
                        <h3 class="prof-title">Profile</h3>
                        <div class="row col-top">
						<?php if(isset($_SESSION['login_user'])){
							$sqlprof="select first_name,last_name,phone_number,encrypted_password from user_info where email='$_SESSION[email]'";
							$result=  mysqli_query($mysqli_connection, $sqlprof);
							$row = mysqli_fetch_array($result,  MYSQLI_ASSOC);
							$count=  mysqli_num_rows($result);   
							if($count>=1){
						}?>
                            <form class="p-40" action="" method="post">
									<div class="form-group">
                                        <label class="lblitem">First Name</label>
                                        <input type="text" class="input100" name="fname" value="<?php echo $row['first_name']; ?>" autocomplete="off" required>
                                    </div>
									<div class="form-group">
                                        <label class="lblitem">Last Name</label>
                                        <input type="text" class="input100" name="lname" value="<?php echo $row['last_name']; ?>"  autocomplete="off" required>
                                    </div>
									<div class="form-group">
										<label class="lblitem">Mobile No.</label>
                                        <input type="text" class="input100" name="mobile" value="<?php echo $row['phone_number']; ?>" required>
                                    </div>
									<div class="form-group">
										<label class="lblitem">Password</label>
                                        <input type="password" class="input100" id="passw" name="password" value="<?php echo $row['encrypted_password']; ?>" required>
										<span id="passws" toggle="#passw" class="fa fa-fw fa-eye field-icon" onclick="showpas()"></span>
			                         </div>
                                    <button type="submit" name="submit" class="btn btn-defaul btn-lg btn-update">Update</button>
                                </form>
						<?php } ?> 
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