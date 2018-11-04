<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../includes/head.php'); ?>
</head>

<body>

    <div id="wrapper">
        <?php include_once('../includes/nav.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Merchants Management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add / Edit Merchant <p class="statusMsg"></p>
                        </div>
                        <div class="panel-body">
                        <form role="form" enctype="multipart/form-data" name="merchantForm" id="merchantForm">
                            <input type="hidden" value="add_merchant" name="action" id="action"/>
                            <input type="hidden" value="" name="merchant_id" id="merchant_id"/>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="merchant_email">Merchant Email</label>
                                        <div class="col-md-8">
                                            <input id="merchant_email" name="merchant_email" class="form-control" placeholder="Merchant Email" type="text" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="password">Merchant Password</label>
                                        <div class="col-md-8">
                                            <input id="password" name="password" type="password" placeholder="Merchant Password" class="form-control input-md" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="business_name">Business Name</label>
                                        <div class="col-md-8">
                                            <input id="business_name" name="business_name" class="form-control" placeholder="Business Name" type="text" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="phone_number">Phone Number</label>  
                                        <div class="col-md-8">
                                            <input id="phone_number" name="phone_number" type="text" placeholder="Phone Number " class="form-control input-md" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="addess1">Address</label>  
                                        <div class="col-md-8">
                                            <input id="addess1" name="addess1" type="text" placeholder="Door no / Building name" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="addess2"></label>  
                                        <div class="col-md-8">
                                            <input id="addess2" name="addess2" type="text" placeholder="Street" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="state"></label>  
                                        <div class="col-md-8">
                                            <input id="state" name="state" type="text" placeholder="State" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="postal_code"></label>  
                                        <div class="col-md-8">
                                            <input id="postal_code" name="postal_code" type="text" placeholder="Postal Code" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="country">Country</label>
                                        <div class="col-md-8">
                                            <select id="country" name="country" class="form-control">
                                            <option value="UK">United Kingdom</option>
                                            <option value="India">India</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> <!-- col-lg-6 -->
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="operating_time">Operating Hours</label>  
                                        <div class="col-md-8">
                                            <input id="operating_time" name="operating_time" type="text" placeholder="Operating Hours" class="form-control input-md" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="website">Website</label>  
                                        <div class="col-md-8">
                                            <input id="website" name="website" type="text" placeholder="Website" class="form-control input-md">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="facebook">Facebook</label>  
                                        <div class="col-md-8">
                                            <input id="facebook" name="facebook" type="text" placeholder="Facebook" class="form-control input-md">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="youtube">Youtube</label>  
                                        <div class="col-md-8">
                                            <input id="youtube" name="youtube" type="text" placeholder="Youtube" class="form-control input-md">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="instagram">Instagram</label>  
                                        <div class="col-md-8">
                                            <input id="instagram" name="instagram" type="text" placeholder="Instagram" class="form-control input-md">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="description">Business Description</label>
                                        <div class="col-md-8">                     
                                            <textarea class="form-control" id="description" name="description" required=""></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="image_dir">Upload Image</label>
                                        <div class="col-md-8">
                                            <input id="image_dir" name="image_dir" class="input-file" type="file" required="">
                                        </div>
                                    </div>
                                </div> <!-- col-lg-6 -->
                            </div> <!-- row -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="submit" name="submit" class="btn btn-danger submitBtn" value="Save Merchant Details"/>
                                    <input type="reset" name="reset" class="btn btn-info submitBtn" value="Reset"/>
                                </div>
                            </div> <!-- row -->
                            </form>
                        </div> <!-- panel-body -->
                    </div> <!-- panel panel-default -->
                </div> <!-- col-lg-12 -->
            </div> <!-- row -->

            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">List of Merchants</div>
                            <div class="panel-body">
                                <table id="merchantTable"  class="display compact table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Merchant Id</th>
                                        <th>Merchant Email</th>
                                        <th>Business Name</th>
                                        <th>Phone Number</th>
                                        <th>State</th>
                                        <th>Country</th>
                                        <th>Postal Code</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel panel-default -->
                    </div><!-- /.col-lg-12 -->
            </div> <!-- row -->
        </div> <!-- /#wrapper -->


    <?php include_once('../includes/js.php'); ?>
    <script>
        $(document).ready(function(e){
            var selected = [];
            var dataTable = $('#merchantTable').dataTable({
                "bProcessing": true,
                "sAjaxSource": "../controller/merchant_controller.php?action=all_merchants",
                "rowCallback": function( row, data ) {
                    if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                        $(row).addClass('selected');
                    }
                },
                "aoColumns": [
                    { mData: 'merchant_id', "visible": false, "searchable": false } ,
                    { mData: 'merchant_email' } ,
                    { mData: 'business_name' },
                    { mData: 'phone_number' },
                    { mData: 'state' },
                    { mData: 'country' },
                    { mData: 'postal_code' },
                    { mData: 'image_dir',
                        render: function(mData) {
                            return '<img src="../'+mData+'" style="width:80px;height:50px">'
                        }
                    },
                    {"mRender": function ( data, type, row ) {
                        return '<a class="editForm" href="#" data-id='+row.merchant_id+'>Edit</a> / <a class="deleteForm" href="#" data-id='+row.merchant_id+'>Delete</a>';}
                    }
                ]
            }); 

            $(document).on('click',".deleteForm",function(){
                $.ajax({
                    type: 'GET',
                    url: '../controller/merchant_controller.php?action=delete_merchant&merchant_id=' + $(this).data('id'),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(msg){
                        $('.statusMsg').html('');
                        if(msg.return_code == 1){
                            $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Merchant record deleted successfully.</span>');
                            $('#merchantForm')[0].reset();
                            dataTable.ajax.reload();
                        }else{
                            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                        }
                    }
                });           
            });

            $(document).on('click',".editForm",function(){
                $.ajax({
                    type: 'GET',
                    url: '../controller/merchant_controller.php?action=load_merchant&merchant_id=' + $(this).data('id'),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(msg){
                        $('.statusMsg').html('');
                        if(msg.return_code == 1 && msg.return_message[0] != undefined){
                            var merchantObj = msg.return_message[0];
                            $('#merchant_id').val(merchantObj.merchant_id);
                            $('#merchant_email').val(merchantObj.merchant_email);
                            $('#password').val(merchantObj.encrypted_password);
                            $("#password").prop('disabled', true);
                            $('#business_name').val(merchantObj.business_name);
                            $('#address1').val(merchantObj.address1);
                            $('#address2').val(merchantObj.address2);
                            $('#state').val(merchantObj.state);
                            $('#country').val(merchantObj.country);
                            $('#postal_code').val(merchantObj.postal_code);
                            $('#operating_time').val(merchantObj.operating_time);
                            $('#website').val(merchantObj.website);
                            $('#facebook').val(merchantObj.facebook);
                            $('#youtube').val(merchantObj.youtube);
                            $('#instagram').val(merchantObj.instagram);
                            $('#description').val(merchantObj.description);
                        }else{
                            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                        }
                    }
                });           
            });

            $("#merchantForm").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '../controller/merchant_controller.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $('.submitBtn').attr("disabled","disabled");
                        $('#merchantForm').css("opacity",".5");
                    },
                    success: function(msg){
                        $('.statusMsg').html('');
                        if(msg.return_code == 1){
                            $('#merchantForm')[0].reset();
                            $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Merchant record added successfully.</span>');
                            dataTable.ajax.reload();
                        }else{
                            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                        }
                        $('#merchantForm').css("opacity","");
                        $(".submitBtn").removeAttr("disabled");
                    }
                });
            });
            
            //file type validation
            $("#image_dir").change(function() {
                var file = this.files[0];
                var imagefile = file.type;
                var match= ["image/jpeg","image/png","image/jpg"];
                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
                    alert('Please select a valid image file (JPEG/JPG/PNG).');
                    $("#image_dir").val('');
                    return false;
                }
            });
        });
    </script>

</body>

</html>
