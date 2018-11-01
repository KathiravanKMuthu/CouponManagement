    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <!--script src="../vendor/morrisjs/morris.min.js"></script-->
    <!--script src="../data/morris-data.js"></script-->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">
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