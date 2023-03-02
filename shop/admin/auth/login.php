<?php
    session_start();

    if ((! empty($_SESSION['admin_login']) || (! empty($_SESSION['admin_sign_up'])))) {
        header('location: ../dashboard.php');
    }
    else {
        ?> 

    <?php
        include_once("../../database/config.php");

        if(isset($_POST['signin'])){
            $pass = $_POST['pass'];
            $email = $_POST['email'];

            if ($_POST['pass'] == '' || $_POST['email'] == '') {
                echo("<script type='text/javascript'>alert('All fields are required!')</script>"); 
            }
            // Fetch all users from the database
            $Data = "SELECT * FROM `admin_users` WHERE PassWD = '$pass' AND email_Add = '$email' ";
            $Fetch = mysqli_query($PDO, $Data) or die("Error fetching email and password");

            while($Data = mysqli_fetch_array($Fetch)){

                $username = $Data['Cust_Username'];
                
                $_SESSION['admin'] = 'true';

                $_SESSION['admin_sign_up'] = 'true';
                $_SESSION['admin_username'] = $username;
            }

            if(mysqli_num_rows($Fetch) > 0){

                $_SESSION['admin_sign_up'] = 'true';
                $_SESSION['admin_login'] = 'true';
                
                header('location: ../');
            }
            else{
                echo("<script type='text/javascript'>alert('Wrong Credentials.')</script>"); 
            }
        }
    ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="Supermarket Management Software">
            <meta name="author" content="James Akweter">
            <meta name="generator" content="Angel Dev Team">
            <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
            <title>Admin Login</title>
            <link rel="stylesheet" href="../../node_modules/bootstrap/bootstrap.min.css">
        </head>
        <body>
                <div class="py-5 modal-dialog">
                    <div class="modal-content p-5 ">
                        <div class="modal-header pb-4 border-bottom-0">
                            <h1 class="fw-bold mb-0 fs-2">Are You Admin?</h1>
                        </div>
                        <div class="modal-body rounded-3  pt-0">
                            <form method="post">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control rounded-3" id="email" name="email" placeholder="john.doe@domain.com">
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="pass" class="form-control rounded-3" id="pass" placeholder="Password">
                                    <label for="pass">Password</label>
                                </div>
                                <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" name="signin" type="submit">Log in</button>
                                <div style="text-align:center;" id="forgotPass"><a href="#">Forgot password</a></div>
                                <hr class="my-4">
                                <div>
                                    <h5 style="text-align:center;">Don't have account?</h5>
                                    <a href="./signup.php" class="w-100 mb-4 btn btn-md rounded-3 btn-warning" name="submit" type="submit"><strong> Sign Up</strong></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </body>
    </html>
<?php
 }
?>