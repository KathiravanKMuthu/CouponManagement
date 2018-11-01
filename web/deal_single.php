<?php 
//include('api/config/app_config.php');				
$sms=  filter_input(INPUT_GET,'msg');	
$psid=  filter_input(INPUT_GET,'pro_id');	
//echo $_SESSION['user_id'];
//echo date("m/d/y G.i:s<br>", time());

?>

<script src="js/jquery-3.3.1.min.js"></script>
<script language="javascript" type="text/javascript">
	
	$(document).ready(function(){
		
	var repmsg="<?php if($sms!=""){ echo $sms;}?>";
	var usrid="<?php if(isset($_SESSION['user_id'])) {echo $_SESSION['user_id'];}?>";
	if(repmsg!=""){alert(repmsg);}
		//var usrid=sessionStorage.getItem("user_id");
			//alert(usrid);
		
		$('#dealfrm').on('submit',function(){
			//alert(usrid);
			if(usrid===""){ 
				alert("Please Singin for more.."); 
				$(this).attr('action', 'index.php?page=signin');
			}
			else{	
				/*var dat={
					deal_id:$('#dealchk').val(),
					qrcode_string:$('#qrcode').val(),
					user_id:usrid };
				$.ajax({
					type:"POST",
					url:"api/deals.php",
					data:JSON.stringify(dat),//"role="+rol+"&mem_email="+id+"&mem_password="+ps,
					//data:JSON.stringify($(this).serializeObject()),
					dataType:"json",
					contentType:"application/json",
					success:function(dt){ 
						alert(dt['return_code']);
						alert(dt['return_message']);
						//alert(dt['token']);
						//if(dt['return_code']===1){
						//window.location.href='index.php';
						//}
					}
				}); */	
				$(this).attr('action', 'api/deals.php');	
			}
			
		});
		
		
		/*
		$('#btnsignin').click(function(){
			var dat={
			deal_id:$('#dealchk').val(),
			qrcode_string:$('#qrcode').val(),
			user_id:usrid
			};
			if(typeof(usrid)==="undefined"){ 
				alert("sing in"); 
				$(this).attr('action', 'index.php?page=signin');
			}
			else{	$.ajax({
				type:"POST",
				url:"api/deals.php",
				data:JSON.stringify(dat),//"role="+rol+"&mem_email="+id+"&mem_password="+ps,
				//data:JSON.stringify($(this).serializeObject()),
				dataType:"json",
				contentType:"application/json",
				success:function(dt){ 
					alert(dt['return_code']);
					alert(dt['return_message']);
					//alert(dt['token']);
					//if(dt['return_code']===1){
						
						//window.location.href='index.php';
					//}
				}
			});	}
			
		
		
		});*/
	});
</script>

