<?php
    session_start();
    include "./dp.php";

    if(isset($_POST["buy"])){
      $productid = $_POST['productid'];
      $userid = $_POST['userid'];
      $sql = "INSERT INTO product(`product_id`,`user_id`) VALUES('$productid','$userid')";
      insert($sql);
      header("refresh: 0");
    }

    if(isset($_POST["delete"])){
      $id = $_POST['id'];
      $sql = "DELETE FROM product WHERE `id` = '$id'";
      delete($sql);
      header("refresh: 0");
    }

    if(isset($_POST["deletevip"])){
      $id = $_POST['id'];
      $sql = "DELETE FROM vipsell WHERE `id` = '$id'";
      delete($sql);
      header("refresh: 0");
    }

    if(isset($_POST['buyvip'])){
          $productid = $_POST['productid'];
          $userid = $_POST['userid'];
          $sql = "INSERT INTO vipsell(`product_id`,`user_id`) VALUES('$productid','$userid')";
      insert($sql);
      header('refresh:0');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/animate.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <title>Document</title>
</head>
<body>

<section class="navbar" id="home">
        <nav class="navbar navbar-expand-lg navbar-light container">
            <a class="navbar-brand" href="#"><img src="./images/logo5.png" alt=""></a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                  <a class="nav-link home" data-link="home" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link about" data-link="about" href="index.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link product" data-link="product" href="index.php">Product</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link review" data-link="review" href="index.php">Review</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link stats" data-link="stats" href="index.php">Stats</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link contact" data-link="contact" href="index.php">Contact</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link vip" data-link="vip"href="index.php">Vip</a>
                  </li>
                  <li class="nav-item all">
                    <a class="nav-link" href="#">All Product</a>
                    <div class="all-pr">
                        <a class="nav-link" href="all.php">Products</a>
                        <a class="nav-link" href="vip.php">VIP Product</a>
                    </div>
                  </li>
                  <?php
                    if(!isset($_SESSION['user'])){
                      ?>
                      <li class="nav-item"><a class="nav-link" href="./login.php">Login</a></li>
                      <li class="nav-item"><a class="nav-link" href="./signup.php">Sign up</a></li>
                      <?php
                    }else{
                      ?>
                      <li class="nav-item"> <a class="nav-link" href="./logout.php">Log Out</a></li>
                      <?php
                    }
                ?>
              </ul>
            </div>
            <form class="form-inline my-2 my-lg-0">
              <i class="fas fa-search show-search"></i>
              <div class="search">
                  <input type="text" placeholder="search here...">
                  <label class="search-box fas fa-search" for=""></label>
              </div>
              <i class="fas fa-shopping-cart"></i>
            </form>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
        </nav>
        <div class="cart-items-container">
        <?php
          if(isset($_SESSION['id'])){
            
            $all_cart1 = getRowsCart("product",$_SESSION['id']);
            foreach($all_cart1 as $cart){
              $cart2 = getRow("all_products",'id',$cart['product_id']);
              echo '<div class="cart-item">';
                  echo  '<form class="delete"  action="'.$_SERVER['PHP_SELF'].'"method="POST">';
                      echo '<input type="text" name="id" value="' . $cart['id'] . '" hidden>';
                      echo '<input type="submit" name="delete" value="x">';
                  echo '</form>';
                  echo '<img src="./uploads/' .$cart2["photo"]. '" alt="">';
                  echo '<div class="content">';
                      echo '<h3>' .$cart2['name_product']. '</h3>';
                      echo '<div class="price">$' .$cart2['price'].'</div>';
                  echo '</div>';
              echo '</div>';
            }

            $all_cart2 = getRowsCart("vipsell",$_SESSION['id']);
            foreach($all_cart2 as $cart){
              $cart2 = getRow("vip_product",'id',$cart['product_id']);
              echo '<div class="cart-item">';
                  echo  '<form class="delete"  action="'.$_SERVER['PHP_SELF'].'"method="POST">';
                      echo '<input type="text" name="id" value="' . $cart['id'] . '" hidden>';
                      echo '<input type="submit" name="deletevip" value="x">';
                  echo '</form>';
                  echo '<img src="./uploads/' .$cart2["photo"]. '" alt="">';
                  echo '<div class="content">';
                      echo '<h3>' .$cart2['name']. '</h3>';
                      echo '<div class="price">$ ' .$cart2['price_two']. '</div>';
                  echo '</div>';
              echo '</div>';
            }
            if(count($all_cart1) + count($all_cart2) == 0){
              echo '<h1 class="text-center mt-5">No Product</h1>';
            }
          }else{
              echo '<h1 class="text-center mt-5">Must Login Or Signup</h1>';
          }
          ?>
        </div>
    </section>
<section class="our_product mb-5 mt" id="product">
        <div class="container">
          <div class="header justify-content-center text-center">
            <h1>OUR <span> PRODUCTS</span></h1>
          </div>
          <div class="row">
          <?php
                    
                $all_products = getRows('all_products');
                foreach($all_products as $product){
                    echo "<div class='col-12 col-md-6 col-lg-4'>";
                        echo '<div class="product">';
                            echo '<span class="circul"></span>';
                            echo '<span class="mark">Nike</span>';
                            echo '<div class="img">';
                                echo '<img src="./uploads/' .$product["photo"]. '" alt="">';
                            echo "</div>";
                            echo "<h2>". $product['name_product']  ."</h2>";
                            echo '<div class="size">';
                                echo '<h4>Size :  </h4>
                                        <ul class="list-size">
                                            <li>5</li>
                                            <li>8</li>
                                            <li>11</li>
                                            <li>2</li>
                                        </ul>';
                                echo "</div>";
                                echo '<div class="color">
                                        <h4>Color :  </h4>
                                        <ul class="list-color">
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                    </div>';
                                echo '<div class="btn">';
                                echo  '<form class="form-buy"  action="'.$_SERVER['PHP_SELF'].'"method="POST">';
                                    echo   '<input value='.$_SESSION['id']." name='userid' hidden>";
                                    echo   "<input value='" .$product['id']. "'name='productid' hidden>";
                                    echo   '<input class="buy" type="submit" name="buy" value="Buy Now">';
                                echo '</form>';
                                echo  '</div>';
                        echo '</div>';
                    echo "</div>";
                }
            ?>
          </div>
          <?php
            if($_SESSION['id'] == 1){
                ?>
                    <div class="text-center">
                        <a href="add.php">Add Product</a>
                    </div>
                <?php
            }
            ?>
        </div>
    </section>

    <script>
      var card = document.querySelector(".cart-items-container");
          document.querySelector(".fa-shopping-cart").onclick = function(){
          card.classList.toggle("active");
      }
    </script>
</body>
</html>