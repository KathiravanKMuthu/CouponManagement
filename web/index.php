<?php
include('api/config/app_config.php');
session_start();
if(isset($_SESSION['login_user'])&&isset($_SESSION['role'])){
//echo $_SESSION['login_user']." ".$_SESSION['role'];
}

?>
<!DOCTYPE html>
<html>
<head>

		<meta charset="UTF-8">
		
		<title>Dinjer Deals | Coupons, Deals, Discounts</title>

        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="images/favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<!--		<link rel="stylesheet" type="text/css" href="css/base.css"> -->
		<link rel="stylesheet" href="css/styl.css">
		<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">


	<noscript>
         For full functionality of this site it is necessary to enable JavaScript. Here are the <a href="http://www.enable-javascript.com/" target="_blank">
		 instructions how to enable JavaScript in your web browser</a>.

    </noscript>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript">

	$(document).ready(function(){

		$(function(){
			var url=window.location.href;
			var activepage=url.substring(url.lastIndexOf('=')+1);
			$('.navbar-nav li a').each(function(){
				var linkpage=this.href.substring(this.href.lastIndexOf('=')+1);
				if(activepage==linkpage){
					$(this).parent().addClass('current');
				}
			});
		});

		$('#myCarouselmer').bind('mousewheel', function(e){
			if(e.originalEvent.wheelDelta /120 > 0) {
				$(this).carousel('next');
			}
			else{
				$(this).carousel('prev');
			}
		});

		function timedown(ti,id){

		var countdown = new Date(ti).getTime();
			var x =setInterval(function(){
				var now =new Date().getTime();
				var distance=countdown-now;
				var seconds = (distance / 1000) | 0;
				distance -= seconds * 1000;
				var minutes = (seconds / 60) | 0;
				seconds -= minutes * 60;
				var hours = (minutes / 60) | 0;
				minutes -= hours * 60;
				var days = (hours / 24) | 0;
				hours -= days * 24;
				var weeks = (days / 7) | 0;
				days -= weeks * 7;
				var ret=(weeks!=0 ? weeks + " WEEKS " : '')+(days!=0 ? days + " DAYS " : '') + (hours!= 0 ? hours + ":" : '')+ (minutes != 0 ? minutes + ":" : '') + seconds + " ";
				document.getElementById(id).innerHTML =ret;
				if(distance<0){
					clearInterval(x);
					var ret="This offer have expired!";
					document.getElementById(id).innerHTML =ret;
				}
			},1000);
	}
	var countdownDivs = document.querySelectorAll('span[data-countdown]');
	for(var i =0; countdownDivs.length>>>0; i++){
		timedown(countdownDivs[i].dataset.countdown,countdownDivs[i].id);
	}



	//	var span =$(this).find('span');
	//	span.countdown(span.attr('data-countdown'));

	/*
	var xmlhttp= new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
	if(this.readyState===4 && this.status===200){
		var arr=this.responseText;
		document.getElementById("viewcat").innerHTML=this.responseText;
	}
	};
    xmlhttp.open("GET","api/categories.php",true);
	xmlhttp.send();
	*/
	});

	</script>

</head>

