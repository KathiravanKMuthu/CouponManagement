<?php 

$sms=  filter_input(INPUT_GET,'msg');	
$psid=  filter_input(INPUT_GET,'pro_id');	
//echo $_SESSION['user_id'];
//echo date("m/d/y G.i:s<br>", time());

?>
<script src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">     
	
	$(document).ready(function(){
		var dat={action:'user',
		user_id:'<?php echo $_SESSION['user_id'];?>'};
		
		
		//$.get("api/deals.php",{action:"user",user_id:"<?php echo $_SESSION['user_id'];?>"},function(dt){//alert(dt);},"JSON");
		/*$.ajax({
					type:"GET",
					url:"api/deals.php",
					data:JSON.stringify(dat),//"role="+rol+"&mem_email="+id+"&mem_password="+ps,
					//data:JSON.stringify($(this).serializeObject()),
					dataType:"json",
					contentType:"application/json",
					success:function(dt){ 
						//alert(dt['return_code']);
						//alert(dt['return_message']);
						////alert(dt['token']);
						//if(dt['return_code']===1){
						//window.location.href='index.php';
						//}
					}
				});*/
		
	});

    function PrintDiv(id) {  
	   var id	= id;	  
	   //alert(id);
       var divToPrint = document.getElementById('divToPrint'+id);
       var popupWin = window.open('', '_blank', 'width=900,height=800');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
	function PrintQr(id){
			    $('#mymodal'+id).css("background-color","#fff");
                $('#mymodal'+id).css("border-radius","10px");
                $('#mymodal'+id).css("left",($(window).width()/3)+"px"); //Math.max(0,($(window).width()-$("#mymodal").outerWidth()))
                $('#mymodal'+id).css("top",($(window).height()/4)+"px");
                $('#mymodal'+id).width(350);
                $('#mymodal'+id).height(300);            
                $(".modal-body").css("overflow","auto");
                $('#mymodal'+id).modal("show");    
	}
 </script>    
<div class="container">
	<div class="container" style="margin-top:2%;border:1px solid #fff;background-color:#d1d1d1;">
	
		<div class="row" style="padding-top:30px;padding-bottom:40px;padding-right:20px;padding-left:20px;">
			<h3 class="h-title" style="margin-bottom:10px;text-transform:uppercase;border-bottom:2px solid #0f0;">My Deals</h3>
			<?php 
				$query = "SELECT a.*, b.user_id, b.qrcode_string, b.is_redeemed, b.is_wished";
				$query .= " FROM deal_info a, user_deals b WHERE b.deal_id = a.deal_id AND b.user_id = ".$_SESSION['user_id'];
				$response_array = $db->get_by_query($query);
				$dts=$response_array['return_message'];
				if($response_array['return_code']>0){
				foreach($dts as $ar){													
				//echo $ar['deal_id']."\n".$ar['image_dir']."\n".$ar['title']."\n".$ar['description'];}
				?>
		<div id="mymodal<?php echo $ar['deal_id'];?>" class="modal fade" role="dailog" >
			<div class="model-content">   
				<div class="modal-body">
					<center>
					<h4 class="price" style="font-size:15pt;color:#00e100;">Traditional Yoga for Modern Minds</h4>
					<h5>Scar QR-CODE</h5>
					<img src="coder.php?text1=<?php echo $ar['qrcode_string'];?>" width=150;>
					<br>
					<a href="javascript:void(0)" data-dismiss="modal" onclick="window.location.reload();" style="font-size:15pt;">Close</a>
					</center>
				</div>
			</div>
		</div>	
				
			<div id="divToPrint<?php echo $ar['deal_id'];?>" style="display:none;">
                    <div style="width:500px;height:500px;">
                        <div class="media-left is-hidden-sm-down">
                            <figure class="product-thumb">
                                <img src="<?php echo $ar['image_dir'];?>" alt="product">
                            </figure>
                        </div>
                        <div class="">
                            <h5 class="title mb-5 t-uppercase"><?php echo $ar['title'];?></h5>
                        </div>
                        <div class="">
                            <h5 class="title mb-5 t-uppercase"><?php echo $ar['description'];?></h5>
                            <img src="coder.php?text1=<?php echo $ar['qrcode_string'];?>">
                        </div>
                    </div>
			</div>
			<div id="light<?php echo $ar['deal_id'];?>" class="white_content" align="center" style="display:none;">
                <h4 class="price color-green">Traditional Yoga for Modern Minds</h4>
                <h5>Scar QR-CODE</h5>
                <img src="coder.php?text1=<?php echo $ar['qrcode_string'];?>">
                <br>
                <a href="javascript:void(0)" onclick="document.getElementById('#light<?php echo $ar['deal_id'];?>').style.display='none';">Close</a>
            </div>
			<?php }?>
			<div class="table-responsive">
			<table id="cart_list" class="" style=" border-collapse: separate;border-spacing: 0 1em;">
                <tbody>
				<?php 
				$query = "SELECT a.*, b.user_id, b.qrcode_string, b.is_redeemed, b.is_wished";
				$query .= " FROM deal_info a, user_deals b WHERE b.deal_id = a.deal_id AND b.user_id = ".$_SESSION['user_id'];
				$response_array = $db->get_by_query($query);
				$dts=$response_array['return_message'];
				foreach($dts as $ar){													
				//echo $ar['deal_id']."\n".$ar['image_dir']."\n".$ar['title']."\n".$ar['description'];}
				?>
					
					
                    <tr class="" style="background-color:#fff;">
						<td class="col-lg-5">
							<div class="media-left">
                                    <figure class="product-thumb">
										<img src="<?php echo $ar['image_dir']?>" alt="product" style="width:100px;">
                                    </figure>
                            </div>
                                <div class="media-body valign-middle">
                                    <h5 class="title mb-5 t-uppercase" style="margin:5px;text-transform:uppercase;font-size:13pt;">
										<a href="index.php?page=deal_single&pro_id=<?php echo $ar['deal_id'];?>"><?php echo $ar['title']?></a></h5>
                                </div>
						</td>
						<td class="col-lg-4">
							<h5 class="title text-muted" style="margin:5px;text-transform:uppercase;font-size:11pt;width:200px;"><?php echo $ar['description']?><!--</a>--></h5>
                            <h4 class="price" style="color:#0a0;"><?php if($ar['actual_amount']!=""){?><span class="price-sale" style="text-decoration: line-through;padding-right:5px;color:#f00;">£<?php echo $ar['deal_amount'];?></span>£<?php echo $ar['actual_amount'];}?></h4>
                        </td>
						<td class="col-lg-3">
							<a href="javascript:void(0)" onclick="PrintQr(<?php echo $ar['deal_id'];?>)" class="btn btn-rounded btn-lg">Accepted</a> <!-- document.getElementById('light<?php echo $ar['deal_id'];?>').style.display='block';-->
							<a href="javascript:void(0)" onclick="PrintDiv(<?php echo $ar['deal_id'];?>);" class="btn btn-rounded btn-lg">Print</a>
						</td>    
                    </tr>
						
					
					                                        
					<?php }}?>
                    </tbody>
            </table>
			</div>
		</div>
	
	</div>


<br><br><br>

</div>