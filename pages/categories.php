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
                    <h1 class="page-header">Categories Management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Add / Edit Category <p class="statusMsg"></p>
                        </div>
                        <div class="panel-body">
                        <form role="form" enctype="multipart/form-data" name="categoryForm" id="categoryForm">
                            <input type="hidden" value="add_category" name="action" id="action"/>
                            <input type="hidden" value="" name="category_id" id="category_id"/>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="col-md-3 control-label" for="category_name">Category Name</label>
                                    <div class="col-md-9">
                                        <input id="category_name" name="category_name" class="form-control" placeholder="Category Name" type="text" required="">
                                    </div>
                                    <div class="form-group" id="imageDiv">
                                        <label class="col-md-3 control-label" for="image_dir">Upload Images</label>
                                        <div class="col-md-9">
                                            <input id="category_images" name="image_dir" class="input-file" type="file" required="" accepts="image/*" multiple>
                                        </div>
                                    </div>

                                    <div class="append_pre_p_v">
                                        <div class="filearray"> </div>
                                    </div>
                                </div> <!-- col-lg-12 -->
                            </div> <!-- row -->
                            <br/>
                            <div class="row">
                                <div class="col-lg-5"></div>
                                <div class="col-lg-2">
                                    <input type="submit" name="submit" class="btn btn-danger submitBtn" value="Submit"/>
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
                            <div class="panel-heading">List of Categories</div>
                            <div class="panel-body">
                                <table id="categoryTable" class="display compact table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Category Id</th>
                                        <th>Seq No</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
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
            $("#category_images").change(function() {
                var match= ["image/jpeg","image/png","image/jpg"];

                $(".filearray").empty();//you can remove this code if you want previous user input
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

            var dataTable = $('#categoryTable').dataTable({
                "paging": false,
                "bProcessing": true,
                "sAjaxSource": "../controller/category_controller.php?action=all_categories",
                "rowCallback": function( row, data ) {
                    if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                        $(row).addClass('selected');
                    }
                },
                "aoColumns": [
                    { mData: 'category_id', "visible": false, "searchable": false } ,
                    { mData: 'category_id' } ,
                    { mData: 'category_name' } ,
                    {"mRender": function ( data, type, row ) {
                            return (row.is_active == true) ? "Active" : "Inactive";
                        } // end function
                    },
                    { "mRender": function ( data, type, row ) {
                            return '<img src="../'+row.image_file+'" style="width:80px;height:50px">'
                        }
                    },
                    {"mRender": function ( data, type, row ) {
                        return '<a class="editForm" href="#" data-id='+row.category_id+'>Edit</a> / <a class="deleteForm" href="#" data-active='+row.is_active+' data-id='+row.category_id+'>Toggle Status</a>';}
                    }
                ]
            });

            $(document).on('click',".deleteForm",function(){
                $.ajax({
                    type: 'POST',
                    url: '../controller/category_controller.php', //?action=delete_merchant&merchant_id=' + $(this).data('id'),
                    data: JSON.stringify({action: "delete_category", category_id: $(this).data('id'), "is_active": $(this).data('active')}),
                    contentType: 'application/json; charset=utf-8',
                    success: function(msg){
                        $('.statusMsg').html('');
                        if(msg.return_code == 1){
                            $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Category deleted successfully.</span>');
                            $('#categoryForm')[0].reset();
                            $("#categoryTable").DataTable().ajax.reload();
                        }else{
                            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                        }
                    }
                });
            });

            $(document).on('click',".editForm",function(){
                $.ajax({
                    type: 'GET',
                    url: '../controller/category_controller.php?action=load_category&category_id=' + $(this).data('id'),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(msg){
                        $('.statusMsg').html('');
                        if(msg.return_code == 1 && msg.return_message[0] != undefined){
                            var merchantObj = msg.return_message[0];
                            $('#category_id').val(merchantObj.category_id);
                            $('#category_name').val(merchantObj.category_name);
                            $('#category_images').attr("disabled","disabled");

                            let $img=jQuery.parseHTML("<img src=''>");
                                $img[0].src="../" + merchantObj.image_file;
                                $img[0].style.width="80px";
                                $img[0].style.height="80px";
                                $img[0].style.padding="5px";
                            $(".filearray").append($img);
                        }else{
                            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                        }
                    }
                });
            });

            $("#resetBtn").on('click', function(e){
                $(".filearray").html("");
                $("#categoryForm")[0].reset();
            });

            $("#categoryForm").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '../controller/category_controller.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $('.submitBtn').attr("disabled","disabled");
                        $('#categoryForm').css("opacity",".5");
                    },
                    success: function(msg){
                        $('.statusMsg').html('');
                        if(msg.return_code == 1){
                            $('#categoryForm')[0].reset();
                            $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Category is added / updated successfully.</span>');
                            $("#categoryTable").DataTable().ajax.reload();
                        }else{
                            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                        }
                        $('#categoryForm').css("opacity","");
                        $(".filearray").html("");
                        $(".submitBtn").removeAttr("disabled");
                    }
                });
            });
        }); // end of jquery document ready function
    </script>

</body>

</html>
