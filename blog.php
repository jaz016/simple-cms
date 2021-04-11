<?php
    
    session_start();
    include 'config.php';
    include 'classes/autoloader.php';
    include 'inc/connection.php';
    include 'inc/user_init.php';
    $page_title = "Blog";



    // fetch all portfolio
    $blog_posts = new BlogPost();
    $blog_post_items = $blog_posts->fetch_all();
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $paginator = new Paginator($blog_post_items, $page, 4);

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
    <?php include 'layout/navbar.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Blog
                    
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo ROOT_DIR; ?>">Home</a>
                    </li>
                    <li class="active">Blog</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">


                <?php
                if(!$blog_post_items) 
                    echo "<span>There are no blog posts yet</span>";
                else {
                    $page_items = $paginator->get_data();
                    foreach ($page_items as $blog_post) :
                    ?>
                        
                        
                        <h2>
                            <a href="post.php?id=<?php echo $blog_post->get_id(); ?>"><?php echo $blog_post->get_title(); ?></a>
                        </h2>
                        <p class="lead">
                            by <strong><?php echo $blog_post->get_author(); ?></strong>
                        </p>
                        <p><i class="fa fa-clock-o"></i> Posted on <?php echo $blog_post->get_date_posted(); ?></p>
                        <hr>
                        <a href="post.php?id=<?php echo $blog_post->get_id(); ?>">
                            <img class="img-responsive img-hover" src="/oop-cms/uploads/<?php echo $blog_post->get_image(); ?>" alt="">
                        </a>
                        <hr>
                        <p><?php echo $blog_post->get_content(); ?></p>


                        <hr>

                    <?php
                    endforeach;
                }
                ?>


                <!-- Pagination -->
                <div class="text-center">
                    <?php $paginator->create_links(); ?>
                </div>
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter Post Title">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <?php 
                            $categories = $blog_posts->fetch_categories();
                            if(!$categories)
                                echo "<span>There are no blog categories</span>";
                            else {
                                echo "<ul class='list-unstyled'>";
                                foreach ($categories as $category) :
                                ?>
                                
                                    <li><a href="#"><?php echo $category['category_name']; ?></a></li>

                                <?php
                                endforeach;
                                echo "</ul>";
                            }
                            ?>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include 'layout/footer.php'; ?>

    </div>
    <!-- /.container -->

    <?php include 'inc/login-modal.php'; ?>
    <?php include 'inc/footer-scripts.php'; ?>

</body>

</html>
