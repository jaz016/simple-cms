<?php

    session_start();
    include '../config.php';
    include '../classes/autoloader.php';
    include '../inc/connection.php';
    include '../inc/user_init.php';
    $page_title = "UCP";

    if(!$current_user->is_logged_in)
        die("You are not logged in");

?>






<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $page_title . " | " . SITE_TITLE; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo ROOT_DIR; ?>/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo ROOT_DIR; ?>/assets/css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo ROOT_DIR; ?>/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <?php include '../layout/navbar.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User Control Panel
                    <small>Management</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo ROOT_DIR; ?>">Home</a>
                    </li>
                    <li class="active">Site Info</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Sidebar Column -->
            <?php include 'admin-sidebar.php'; ?>
            <!-- Content Column -->
            <div class="col-md-9">
                <h2>Site Info</h2>
                


    
                <label for="site-title">Site Title</label>
                <input type="text" name="site-title" class="form-control" value="<?php echo SITE_TITLE; ?>" disabled />

                <br>

                <label for="footer-info">Footer Info</label>
                <input type="text" name="footer-info" class="form-control" value="<?php echo FOOTER_INFO; ?>" disabled />

                <br>


            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include '../layout/footer.php'; ?>

    </div>
    <!-- /.container -->



    <?php include '../inc/login-modal.php'; ?>
    <?php include '../inc/footer-scripts.php'; ?>


</body>

</html>
