<?php

    session_start();
    include 'config.php';
    include 'classes/autoloader.php';
    include 'inc/connection.php';
    include 'inc/user_init.php';
    $page_title = "Home";


    $slides =          new Content();
    $blog_posts =      new BlogPost();
    $portfolios =      new Portfolio();
    $slide_items =     $slides->fetch_all();
    $blog_post_items = $blog_posts->fetch_all();
    $portfolio_items = $portfolios->fetch_all();

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


    <?php if($slide_items) : ?>
        <!-- Header Carousel -->
        <header id="myCarousel" class="carousel slide">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php
                $i=0;
                foreach ($slide_items as $slide) :
                ?>

                    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0) echo 'active'; ?>"></li>

                <?php
                $i++;
                endforeach;
                ?>
                
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php
                $i=0;
                foreach ($slide_items as $slide) :
                ?>
                <div class="item <?php if($i==0) echo 'active'; ?>">
                    <div class="fill" style="background-image:url('/oop-cms/uploads/<?php echo $slide->get_image(); ?>');"></div>
                    <div class="carousel-caption">
                        <h2><?php echo $slide->get_title(); ?></h2>
                    </div>
                </div>
                <?php
                $i++;
                endforeach;
                ?>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="icon-next"></span>
            </a>
        </header>
    <?php endif; ?>

    <!-- Page Content -->
    <div class="container">


        <!-- Welcome Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    What's New with <?php echo SITE_TITLE ?>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        
        <?php 
        if($blog_post_items) {
            $i = 0;
            foreach ($blog_post_items as $blog_post) :
            ?>

                <!-- Blog Post Row -->
                <div class="row">
                    <div class="col-md-1 text-center">
                        <p><i class="fa fa-calendar fa-2x"></i>
                        </p>
                        <p><?php echo $blog_post->get_date_posted(); ?></p>
                    </div>
                    <div class="col-md-5">
                        <a href="post.php?id=<?php echo $blog_post->get_id(); ?>">
                            <img class="img-responsive img-hover" src="/oop-cms/uploads/<?php echo $blog_post->get_image(); ?>" alt="">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <h3>
                            <a href="post.php?id=<?php echo $blog_post->get_id(); ?>"><?php echo $blog_post->get_title(); ?></a>
                        </h3>
                        <p>by <strong><?php echo $blog_post->get_author(); ?></strong>
                        </p>
                        <p><?php echo $blog_post->get_content(); ?></p>
                        <a class="btn btn-primary" href="post.php?id=<?php echo $blog_post->get_id(); ?>">Read More <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <!-- /.row -->

                <hr>


            <?php
            if($i == 2)
                break;
            $i++;
            endforeach;
        }
        ?>



        <?php 
        if($portfolio_items) {
            $i = 0;
            ?>
            <!-- Portfolio Section -->
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><?php echo SITE_TITLE; ?> Portfolio</h2>
                </div>
                <?php
                foreach ($portfolio_items as $portfolio) :
                ?>
                
                    <div class="col-md-4 col-sm-6" style="margin-bottom:1.6em">
                        <a href="portfolio-item.html">
                            <div class="image-wrap" style="height: 205px;overflow: hidden;border: 1px solid #f5f5f5;">
                                <img class="img-responsive img-portfolio img-hover" src="/oop-cms/uploads/<?php echo $portfolio->get_image(); ?>" alt="">
                            </div>
                        </a>
                    </div>

                <?php
            if($i == 5)
                break;
            $i++;
            endforeach;
            ?>

            </div>
            <!-- /.row -->
            <hr>
        <?php
        }
        ?>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="#">Reach out to us!</a>
                </div>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <?php include 'layout/footer.php'; ?>

    </div>
    <!-- /.container -->


    <?php include 'inc/login-modal.php'; ?>
    <?php include 'inc/footer-scripts.php'; ?>

    
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
