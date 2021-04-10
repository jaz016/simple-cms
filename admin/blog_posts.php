<?php

    session_start();
    include '../config.php';
    include '../classes/autoloader.php';
    include '../inc/connection.php';
    include '../inc/user_init.php';
    $page_title = "Blog Posts";

    if(!$current_user->is_logged_in)
        die("You are not logged in");

    if($current_user->get_access_level() < 2)
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
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Sidebar Page</li>
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


                <a href="view_posts.php" class="btn btn-primary btn-sm" style="float:right;margin-top:20px"><i class="fa fa-list"></i> View All Blog Posts</a>
                <a class="btn btn-info btn-sm category-modal-trigger" style="float:right;margin-top:20px;margin-right:5px">Add Post Category</a>
                   

                <form action="#" id="blog-post-form" data-content="blog-post" enctype="multipart/form-data">
    
                    <label for="post-title">Post Title</label>
                    <input type="text" name="post-title" class="form-control" placeholder="Enter Post Title" required />

                    <br>

                    <label for="post-content">Content</label>
                    <textarea name="post-content" class="form-control" rows="10" placeholder="Enter Content" style="resize:none" required></textarea>

                    <br>


                    <label for="post-image">Post Image</label>
                    <div class="prompt-area"></div>
                    <input type="file" name="post-image" class="form-control" />

                    <br>


                    <label for="post-category">Category</label>

                    <select name="post-category" class="form-control" required>
                        <option value="">-- Select Post Category --</option>
                        <?php
                        $categories = BlogPost::fetch_categories();
                        foreach ($categories as $category) :
                        ?>

                            <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>

                        <?php
                        endforeach;
                        ?>
                    </select>


                    <br>


                    <input type="submit" value="Publish" class="btn btn-primary" />

                </form>
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
