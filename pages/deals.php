<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../includes/head.php'); ?>
    <style>
         td.details-control {
            background: url('../images/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('../images/details_close.png') no-repeat center center;
        }

        .panel.with-nav-tabs .panel-heading{
            padding: 5px 5px 0 5px;
        }
        .panel.with-nav-tabs .nav-tabs{
            border-bottom: none;
        }
        .panel.with-nav-tabs .nav-justified{
            margin-bottom: -1px;
        }
        /********************************************************************/
        /*** PANEL PRIMARY ***/
        .with-nav-tabs.panel-primary .nav-tabs > li > a,
        .with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
            color: #fff;
        }
        .with-nav-tabs.panel-primary .nav-tabs > .open > a,
        .with-nav-tabs.panel-primary .nav-tabs > .open > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > .open > a:focus,
        .with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
            color: #fff;
            background-color: #3071a9;
            border-color: transparent;
        }
        .with-nav-tabs.panel-primary .nav-tabs > li.active > a,
        .with-nav-tabs.panel-primary .nav-tabs > li.active > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > li.active > a:focus {
            color: #428bca;
            background-color: #fff;
            border-color: #428bca;
            border-bottom-color: transparent;
        }
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu {
            background-color: #428bca;
            border-color: #3071a9;
        }
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a {
            color: #fff;   
        }
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
            background-color: #3071a9;
        }
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a,
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
        .with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
            background-color: #4a9fe9;
        }
    </style>
</head>

