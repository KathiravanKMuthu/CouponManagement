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
                    <h1 class="page-header">Accepted Deals</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
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
                        </div> <!-- panel panel-info -->
                    </div><!-- /.col-lg-12 -->
            </div> <!-- row -->
        </div> <!-- /#wrapper -->

    <?php include_once('../includes/js.php'); ?>
    <script>
        $(document).ready(function(e){
            var selected = [];

            var dataTable = $('#acceptedDealTable').dataTable({
                "bProcessing": true,
                "sAjaxSource": '../controller/deal_controller.php?action=load_user_accepted_deals',
                "rowCallback": function( row, data ) {
                    if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                        $(row).addClass('selected');
                    }
                },
                "aoColumns": [
                    {"mRender": function ( data, type, row ) {
                            return row.first_name + " " + row.last_name;
                        } // end of function
                    },
                    { mData: 'business_name' } ,
                    { mData: 'title' },
                    { mData: 'start_date' },
                    { mData: 'end_date' },
                    { mData: 'actual_amount' },
                    { mData: 'deal_amount' },
                    { mData: 'percentage' }
                ]
            }); // end of dataTable

        });
    </script>

</body>

</html>