<body id="body" style="background-color:#e00;">
<?php
		//include('api/config/app_config.php');
		//$table_name="category" ;
		//$response_array = $db->get($table_name);
		//$dts=json_encode($response_array['return_message']);
		//echo $dts;
		//$sd=preg_split('/"/',$dts);
		//echo $sd[7]." ".$sd[19]." ".$sd[31]." ".$sd[43]." ".$sd[55];

		?>
		<!-- <div class="container-fluid"> -->

		<div class="top2-bar">
			<div class=" container">
			<div class="device-lg visible-lg col-md-4 col-lg-5 is-hidden-sm-down">
				<a href="index.php?page=download"><img src="images/dd.png" width="450"></a>
			</div>
			<div class="device-lg visible-lg device-mg visible-mg device-xs visible-xs col-sm-12 col-md-8 col-lg-offset-4 col-lg-3">
			<center>
				<a href="#"><i class="fa fa-gbp"></i>GBP <!--<i class="fa fa-caret-down"></i>--></a>&nbsp;
				<?php if(isset($_SESSION['first_name'])){
						echo '<a href="index.php?page=profile"><i class="fa fa-lock"></i>'.$_SESSION['first_name'].'</a>&nbsp;
							  <a href="index.php?page=signout"><i class="fa fa-user"></i>Logout</a>&nbsp;'; }
								//echo $_SESSION['login_user']." ".$_SESSION['clinic'];
                           else{ echo '<a href="index.php?page=signin"><i class="fa fa-lock"></i>Sign In</a>&nbsp;
				<a href="index.php?page=signup"><i class="fa fa-user"></i>Sign Up</a>&nbsp;';} ?>

			</center>
			</div>
			</div>
		</div>

		<div class="container-fluid" id="header" >
			<div class="container">
                <div class="col-lg-3 col-xs-12" id="brandiv">
					<div class="row" style="position:relative !important;margin-bottom:20% !important;">
					<a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="" width="200"></a>
					</div>
				</div>
				<div class="col-lg-6 col-xs-12" id="header-form">	<!-- col-sm-12  -->
					<form class="" action="index.php?page=deals" role="search" id="top-form" method="post">
						<div class="input-group input-group-lg">
							<input type="text" class="form-control" name="keyword" placeholder="Search Deals/merchants..." value="">
							<select class="form-control" name="category" style="text-transform: capitalize;">
								<option value="null">Select Your Category</option>
								<?php
				$table_name='category';
				$response_array = $db->get($table_name);
				$dts=$response_array['return_message'];
				foreach($dts as $ar){					?>
					<option value="<?php echo $ar['category_id'];?>"><?php echo $ar['category_name'];?></option>
				<?php }		?>

							</select>
							<button type="submit" name="submit" class="form-control btn btn-block" value="srch"><i class="fa fa-search font-12"></i></button>
						</div>
					</form>
				</div>
				<div class="col-lg-3 col-xs-12" style="padding-top:4%;"> <!-- padding-top:3%; -->
					<center>
						<!-- <a href=""><span class="fa fa-heart font-16" style="color:pink;padding-right:3px;"></span><span class="title" onclick="loginAlert('');">Wishlist</span></a>-->
					</center>
				</div>
			</div>
		</div>


		<div class="header-menu">
			<div class="container">
				<nav class="navbar navbar-default" role="navigation">
					<div class="navbar-header" style="float:left;">
						<button type="button" class="navbar-toggle" data-toggle="collapse"	data-target="#example-navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="collapse navbar-collapse" id="example-navbar-collapse">
						<ul class="nav navbar-nav  navber-left">
							<li><a href="index.php?page=home">Home</a></li>
							<!-- <li ><a href="index.php?page=expdeals">Expire Deals</a></li>-->
							<li ><a href="index.php?page=deals">Deals</a></li> <!-- -->
							<li ><a href="index.php?page=merchants">Merchants</a></li>
							<li ><a href="index.php?page=about">About Us</a></li>
							<li ><a href="index.php?page=contact">Contact Us</a></li>
							<li ><a href="index.php?page=faq">FAQ</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right" style="">
							<li class="current"><a href="index.php?page=download">DOWNLOAD</a></li>&nbsp;
				<?php if(isset($_SESSION['first_name'])){
						echo '<li class="current"><a href="index.php?page=mydeals">MY DEALS</a></li>'; }?>

						</ul>
					</div>

				</nav>
			</div>
		</div>


		<div id="maincontent">
            <div class="container-fluid">

                <div class="col-lg-12">
                    <div id="content" class="row" style="// min-height: 1000px;">
                        <?php
                        $p=  filter_input(INPUT_GET,'page');
						$aid=  filter_input(INPUT_GET,'agent_id');
						$page=$p.".php";
                        if(file_exists($page)) {
                            include_once($page);
                        }
                        elseif($p=="errorpage"){
                            echo "Error on page!!!";
				        }
                        else{  include_once 'home.php';    }

						//if($aid!=null){
							// include 'agent_details.php?agent_id='.$aid;
						//}

						?>
                    </div>
			    </div>
            <!-- <div class="row"></div>            -->
            </div>
        </div>



    <footer id="mainFooter" class="main-footer">
            <div class="container">
                <div class="row">
                    <p>Copyright © 2018 . All rights reserved to Deal. <a href="index.php?page=terms_conditions">Terms and conditions</a> <a href="index.php?page=privacy">Privacy Policy</a></p>
                </div>
            </div>
    </footer>

    <script src="js/jquery.countdown.js"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script>
		$(function(){
			$('[data-tooltip]').tooltip();

    $("body").on("click", "#delete", function(){
        //code goes here
    });
	$('#myCarouselmer').bind('mousewheel',function(e){
		if(e.originalEvent.wheelDalta/120 >0){
			$(this).carousel('next');
		}
		else{
			$(this).carousel('prev');
		}
	});

});

	</script>


    </div>
</body>

</html>
