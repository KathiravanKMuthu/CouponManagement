<?php
$sms=  filter_input(INPUT_GET,'msg');	
$ctid=  filter_input(INPUT_GET,'cat_id');	
$word=  filter_input(INPUT_GET,'keywd');	
if(filter_input(INPUT_SERVER,'REQUEST_METHOD')=="POST"){
	if($_POST['submit']=="srch"){
		$cat=$_POST['category'];
		$keyw=$_POST['keyword'];
		if(isset($cat) || isset($keyw)){
			$ctid=$cat;
			$word=$keyw;
		}
}} ?>

<script src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">

	

	
</script>	
<?php if($ctid==""){
	?>							
		<div class="container">
				<div class="section latest-deals-area">
                <header class="header-panel">
                    <h3 class="section-title">Deals	</h3>
                </header>				
                <div class="row row-masnory" >
				<?php 
				$table_name='deal_info';
				$response_array = $db->get($table_name); //'merchant_id=1'
				//$dts=json_encode($response_array['return_message']);
				$dts=$response_array['return_message'];
				foreach($dts as $ar){					
				
				$table_name='merchant_info';
				$where_condition ="merchant_id=".$ar['merchant_id'];				
				$response_array = $db->get($table_name,$where_condition); //'merchant_id=1'
				//$dts=json_encode($response_array['return_message']);
				$dts2=$response_array['return_message'];
				foreach($dts2 as $ar2){					
								
				//echo $ar['category_id']."\n".$ar['category_name']."\n".$ar['seq_no'];?>
					<div class="col-sm-6 col-lg-4">
                        <div class="deal-single">
							<figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="" style="background-image: url(<?php echo $ar['image_dir']?>);">
								<div class="label-discount">-<?php echo $ar['percentage']?>%</div>	
								<div class="deal-actions">   
									<span id="txtHintexpireDeal119">
										<i class="fa fa-heart" onclick="updateFavourite(2, 119, '', 'expireDeal');"></i>
									</span>
									<span>
										<i class="fa fa-share-alt" style="color;#fff;"></i>
									</span>	
									<span>
										<i class="fa fa-camera" data-toggle="modal" href="#lightbox"></i>
									</span>
									<div class="modal fade and carousel slide" id="lightbox">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-body">
													<ol class="carousel-indicators">
														<li data-target="#lightbox" data-slide-to="0" class="active"></li>
														<li data-target="#lightbox" data-slide-to="1"></li>
														<li data-target="#lightbox" data-slide-to="2"></li>
													</ol>
													<div class="carousel-inner">
														<div class="item active">
															<img src="" alt="First slide">
														</div>
														<div class="item">
															<img src="" alt="Second slide">
														</div>
														<div class="item">
															<img src="" alt="Third slide">
															<div class="carousel-caption"><p>even with captions...</p></div>
														</div>
													</div><!-- /.carousel-inner -->
													<a class="left carousel-control" href="#lightbox" role="button" data-slide="prev"><span>&lsaquo;</span></a>
													<a class="right carousel-control" href="#lightbox" role="button" data-slide="next"><span>&rsaquo;</span></a>
												</div><!-- /.modal-body -->
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
								</div>							
								<div class="time-left">
                                    <span>
										<i class="ico fa fa-clock-o mr-10"></i>
										<span id="<?php echo $ar['deal_id']?>" data-countdown="<?php echo $ar['end_date']?>"></span>
									</span>
                                </div>
                                <div class="deal-store-logo">		
                                        <img src="<?php echo $ar2['image_dir']?>" alt="">
                                </div>
						</figure>
							<div class="" style="background-color:white;padding-top:5px;padding-left:20px;padding-right:15px;padding-bottom:10px;">
								<div class="pr-md-10" style="padding-right: 10px;">
                                    <h3 class="deal-title" style="font-size: 20px;text-overflow:ellipsis;overflow:hidden;width:90%;display:inline-block;white-space:nowrap;">
                            			<a style="text-decoration:none;" data-tooltip data-toggle="tooltip" data-placement="bottom" title="" 
										data-original-title="<?php echo $ar['title']?>" href="index.php?page=deal_single&pro_id=<?php echo $ar['deal_id']?>"> <?php echo $ar['title']?></a>                                       
                        			</h3>
                                    <a href="index.php?page=deal_single&pro_id=<?php echo $ar['deal_id'];?>" style="text-decoration:none;">
                                        <h6 style="color:#26CC71;font-size: 14px;"><?php echo $ar2['business_name'];?></h6>
                        				<ul class="deal-meta list-inline mb-10 color-mid" style="margin-bottom:10px;color: #717f86;">
                                            <li style="text-overflow:ellipsis;overflow:hidden;width:90%;display:inline-block;white-space:nowrap;"><i class="ico fa fa-map-marker mr-10"></i><?php echo $ar2['address1'].",".$ar2['state'].",".$ar2['country'].",".$ar2['postal_code'];?></li>
                                        </ul>
                                        <p class="text-muted mb-20" style="text-overflow:ellipsis;overflow:hidden;width:90%;display:inline-block;white-space:nowrap;"><?php echo $ar['description']?></p>
                                    </a>
                                </div>
                                <div class="deal-price pos-r mb-15" style="position:relative;margin-bottom: 15px;">
                                    <ul class="deal-meta list-inline mb-10 color-mid">
                                        <li><i class="ico fa fa-shopping-basket mr-10"></i><?php echo $ar['redemption_count']?> Redeemed</li>
										<li>
											<h3 class="price" style="padding-top:5px;padding-bottom:5px;text-align:right;color: #3BAC44;margin-bottom: 0">
											<span class="price-sale" style="color: #d84523; font-size: 85%;   text-decoration: line-through;
											margin-right: 1em;">£<?php echo $ar['deal_amount']?></span>£<?php echo $ar['actual_amount']?></h3>
                                        </li>
                                    </ul>
                                </div>
                            </div>
					    </div>
                    </div>
				<?php }}?>
                </div>
            </div>
		</div>
		
		
		
		
	<?php }else{ ?>
	<div class="container" style="padding-bottom:60px;padding-top:60px;">
            <div class="page-sidebar col-md-4 col-sm-5 col-xs-12">						                          
                <div class="row row-tb-10">
                        <div class="col-xs-12">
                                        <!-- Search Form -->
                                        <div class="widget search-form panel ptb-30 prl-20" style="padding:20px;">
                                            <div class="widget-body">
                                                <form method="post" action="index.php?page=search#">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="Search for..." name="keyword" required="">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-o" type="submit" name="submit"><i class="fa fa-search font-16"></i></button>
                                                        </span>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End Search Form -->
                        </div>
						<div class="col-xs-12">
                                        <!-- Categories Widget -->
                                        <div class="widget categories-widget panel pt-20 prl-20" style="padding:20px;">
                                            <div class="widget-header">
                                                <h3 class="widget-title h-title" style="background:linear-gradient(to right,green 0%,red 0%,green 0%,red 90%)no-repeat;background-size:100% 2px;background-position:left bottom;" >Categories</h3>
                                            </div>
                                            <div class="widget-body ptb-20">
	                                           	<ul class="nav nav-coupon-category nav-panel" style="background-color:#fff;">
				<?php 
				$table_name='category';
				$response_array = $db->get($table_name); //'merchant_id=1'
				//$dts=json_encode($response_array['return_message']);
				$dts=$response_array['return_message'];
				foreach($dts as $ar){					
					?>
				<li><a href="index.php?page=deals&cat_id=<?php echo $ar['category_id'];?>"><i class="fa fa-circle-thin" style="padding-right:10px;"></i><?php echo $ar['category_name'];?></a></li><!-- <span>10</span>-->
				<?php }		?>
												</ul>
                                            </div>
                                        </div>
                        </div>                          
                    </div>
                
            </div>
						
             <div class="page-content col-xs-12 col-sm-7 col-md-8">                           
				<div class="section latest-deals-area">
                <header class="header-panel" style="display:none;"><h3 class="section-title">Deals</h3></header>				
						<div class="row row-masnory" >
				<?php 
				if($word==""){
				$table_name='deal_info';
				$where_condition ="parent_deal_id=".$ctid;				
				$response_array = $db->get($table_name,$where_condition); //'merchant_id=1'
				//$dts=json_encode($response_array['return_message']);
				$dts=$response_array['return_message'];
				if($response_array['return_code']>0){
				foreach($dts as $ar){					
				
				$table_name='merchant_info';
				$where_condition ="merchant_id=".$ar['merchant_id'];				
				$response_array = $db->get($table_name,$where_condition); //'merchant_id=1'
				//$dts=json_encode($response_array['return_message']);
				$dts2=$response_array['return_message'];
				foreach($dts2 as $ar2){					
				?>
					<div class="col-sm-6 col-lg-6">
                        <div class="deal-single">
							<figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="" style="background-image: url(<?php echo $ar['image_dir']?>);">
								<div class="label-discount">-<?php echo $ar['percentage']?>%</div>	
								<div class="deal-actions">   
									<span id="txtHintexpireDeal119">
										<i class="fa fa-heart" onclick="updateFavourite(2, 119, '', 'expireDeal');"></i>
									</span>
									<span>
										<i class="fa fa-share-alt" style="color;#fff;"></i>
									</span>	
									<span>
										<i class="fa fa-camera" data-toggle="modal" href="#lightbox"></i>
									</span>
									<div class="modal fade and carousel slide" id="lightbox">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-body">
													<ol class="carousel-indicators">
														<li data-target="#lightbox" data-slide-to="0" class="active"></li>
														<li data-target="#lightbox" data-slide-to="1"></li>
														<li data-target="#lightbox" data-slide-to="2"></li>
													</ol>
													<div class="carousel-inner">
														<div class="item active">
															<img src="" alt="First slide">
														</div>
														<div class="item">
															<img src="" alt="Second slide">
														</div>
														<div class="item">
															<img src="" alt="Third slide">
															<div class="carousel-caption"><p>even with captions...</p></div>
														</div>
													</div><!-- /.carousel-inner -->
													<a class="left carousel-control" href="#lightbox" role="button" data-slide="prev"><span>&lsaquo;</span></a>
													<a class="right carousel-control" href="#lightbox" role="button" data-slide="next"><span>&rsaquo;</span></a>
												</div><!-- /.modal-body -->
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
								</div>							
								<div class="time-left">
                                    <span>
										<i class="ico fa fa-clock-o mr-10"></i>
										<span id="<?php echo $ar['deal_id']?>" data-countdown="<?php echo $ar['end_date']?>"></span>
									</span>
                                </div>
                                <div class="deal-store-logo">		
                                        <img src="<?php echo $ar2['image_dir']?>" alt="">
                                </div>
						</figure>
							<div class="" style="background-color:white;padding-top:5px;padding-left:20px;padding-right:15px;padding-bottom:10px;">
								<div class="pr-md-10" style="padding-right: 10px;">
                                    <h3 class="deal-title" style="font-size: 20px;text-overflow:ellipsis;overflow:hidden;width:90%;display:inline-block;white-space:nowrap;">
                            			<a style="text-decoration:none;" data-tooltip data-toggle="tooltip" data-placement="bottom" title="" 
										data-original-title="<?php echo $ar['title']?>" href="index.php?page=deal_single&pro_id=<?php echo $ar['deal_id']?>"> <?php echo $ar['title']?></a>                                       
                        			</h3>
                                    <a href="index.php?page=deal_single&pro_id=<?php echo $ar['deal_id'];?>" style="text-decoration:none;">
                                        <h6 style="color:#26CC71;font-size: 14px;"><?php echo $ar2['business_name'];?></h6>
                        				<ul class="deal-meta list-inline mb-10 color-mid" style="margin-bottom:10px;color: #717f86;">
                                            <li style="text-overflow:ellipsis;overflow:hidden;width:90%;display:inline-block;white-space:nowrap;"><i class="ico fa fa-map-marker mr-10"></i><?php echo $ar2['address1'].",".$ar2['state'].",".$ar2['country'].",".$ar2['postal_code'];?></li>
                                        </ul>
                                        <p class="text-muted mb-20" style="text-overflow:ellipsis;overflow:hidden;width:90%;display:inline-block;white-space:nowrap;"><?php echo $ar['description']?></p>
                                    </a>
                                </div>
                                <div class="deal-price pos-r mb-15" style="position:relative;margin-bottom: 15px;">
                                    <ul class="deal-meta list-inline mb-10 color-mid">
                                        <li><i class="ico fa fa-shopping-basket mr-10"></i><?php echo $ar['redemption_count']?> Redeemed</li>
										<li>
											<h3 class="price" style="padding-top:5px;padding-bottom:5px;text-align:right;color: #3BAC44;margin-bottom: 0">
											<span class="price-sale" style="color: #d84523; font-size: 85%;   text-decoration: line-through;
											margin-right: 1em;">£<?php echo $ar['deal_amount']?></span>£<?php echo $ar['actual_amount']?></h3>
                                        </li>
                                    </ul>
                                </div>
                            </div>
					    </div>
                    </div>
				<?php }}}
				
				
				}else{
					
					$srcw='"%'.$word.'%"';
					$query="SELECT * FROM deal_info WHERE CONCAT(title, '', description, '') LIKE ".$srcw;
					$response_array = $db->get_by_query($query); 
					$dts=$response_array['return_message'];
					if($response_array['return_code']>0){
					foreach($dts as $ar){					
				
				$table_name='merchant_info';
				$where_condition ="merchant_id=".$ar['merchant_id'];				
				$response_array = $db->get($table_name,$where_condition); //'merchant_id=1'
				//$dts=json_encode($response_array['return_message']);
				$dts2=$response_array['return_message'];
				foreach($dts2 as $ar2){					
				?>
					<div class="col-sm-6 col-lg-6">
                        <div class="deal-single">
							<figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="" style="background-image: url(<?php echo $ar['image_dir']?>);">
								<div class="label-discount">-<?php echo $ar['percentage']?>%</div>	
								<div class="deal-actions">   
									<span id="txtHintexpireDeal119">
										<i class="fa fa-heart" onclick="updateFavourite(2, 119, '', 'expireDeal');"></i>
									</span>
									<span>
										<i class="fa fa-share-alt" style="color;#fff;"></i>
									</span>	
									<span>
										<i class="fa fa-camera" data-toggle="modal" href="#lightbox"></i>
									</span>
									<div class="modal fade and carousel slide" id="lightbox">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-body">
													<ol class="carousel-indicators">
														<li data-target="#lightbox" data-slide-to="0" class="active"></li>
														<li data-target="#lightbox" data-slide-to="1"></li>
														<li data-target="#lightbox" data-slide-to="2"></li>
													</ol>
													<div class="carousel-inner">
														<div class="item active">
															<img src="" alt="First slide">
														</div>
														<div class="item">
															<img src="" alt="Second slide">
														</div>
														<div class="item">
															<img src="" alt="Third slide">
															<div class="carousel-caption"><p>even with captions...</p></div>
														</div>
													</div><!-- /.carousel-inner -->
													<a class="left carousel-control" href="#lightbox" role="button" data-slide="prev"><span>&lsaquo;</span></a>
													<a class="right carousel-control" href="#lightbox" role="button" data-slide="next"><span>&rsaquo;</span></a>
												</div><!-- /.modal-body -->
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
								</div>							
								<div class="time-left">
                                    <span>
										<i class="ico fa fa-clock-o mr-10"></i>
										<span id="<?php echo $ar['deal_id']?>" data-countdown="<?php echo $ar['end_date']?>"></span>
									</span>
                                </div>
                                <div class="deal-store-logo">		
                                        <img src="<?php echo $ar2['image_dir']?>" alt="">
                                </div>
						</figure>
							<div class="" style="background-color:white;padding-top:5px;padding-left:20px;padding-right:15px;padding-bottom:10px;">
								<div class="pr-md-10" style="padding-right: 10px;">
                                    <h3 class="deal-title" style="font-size: 20px;text-overflow:ellipsis;overflow:hidden;width:90%;display:inline-block;white-space:nowrap;">
                            			<a style="text-decoration:none;" data-tooltip data-toggle="tooltip" data-placement="bottom" title="" 
										data-original-title="<?php echo $ar['title']?>" href="index.php?page=deal_single&pro_id=<?php echo $ar['deal_id']?>"> <?php echo $ar['title']?></a>                                       
                        			</h3>
                                    <a href="index.php?page=deal_single&pro_id=<?php echo $ar['deal_id'];?>" style="text-decoration:none;">
                                        <h6 style="color:#26CC71;font-size: 14px;"><?php echo $ar2['business_name'];?></h6>
                        				<ul class="deal-meta list-inline mb-10 color-mid" style="margin-bottom:10px;color: #717f86;">
                                            <li style="text-overflow:ellipsis;overflow:hidden;width:90%;display:inline-block;white-space:nowrap;"><i class="ico fa fa-map-marker mr-10"></i><?php echo $ar2['address1'].",".$ar2['state'].",".$ar2['country'].",".$ar2['postal_code'];?></li>
                                        </ul>
                                        <p class="text-muted mb-20" style="text-overflow:ellipsis;overflow:hidden;width:90%;display:inline-block;white-space:nowrap;"><?php echo $ar['description']?></p>
                                    </a>
                                </div>
                                <div class="deal-price pos-r mb-15" style="position:relative;margin-bottom:15px;">
                                    <ul class="deal-meta list-inline mb-10 color-mid">
                                        <li><i class="ico fa fa-shopping-basket mr-10"></i><?php echo $ar['redemption_count']?> Redeemed</li>
										<li>
											<h3 class="price" style="padding-top:5px;padding-bottom:5px;text-align:right;color: #3BAC44;margin-bottom: 0">
											<span class="price-sale" style="color: #d84523; font-size: 85%;   text-decoration: line-through;
											margin-right: 1em;">£<?php echo $ar['deal_amount']?></span>£<?php echo $ar['actual_amount']?></h3>
                                        </li>
                                    </ul>
                                </div>
                            </div>
					    </div>
                    </div>
				<?php }}}
				else{?>
				
                <div class="row row-masnory" >
					<div class="col-xs-12">
						<p style="font-size:15pt;background-color:#f1f1f1;border-radius:4px;padding-left:10px;">Your search is not Found !!<br>Maybe your search can be related to below.</p>
					</div>
				<?php 
				$table_name='deal_info';
				$order_by='deal_id LIMIT 16';
				$response_array = $db->get($table_name,$order_by); 
				$dts=$response_array['return_message'];
				foreach($dts as $ar){					
				$table_name='merchant_info';
				$where_condition ="merchant_id=".$ar['merchant_id'];				
				$response_array = $db->get($table_name,$where_condition); 
				$dts2=$response_array['return_message'];
				foreach($dts2 as $ar2){					
				?>
					<div class="col-sm-6 col-lg-6">
                        <div class="deal-single">
							<figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="" style="background-image: url(<?php echo $ar['image_dir']?>);">
								<div class="label-discount">-<?php echo $ar['percentage']?>%</div>	
								<div class="deal-actions">   
									<span id="txtHintexpireDeal119">
										<i class="fa fa-heart" onclick="updateFavourite(2, 119, '', 'expireDeal');"></i>
									</span>
									<span>
										<i class="fa fa-share-alt" style="color;#fff;"></i>
									</span>	
									<span>
										<i class="fa fa-camera" data-toggle="modal" href="#lightbox"></i>
									</span>
									<div class="modal fade and carousel slide" id="lightbox">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-body">
													<ol class="carousel-indicators">
														<li data-target="#lightbox" data-slide-to="0" class="active"></li>
														<li data-target="#lightbox" data-slide-to="1"></li>
														<li data-target="#lightbox" data-slide-to="2"></li>
													</ol>
													<div class="carousel-inner">
														<div class="item active">
															<img src="" alt="First slide">
														</div>
														<div class="item">
															<img src="" alt="Second slide">
														</div>
														<div class="item">
															<img src="" alt="Third slide">
															<div class="carousel-caption"><p>even with captions...</p></div>
														</div>
													</div><!-- /.carousel-inner -->
													<a class="left carousel-control" href="#lightbox" role="button" data-slide="prev"><span>&lsaquo;</span></a>
													<a class="right carousel-control" href="#lightbox" role="button" data-slide="next"><span>&rsaquo;</span></a>
												</div><!-- /.modal-body -->
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
								</div>							
								<div class="time-left">
                                    <span>
										<i class="ico fa fa-clock-o mr-10"></i>
										<span id="<?php echo $ar['deal_id']?>" data-countdown="<?php echo $ar['end_date']?>"></span>
									</span>
                                </div>
                                <div class="deal-store-logo">		
                                        <img src="<?php echo $ar2['image_dir']?>" alt="">
                                </div>
						</figure>
							<div class="" style="background-color:white;padding-top:5px;padding-left:20px;padding-right:15px;padding-bottom:10px;">
								<div class="pr-md-10" style="padding-right: 10px;">
                                    <h3 class="deal-title" style="font-size: 20px;text-overflow:ellipsis;overflow:hidden;width:90%;display:inline-block;white-space:nowrap;">
                            			<a style="text-decoration:none;" data-tooltip data-toggle="tooltip" data-placement="bottom" title="" 
										data-original-title="<?php echo $ar['title']?>" href="index.php?page=deal_single&pro_id=<?php echo $ar['deal_id']?>"> <?php echo $ar['title']?></a>                                       
                        			</h3>
                                    <a href="index.php?page=deal_single&pro_id=<?php echo $ar['deal_id'];?>" style="text-decoration:none;">
                                        <h6 style="color:#26CC71;font-size: 14px;"><?php echo $ar2['business_name'];?></h6>
                        				<ul class="deal-meta list-inline mb-10 color-mid" style="margin-bottom:10px;color: #717f86;">
                                            <li style="text-overflow:ellipsis;overflow:hidden;width:90%;display:inline-block;white-space:nowrap;"><i class="ico fa fa-map-marker mr-10"></i><?php echo $ar2['address1'].",".$ar2['state'].",".$ar2['country'].",".$ar2['postal_code'];?></li>
                                        </ul>
                                        <p class="text-muted mb-20" style="text-overflow:ellipsis;overflow:hidden;width:90%;display:inline-block;white-space:nowrap;"><?php echo $ar['description']?></p>
                                    </a>
                                </div>
                                <div class="deal-price pos-r mb-15" style="position:relative;margin-bottom: 15px;">
                                    <ul class="deal-meta list-inline mb-10 color-mid">
                                        <li><i class="ico fa fa-shopping-basket mr-10"></i><?php echo $ar['redemption_count']?> Redeemed</li>
										<li>
											<h3 class="price" style="padding-top:5px;padding-bottom:5px;text-align:right;color: #3BAC44;margin-bottom: 0">
											<span class="price-sale" style="color: #d84523; font-size: 85%;   text-decoration: line-through;
											margin-right: 1em;">£<?php echo $ar['deal_amount']?></span>£<?php echo $ar['actual_amount']?></h3>
                                        </li>
                                    </ul>
                                </div>
                            </div>
					    </div>
                    </div>
				<?php }}?>
                </div>
            </div>
		</div>
		
				
				<?php			
				}			
				
	 } ?>
                </div>
              </div>
    </div>
                                  
	<?php }?>
	