<div class="container">
			<?php 
				$table_name='deal_info';
				$where_condition ='deal_id='.$psid;
				//$order_by='merchant_id';
				$response_array = $db->get($table_name,$where_condition); 
				$dts=$response_array['return_message'];
				foreach($dts as $ar){					
								
				//echo $ar['deal_id']."\n".$ar['title'];
				?>
	<div class="row">
		<div class="col-lg-8 col-xs-12"  style="">
			<div class="row" style="background-color:#fff;border-radius:4px;margin-top:10px;margin-left:10px;">
				<div class="row" style="margin:0px;background-color:#fff;">
					<img alt="" src="<?php echo $ar['image_dir'];?>" draggable="false" style="width:100%;border-radius:4px;">
				</div>
				<div class="row" style="margin:0px;background-color:#fff;">
					<img alt="" src="<?php echo $ar['image_dir'];?>" draggable="false" style="width:150px;">
					<img alt="" src="<?php echo $ar['image_dir'];?>" draggable="false" style="width:150px;">
					<img alt="" src="<?php echo $ar['image_dir'];?>" draggable="false" style="width:150px;">			
				</div>
				<div class="row"  style="margin:5px;padding-left:5%;padding-top:2%;padding-bottom:3%;padding-right:5%;background-color:#fff;">
					<div class="row"><h4 style="font-size:20px;"><?php echo $ar['title'];?></h4></div>
					<div class="row"><p><?php echo "address";?></p></div>
					<div class="row"><span style="color:#3BAC44;font-size:20pt;">£<?php echo $ar['actual_amount'];?></span></div>
					<div class="row"><p><?php echo $ar['description'];?></p></div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-xs-12" >
			<div class="row"  style="background-color:#fff;margin-top:10px;margin-left:10px;padding-bottom:5%;padding:10px;border-radius:4px;">
				<h3>Deals</h3>
				<form action="" method="post" id="dealfrm">
				<ul style="list-style-type:none;padding:0;">
			<?php 
				$table_name='deal_info';
				$where_condition ='merchant_id='.$ar['merchant_id'];
				$response_array = $db->get($table_name,$where_condition); //'merchant_id=1'
				$dts=$response_array['return_message'];
				foreach($dts as $ar){					
				?>
					<li style="border-bottom:1px solid #f1f1f1;margin-top:5px;">
						<input type="radio" value="<?php echo $ar['deal_id'];?>" name="deal_id" style="margin-right:10px;" id="dealchk" <?php if($ar['deal_id']==$psid){?>checked="checked"<?php }?>><?php echo $ar['title'];?><br>
						<i class="ico fa fa-shopping-basket mr-10" style="margin-right:10px;margin-left:5%;"></i><?php echo $ar['redemption_count'];?> Redeemed
						<div class="breakout-pricing-messages with-discount-messaging price ptb-5 text-right">
							<span class="t-uppercase" data-countdown="2018/09/30 23:59:59">02 Weeks 00 Day 03 : 18 : 57</span>
						</div>
					</li>
				<?php }?>
				</ul>
				 <input type="hidden" value="<?php echo "DATE:".time();?>" name="qrcode_string" id="qrcode">
				<input type="hidden" value="<?php echo $_SESSION['user_id'];?>" name="user_id" id="usrid">
				<input type="submit" class="btn btn-o" value="Accept" name="selection-submit" style="border:2px solid #f00;margin-top:5%;margin-bottom:5%;" onclick="checkid()">
				<form>
			</div>
		</div>
	</div>
	<?php }	?>
	
	
	
	<div class="row" style="margin-top:5%;">
		<div class="col-lg-8" style=""> 
			<div class="row" style="background-color:#fff;margin-top:10px;margin-left:10px;padding:10px;border-radius:4px;"> <!-- margin-top:5%;padding:10px;border-radius:3px;"-->
				<?php 
					$table_name='merchant_info';
					$where_condition ='merchant_id='.$ar['merchant_id'];
					//$order_by='merchant_id';
					//echo $table_name." ".$order_by;
					$response_array = $db->get($table_name,$where_condition); //'merchant_id=1'
					//$dts=json_encode($response_array['return_message']);
					$dts=$response_array['return_message'];
					foreach($dts as $ar){					
						//echo $ar['merchant_id']."\n".$ar['business_name'];
					}
				
				?>
					<h3 style="font-size:17pt;border-bottom:2px solid #f0f0f0;">About Merchant</h3>
					<img alt="" src="<?php echo $ar['image_dir'];?>" draggable="false" style="width:50%;border-radius:4px;padding:10px;float:left;">
					<h3 style="font-size:20px;text-align:center;padding-top:3px;"><?php echo $ar['business_name'];?></h3>
					<p style="font-size:15px;padding:10px;text-align:justify;"><?php echo $ar['description'];?></p>
					<button class="btn btn-info" style="margin:10px;">visit</button>
					
					
				</div>			
		</div>
		<div class="col-lg-4"  style="">
			<div class="row"  style="background-color:#fff;margin-top:10px;margin-left:10px;padding:10px;border-radius:4px;"> <!-- margin-top:5%;padding:10px;border-radius:3px;"-->
			<!-- Contact Us Widget -->
            <div class="widget contact-us-widget">
                <h3 class="widget-title">Got any questions?</h3>
                <div class="widget-body ptb-30">
                    <p class="mb-20 color-mid">If you are having any questions, please feel free to ask.</p>
                    <a href="index.php?page=contact_us" class="btn btn-block btn-o"><i class="mr-10 font-15 fa fa-envelope-o"></i>Drop Us a Line</a>
                </div>
            </div>
            <!-- End Contact Us Widget -->
			</div>
        </div>
		
	</div>
	
	<br><br><br>
				
</div>