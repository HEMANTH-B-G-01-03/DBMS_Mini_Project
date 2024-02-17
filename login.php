<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <?php include('./header.php'); ?>
    <?php include('admin/db_connect.php'); ?>
    <?php session_start(); ?>
    
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Add your custom CSS styles here */
        .bg-dangerinfo-subtle {
            background-color: #f8d7da; /* Subtle red (danger) */
            background-image: linear-gradient(to bottom, #f8d7da, #d1ecf1); /* Subtle blue (info) */
        }

        .login-title {
            animation: changeColor 5s infinite; /* Change colors every 5 seconds infinitely */
        }

        /* Change color of "Create New Account" link */
        #new_account {
            color: white; /* White color */
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100 bg-dangerinfo-subtle" id="b-img">
        <div class="p-5 rounded bg-info border border-2 border-dark">
            <form action="login_handler.php" method="post"> <!-- Make sure to specify the action and method for form submission -->
                <h2 class="text-center login-title">Login</h2><br/> <!-- Add the 'login-title' class for the colorful text -->
                <div class="mb-3 px-5">
                    <label for="email">Email :</label>
                    <input type="email" placeholder="Enter your email" class="control-label" name="Email" required>
                </div>
                <div class="mb-3 px-5">
                    <label for="password">Password :</label>
                    <input type="password" placeholder="Enter your Password" class="control-label" name="Password" required>
                </div>
              
                <div class="d-grid mb-3 px-5">
                    <button class="btn btn-success ml-5  " type="submit">Login</button>
                </div>
            </form>
            <div class="text-center mt-3"> <!-- Add a container for the "Create New Account" link -->
                <small><a href="javascript:void(0)" id="new_account">Create New Account</a></small>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript if needed -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

	<script>
	$('#new_account').click(function(){
		uni_modal("Create an Account",'signup.php?redirect=index.php?page=checkout')
	})
	$('#login-frm').submit(function(e){
		e.preventDefault()
		$('#login-frm button[type="submit"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'admin/ajax.php?action=login2',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home' ?>';
				}else{
					$('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>
</body>
</html>




<div class="container-fluid">
	<form action="" id="login-frm">
		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="email" name="email" required="" class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" name="password" required="" class="form-control">
			<small class="text-white"><a href="javascript:void(0)" id="new_account">Create New Account</a></small>
		</div>
		<button class="button btn btn-info btn-sm">submit </button>
	</form>
</div>

<style>
	#uni_modal .modal-footer{
		display:none;
	}
</style>

