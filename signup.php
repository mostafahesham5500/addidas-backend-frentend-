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
            if(isset($_POST["signup"])){
                if(!checkempty($_POST["user"])){
                    $formerrors[] =  '<div class="alert alert-danger"> Name Cant Be <strong> Empty</strong> </div>';
                }

                if(!checkless($_POST["user"],5)){
                    $formerrors[] = '<div class="alert alert-danger"> Name Is <strong> Less 5</strong> </div>';
                }

                if(!checkempty($_POST["email"])){
                    $formerrors[] =  '<div class="alert alert-danger"> Email Cant Be <strong> Empty</strong> </div>';
                }

                if(!checkempty($_POST["pass"])){
                    $formerrors[] =  '<div class="alert alert-danger"> Pass Cant Be <strong> Empty</strong> </div>';
                }

                if(!checkempty($_POST["repass"])){
                    $formerrors[] =  '<div class="alert alert-danger"> Repass Cant Be <strong> Empty</strong> </div>';
                }

                if(!checkempty($_POST["number"])){
                    $formerrors[] =  '<div class="alert alert-danger"> Number Cant Be <strong> Empty</strong> </div>';
                }

                if($_POST["repass"] != $_POST["pass"]){
                    $formerrors[] =  '<div class="alert alert-danger"> Tow Password must be <strong> Equal</strong> </div>';
                }

                $email = $_POST["email"];

                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $formerrors[] =  '<div class="alert alert-danger"> Email must Be Include <strong> @ </strong> </div>';
                }

                if(strlen($_POST['pass']) < 6){
                    $formerrors[] =  '<div class="alert alert-danger"> Password Can,t  <strong> Less 6</strong> </div>';
                }
                $check = getRow('users','email',$email);
                if($email == $check['email']){
                    $formerrors[] =  '<div class="alert alert-danger"> email is <strong> Existing </strong> you must choose another email </div>';
                }
                if(empty($formerrors)){
                    $username = $_POST["user"];
                    $pass = $_POST["pass"];
                    $repass = $_POST["repass"];
                    $number = $_POST["number"];
                    $insert = "INSERT INTO users(`name`,email,`password`,repassword,`number`) 
                    VALUES('$username','$email','$pass','$repass','$number')";
                    if(insert($insert)){
                        $check = getRow('users','email',$email);

                        $_SESSION["id"] = $check['id'];
                        $_SESSION["email"] = $email;
                        header('location:index.php');
                    }
                }else{
                    foreach($formerrors as $error){
                        echo $error;
                    }
                }
            }
        }
    ?>
    <form class="form-login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <h4 class="text-center">Sign Up</h4>
        <input class="form-control" type="text" value="<?php echo @$_POST['user'] ?>" name="user" placeholder="Username" />
        <input class="form-control" type="email" name="email" value="<?php echo @$_POST['email'] ?>"  placeholder="Email" />
        <input class="form-control" type="password" name="pass" value="<?php echo @$_POST['pass'] ?>" placeholder="Password"/>
        <input class="form-control" type="password" name="repass" value="<?php echo @$_POST['repass'] ?>" placeholder="Return Password"/>
        <input class="form-control" type="text" name="number" value="<?php echo @$_POST['number'] ?>" placeholder="Number"/>
        <input class="btn btn-primary btn-block" type="submit" value="Sign Up" name="signup"/>
        <a href="./login.php" class="btn btn-primary btn-block">Login </a>
    </form>
</body>
</html>