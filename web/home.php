<?php //include('config/dbconfig.php'); 
//include('api/config/app_config.php');					
?>
<!-- page -->		
		
	<div class="page-container">
        <div class="container">	
            <div class="section deals-header-area" >
                <div class="row">
                    <div class="col-xs-12 col-md-4 col-lg-3">
                        		
						<ul class="nav nav-coupon-category nav-panel" style="background-color:#fff;">
							<li class="all-cat"><a class="font-14" href="index.php?page=deals">All Categories</a></li>
						<?php 
				$table_name='category';
				$response_array = $db->get($table_name); //'merchant_id=1'
				//$dts=json_encode($response_array['return_message']);
				$dts=$response_array['return_message'];
				foreach($dts as $ar){					
								
				//echo $ar['category_id']."\n".$ar['category_name']."\n".$ar['seq_no'];?>
				    <li><a href="index.php?page=deals&cat_id=<?php echo $ar['category_id'];?>"><i class="fa fa-circle-thin" style="padding-right:10px;"></i><?php echo $ar['category_name'];?></a></li><!-- <span>10</span>-->
				<?php }		?>
		        </ul>
                       
                    </div>
					
					
					<div class="col-xs-12 col-md-8 col-lg-9">
						<div class="row" style="margin-top:10px;">
							<div id="myCarousel" class="carousel slide" > 
								<div class="carousel-inner">
						<?php	$table_name='deal_info';
								$order_by='end_date LIMIT 9';
								$where_condition ='is_active=1 AND percentage>15 ';
								$response_array = $db->get($table_name,$where_condition,$order_by); 
								//if($response_array['return_code']>0){
									$dts=$response_array['return_message'];
									$sr=1;
									foreach($dts as $ar){
						$table_name='merchant_info';
				$where_condition ="merchant_id=".$ar['merchant_id'];				
				$response_array = $db->get($table_name,$where_condition); 
				$dts2=$response_array['return_message'];
				
				foreach($dts2 as $ar2){					
				 if($sr==1){$actv="active";}else{$actv=" ";}
								echo '<div class="item '.$actv.'">
										<div class="label-discount">-'.$ar['percentage'].'%</div>
										<img class="item-img img-responsive" src="'.$ar['image_dir'].'" alt="First slide"  >
											<div class="carousel-caption">
												<h2 class="deal-title">
                                                    <a href="index.php?page=deal_single&pro_id='.$ar['deal_id'].'" class="color-light color-h-lighter">'.$ar['title'].'</a>
                                                </h2>
                                                <h3 class="deal-title">
                                                    <a href="index.php?page=deal_single&pro_id='.$ar['deal_id'].'" class="text-muted">'.$ar['description'].'</a>
                                                </h3>                                                
											</div>
									</div>';
									$sr=0;
					 }}?>						
								</div>
							<!-- Carousel nav -->
								<a class="carousel-control left" href="#myCarousel" data-slide="prev" ><span>&lsaquo;</span></a>
								<a class="carousel-control right" href="#myCarousel" data-slide="next" ><span>&rsaquo;</span></a>
							</div>
						</div>
					</div>
                </div>
            </div>
			
			
            <div class="section explain-process-area">
                <div class="row" style="padding-top:10px;">
                    <div class="col-md-4">
                        <div class="item panel">
                            <div class="row row-rl-5 row-xs-cell">
                                <div class="col-xs-4 valign-middle">
                                    <img class="img-responsive" src="images/ven/tablet.png" alt="">
                                </div>
                                <div class="col-xs-8">
                                    <h5 class="mb-10">Deals & Coupons</h5>
                                    <p class="color-mid">You can find the high street deals easily not only shops online merchants deals also available in deal dio. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item panel">
                            <div class="row row-rl-5 row-xs-cell">
                                <div class="col-xs-4 valign-middle">
                                    <img class="img-responsive" src="images/ven/online-shop-6.png" alt="">
                                </div>
                                <div class="col-xs-8">
                                    <h5 class="mb-10 pt-5">Find Best Offers</h5>
                                    <p class="color-mid">The Hot deals that you find nowhere else, only for you in deals dio. Amazing deal that you can claim easily and get more offers as well.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item panel">
						<div class="row row-rl-5 row-xs-cell">
                                <div class="col-xs-4 valign-middle">
                                    <img class="img-responsive" src="images/ven/money.png" alt="">
                                </div>
                                <div class="col-xs-8">
                                    <h5 class="mb-10 pt-5">Save Money</h5>
                                    <p class="color-mid">Deal dio keep calm and save money.  Where penny you save through deal dio matters to us. We provide deals that only save money to our customers.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
				
					<?php 
								$table_name='deal_info';
								$order_by = " end_date ASC";
								$where_condition = ' end_date > NOW() AND end_date <= DATE_ADD(NOW(), INTERVAL 5 DAY) AND parent_deal_id = 0';
								$response_array = $db->get($table_name, $where_condition, $order_by);
								if($response_array['return_code']>0){
									$dts=$response_array['return_message'];
										?>
			<div class="section latest-deals-area">
                <header class="header-panel">
                    <h3 class="section-title">Expiring Deals
                    <a href="index.php?page=deals_expired" class="btn btn-o btn-xs header-panel-btn">View All</a>
					</h3>
                </header>				
				
                <div class="row row-masnory" >
									
					<?php		foreach($dts as $ar){
						$table_name='merchant_info';
				$where_condition ="merchant_id=".$ar['merchant_id'];				
				$response_array = $db->get($table_name,$where_condition); 
				$dts2=$response_array['return_message'];
				foreach($dts2 as $ar2){					
									
								echo '<div class="col-sm-6 col-lg-4">
                        <div class="deal-single">
							<figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="" style="background-image: url('.$ar['image_dir'].');">
								';
								if($ar['percentage']!=0){
									echo '<div class="label-discount">-'.$ar['percentage'].'%</div>	';
								}			
								echo '<div class="deal-actions">   
									<span id="txtHintexpireDeal119">
										<i class="fa fa-heart" onclick="updateFavourite(2, 119, "", "expireDeal");"></i>
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
													<a class="left carousel-control" href="#lightbox" role="button" data-slide="prev"><span>&lsaquo;</span>
													<a class="right carousel-control" href="#lightbox" role="button" data-slide="next"><span>&rsaquo;</span></a>
												</div><!-- /.modal-body -->
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
								</div>							
								<div class="time-left">
                                    <span>
										<i class="ico fa fa-clock-o mr-10"></i>
										<span id="'.$ar['deal_id'].'" data-countdown="'.$ar['end_date'].'"></span>
									</span>
                                </div>
                                <div class="deal-store-logo">
                                        <img src="'.$ar2['image_dir'].'" alt="'.$ar2['business_name'].'">
                                </div>
						
                        </figure>
							<div class="deal-dets">
								<div style="padding-right: 10px;">
                                    <h3 class="deal-title">
                            			<a data-tooltip data-toggle="tooltip" data-placement="bottom" title="" 
										data-original-title="'.$ar['title'].'" href="index.php?page=deal_single&pro_id='.$ar['deal_id'].'" > '.$ar['title'].'</a>                                       
                        			</h3>
                                    <a href="index.php?page=deal_single&pro_id='.$ar['deal_id'].'">
                                        <h6 style="color:#26CC71;font-size: 14px;">'.$ar2['business_name'].'</h6>
                        				<p class="deal-meta">
                                            <i class="ico fa fa-map-marker"></i>'.$ar2['address1'].'
                                        </p>
                                        <p class="text-muted">'.$ar['description'].'</p>
                                    </a>
                                </div>
                                <div class="deal-price pos-r mb-15" style="position:relative;margin-bottom: 15px;">
                                    <ul class="deal-meta list-inline mb-10 color-mid">
                                        <li><i class="ico fa fa-shopping-basket mr-10"></i>'.$ar['redemption_count'].' Redeemed</li>
										<li>
											<h3 class="price" style="padding-top:5px;padding-bottom:5px;text-align:right;color: #3BAC44;margin-bottom: 0">
											<span class="price-sale" style="color: #d84523; font-size: 85%;   text-decoration: line-through;
											margin-right: 1em;">£'.$ar['deal_amount'].'</span>£'.$ar['actual_amount'].'</h3>
                                        </li>
                                    </ul>
                                </div>
                            </div>
					    </div>
                    </div>';
					}	}?>
				</div>
			</div>
								<?php }?>
			
			<div class="section latest-deals-area">
                <header class="header-panel">
                    <h3 class="section-title">Deals
                    <a href="index.php?page=deals" class="btn btn-o btn-xs header-panel-btn">View All</a>
					</h3>
                </header>				
                <div class="row row-masnory" >
					<?php 
								$table_name='deal_info';
								$order_by='end_date LIMIT 12';
								$where_condition ='is_active=1';
								$response_array = $db->get($table_name,$where_condition,$order_by); 
								
									$dts=$response_array['return_message'];
								foreach($dts as $ar){
						$table_name='merchant_info';
				$where_condition ="merchant_id=".$ar['merchant_id'];				
				$response_array = $db->get($table_name,$where_condition); 
				$dts2=$response_array['return_message'];
				foreach($dts2 as $ar2){					
									
								echo '<div class="col-sm-6 col-lg-4">
                        <div class="deal-single">
							<figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="" style="background-image: url('.$ar['image_dir'].');">
								';
								if($ar['percentage']!=0){
									echo '<div class="label-discount">-'.$ar['percentage'].'%</div>	';
								}			
								echo '<div class="deal-actions">   
									<span id="txtHintexpireDeal119">
										<i class="fa fa-heart" onclick="updateFavourite(2, 119, "", "expireDeal");"></i>
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
													<a class="left carousel-control" href="#lightbox" role="button" data-slide="prev"><span>&lsaquo;</span>
													<a class="right carousel-control" href="#lightbox" role="button" data-slide="next"><span>&rsaquo;</span></a>
												</div><!-- /.modal-body -->
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
								</div>							
								<div class="time-left">
                                    <span>
										<i class="ico fa fa-clock-o mr-10"></i>
										<span id="'.$ar['deal_id'].'" data-countdown="'.$ar['end_date'].'"></span>
									</span>
                                </div>
                                <div class="deal-store-logo">
                                        <img src="'.$ar2['image_dir'].'" alt="'.$ar2['business_name'].'">
                                </div>
						
                        </figure>
							<div class="deal-dets">
								<div style="padding-right: 10px;">
                                    <h3 class="deal-title">
                            			<a data-tooltip data-toggle="tooltip" data-placement="bottom" title="" 
										data-original-title="'.$ar['title'].'" href="index.php?page=deal_single&pro_id='.$ar['deal_id'].'" > '.$ar['title'].'</a>                                       
                        			</h3>
                                    <a href="index.php?page=deal_single&pro_id='.$ar['deal_id'].'">
                                        <h6 style="color:#26CC71;font-size: 14px;">'.$ar2['business_name'].'</h6>
                        				<p class="deal-meta">
                                            <i class="ico fa fa-map-marker"></i>'.$ar2['address1'].'
                                        </p>
                                        <p class="text-muted">'.$ar['description'].'</p>
                                    </a>
                                </div>
                                <div class="deal-price pos-r mb-15" style="position:relative;margin-bottom: 15px;">
                                    <ul class="deal-meta list-inline mb-10 color-mid">
                                        <li><i class="ico fa fa-shopping-basket mr-10"></i>'.$ar['redemption_count'].' Redeemed</li>
										<li>
											<h3 class="price" style="padding-top:5px;padding-bottom:5px;text-align:right;color: #3BAC44;margin-bottom: 0">
											<span class="price-sale" style="color: #d84523; font-size: 85%;   text-decoration: line-through;
											margin-right: 1em;">£'.$ar['deal_amount'].'</span>£'.$ar['actual_amount'].'</h3>
                                        </li>
                                    </ul>
                                </div>
                            </div>
					    </div>
                    </div>';
					}			
				
						}?>
                </div>
            </div>
		
			
			<div class="section stores-area">
				
				<header class="header-panel">
                    <h3 class="section-title">Popular Merchants
                    <a href="index.php?page=merchants" class="btn btn-o btn-xs header-panel-btn">All Merchants</a>
					</h3>
                </header>				
				<div id="myCarouselmer" class="carousel slide" data-interval="false" data-type="multi"> 
					<div class="carousel-inner">
					<div class="item active"> 						
					<?php 
								$table_name='merchant_info';
								$order_by='merchant_id';// LIMIT 6
								//echo $table_name." ".$order_by;
								$response_array = $db->get($table_name,$order_by); //'merchant_id=1'
								$dts=$response_array['return_message'];
								//echo sizeof($dts);
								//$dts2=array_chunk($dts,2);
								$dts2=array_slice($dts,0,6);
								foreach($dts2 as $ar){					
									
							echo '<div class="item-list">';?>
								<a href="index.php?page=agent_details&agent_id=<?php echo $ar['merchant_id'];?>" class="thumnail">
								<?php echo	'<img src="'.$ar['image_dir'].'" alt="image" class="img-responsive">
										<h6 class="store-name">
											<marquee behavior="scroll" direction="left" scrolldelay="100" scrollamount="2">'.$ar['business_name'].'</marquee></h6>
								</a>
							</div>';
						}?>
					</div>
					<div class="item"> 
						<?php
						if(sizeof($dts)>6){
								$dts2=array_slice($dts,7,12);
								foreach($dts2 as $ar){					
									
							echo '<div class="item-list">';?>
							
								<a href="index.php?page=agent_details&agent_id=<?php echo $ar['merchant_id'];?>" class="thumnail">
								<?php echo '<img src="'.$ar['image_dir'].'" alt="image" class="img-responsive">
										<h6 class="store-name">
											<marquee behavior="scroll" direction="left" scrolldelay="100" scrollamount="2">'.$ar['business_name'].'</marquee></h6>
								</a>
							</div>';
						}	
					}	?>
					</div>
				</div>
							<!-- Carousel nav -->
								<a class="carousel-control left" href="#myCarouselmer" data-slide="prev"><span>&lsaquo;</span></a>
								<a class="carousel-control right" href="#myCarouselmer" data-slide="next"><span>&rsaquo;</span></a>
				</div>
				
        </div>
		
			
			<div class="section subscribe-area">
                <div class="newsletter-form">
                    <h4><i class="fa fa-envelope-o"></i>Sign up for our weekly email newsletter</h4>
                    <p>Subscribe to our weekly newsletter and check out all of the latest offers and updates first before anyone else!</p>
                    <form method="post" action="index.php#">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email Address" required="">
                            <span class="input-group-btn">
                                <button class="btn form-control" type="submit">Subscribe</button>
                            </span>
                        </div>
                    </form>
                    <p><small>We’ll never share your email address with any third-party. </small> </p>
                </div>
            </div>
			
			
			
			
		
		</div>
	</div>