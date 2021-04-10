$(document).ready(function() {


	'use strict';


	// call login modal
	$(".toggle-login").on("click", function(e) {
		e.preventDefault();
		$("#login-modal").modal({
			show: true
		});
	});



	// submit on login form
	$("#login-form").on("submit", function(e) {
		e.preventDefault();
		$.post("/oop-cms/inc/processing.php", $(this).serialize() + "&login=", function(data) {
			if(data=="success")
				window.location = '/oop-cms/';
			else
				alert("Wrong Login Details");
		});
	});



	// submit content (slide, blog post, portfolio)
	$("#slide-form, #blog-post-form, #portfolio-form").on("submit", function(e) {
		e.preventDefault();


		var successMsg = "";
		var redirectTo = "";
		var $contentType = $(this).data("content");
		var formData = new FormData($(this)[0]);



		switch($contentType) {
			case 'slide':
				formData.append('process-slide', true);
				successMsg = "Done Successfully";
				redirectTo = "slider_options.php";
				break;
			case 'blog-post':
				formData.append('publish-post', true);
				successMsg = "Post Published";
				redirectTo = "blog_posts.php";
				break;
			case 'portfolio':
				formData.append('publish-portfolio', true);
				successMsg = "Portfolio Published";
				redirectTo = "portfolio_management.php";
				break;
			default:
				break;
		}



		$.ajax({
			url: '/oop-cms/inc/processing.php',
			data: formData,
			type: 'POST',
			contentType: false,
			processData: false,
			success: function(data) {
				if(data=='success') {
					alert(successMsg);
					window.location = "/oop-cms/admin/"+redirectTo;
				} else if(data=='error') {
					$(".prompt-area").html("<span style='color:red'>Invalid image file type</span>");
				} else {
					alert(data);
				}
			}
		});
	});



	// delete content (slide, blog post, portfolio)
	$(".delete-content").on("click", function() {


		var $contentType = $(this).data("content");
		var $contentNo = "";


		switch($contentType) {
			case 'slide':
				$contentNo = $(this).data("slide-no");
				if(confirm("Do you want to delete this slide?")) {
					$.post("/oop-cms/inc/processing.php", {"delete-slide": true, "slide-no": $contentNo}, function() {
						alert("Slide deleted");
						window.location = '/oop-cms/admin/slider_options.php';
					});
				}
				break;
			case 'blog-post':
				$contentNo = $(this).data("post-no");
				if(confirm("Do you want to delete this post?")) {
					$.post("/oop-cms/inc/processing.php", {"delete-post": true, "post-no": $contentNo}, function() {
						alert("Post deleted");
						window.location = '/oop-cms/admin/view_posts.php';
					});
				}
				break;
			case 'portfolio':
				$contentNo = $(this).data("portfolio-no");
				if(confirm("Do you want to delete this portfolio?")) {
					$.post("/oop-cms/inc/processing.php", {"delete-portfolio": true, "portfolio-no": $contentNo}, function() {
						alert("Portfolio deleted");
						window.location = '/oop-cms/admin/view_portfolio.php';
					});
				}
				break;
			default:
				break;
		}
	});



	// submit on add-category form
	$("#category-form").on("submit", function(e) {
		e.preventDefault();
		$.post("/oop-cms/inc/processing.php", $(this).serialize() + "&add-category=", function(data) {
			if(data=="success") {
				alert("Category added");
				window.location = '/oop-cms/admin/blog_posts.php';
			}
			else {
				$(".prompt-area").html("<span style='color:red'>Category already exists</span>")
			}
		});
	});



	// delete post category
	$("body").on("click", ".delete-category", function(e) {
		e.preventDefault();
		if(confirm("Do you want to delete this category?")) {
			var $categoryNo = $(this).data("category-no");
			$.post("/oop-cms/inc/processing.php", {"delete-category": true, "category-no": $categoryNo}, function() {
				alert("Category Deleted");
				window.location = '/oop-cms/admin/blog_posts.php';
			});
		}
	});



	// submit on user form
	$("#user-form").on("submit", function(e) {
		e.preventDefault();
		$.post("/oop-cms/inc/processing.php", $(this).serialize() + "&add-user=", function(data) {
			if(data=="success") {
				alert("User added");
				window.location = '/oop-cms/admin/users_management.php';
			}
			else if(data=="error") {
				$(".prompt-area").html("<span style='color:red'>Username already exists</span>")
			} else {
				alert(data);
			}
		});
	});

});