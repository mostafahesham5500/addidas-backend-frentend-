<?php
session_start();
    require "./validate.php";
    require "./dp.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/signup.css">
</head>
<body class="login">
    <?php
        $formerrors = [];
        if($con){
            if(isset($_POST["login"])){
                if(!checkempty($_POST["email"])){
                    $formerrors[] =  '<div class="alert alert-danger"> Email Cant Be <strong> Empty</strong> </div>';
                }

                if(!checkempty($_POST["pass"])){
                    $formerrors[] =  '<div class="alert alert-danger"> Pass Cant Be <strong> Empty</strong> </div>';
                }

                $email = $_POST["email"];

                $check = getRow('users','email',$email);

                if(!empty($check)){
                    $check_pass = $check['password'];
                    if($check_pass != $_POST['pass']){
                        $formerrors[] =  '<div class="alert alert-danger"> Password is <strong> Wrong</strong> </div>';
                    }
                }else{
                    $formerrors[] =  '<div class="alert alert-danger"> Email is <strong> Wrong</strong> </div>';
                }


                if(empty($formerrors)){
                    $_SESSION["user"] = $check['name'];
                    $_SESSION["id"] = $check['id'];
                    header('location:index.php');
                }else{
                    foreach($formerrors as $error){
                        echo $error;
                    }
                }
            }
        }
    ?>
    <form class="form-login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <h4 class="text-center">Login</h4>
        <input class="form-control" type="email" name="email" placeholder="Email" />
        <input class="form-control" type="password" name="pass" placeholder="Password"/>
        <input class="btn btn-primary btn-block" type="submit" value="Login" name="login"/>
        <a href="./signup.php" class="btn btn-primary btn-block">Sign Up </a>
    </form>
</body>
</html>