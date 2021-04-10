<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo ROOT_DIR; ?>"><?php echo SITE_TITLE; ?></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li <?php if($page_title==="Home") echo "class='active'"; ?>>
                    <a href="<?php echo ROOT_DIR ?>">Home</a>
                </li>
                <li <?php if($page_title==="Blog") echo "class='active'"; ?>>
                    <a href="<?php echo ROOT_DIR ?>/blog.php">Blog</a>
                </li>
                <li <?php if($page_title==="Portfolio") echo "class='active'"; ?>>
                    <a href="<?php echo ROOT_DIR ?>/portfolio.php">Portfolio</a>
                </li>
                <li <?php if($page_title==="Contact") echo "class='active'"; ?>>
                    <a href="<?php echo ROOT_DIR ?>/contact.php">Contact Us</a>
                </li>
                <?php if($current_user->is_logged_in) : ?>
                    <li <?php if($page_title==="UCP"||$page_title==="Slider Options"||$page_title==="Blog Posts"||$page_title==="Portfolio Management"||$page_title==="Users Management"||$page_title==="View Posts"||$page_title==="View Portfolio") echo "class='active'"; ?>>
                        <a href="<?php echo ROOT_DIR ?>/admin/ucp.php">UCP</a>
                    </li>
                <?php endif; ?>
                
                <?php if($current_user->is_logged_in) : ?>
                    <div style="color:#fff;display:inline-block;float:right;margin-top:15px;border-left:1px solid #ccc;padding-left:15px" class="user-area">
                        <span>Welcome, <strong><?php echo $current_user->get_name(); ?></strong>!</span>&nbsp;
                        <a href="/oop-cms/logout.php" class="btn btn-default btn-xs">Log Out <i class="fa fa-sign-out"></i></a>
                    </div>
                <?php else : ?>
                    <a href="#" style="margin-top:8px" class="btn btn-danger toggle-login">Log In</a>
                <?php endif; ?>
            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>