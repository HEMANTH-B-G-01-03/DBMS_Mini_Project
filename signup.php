<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    
    
    <?php session_start();
   
    include('header.php');
    include('admin/db_connect.php');
	?>

    <style>
        /* Custom CSS styles */
        /* Add any additional custom CSS styles here if needed */
        .bg-danger-subtle {
            background-image: url('flight1.jpg'); /* Specify the path to your background image */
            background-size: cover;
            background-position: center;
        }
		
        
    </style>
</head>
<body>
    
    <div class="container-fluid h-100 bg-danger-subtle">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-lg-6">
                <div class="p-5 rounded border border-2 border-dark">
                    <form action="signup_handler.php" method="post">
                        <h2 class="text-center text-white">Sign Up</h2><br/>

                        <div class="form-group px-5">
                            <label for="username">Name</label>
                            <input type="text" placeholder="Enter your username" class="form-control" name="name" required>
                        </div>
                        <div class="form-group px-5">
                            <label for="email">Contact</label>
                            <input type="email" placeholder="Enter your email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group px-5">
                            <label for="email">Address</label>
                            <input type="email" placeholder="Address" class="form-control" name="address" required>
                        </div>
                        <div class="form-group px-5">
                            <label for="password">Password:</label>
                            <input type="password" placeholder="Enter your Password" class="form-control" name="password" required>
                        </div>
                      
                        
                            <button class="btn btn-info btn-sm ml-5 mt-4  " type="submit">Sign Up</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

	<script>
	$('#signup-frm').submit(function(e){
		e.preventDefault()
		$('#signup-frm button[type="submit"]').attr('disabled',true).html('Saving...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'admin/ajax.php?action=signup',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');

			},
			success:function(resp){
				if(resp == 1){
					location.reload();
				}else{
					$('#signup-frm').prepend('<div class="alert alert-danger">Email already exist.</div>')
					$('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
				}
			}
		})
	})
</script>
</body>
</html>

<style>
	#uni_modal .modal-footer{
		display:none;
	}
</style>
