<?php

    session_start();
    include '../config.php';
    include '../classes/autoloader.php';
    include '../inc/connection.php';
    include '../inc/user_init.php';
    $page_title = "Slider Options";

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
                    <li class="active">Slider Options</li>
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
                <h2><?php echo $page_title; ?></h2>

                <?php


                $slides = new Content();
                $slide_items = $slides->fetch_all();
                if(!$slide_items) {
                    echo "<p>There are no slides yet.</p>";
                } else {

                    foreach($slide_items as $slide) :

                    ?>

                        <div class="well">
                            <div class="row">
                                <div class="col-sm-6">
                                    <img src="<?php echo ROOT_DIR; ?>/uploads/<?php echo $slide->get_image(); ?>" class="img-responsive" />
                                </div>
                                <div class="col-sm-6">
                                    <h3><strong>Caption</strong></h3>
                                    <br>
                                    <p><?php echo $slide->get_title(); ?></p>
                                    <button type="button" class="btn btn-primary btn-xs slide-modal-trigger" data-slide-action="edit" data-slide-no="<?php echo $slide->get_id(); ?>"style="position: absolute;top: 0;right: 80px;"><i class="fa fa-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-danger btn-xs delete-content" data-content="slide" data-slide-no="<?php echo $slide->get_id(); ?>" style="position: absolute;top: 0;right: 15px;"><i class="fa fa-trash"></i> Delete</button>
                                </div>
                            </div>
                        </div>


                    <?php

                    endforeach;

                }

                ?>
                
                <div class="well">
                    <button type="button" class="btn btn-primary slide-modal-trigger" data-slide-action="add"><i class="fa fa-plus"></i> Add Slide</button>
                </div>
                
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include '../layout/footer.php'; ?>

    </div>
    <!-- /.container -->


    <!-- slide modal -->
    <div id="slide-modal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <form action="#" id="slide-form" data-content="slide" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="prompt-area"></div>
              <label for="slide-image">Image</label><br>
              <input type="file" name="slide-image" class="form-control" required />
              <br>
              <label for="slide-caption">Caption</label><br>
              <input type="text" name="slide-caption" class="form-control" placeholder="Enter Slide Caption" required />
              <input type="hidden" name="slide-no" value />
              <input type="hidden" name="slide-action" value />
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



    <!-- display slide-modal script -->
    <script>
        $(".slide-modal-trigger").on("click", function() {
            var $action = $(this).data("slide-action");
            var $targetModal = $("#slide-modal");

            if($action == "add") {
                $targetModal.find(".modal-title").html("<i class='fa fa-plus'></i> Add Slide");
                $targetModal.find("input[name='slide-action']").val("add");
            } else if($action == "edit") {
                $targetModal.find(".modal-title").html("<i class='fa fa-edit'></i> Edit Slide");
                $targetModal.find("input[name='slide-no']").val($(this).data("slide-no"));
                $targetModal.find("input[name='slide-action']").val("edit");
            }
            $targetModal.modal({"show":true});
        });
    </script>


</body>

</html>
