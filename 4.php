
<?php include 'header.php';?>

    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
         <?php include 'nav.php';?>
        
            <!-- Left side column. contains the logo and sidebar -->
            <?php include 'menu.php';?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    </h1>
                   
                </section>

                <!-- Main content -->
               
                 <div class="panel-body">
                       <input type="checkbox">
                        <script type="text/javascript">
                        	$(':checkbox').checkboxpicker();
        </script>
                  </div>
                        <!-- /.panel-body -->
                
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
<?php include 'footer.php';?>