<?php
session_start();
if (isset($_SESSION["member_login"])) {

    include 'element/db_connection.php';

    $call_panti = $connect->query("SELECT * FROM panti");
    $call_loggedin_member = $connect->query("SELECT * FROM admin WHERE username ='" . $_SESSION["member_login"] . "'");
    $fetch_member = $call_loggedin_member->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Add Child</title>
            <?php include 'element/header.php' ?>

            <!-- iCheck for checkboxes and radio inputs -->
            <link rel="stylesheet" href="../../plugins/iCheck/all.css">

        </head>
        <?php include 'element/style.php' ?>
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="home.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>o</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b>Orphouse</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">


                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="../../dist/img/<?php echo $fetch_member["img"] ?>" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"><?php echo $fetch_member["fullname"] ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="../../dist/img/<?php echo $fetch_member["img"] ?>" class="img-circle" alt="User Image">
                                        <p>
                                            <?php echo $fetch_member["fullname"] ?>
                                        </p>
                                    </li>

                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="handler/logout_handler.php" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../../dist/img/<?php echo $fetch_member["img"] ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $fetch_member["fullname"] ?></p>
                            <!-- Status -->
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <?php include 'element/side_menu.php'; ?>

                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <i class="fa fa-child"></i> Add Child                           
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-angle-right"></i> Level</a></li>
                        <li class="active">Add</li>
                        <li class="active">Add Child</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Child Data</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form role="form" action="handler/add_child_handler.php" method="post" enctype="multipart/form-data">
                                
                                <!-- Select -->
                                <div class="form-group">
                                    <label>Orphanage</label>
                                    <select class="form-control" style="width: 100%;" name="id_panti">
                                        <?php
                                        while ($fetch_panti = $call_panti->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $fetch_panti["id_panti"] ?>"><?php echo $fetch_panti["nama"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Child Name</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
                                        <input type="text" class="form-control" placeholder="" name="nama" required="">
                                    </div>
                                </div>

                                <!-- Date dd/mm/yyyy -->
                                <div class="form-group">
                                    <label>Birthdate</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="lahir" required="">
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->

                                <!-- text input -->
                                <div class="form-group">
                                    <label>School</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>                                        
                                        <input type="text" class="form-control" placeholder="" name="sekolah" required="">
                                    </div>                                        
                                </div>
                                
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Hobby</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="ion ion-ios-basketball"></i></span>                                        
                                        <input type="text" class="form-control" placeholder="" name="hobi">
                                    </div>                                        
                                </div>

                                <!-- radio -->
                                <div class="form-group">
                                    <label>Gender</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="jk" class="flat-red" value="L" checked>&nbsp;Male
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="jk" class="flat-red" value="P">&nbsp;Female
                                        </label>
                                    </div>
                                </div>

                                <!-- File Input -->
                                <div class="form-group">
                                    <label for="img">Child Picture</label>
                                    <input type="file" name="img" id="fileToUpload">
                                    <p class="help-block">Picture of the child.</p>
                                </div>

                                
                                <!-- Submit -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary bg-olive btn-block btn-flat">Submit Data</button>
                                </div>
                            </form>
                            <!-- /.box -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box-body -->
                    <?php
                    if (isset($_GET["stat"])) {
                        ?>
                        <br>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i>Success</h4>
                            Child Data successfully inserted
                        </div>
                        <?php
                    }
                    ?>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">

                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2015 <a href="http://www.archisdiningrat.net">Archisdiningrat</a>.</strong> All rights reserved.
            </footer>

        </div><!-- ./wrapper -->

        <?php include 'element/footer.php' ?>
        <!-- Select2 -->
        <script src="../../plugins/select2/select2.full.min.js"></script>

        <!-- InputMask -->
        <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
        <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>

        <!-- iCheck 1.0.1 -->
        <script src="../../plugins/iCheck/icheck.min.js"></script>
        <?php include 'element/script.php' ?>

    </body>
    </html>

    <?php
} else {
    header("location: handler/logout_handler.php");
    exit();
}
?>