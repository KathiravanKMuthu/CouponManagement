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
                    <h1 class="page-header">Deal Management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add / Edit Deal <p class="statusMsg"></p>
                        </div>
                        <div class="panel-body">
                        <form role="form" enctype="multipart/form-data" name="merchantForm" id="merchantForm">
                            <input type="hidden" value="add_merchant" name="action" id="action"/>
                            <input type="hidden" value="" name="merchant_id" id="merchant_id"/>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="merchant_email">Merchant</label>
                                        <div class="col-md-8 input-group">
                                            <span class="input-group-addon">@</span>
                                            <input id="merchant_email" name="merchant_email" class="form-control" placeholder="Merchant Email" type="text" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="title">Title</label>  
                                        <div class="col-md-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-header"></i></span>
                                            <input id="title" name="title" type="text" placeholder="Deal Title" class="form-control input-md" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="business_name">Product Price</label>
                                        <div class="col-md-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-gbp"></i></span>
                                            <input id="actual_amount" name="actual_amount" class="form-control" placeholder="Product Price" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="business_name">Offer Price</label>
                                        <div class="col-md-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-gbp"></i></span>
                                            <input id="deal_amount" name="deal_amount" class="form-control" placeholder="Offer Price" type="text">
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="business_name">Percentage</label>
                                        <div class="col-md-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                            <input id="percentage" name="percentage" class="form-control" placeholder="Percentage" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="description">Description</label>
                                        <div class="col-md-8 input-group">
                                            <span class="input-group-addon"><i class="fa fa-info"></i></span>
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
                                    <input type="submit" name="submit" class="btn btn-danger submitBtn" value="Save Deal Info"/>
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
                            <div class="panel-heading">Deal Details</div>
                            <div class="panel-body">
                                <table id="dealTable"  class="display compact table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Deal Id</th>
                                        <th>Merchant Email</th>
                                        <th>Deal Title</th>
                                        <th>Product Price</th>
                                        <th>Offer Price</th>
                                        <th>Percentage</th>
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
            var dataTable = $('#dealTable').dataTable({
                "bProcessing": true,
                "sAjaxSource": "../controller/deal_controller.php?action=all_deals",
                "rowCallback": function( row, data ) {
                    if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                        $(row).addClass('selected');
                    }
                },
                "aoColumns": [
                    { mData: 'deal_id', "visible": false, "searchable": false } ,
                    { mData: 'merchant_email' } ,
                    { mData: 'title' },
                    { mData: 'actual_amount' },
                    { mData: 'deal_amount' },
                    { mData: 'percentage' },
                    { mData: 'image_dir',
                        render: function(mData) {
                            return '<img src="../'+mData+'" style="width:80px;height:50px">'
                        }
                    },
                    {"mRender": function ( data, type, row ) {
                        return '<a class="editForm" href="#" data-id='+row.deal_id+'>Edit</a> / <a class="deleteForm" href="#" data-id='+row.deal_id+'>Delete</a>';}
                    }
                ]
            }); 

            $(document).on('click',".deleteForm",function(){
                $.ajax({
                    type: 'GET',
                    url: '../controller/deal_controller.php?action=delete_merchant&merchant_id=' + $(this).data('id'),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(msg){
                        $('.statusMsg').html('');
                        if(msg.return_code == 1){
                            $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Merchant record deleted successfully.</span>');
                            $('#merchantForm')[0].reset();
                            dataTable.reload();
                        }else{
                            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                        }
                    }
                });           
            });

            $(document).on('click',".editForm",function(){
                $.ajax({
                    type: 'GET',
                    url: '../controller/deal_controller.php?action=load_merchant&merchant_id=' + $(this).data('id'),
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
                    url: '../controller/deal_controller.php',
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
