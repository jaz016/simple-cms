<?php
    
    session_start();
    include 'config.php';
    include 'classes/autoloader.php';
    include 'inc/connection.php';
    include 'inc/user_init.php';
    $page_title = "Portfolio";



    // fetch all portfolio
    $portfolios = new Portfolio();
    $portfolio_items = $portfolios->fetch_all();
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $paginator = new Paginator($portfolio_items, $page, 9);

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
                <h1 class="page-header">Portfolio
                    
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo SITE_TITLE; ?>">Home</a>
                    </li>
                    <li class="active">Portfolio</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">


            <?php
            if(!$portfolio_items)
                echo "<div class='col-md-12'><span>There are no portfolios yet.</span></div>";
            else {
                $page_items = $paginator->get_data();
                $i = 0;
                foreach ($page_items as $portfolio) :
                ?>

                    <div class="col-md-4 img-portfolio">
                        <a href="portfolio-item.html">
                            <div class="image-wrap" style="height: 205px;overflow: hidden;border: 1px solid #f5f5f5;">
                                <img class="img-responsive img-hover" src="/oop-cms/uploads/<?php echo $portfolio->get_image(); ?>" alt="">
                            </div>
                        </a>
                        <h3>
                            <a href="portfolio-item.html"><?php echo $portfolio->get_title(); ?></a>
                        </h3>
                        <p><?php echo $portfolio->get_content(); ?></p>
                    </div>
                    
                    <?php
                    $i++;
                    if($i%3==0) {
                        echo "</div><div class='row'>";
                    }
                endforeach;
            }
            ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <?php $paginator->create_links(); ?>
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
