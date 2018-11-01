<?php 
	$sms=  filter_input(INPUT_GET,'signinmsg');	
	//echo $sms;
?>
    <style type="text/css">
	
		@font-face {
			font-family: Poppins-Regular;
			src: url('fonts/poppins/Poppins-Regular.ttf'); 
		}

		@font-face {
			font-family: Poppins-Bold;
			src: url('fonts/poppins/Poppins-Bold.ttf'); 
		}

		@font-face {
			font-family: Poppins-Medium;
			src: url('fonts/poppins/Poppins-Medium.ttf'); 
		}

		@font-face {
			font-family: Raleway-Regular;
			src: url('fonts/raleway/Raleway-Regular.ttf'); 
		}

		@font-face {
			font-family: Raleway-Black;
			src: url('fonts/raleway/Raleway-Black.ttf'); 
		}

		@font-face {
			font-family: Raleway-SemiBold;
			src: url('fonts/raleway/Raleway-SemiBold.ttf'); 
		}

		@font-face {
			font-family: Raleway-Bold;
			src: url('fonts/raleway/Raleway-Bold.ttf'); 
		}
	</style>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
	function showmodel(){       
            if($(window).width()<768){
                $('#mymodal').css("background-color","#fff");
                $('#mymodal').css("border-radius","10px");
                $(".modal-header").css("overflow-y","initial");
                $(".modal-title").html('<p>'+name+'</p>');
                $(".modal-body").css("overflow-y","auto");
                //$(".modal-body").load("getstfatend.php",{'name':name,'month':monht});
                $('#mymodal').modal("show");
            }else{
                $('#mymodal').css("background-color","#fff");
                $('#mymodal').css("border-radius","10px");
                $('#mymodal').css("left",Math.max(0,($(window).width())/3)+"px");
                $('#mymodal').css("top",Math.max(0,($(window).height())/4)+"px");
                $('#mymodal').width(500);//$(window).width()-400
                $('#mymodal').height(300);            
                $('#mymodal-header').css("overflow","hidden");
                $(".modal-title").html('<p>'+name+'</p>');
                $(".modal-body").css("overflow","auto");
                //$(".modal-body").load("getstfatend.php",{'name':name,'month':monht});
                $('#mymodal').modal("show");    
            }
            
                       
        
    }
	$(document).ready(function(){
				
		var signmsg="<?php echo $sms;?>";
		if(signmsg!=""){alert(signmsg);}
		
		/*$('#btnsignin').click(function(){
			var dat={
			role:$('#role').val(),
			mem_email:$('#email').val(),
			mem_password:$('#password').val()};
			$.ajax({
				type:"POST",
				url:"api/signin.php",
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
			});
			
		});*/
		
		/*$('#signinform').submit(function(){			
			$.ajax({
				type:"POST",
				url:"api/signin.php",
				//data:JSON.stringify($(this).serializeObject()),
				//dataType:"json",
				//contentType:"application/json"
				success:function(dt){ alert(dt);//$('#result').text(dt);
				}
			});
		});*/
	}); 
		</script>
	    
	<div class="container">
	
   <div id="mymodal" class="modal fade" role="dailog">
          <div class="model-content">
            <div class="modal-header">
				<h3 class="sign-title">Forgot Password ? <small>Or <a href="index.php?page=signup" class="color-green">Sign Up</a></small>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="window.location.reload();">&times;</button>
				</h3>
                
            </div>      
           <div class="modal-body">
				
					<form class="p-40" action="forgot_pass" method="post">
						<div class="col-sm-6 col-md-12">
							<h4>Enter your e-mail address below to reset your password.</h4>
							<div class="form-group">
								<label class="sr-only">Email</label>
								<input type="text" class="form-control input-lg"  name="email" placeholder="Email" required="required">
							</div>
						</div>
						<div class="col-sm-6 col-md-6">
							<button type="submit"  name="submit" class="btn btn-o btn-lg" onMouseOver="this.style='border-color:#1f1;background-color:#1f1;color:#000;'" onMouseOut="this.style='border-color:transparant;background-color:#e0e0e0;color:#000;'">submit</button>
						</div>
						<div class="col-sm-6 col-md-6">
							<button type="button" class="btn btn-o btn-lg" data-dismiss="modal" onclick="window.location.reload();">cancel</button>
							<!-- <button type="button"  name="cancel" onclick = "document.getElementById('light').style.display='none';" class="btn btn-block btn-lg">Cancel</button>-->
						</div>
					</form>
                
			</div>
           </div>
        <!--<div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="window.location.reload();">close</button>
        </div>-->
        </div> 
    
 
	
	
		 <div class="row">
                    <div class="sign-area panel col-lg-offset-3 col-lg-6">
                        <h3 class="sign-title">Sign In <small>Or <a href="index.php?page=signup" class="color-green">Sign Up</a></small></h3>
                        <div class="row col-top">
                            <!--<div class="col-sm-6 col-md-7 col-left">    -->
                                <form class="p-40"  method="post" id="signinform" action="api/signin.php"> <!--  -->
									<div class="form-group">
                                        <!-- <label class="sr-only">Email</label> -->
										<input type="hidden" class="input100" id="role" name="role" value="member">
                                        <input type="text" class="input100" id="email" name="mem_email" placeholder="Email" ><!-- autocomplete="off"-->
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="input100" id="password" name="mem_password" placeholder="Password" style="width:80%;margin-left:10%;">
                                    </div>
                                    <div class="form-group">
                                        <a href="#" onclick="showmodel();" class="forgot-pass-link color-green" style="margin-left:10%;">Forget Your Password ?</a>
										<!-- onclick="document.getElementById('light').style.display='block';"--->
                                    </div>
                                    <div class="custom-checkbox mb-20">
									<label class="mycheckbox">
										<input type="checkbox" id="remember_account" checked><span class="checkmark"></span>Keep me signed in on this computer.
									</label>
                                    </div>
                                    <button id="btnsignin" type="submit" class="btn btn-defaul btn-lg btn-signin" style="width:80%;margin-left:10%;">Sign In</button>
                                </form>
                                <span class="or">Or</span>
							</div>
							<div class="row"><div id="result"></div></div>
							<div class="row">
								    <div class="col-lg-6">
                                        <a href="https://www.facebook.com/v2.2/dialog/oauth?client_id=1634558113321584&amp;state=a28d6649dff6a14e31d06d980c566ebe&amp;response_type=code&amp;sdk=php-sdk-5.6.2&amp;redirect_uri=https%3A%2F%2Fwww.dealdio.com%2Ffb-callback.php&amp;scope=email" class="btn btn-social btn-facebook">
										<i class="fa fa-facebook-square"></i>Facebook</a>
                                    </div>
                                    <div class="col-lg-6">
                                    	<a href="login.php" class="btn btn-social btn-googleplus"><i class="fa fa-google-plus"></i>Google</a>
                                    </div>
                                    <div class="text-center color-mid">
                                        Need an Account ? <a href="index.php?page=signup" class="color-green">Create Account</a>
                                    </div>
                            </div>                            
                            
                            
                        </div>
                    </div>
                </div>
			</div>
		