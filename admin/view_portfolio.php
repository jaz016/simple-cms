<?php

    session_start();
    include '../config.php';
    include '../classes/autoloader.php';
    include '../inc/connection.php';
    include '../inc/user_init.php';
    $page_title = "View Portfolio";

    if(!$current_user->is_logged_in)
        die("You are not logged in");

    if($current_user->get_access_level() < 3)
        die("You do not have sufficient privileges to access this page");

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
                    <li class="active">View All Portfolio</li>
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
                <h2 style="display:inline-block"><?php echo $page_title; ?></h2>


                <a href="portfolio_management.php" class="btn btn-primary btn-sm" style="float:right;margin-top:20px"><i class="fa fa-arrow-left"></i> Go back to Add Portfolio</a>



                <?php

                $portfolios = new Portfolio();
                $portfolio_items = $portfolios->fetch_all();
                if(!$portfolio_items) {
                    echo "<p>There are no portfolios yet.</p>";
                } else {

                    foreach($portfolio_items as $portfolio) :

                    ?>

                        <div class="well">
                            <div class="row">
                                <div class="col-sm-6">

                                <?php
                                if($portfolio->get_image()) :
                                ?>
                                    
                                    <img src="<?php echo ROOT_DIR; ?>/uploads/<?php echo $portfolio->get_image(); ?>" class="img-responsive" />

                                <?php
                                endif;
                                ?>
                                </div>



                                <div class="col-sm-6">
                                    <h3><strong><?php echo $portfolio->get_title(); ?></strong></h3>
                                    <p>
                                        <strong>Posted on:</strong> 
                                        <span class="date-posted"><?php echo $portfolio->get_date_posted(); ?></span>

                                    </p>

                                    <p><?php echo $portfolio->get_content(); ?></p>
                                    <button type="button" class="btn btn-danger btn-xs delete-content" data-content="portfolio" data-portfolio-no="<?php echo $portfolio->get_id(); ?>" style="position: absolute;top: 0;right: 15px;"><i class="fa fa-trash"></i> Delete</button>
                                </div>
                            </div>
                        </div>


                    <?php

                    endforeach;

                }

                ?>
                
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include '../layout/footer.php'; ?>

    </div>
    <!-- /.container -->




    <!-- category modal -->
    <div id="category-modal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Post Categories</h4>
          </div>
          <form action="#" id="category-form">
            <div class="modal-body">
              <div class="prompt-area"></div>
              <label for="category-name">Category Name</label><br>
              <input type="text" name="category-name" class="form-control" placeholder="Enter Category Name" required />
              <div class="category-area"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->




    <?php include '../inc/footer-scripts.php'; ?>



    <!-- display category modal script -->
    <script>
        $(".category-modal-trigger").on("click", function() {
            var $targetModal = $("#category-modal");


            // fetch all post categories and display it on the modal
            $.post("/oop-cms/inc/processing.php", {"fetch-post-categories": true}, function(data) {
                if(data != "false") {
                    $targetModal.find(".prompt-area").html("");
                    $targetModal.find(".category-area").html("");
                    $targetModal.find(".category-area").append("<hr>");
                    $targetModal.find(".category-area").append(data);
                }
            });

            $targetModal.modal({"show":true});
        });
    </script>


</body>

</html>
