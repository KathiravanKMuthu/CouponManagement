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
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Add / Edit Deal <p class="statusMsg"></p>
                                <div class="input-group" id="deal_header">
                                    <label class="radio-inline">
                                        <input type="radio" name="deal_type_radio" id="parent_deal" value="1" checked>Parent Deal
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="deal_type_radio" id="child_deal" value="0">Child Deal
                                    </label>
                                </div>
                        </div>

                        <div class="panel-body">
                            <div class="tab-pane fade in active" id="tab1primary">
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
            $(document).on('change', "#deal_images", function() {
                var match= ["image/jpeg","image/png","image/jpg"];

                //$(".filearray").empty();//you can remove this code if you want previous user input
                for(let i=0;i<this.files.length;++i)
                {
                    var imagefile = this.files[i].type;
                    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
                        alert('Please select a valid image file (JPEG/JPG/PNG).');
                        $("#deal_images").val('');
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

            // function to populate merchant names
            var populateMerchantNames = function() {
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
            }

            // function to populate parent deals
            var populateParentDeals = function(selected_merchant_id) {
                $.ajax({
                    type: "GET",
                    url: '../controller/deal_controller.php?action=load_parent_deals',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(msg)
                    {
                        if(msg.iTotalRecords >= 1) {
                            var data = [];
                            $.each(msg.aaData, function(key,value) {
                                if(value.merchant_id == selected_merchant_id)
                                    data.push({"id": value.deal_id, "name": value.title});
                            });

                            helpers.buildDropdown(data, $('#parent_deal_name'),'Select a Deal');
                        }
                    }
                });
            }

            $(document).on('change', "#merchant_id", function() {
                $("#business_name").val($("#merchant_id option:selected").text());

                if($("#parent_deal_name") != undefined) {
                    populateParentDeals($("#merchant_id option:selected").val())
                }
            });

            $(document).on('change', "#parent_deal_name", function() {
                $("#parent_deal_id").val($("#parent_deal_name option:selected").val());
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
                        var retStr = '<a class="editForm" href="#" data-deal="parent" data-id='+row.deal_id+'>Edit</a> ';
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
                var actionStr = '<a class="editForm" href="#" data-deal="child" data-id='+record.deal_id+'>Edit</a>';
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
                            $('#dealTable').DataTable().ajax.reload();
                            $("#resetBtn").click();
                        }else{
                            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                        }
                    }
                });
            });

            $(document).on('click',".editForm",function(){
                $('#tab1primary').html("");
                var isParent = ($(this).data('deal') === "parent") ? true : false;
                var deal_id = $(this).data('id');
                if(isParent) {
                    $("#parent_deal").trigger('click');
                }
                else {
                    $("#child_deal").trigger('click');
                }
                setTimeout(function() {
                     $.ajax({
                        type: 'GET',
                        url: '../controller/deal_controller.php?action=load_deal&deal_id=' + deal_id,
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(msg){
                            $('.statusMsg').html('');
                            if(msg.return_code == 1 && msg.return_message[0] != undefined){
                                var merchantObj = msg.return_message[0];
                                if(isParent) {
                                    $('#action').val("update_parent_deal");
                                }
                                else {
                                    $('#action').val("update_child_deal");
                                }

                                $('#deal_id').val(merchantObj.deal_id);
                                $('#merchant_id').val(merchantObj.merchant_id);
                                $('#merchant_id').prop("disabled", "disabled");
                                $('#title').val(merchantObj.title);
                                $('#actual_amount').val(merchantObj.actual_amount);
                                $('#deal_amount').val(merchantObj.deal_amount);
                                $('#percentage').val(merchantObj.percentage);
                                $('#start_date').val(merchantObj.start_date);
                                $('#end_date').val(merchantObj.end_date);
                                $('#description').val(merchantObj.description);
                                $('#redemption_count').val(merchantObj.redemption_count);
                                $("input[name=is_active][value=" + merchantObj.is_active + "]").prop('checked', true);
                                $('#imageDiv').html("");

                                if(!isParent) {
                                    $('#parent_deal_id').val(merchantObj.parent_deal_id);
                                    $("#merchant_id").trigger('change');
                                    setTimeout(function() {
                                        $('#parent_deal_name').val(merchantObj.parent_deal_id);
                                    }, 100);
                                }

                            }else{
                                $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                            }
                        }
                    }); // end ajax
                },500); // parent_deal_name setTimeout
            });

            $("#resetBtn").on('click', function(e){
                $(".filearray").html("");
                $("#dealForm")[0].reset();
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

            // function to populate Parent Deal form
            $(document).on('click', "#parent_deal", function() {
                //$('#tab1primary').html("");
                $.ajax({
                    type: "GET",
                    url: 'parent_deals.php',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(html)
                    {
                        $('#tab1primary').html(html);

                        $(".date").datetimepicker({
                            format:'DD-MM-YYYY HH:mm'
                            }).find('input:first').on("blur",function () {
                              console.log("inside datepicker");

                                // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
                                // update the format if it's yyyy-mm-dd
                                var date = parseDate($(this).val());

                                if (! isValidDate(date)) {
                                    //create date based on momentjs (we have that)
                                    date = moment().format('DD-MM-YYYY HH:mm');
                                }

                                $(this).val(date);
                        });
                    }
                });
                populateMerchantNames();
            });

            // function to populate Child Deal form
            $(document).on('click', "#child_deal", function() {
                $('#tab1primary').html("");
                $.ajax({
                    type: "GET",
                    url: 'child_deals.php',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(html)
                    {
                        populateMerchantNames();
                        $('#tab1primary').html(html);

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
                    }
                });
            });
            $("#parent_deal").trigger('click'); // Trigger the click event
        });

        function submitForm() {
            $.ajax({
                type: 'POST',
                url: '../controller/deal_controller.php',
                data: new FormData(document.forms[0]),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('.submitBtn').attr("disabled","disabled");
                    $('#dealForm').css("opacity",".5");
                },
                success: function(msg){
                    $('.statusMsg').html('');
                    if(msg.return_code == 1){
                        $('.statusMsg').html('<span style="font-size:18px;color:#34A853">'+msg.return_message+'</span>');
                        $('#dealTable').DataTable().ajax.reload();
                        $("#resetBtn").click();
                    }else{
                        $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                    }
                    $('#dealForm').css("opacity","");
                    $(".submitBtn").removeAttr("disabled");
                }
            });
        }
    </script>

</body>

</html>