<body>

    <div id="wrapper">
        <?php include_once('../includes/nav.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Deals Management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel with-nav-tabs panel-primary">
                        <div class="panel-heading">
                            <p class="statusMsg"></p>
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1primary" data-toggle="tab">Add / Edit Parent Deal</a></li>
                                <li><a href="#tab2primary" data-toggle="tab">Add / Edit Child Deal</a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab1primary">
                                <?php include_once('parent_deals.php'); ?> <!-- parent deal file -->
                            </div>
                            <div class="tab-pane fade" id="tab2primary">
                                <?php include_once('child_deals.php'); ?> <!-- parent deal file -->
                            </div>
                            </div>
                        </div> <!-- panel-body -->
                    </div> <!-- panel panel-info -->
                </div> <!-- col-lg-12 -->
            </div> <!-- row -->

            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><h4>List of Deals</h4></div>
                            <div class="panel-body">
                                <table id="dealTable"  class="display compact table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Deal Id</th>
                                        <th></th>
                                        <th>Merchant Name</th>
                                        <th>Deal Title</th>
                                        <th>Product Price</th>
                                        <th>Offer Price</th>
                                        <th>Percentage</th>
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
            $("#image_dir").change(function() {
                var file = this.files[0];
                var imagefile = file.type;
                var match= ["image/jpeg","image/png","image/jpg"];
                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
                    alert('Please select a valid image file (JPEG/JPG/PNG).');
                    $("#image_dir").val('');
                    return false;
                }

                var filereader = new FileReader();
                var $img=jQuery.parseHTML("<img src=''>");
                filereader.onload = function(){
                    $img[0].src=this.result;
                    $img[0].style.width="80px";
                    $img[0].style.height="80px";
                    $img[0].style.padding="5px";
                };
                filereader.readAsDataURL(this.files[0]);
                $(".filearray").append($img);
            });

            var dataTable = $('#dealTable').DataTable({
                "ajax": "../controller/deal_controller.php?action=load_parent_deals",
                "columns": [
                    { mData: 'deal_id', "visible": false, "searchable": false },
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { mData: 'business_name' } ,
                    { mData: 'title' },
                    { "mRender": function(data, type, row) {
                            if(row.actual_amount) {
                                var currency = row.currency ? row.currency.toLowerCase(): 'gbp';
                                return '<i class="fa fa-'+currency+'"></i> ' + row.actual_amount;
                            }
                            return "";
                        } // end of function
                    },
                    { "mRender": function(data, type, row) {
                            if(row.deal_amount) {
                                var currency = row.currency ? row.currency.toLowerCase(): 'gbp';
                                return '<i class="fa fa-'+currency+'"></i> ' + row.deal_amount;
                            }
                            return "";
                        } // end of function
                    },
                    { "mRender": function(data, type, row) {
                            if(row.percentage) {
                                return row.percentage + ' <i class="fa fa-percent"></i> ';
                            }
                            return "";
                        } // end of function
                    },
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
                        var retStr = '<a class="editForm" href="#" data-id='+row.deal_id+'>Edit</a> ';
                        retStr += '/ <a class="deleteForm" href="#" data-active='+row.is_active+' data-id='+row.deal_id+'>Toggle Status</a>';
                        return retStr;
                        } // end of function
                    }
                ]
            }); // end of DataTable

            $('#dealTable tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = dataTable.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( getChildDeals(row.data().deal_id) ).show();
                    tr.addClass('shown');
                }
            } ); // end of details-control

            function getChildDeals ( deal_id ) {
                var div = $('<div/>')
                .addClass( 'loading' )
                .text( 'Fetching Child Deals...' ); 

                $.ajax( {
                    type: "GET",
                    url: "../controller/deal_controller.php?action=load_child_deals&deal_id=" + deal_id,
                    success: function ( json ) {
                        var content = '<div class="container" id="container_messages">';
                        content += '<table class="table table-bordered table-striped display" id="table_messages_' + deal_id +'">';
                        content += formatTableHead();
                        $.each(json.aaData, function(key, value) {
                            content += formatTableBody(value);
                        });

                        content += '</tbody></table></div>';
                        div
                            .html(content)
                            .removeClass( 'loading' );
                        
                        var subtable = $('#table_messages_' + deal_id).DataTable({
                            "paging": false,
                            "searching": false,
                            "ordering": false,
                            "info":     false
                        });
                    }
                } );
                return div;
            } // end of getChildDeals

            function formatTableHead() {
                return '<thead class="thead-inverse">'+
                    '<tr>'+
                        '<th>Deal Title</th>'+
                        '<th>Product Price</th>'+
                        '<th>Offer Price</th>'+
                        '<th>Percentage</th>'+
                        '<th>Status</th>'+
                        '<th>Action</th>'+
                    '</tr>'+
                '</thead><tbody>';
            }

            function formatTableBody( record ) {
                var actionStr = '<a class="editForm" href="#" data-id='+record.deal_id+'>Edit</a>';
                actionStr += ' / <a class="deleteForm" href="#" data-active='+record.is_active+' data-id='+record.deal_id+'>Toggle Status</a>';

                var actual_amount = deal_amount = percentage = "";
                var currency = record.currency ? record.currency.toLowerCase(): 'gbp';
                if(record.actual_amount) {
                    actual_amount = '<i class="fa fa-'+currency+'"></i> ' + record.actual_amount;
                }
                if(record.deal_amount) {
                    deal_amount = '<i class="fa fa-'+currency+'"></i> ' + record.deal_amount;
                }
                if(record.percentage) {
                    percentage = record.percentage + ' <i class="fa fa-percent"></i> ';
                }

                var retStr = 
                '<tr>'+
                    '<td>'+record.title+'</td>'+
                    '<td>'+actual_amount+'</td>'+
                    '<td>'+deal_amount+'</td>'+
                    '<td>'+percentage+'</td>'+
                    '<td>'+((record.is_active == true) ? 'Active' : 'Inactive')+'</td>'+
                    '<td>'+actionStr+'</td></tr>';
                    return retStr;
            }

            $(document).on('click',".deleteForm",function(){
                var deal_id = $(this).data('id')
                $.ajax({
                    type: 'POST',
                    url: '../controller/deal_controller.php',
                    data: JSON.stringify({action: "delete_deal", deal_id: $(this).data('id'), "is_active": $(this).data('active')}),
                    contentType: 'application/json; charset=utf-8',
                    cache: false,
                    processData:false,
                    success: function(msg){
                        $('.statusMsg').html('');
                        if(msg.return_code == 1){
                            $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Deal status is toggled successfully.</span>');
                            $('#dealForm')[0].reset();
                            $('#dealTable').DataTable().ajax.reload();
                        }else{
                            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                        }
                    }
                });           
            });

            $(document).on('click',".editForm",function(){
                $.ajax({
                    type: 'GET',
                    url: '../controller/deal_controller.php?action=load_deal&deal_id=' + $(this).data('id'),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(msg){
                        $('.statusMsg').html('');
                        if(msg.return_code == 1 && msg.return_message[0] != undefined){
                            var merchantObj = msg.return_message[0];
                            $('#merchant_id').val(merchantObj.merchant_id);
                            $('#title').val(merchantObj.title);
                            $('#actual_amount').val(merchantObj.actual_amount);
                            $('#deal_amount').val(merchantObj.deal_amount);
                            $('#percentage').val(merchantObj.percentage);
                            $('#start_date').val(merchantObj.start_date);
                            $('#end_date').val(merchantObj.end_date);
                            $('#description').val(merchantObj.description);
                        }else{
                            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                        }
                    }
                });           
            });

            $("#parentDealForm").on('reset', function(e){ 
                $(".filearray").html("");
            });

            $("#parentDealForm").on('submit', function(e){
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
                        $('#parentDealForm').css("opacity",".5");
                    },
                    success: function(msg){
                        $('.statusMsg').html('');
                        if(msg.return_code == 1){
                            $('#parentDealForm')[0].reset();
                            $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Parent Deal added successfully.</span>');
                            $('#dealTable').DataTable().ajax.reload();
                        }else{
                            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                        }
                        $('#parentDealForm').css("opacity","");
                        $(".submitBtn").removeAttr("disabled");
                    }
                });
            });

            // function to populate merchant names
            $.ajax({
                type: "GET",
                url: '../controller/merchant_controller.php?action=all_merchants_for_dropdown',
                contentType: false,
                cache: false,
                processData:false,
                success: function(msg)
                {
                    if(msg.return_code == 1) {
                        var data = [];
                        $.each(msg.return_message, function(key,value) {
                            data.push({"id": value.merchant_id, "name": value.business_name});
                        }); 

                        helpers.buildDropdown(data, $('#merchant_id'),'Select a Merchant');
                    }
                }
            });

            $(".date").datetimepicker({
                format:'DD-MM-YYYY HH:mm'
                }).find('input:first').on("blur",function () {
                    // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
                    // update the format if it's yyyy-mm-dd
                    var date = parseDate($(this).val());

                    if (! isValidDate(date)) {
                        //create date based on momentjs (we have that)
                        date = moment().format('DD-MM-YYYY HH:mm');
                    }

                    $(this).val(date);
            });
    
            var isValidDate = function(value, format) {
                format = format || false;
                    // lets parse the date to the best of our knowledge
                if (format) {
                    value = parseDate(value);
                }

                var timestamp = Date.parse(value);

                return isNaN(timestamp) == false;
            }
            
            var parseDate = function(value) {
                var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
                if (m)
                    value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);

                return value;
            }

        });
    </script>

</body>

</html>
