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
                    <h1 class="page-header">Users Management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">User Details<p class="statusMsg"></p></div>
                            <div class="panel-body">
                                <table id="userTable"  class="display compact table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>User Id</th>
                                        <th>User Email</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Phone Number</th>
                                        <th>Social Login details</th>
                                        <th>Country</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div> <!-- panel-body -->
                        </div> <!-- panel panel-default -->
                    </div><!-- /.col-lg-12 -->
            </div> <!-- row -->
        </div> <!-- /#wrapper -->

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">User Deals</h4>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Accepted Deals<p class="statusMsg"></p></div>
                                    <div class="panel-body">
                                        <table id="acceptedDealTable"  class="display compact table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>User Name</th>
                                                    <th>Merchant Name</th>
                                                    <th>Deal Title</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Product Price</th>
                                                    <th>Offer Price</th>
                                                    <th>Percentage</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div> <!-- panel-body -->
                                </div> <!-- panel panel-default -->
                            </div><!-- /.col-lg-12 -->
                        </div> <!-- row -->
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Redeemed Deals<p class="statusMsg"></p></div>
                                    <div class="panel-body">
                                        <table id="redeemedDealTable"  class="display compact table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>User Name</th>
                                                    <th>Merchant Name</th>
                                                    <th>Deal Title</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Product Price</th>
                                                    <th>Offer Price</th>
                                                    <th>Percentage</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div> <!-- panel-body -->
                                </div> <!-- panel panel-default -->
                            </div><!-- /.col-lg-12 -->
                        </div> <!-- row -->
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Favourite Deals<p class="statusMsg"></p></div>
                                    <div class="panel-body">
                                        <table id="favDealTable"  class="display compact table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>User Name</th>
                                                    <th>Merchant Name</th>
                                                    <th>Deal Title</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Product Price</th>
                                                    <th>Offer Price</th>
                                                    <th>Percentage</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div> <!-- panel-body -->
                                </div> <!-- panel panel-default -->
                            </div><!-- /.col-lg-12 -->
                        </div> <!-- row -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <?php include_once('../includes/js.php'); ?>
    <script>
        $(document).ready(function(e){
            var selected = [];

            $(document).on('click',".dealsForm",function(e){
                e.preventDefault();
                $('#myModal').modal('show');

                $('#acceptedDealTable').dataTable({
                    destroy: true,
                    "bProcessing": true,
                    "sAjaxSource": '../controller/user_controller.php?action=load_user_accepted_deals&user_id=' + $(this).data('id'),
                    "rowCallback": function( row, data ) {
                        if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                            $(row).addClass('selected');
                        }
                    },
                    "aoColumns": [
                        { mData: 'deal_id' } ,
                        { mData: 'merchant_id' } ,
                        { mData: 'title' },
                        { mData: 'start_date' },
                        { mData: 'end_date' },
                        { mData: 'actual_amount' },
                        { mData: 'deal_amount' },
                        { mData: 'percentage' }
                    ]
                }); // end of dataTable

                $('#redeemedDealTable').dataTable({
                    destroy: true,
                    "bProcessing": true,
                    "sAjaxSource": '../controller/user_controller.php?action=load_user_redeemed_deals&user_id=' + $(this).data('id'),
                    "rowCallback": function( row, data ) {
                        if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                            $(row).addClass('selected');
                        }
                    },
                    "aoColumns": [
                        { mData: 'deal_id' } ,
                        { mData: 'merchant_id' } ,
                        { mData: 'title' },
                        { mData: 'start_date' },
                        { mData: 'end_date' },
                        { mData: 'actual_amount' },
                        { mData: 'deal_amount' },
                        { mData: 'percentage' }
                    ]
                }); // end of dataTable

                $('#favDealTable').dataTable({
                    destroy: true,
                    "bProcessing": true,
                    "sAjaxSource": '../controller/user_controller.php?action=load_user_wished_deals&user_id=' + $(this).data('id'),
                    "rowCallback": function( row, data ) {
                        if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                            $(row).addClass('selected');
                        }
                    },
                    "aoColumns": [
                        { mData: 'deal_id' } ,
                        { mData: 'merchant_id' } ,
                        { mData: 'title' },
                        { mData: 'start_date' },
                        { mData: 'end_date' },
                        { mData: 'actual_amount' },
                        { mData: 'deal_amount' },
                        { mData: 'percentage' }
                    ]
                }); // end of dataTable
            }); // end of dealsForm

            $(document).on('click',".statusForm",function(e){
                e.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: '../controller/user_controller.php?action=toggle_status&user_id=' + $(this).data('id') + '&is_active=' + $(this).data('status'),
                    contentType: 'application/json; charset=utf-8',
                    success: function(msg){
                        $('.statusMsg').html('');
                        if(msg.return_code == 1){
                            $('.statusMsg').html('<span style="font-size:18px;color:#34A853">User status is toggled successfully.</span>');
                            $("#userTable").DataTable().ajax.reload();
                        }else{
                            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                        }
                    }
                });           
            }); // end of statusForm

            var dataTable = $('#userTable').dataTable({
                "bProcessing": true,
                "sAjaxSource": "../controller/user_controller.php?action=all_users",
                "rowCallback": function( row, data ) {
                    if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                        $(row).addClass('selected');
                    }
                },
                "aoColumns": [
                    { mData: 'user_id', "visible": false, "searchable": false } ,
                    { mData: 'email' } ,
                    { mData: 'first_name' },
                    { mData: 'last_name' },
                    { mData: 'phone_number' },
                    {"mRender": function ( data, type, row ) {
                        if(row.is_social_login == true)
                            return row.social_login_partner + ": " + row.social_login_id;

                        return "";
                        } // end function
                    },
                    { mData: 'country' },
                    {"mRender": function ( data, type, row ) {
                        return (row.is_active == true) ? "Active" : "Inactive"; 
                        } // end function
                    },
                    {"mRender": function ( data, type, row ) {
                        var retStr = '<a class="statusForm" href="#" data-status='+row.is_active+' data-id='+row.user_id+'>Toggle Status</a>';
                        retStr += ' / <a class="dealsForm" href="#" data-id='+row.user_id+'>View Deals</a>'
                        return retStr;
                        } // end function
                    }
                ]
            }); // end of dataTable

        });
    </script>

</body>

</html>
