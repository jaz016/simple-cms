<div class="col-md-3">
    <div class="list-group">


		<?php if($current_user->get_access_level() > 0) : ?>
			<a href="<?php echo ROOT_DIR ?>/admin/ucp.php" class="<?php if($page_title==='UCP') echo 'active'; ?> list-group-item"><i class="fa fa-exclamation-circle"></i> Site Info</a>
		<?php endif; ?>

		<?php if($current_user->get_access_level() > 1) : ?>
			 <a href="<?php echo ROOT_DIR ?>/admin/blog_posts.php" class="<?php if($page_title==='Blog Posts'||$page_title==='View Posts') echo 'active'; ?> list-group-item"><i class="fa fa-comments"></i> Blog Posts</a>
		<?php endif; ?>


		<?php if($current_user->get_access_level() > 2) : ?>
			<a href="<?php echo ROOT_DIR ?>/admin/slider_options.php" class="<?php if($page_title==='Slider Options') echo 'active'; ?> list-group-item"><i class="fa fa-sliders"></i> Slider Options</a>  
	        <a href="<?php echo ROOT_DIR ?>/admin/portfolio_management.php" class="<?php if($page_title==='Portfolio Management'||$page_title==='View Portfolio') echo 'active'; ?> list-group-item"><i class="fa fa-gear"></i> Portfolio Management</a>
	        <a href="<?php echo ROOT_DIR ?>/admin/users_management.php" class="<?php if($page_title==='Users Management') echo 'active'; ?> list-group-item"><i class="fa fa-users"></i> Users Management</a>
		<?php endif; ?> 


    </div>
</div>