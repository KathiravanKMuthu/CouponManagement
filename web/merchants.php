<?php 
?>
<div class="container">
	<div class="stores-area" style="">
				<header class="header-panel">
                    <h3 class="section-title">All Merchants
                    <!-- <a href="index.php?page=agents" class="btn btn-o btn-xs header-panel-btn">All Merchants</a> -->
					</h3>
                </header>			
				<div class=" merchants-lists">
				<?php 	
								$table_name='merchant_info';
								$order_by='merchant_id';
								//echo $table_name." ".$order_by;
								$response_array = $db->get($table_name,$order_by); //'merchant_id=1'
								//$dts=json_encode($response_array['return_message']);
									$dts=$response_array['return_message'];
								foreach($dts as $ar){
					echo	'<div class="col-lg-2 col-xs-12" style="margin:2px;padding:0px;width:180px;height:140px;margin-bottom:20px;">
								<div class="merc-list" style="background-color:#f1f1f1;padding:1px;margin:1px;height:100%;">
									<a href="index.php?page=agent_details&agent_id='.$ar['merchant_id'].'" class="thumnail">
										<img src="'.$ar['image_dir'].'" alt="image" style="width:94%;margin-top:5px;">
										<h6 class="store-name" style="margin-top:10px;margin-bottom:0px;font-size:16px;">
										<marquee behavior="scroll" direction="left" scrolldelay="100" scrollamount="2">'.$ar['business_name'].'</marquee></h6>
									</a>
								</div>
							</div>';
							} ?>
				</div>
				<br><br>
	</div>
	<br>
</div>