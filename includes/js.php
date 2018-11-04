    <!-- jQuery -->
    <script src="https:/cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>

    <!--script src="../vendor/morrisjs/morris.min.js"></script-->
    <!--script src="../data/morris-data.js"></script-->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">
        var helpers =
        {
            buildDropdown: function(result, dropdown, emptyMessage)
            {
                // Remove current options
                dropdown.html('');
                // Add the empty option with the empty message
                dropdown.append('<option value="">' + emptyMessage + '</option>');
                // Check result isnt empty
                if(result != '')
                {
                    // Loop through each of the results and append the option to the dropdown
                    $.each(result, function(k, v) {
                        dropdown.append('<option value="' + v.id + '">' + v.name + '</option>');
                    });
                }
            }
        }

        function openURL(url)
        {
            var modifiedArray = [];
            var pathArray = window.location.href.split( '/' );
            for(var i=0; i < (pathArray.length-1); i++)
            {
                modifiedArray.push(pathArray[i]);
            }
            window.location.href = modifiedArray.join("/") + "/" + url;
        }
    </script>