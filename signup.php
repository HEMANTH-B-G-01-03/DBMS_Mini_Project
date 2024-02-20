<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <?php 
    include('header.php');
    include('admin/db_connect.php');
    ?>

    <style>
        /* Custom CSS styles */
        /* Add any additional custom CSS styles here if needed */
        
        /* Background image */
        body {
            background-image: url('https://png.pngtree.com/background/20230425/original/pngtree-an-airplane-sitting-on-a-runway-at-night-picture-image_2476643.jpg'); /* Replace 'path_to_your_image.jpg' with the actual path to your background image */
            background-size: cover;
            background-position: center;
            height: 100%;
            overflow: auto;
        }
        
        #color{
            color: white;
        }

        /* On hover, change text color to white with reduced opacity */
        .text-white:hover {
            color: rgba(255, 255, 255, 0.7); /* Adjust opacity as needed */
        }
        .white{
            color:white;
            font-size:20px;
        }

    </style>
</head>
<body>
    
    <div class="container-fluid vh-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-lg-4">
                <div class="p-5 rounded border border-2 mt-3 ">

                    <form action="signup_handler.php" method="post" id="#signup-frm">
                        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">

                        <div class="form-group">
                            <label for="name" class="white">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
                        </div>
                        <div class="form-group" >
                            <label for="username" class="white">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="white">Password</label>
                            <input type="password" name="password" id="password" class="form-control" value="<?php echo isset($meta['password']) ? $meta['password']: '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="type" class="white">User Type</label>
                            <select name="type" id="type" class="custom-select">
                                <option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Admin</option>
                                <option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>Staff</option>
                            </select>
                        </div>
                        
                        <button class="btn btn-info btn-sm ml-5 mt-4" type="submit">Sign Up</button>
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
            start_load()
            $('#signup-frm button[type="submit"]').attr('disabled',true).html('Saving...');

            $.ajax({
                url:'admin/ajax.php?action=signup',
                method:'POST',
                data:$(this).serialize(),

                error:err=>{
                    console.log(err)
                    $('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
                },
                success:function(resp){
                    if(resp ==1){
                        alert_toast("SignUp Sucessfull",'success')
                        setTimeout(function(){
                            location.reload()
                        },1500)
                    }
                    else{
                        $('#signup-frm').prepend('<div class="alert alert-danger">Email already exist.</div>')
                        $('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
                    }
                }
            })
        })
    </script>
</body>
</html>
