<?php 

session_start();

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
	
		
		
	</script>
    <style type="text/css">
			body{
				background-color:#d11;
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
				
			.nav-coupon-category li {
				width:300px;
				border:1px solid #000;
			}		
			.nav-coupon-category li a {
				display: block;
				position: relative;
				text-transform: uppercase;
				line-height: 43px;
				height: 43px;
				white-space: nowrap;
				text-overflow: ellipsis;
				color:#fff ; //#717f86
				padding-left: 5px;
				font-size: 13px;
				-webkit-transition: all 200ms linear;
				-ms-transition: all 200ms linear;
				-o-transition: all 200ms linear;
				transition: all 200ms linear;
			}
			@media only screen and (min-width: 1200px) {
			.nav-coupon-category li a {
				line-height: 46px;
				height: 46px;
			}
			}
			.nav-coupon-category .all-cat a {
				padding-right: 20px;
				padding-left: 20px;
				height: 50px;
				line-height: 50px;
			}
			.nav-coupon-category li a .fa {
				font-size: 15px;
				width: 25px;
				margin-right: 5px;
				color: #fff;//#3BAC44
				border-right: 1px solid #ddd;
				text-align: center;
			}
			.nav-coupon-category li a > span {
				margin-left: 0px;
				color: #bfbfbf;
				padding: 1px 7px;
				border-radius: 2px;
				font-size: 11px;
				-webkit-transition: all 200ms linear;
				-ms-transition: all 200ms linear;
				-o-transition: all 200ms linear;
				transition: all 200ms linear;
			}
			.nav-coupon-category li a:hover {
				padding-left: 12px;
				background-color:transparent;
			}
			.nav-coupon-category li a:hover > span {
				margin-left: 10px;
				color: #fff;
				background-color: #2f2 ; //#3BAC44
			}
			.nav-coupon-category li + li {
				border-top: 1px solid #eee;
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
									</center>	
								</div>
								
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
		<div class="row">
		<div class="col-xs-12 col-md-4 col-lg-3">
			<aside>
                <ul class="nav nav-coupon-category nav-panel" >
					<li><a class="font-14" href="deals" >All Categories</a></li> <!--  class="all-cat" -->
                    <li><a><i class="fa fa-cutlery"></i>Beauty &amp; Spa<span>10</span></a></li>
					<li><a><i class="fa fa-cutlery"></i>Cakes<span>2</span></a></li>
					<li><a><i class="fa fa-home"></i>Estate Agents &amp; Home Sales<span>3</span></a></li>
					<li><a><i class="fa fa-shopping-bag"></i>Fashion &amp; Clothing<span>11</span></a></li>
					<li><a><i class="fa fa-cutlery"></i>Healthcare &amp; Well-being<span>4</span></a></li>
					<li><a><i class="fa fa-shopping-cart"></i>Off Licence &amp; Groceries<span>10</span></a></li>
					<li><a><i class="fa fa-shopping-cart"></i>Parcels, Shipping &amp; Deliveries<span>7</span></a></li>
					<li><a><i class="fa fa-beer"></i>Parties &amp; Services <span>13</span></a></li>
					<li><a><i class="fa fa-cutlery"></i>Pubs &amp; Leisure<span>2</span></a></li>
					<li><a><i class="fa fa-cutlery"></i>Restaurants &amp; Fast Food<span>20</span></a></li>
					<li><a><i class="fa fa-print"></i>Technology &amp; Printing <span>10</span></a></li>
					<li><a><i class="fa fa-taxi"></i>Transportation &amp; Minicabs<span>3</span></a></li>
					<li><a><i class="fa fa-circle"></i>Others<span>19</span></a></li>
                </ul>
            </aside>
        </div>
		<div class="col-xs-12 col-md-4 col-lg-9">
			
		</div>
		</div>
		<div class="row" style="paddig-top:20px;border:1px solid #000;background-color:#e00;">
		&nbsp;Footer<br>
		&nbsp;This is footer we can add footer for this page....
		</div>
	</div>
                 
        
		            
    
	<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    
</body>

</html>