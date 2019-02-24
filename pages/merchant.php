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
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Add / Edit Merchant <p class="statusMsg"></p>
                        </div>
                        <div class="panel-body">
                        <form role="form" method="post" enctype="multipart/form-data" name="merchantForm" id="merchantForm">
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
                                        <!--div class="col-md-2">
                                            <button id="show_password" class="btn btn-default" type="button">
                                                <span class="glyphicon glyphicon-eye-close"></span>
                                            </button>
                                        </div-->
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
                                        <label class="col-md-4 control-label" for="address1">Address</label>
                                        <div class="col-md-8">
                                            <input id="address1" name="address1" type="text" placeholder="Door no / Building name" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="address2"></label>
                                        <div class="col-md-8">
                                            <input id="address2" name="address2" type="text" placeholder="Street" class="form-control input-md">
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
                                            <!--option value="India">India</option-->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="operating_time">Operating Hours</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" id="operating_time" name="operating_time" required="" rows=5 placeholder="Format is 'Day1: start time - end time; Day2: start time - end time;'"></textarea>
                                        </div>
                                    </div>

                                </div> <!-- col-lg-6 -->

                                <div class="col-lg-6">

                                  <div class="form-group">
                                      <label class="col-md-4 control-label" for="country">Business Category</label>
                                      <div class="col-md-8">
                                          <select id="category_id" name="category_id" class="form-control" required=""></select>
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
                                            <textarea class="form-control" id="description" name="description" required="" rows=5></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="latitude">Map Location</label>
                                        <div class="col-md-8">
                                            <input id="latitude" name="latitude" type="text" placeholder="Latitude" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="longitude"></label>
                                        <div class="col-md-8">
                                            <input id="longitude" name="longitude" type="text" placeholder="Longitude" class="form-control input-md" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="is_active">Status</label>
                                        <div class="col-md-8 input-group">
                                            <label class="radio-inline">
                                                <input type="radio" name="is_active" id="status_active" value="1" checked>Active
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="is_active" id="status_inactive" value="0">Inactive
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group" id="imageDiv">
                                        <label class="col-md-4 control-label" for="image_dir">Upload Images</label>
                                        <div class="col-md-8">
                                            <input id="merchant_images" name="image_dir[]" class="input-file" type="file" required="" accepts="image/*" multiple>
                                            <span style="color:red">*Add All files together</span>
                                        </div>
                                    </div>

                                    <div class="append_pre_p_v">
                                        <div class="filearray"> </div>
                                    </div>
                                </div> <!-- col-lg-6 -->
                            </div> <!-- row -->
                            <br/>
                            <div class="row">
                                <div class="col-lg-5"></div>
                                <div class="col-lg-2">
                                    <input type="submit" name="submit" id="submit" class="btn btn-danger submitBtn" value="Submit"/>
                                    <input type="button" name="resetBtn" id="resetBtn" class="btn btn-info submitBtn" value="Reset"/>
                                </div>
                                <div class="col-lg-5"></div>
                            </div> <!-- row -->
                            </form>
                        </div> <!-- panel-body -->
                    </div> <!-- panel panel-info -->
                </div> <!-- col-lg-12 -->
            </div> <!-- row -->

            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
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
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel panel-info -->
                    </div><!-- /.col-lg-12 -->
            </div> <!-- row -->
        </div> <!-- /#wrapper -->

    <?php include_once('../includes/js.php'); ?>
    <script>
        $(document).ready(function(e){
            var selected = [];
            //file type validation + preview
            $("#merchant_images").change(function() {
                var match= ["image/jpeg","image/png","image/jpg"];

                //$(".filearray").empty();//you can remove this code if you want previous user input
                for(let i=0;i<this.files.length;++i)
                {
                    var imagefile = this.files[i].type;
                    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
                        alert('Please select a valid image file (JPEG/JPG/PNG).');
                        $("#merchant_images").val('');
                        return false;
                    }

                    let filereader = new FileReader();
                    let $img=jQuery.parseHTML("<img src=''>");
                    filereader.onload = function(){
                        $img[0].src=this.result;
                        $img[0].style.width="80px";
                        $img[0].style.height="80px";
                        $img[0].style.padding="5px";
                    };
                    filereader.readAsDataURL(this.files[i]);
                    $(".filearray").append($img);
                }
            });

            $("#show_password").hover(function functionName() { // Show Hide password
                    //Change the attribute to text
                    $("#password").attr("type", "text");
                    $(".glyphicon")
                    .removeClass("glyphicon-eye-close")
                    .addClass("glyphicon-eye-open");
                },
                function() {
                    //Change the attribute back to password
                    $("#password").attr("type", "password");
                    $(".glyphicon")
                    .removeClass("glyphicon-eye-open")
                    .addClass("glyphicon-eye-close");
                }
            );

            var dataTable = $('#merchantTable').DataTable({
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
                    {"mRender": function ( data, type, row ) {
                        return (row.is_active == true) ? "Active" : "Inactive";
                        } // end function
                    },
                    { mData: 'image_dir',
                        render: function(mData) {
                            return '<img src="../'+mData+'" style="width:80px;height:50px">'
                        }
                    },
                    {"mRender": function ( data, type, row ) {
                            var retStr = '<a class="editForm" href="#" data-id='+row.merchant_id+'>Edit</a> ';
                            retStr += '/ <a class="deleteForm" href="#" data-active='+row.is_active+' data-id='+row.merchant_id+'>Toggle Status</a>';
                            return retStr;
                        } // end of function
                    }
                ]
            });

            $(document).on('click',".deleteForm",function(){
                $.ajax({
                    type: 'POST',
                    url: '../controller/merchant_controller.php', //?action=delete_merchant&merchant_id=' + $(this).data('id'),
                    data: JSON.stringify({action: "delete_merchant", merchant_id: $(this).data('id'), "is_active": $(this).data('active')}),
                    contentType: 'application/json; charset=utf-8',
                    success: function(msg){
                        $('.statusMsg').html('');
                        if(msg.return_code == 1){
                            $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Merchant record deleted successfully.</span>');
                            $('#merchantTable').DataTable().ajax.reload();
                            $(".filearray").html("");
                            $("#resetBtn").click();
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
                            $('#action').val("update_merchant");
                            $('#merchant_id').val(merchantObj.merchant_id);
                            $('#merchant_email').val(merchantObj.merchant_email);
                            $('#password').val(merchantObj.encrypted_password);
                            $('#business_name').val(merchantObj.business_name);
                            $('#phone_number').val(merchantObj.phone_number);
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
                            var mapObj = $.parseJSON(merchantObj.map_position);
                            $('#latitude').val(mapObj.latitude);
                            $('#longitude').val(mapObj.longitude);
                            $("input[name=is_active][value=" + merchantObj.is_active + "]").prop('checked', true);
                            $('#category_id').val(merchantObj.category_id);
                            //$('#imageDiv').html("");
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
                            $('#action').val("add_merchant");
                            $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Merchant info is added/updated successfully.</span>');
                            $('#merchantTable').DataTable().ajax.reload();
                            $("#resetBtn").click();
                        }else{
                            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                        }
                        $('#merchantForm').css("opacity","");
                        $(".submitBtn").removeAttr("disabled");
                    }
                });
            });

            $("#resetBtn").on('click', function(e){
                $(".filearray").html("");
                $("#merchantForm")[0].reset();
            });


            // function to populate categories
            var populateCategories = function() {
                $.ajax({
                    type: "GET",
                    url: '../controller/category_controller.php?action=all_categories_for_dropdown',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(msg)
                    {
                        if(msg.return_code == 1) {
                            var data = [];
                            $.each(msg.return_message, function(key,value) {
                                data.push({"id": value.category_id, "name": value.category_name});
                            });

                            helpers.buildDropdown(data, $('#category_id'),'Select a category');
                        }
                    }
                });
            }

            populateCategories();

        });
    </script>

</body>

</html>
