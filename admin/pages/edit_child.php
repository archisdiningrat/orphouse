<?php
session_start();
if (isset($_SESSION["member_login"])) {
    include 'element/db_connection.php';

    $call_loggedin_member = $connect->query("SELECT * FROM admin WHERE username ='" . $_SESSION["member_login"] . "'");
    $fetch_member = $call_loggedin_member->fetch_assoc();

    $call_panti = $connect->query("SELECT * FROM panti");
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Edit Child</title>
            <?php include 'element/header.php' ?>
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
                        <i class="fa fa-child"></i> Edit Child                           
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-angle-right"></i> Level</a></li>
                        <li class="active">Edit</li>
                        <li class="active">Edit Child</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Choose Orphanage</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form role="form" action="edit_child_act.php" method="POST">

                                <!-- Select -->
                                <div class="form-group">
                                    <label>Orphanage</label>
                                    <select class="form-control" style="width: 100%;" name="id">
                                        <?php
                                        while ($fetch_panti = $call_panti->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $fetch_panti["id_panti"] ?>"><?php echo $fetch_panti["nama"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- Submit -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-warning btn-block btn-flat">Choose</button>
                                </div>
                            </form>
                            <!-- /.box -->
                        </div>
                        <!-- /.box-body -->

                    </div><!-- /.box-body -->
                    <?php
                    if (isset($_GET["stat"])) {
                        ?>
                        <br>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i>Success</h4>
                            Child Data successfully edited
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
        <?php include 'element/script.php' ?>

    </body>
    </html>

    <?php
} else {
    header("location: handler/logout_handler.php");
    exit();
}
?>