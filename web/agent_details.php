<?php 
$id=  filter_input(INPUT_GET,'agent_id');
?>
<div class="container">

<?php 	
								$table_name='merchant_info';
								if($id!=""){$where_condition ='merchant_id='.$id;
								$response_array = $db->get($table_name,$where_condition); 								
								}else{
									$response_array = $db->get($table_name); 								
								}
								
								$dts=$response_array['return_message'];
								foreach($dts as $ar){
									echo '
                    <div class="row" style="right:10px;left:10px;margin-top:20px;bottom:20px;">
                        <div class="page-sidebar col-sm-4 col-md-6">
                            <aside class="store-header-area panel t-center" style="text-align:center;">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <figure class="pt-0 pl-0" style="">
                                            <img src="'.$ar['image_dir'].'" alt="" style="width:560px;" class="img-responsive">
                                        </figure>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="store-about ptb-30 prl-10" style="padding-top:30px;padding-bottom:30px;padding-right:10px;padding-left:10px;">
                                            <h3 class="mb-10" style="margin-bottom:10px;">'.$ar['business_name'].'</h3>
                                            <p class="mb-15" style="margin-bottom:15px;">'.$ar['description'].'</p>
											<p class="mb-15" style="margin-bottom:15px;"><strong>OPENING TIMING</strong></p>
											<p class="mb-15" style="margin-bottom:15px;">'.$ar['operating_time'].'<br></p>
                                                    
                                            <a href="'.$ar['website'].'" target="_blank"><button class="btn btn-info">website</button></a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="store-splitter-left">
                                            <header class="left-splitter-header prl-10 ptb-20 bg-lighter">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <h2>10</h2>
                                                        <p>Deals</p>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <h2>1</h2>
                                                        <p>Category</p>
                                                    </div>
                                                </div>
                                            </header>
                                            <ul class="deal-meta list-inline mb-10 color-mid">
                                                <p align=""><i class="ico fa fa-phone mr-10"></i>'.$ar['phone_number'].'</p>
												<p align=""><i class="ico fa fa-map-marker mr-10"></i>'.$ar['address1'].','.$ar['postal_code'].'</p>
												<p></p><div id="googleMap" style="width: 100%; height: 400px; position: relative; overflow: hidden;"><div style="height: 100%; width: 100%;"><div style="overflow: hidden; width: 565px; height: 400px;"></div></div></div><p></p>
                                            
                                                                              
                                            </ul>
                                            <div class="left-splitter-body prl-20 ptb-20">
                                                <div class="row row-rl-10 row-tb-10">
                                                                                                        <div class="col-md-6 col-sm-4 col-xs-6">
                                                                                                            <a class="example-image-link" href="./Dealdio _ FREE Vouchers, Deals, Discounts,37_files/152543962822(1).jpg" data-lightbox="example-set" data-title="">												 														<img class="example-image" src="./Dealdio _ FREE Vouchers, Deals, Discounts,37_files/152543962822(1).jpg" alt=""></a>
                                                                                                    </div>
													                                                    <div class="col-md-6 col-sm-4 col-xs-6">
                                                                                                            <a class="example-image-link" href="./Dealdio _ FREE Vouchers, Deals, Discounts,37_files/152543977033.jpg" data-lightbox="example-set" data-title="">												 														<img class="example-image" src="./Dealdio _ FREE Vouchers, Deals, Discounts,37_files/152543977033.jpg" alt=""></a>
                                                                                                    </div>
													                                                    <div class="col-md-6 col-sm-4 col-xs-6">
                                                                                                            <a class="example-image-link" href="./Dealdio _ FREE Vouchers, Deals, Discounts,37_files/152543983655(2).jpg" data-lightbox="example-set" data-title="">												 														<img class="example-image" src="./Dealdio _ FREE Vouchers, Deals, Discounts,37_files/152543983655(2).jpg" alt=""></a>
                                                                                                    </div>
													                                                    <div class="col-md-6 col-sm-4 col-xs-6">
                                                                                                            <a class="example-image-link" href="./Dealdio _ FREE Vouchers, Deals, Discounts,37_files/152543988366.jpg" data-lightbox="example-set" data-title="">												 														<img class="example-image" src="./Dealdio _ FREE Vouchers, Deals, Discounts,37_files/152543988366.jpg" alt=""></a>
                                                                                                    </div>
													                                                    <div class="col-md-6 col-sm-4 col-xs-6">
                                                                                                            <a class="example-image-link" href="./Dealdio _ FREE Vouchers, Deals, Discounts,37_files/152543994211.jpg" data-lightbox="example-set" data-title="">												 														<img class="example-image" src="./Dealdio _ FREE Vouchers, Deals, Discounts,37_files/152543994211.jpg" alt=""></a>
                                                                                                    </div>
													                                                    
                                                </div>
                                            </div>
                                            <footer class="left-splitter-social prl-20 ptb-20">
                                                <ul class="list-inline social-icons social-icons--colored t-center">
                                                    <li class="social-icons__item">
                                                        <a href="https://www.facebook.com/tamilgifts/" target="_blank"><i class="fa fa-facebook"></i></a>
                                                    </li>
                                                                                                                                                            <li class="social-icons__item">
                                                        <a href="https://www.instagram.com/tamilgifts/" target="_blank"><i class="fa fa-instagram"></i></a>
                                                    </li>
                                                                                                                                                            <li class="social-icons__item">
                                                        <a href="https://www.youtube.com/channel/UCRaZ29oPDSG4sF-z39VTzzQ" target="_blank"><i class="fa fa-youtube"></i></a>
                                                    </li>
                                                </ul>
                                            </footer>
												<div class="fb-page" data-width="500" data-href="" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="adapt_container_width=true&app_id=&container_width=560&hide_cover=false&href=https%3A%2F%2Fwww.facebook.com%2Ftamilgifts%2F&locale=en_GB&sdk=joey&show_facepile=true&small_header=false&tabs=timeline&width=500"><span style="vertical-align: bottom; width: 500px; height: 500px;"><iframe name="f22440cf392e4e8" width="500px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" title="fb:page Facebook Social Plugin" src="./Dealdio _ FREE Vouchers, Deals, Discounts,37_files/page.html" style="border: none; visibility: visible; width: 500px; height: 500px;" class=""></iframe></span></div>
                                                                                        
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
						<div class="page-content col-sm-6 col-md-6">
                            <div class="section store-tabs-area">
                                <div class="tabs tabs-v1">
                                    <ul class="nav nav-tabs panel" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="index.php?page=agent_details&agent_id=37#deals" aria-controls="deals" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-comment mr-10"></i>Deals</a>
                                        </li>
                                    </ul>

                                    
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane ptb-20 active" id="deals">
										<div class="section latest-deals-area">
												<div class="row row-masnory" >
					';
								$table_name='deal_info';
								$order_by='end_date';
								$where_condition ='is_active=1 and merchant_id='.$ar['merchant_id'];
								$response_array = $db->get($table_name,$where_condition,$order_by); 								
								$dts2=$response_array['return_message'];
								if($response_array['return_code']>0){
								foreach($dts2 as $ar2){
									
                        echo '
						
                                            
												<div class="col-sm-6 col-lg-12">
                        <div class="deal-single">
							<figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="" style="background-image: url('.$ar2['image_dir'].');">
								';
								if($ar2['percentage']!=0){
									echo '<div class="label-discount">-'.$ar2['percentage'].'%</div>	';
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
													</div>
													<a class="left carousel-control" href="#lightbox" role="button" data-slide="prev"><span>&lsaquo;</span>
													<a class="right carousel-control" href="#lightbox" role="button" data-slide="next"><span>&rsaquo;</span></a>
												</div>
											</div>
										</div>
									</div>
								</div>							
								<div class="time-left">
                                    <span>
										<i class="ico fa fa-clock-o mr-10"></i>
										<span id="'.$ar2['deal_id'].'" data-countdown="'.$ar2['end_date'].'"></span>
									</span>
                                </div>
                                <div class="deal-store-logo">
                                        <img src="'.$ar['image_dir'].'" alt="'.$ar['business_name'].'">
                                </div>
						
                        </figure>
							<div class="deal-dets">
								<div style="padding-right: 10px;">
                                    <h3 class="deal-title">
                            			<a data-tooltip data-toggle="tooltip" data-placement="bottom" title="" 
										data-original-title="'.$ar2['title'].'" href="index.php?page=deal_single&pro_id='.$ar2['deal_id'].'" > '.$ar2['title'].'</a>                                       
                        			</h3>
                                    <a href="index.php?page=deal_single&pro_id='.$ar2['deal_id'].'">
                                        <h6 style="color:#26CC71;font-size: 14px;">'.$ar['business_name'].'</h6>
                        				<p class="deal-meta">
                                            <i class="ico fa fa-map-marker"></i>'.$ar['address1'].'
                                        </p>
                                        <p class="text-muted">'.$ar2['description'].'</p>
                                    </a>
                                </div>
                                <div class="deal-price pos-r mb-15" style="position:relative;margin-bottom: 15px;">
                                    <ul class="deal-meta list-inline mb-10 color-mid">
                                        <li><i class="ico fa fa-shopping-basket mr-10"></i>'.$ar2['redemption_count'].' Redeemed</li>
										<li>
											<h3 class="price" style="padding-top:5px;padding-bottom:5px;text-align:right;color: #3BAC44;margin-bottom: 0">
											<span class="price-sale" style="color: #d84523; font-size: 85%;   text-decoration: line-through;
											margin-right: 1em;">£'.$ar2['deal_amount'].'</span>£'.$ar2['actual_amount'].'</h3>
                                        </li>
                                    </ul>
                                </div>
                            </div>
					    </div>
                    </div>';
					}}}
				?>
			
                </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane ptb-20" id="reviews">
               <div class="posted-review panel p-30">
                    <h3 class="h-title">0 Review</h3>
                </div>
            </div>
        </div>
      </div>
                            </div>
                            

                        </div>
                    </div>