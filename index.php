<?php
    session_start();
    include "./dp.php";
    if(isset($_POST['buy'])){
      $productid = $_POST['productid'];
      $userid = $_POST['userid'];
      $sql = "INSERT INTO product(`product_id`,`user_id`) VALUES('$productid','$userid')";
      insert($sql);
      header('refresh:0');
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
    <title>Nike_Shoes</title>
</head>
<body>
    <section class="navbar" id="home">
        <nav class="navbar navbar-expand-lg navbar-light container">
            <a class="navbar-brand" href="#"><img src="./images/logo5.png" alt=""></a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                  <a class="nav-link home" data-link="home" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link about" data-link="about" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link product" data-link="product" href="#">Product</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link review" data-link="review" href="#">Review</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link stats" data-link="stats" href="#">Stats</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link contact" data-link="contact" href="#">Contact</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link vip" data-link="vip" href="#">Vip</a>
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

    

    <section class="head" id="home">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="title">
                  <h1>ADIDAS ARE THE BEST CHOISE FOR YOU</h1>
                  <p>Lorem, Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Rem 
                    Culpa Sit Ea Quos Officia Expedita Rerum Adipisci,
                  </p>
                  <div class="btn">
                    <a href="#">Get Yours Now</a>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                  <div class="img text-right">
                      <img src="./images/logo3.png" alt="">
                  </div>
              </div>
            </div>
        </div>
    </section>

    <section class="about-us" id="about">
        <div class="container">
            <div class="header justify-content-center text-center">
                <h1> <span>ABOUT</span>US</h1>
            </div>
            <div class="row ai">
              <div class="col-12 col-lg-6">
                <div class="img">
                    <img src="./images/redshoes.jpg" alt="">
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="title">
                      <h1>What Makes Your Feet Comfortable?</h1>
                      <p>Lorem Ipsum Dolor Sit Amet Consectetur, Lorem Ipsum Dolor Sit Amet Consectetur,
                        Lorem Ipsum Dolor Sit Amet Consectetur,
                      </p>
                      <p>Lorem Ipsum Dolor Sit Amet Consectetur, Lorem Ipsum Dolor Sit Amet Consectetur,
                        Lorem Ipsum Dolor Sit Amet Consectetur,
                      </p>
                      <div class="btn">
                        <a href="#">Learn More</a>
                      </div>
                </div>
              </div>
            </div>
        </div>
    </section>

    <section class="our_product mb-5" id="product">
        <div class="container">
          <div class="header justify-content-center text-center">
            <h1>OUR <span> PRODUCTS</span></h1>
          </div>
          <div class="row">
          <?php
                $all_products = getRowsIndex('all_products');
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
        </div>
    </section>

    <section class="customer" id="review">
      <div class="container">
        <div class="header justify-content-center text-center">
          <h1>CUSTOMERS  <span> REVIEW</span></h1>
        </div>
        <div class="row">
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
              <div class="content">
                <i class="fas fa-quote-right"></i>
                <p>Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Similique Nihil Hic Veritatis,
                  Officiis Voluptatem Porro. Reprehenderit Nobis Corporis Voluptates Sequi Labore Laboriosam
                  Iste Aspernatur Hic Quaerat, Officia, Sunt Eligendi! Quisquam.
                </p>
              </div>
              <div class="img">
                <div class="out"><div class="in"></div></div>
                <img src="./images/team1.jpg" alt="">
              </div>
              <h3>Mohmaed Samie</h3>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div><div class="col-12 col-md-6 col-lg-4">
            <div class="card">
              <div class="content">
                <i class="fas fa-quote-right"></i>
                <p>Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Similique Nihil Hic Veritatis,
                  Officiis Voluptatem Porro. Reprehenderit Nobis Corporis Voluptates Sequi Labore Laboriosam
                  Iste Aspernatur Hic Quaerat, Officia, Sunt Eligendi! Quisquam.
                </p>
              </div>
              <div class="img">
                <div class="out"><div class="in"></div></div>
                <img src="./images/team1.jpg" alt="">
              </div>
              <h3>Mohmaed Samie</h3>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div><div class="col-12 col-md-6 col-lg-4">
            <div class="card">
              <div class="content">
                <i class="fas fa-quote-right"></i>
                <p>Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Similique Nihil Hic Veritatis,
                  Officiis Voluptatem Porro. Reprehenderit Nobis Corporis Voluptates Sequi Labore Laboriosam
                  Iste Aspernatur Hic Quaerat, Officia, Sunt Eligendi! Quisquam.
                </p>
              </div>
              <div class="img">
                <div class="out"><div class="in"></div></div>
                <img src="./images/team2.jpg" alt="">
              </div>
              <h3>Mohmaed Samie</h3>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div><div class="col-12 col-md-6 col-lg-4">
            <div class="card">
              <div class="content">
                <i class="fas fa-quote-right"></i>
                <p>Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Similique Nihil Hic Veritatis,
                  Officiis Voluptatem Porro. Reprehenderit Nobis Corporis Voluptates Sequi Labore Laboriosam
                  Iste Aspernatur Hic Quaerat, Officia, Sunt Eligendi! Quisquam.
                </p>
              </div>
              <div class="img">
                <div class="out"><div class="in"></div></div>
                <img src="./images/team1.jpg" alt="">
              </div>
              <h3>Mohmaed Samie</h3>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div><div class="col-12 col-md-6 col-lg-4">
            <div class="card">
              <div class="content">
                <i class="fas fa-quote-right"></i>
                <p>Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Similique Nihil Hic Veritatis,
                  Officiis Voluptatem Porro. Reprehenderit Nobis Corporis Voluptates Sequi Labore Laboriosam
                  Iste Aspernatur Hic Quaerat, Officia, Sunt Eligendi! Quisquam.
                </p>
              </div>
              <div class="img">
                <div class="out"><div class="in"></div></div>
                <img src="./images/team3.jpg" alt="">
              </div>
              <h3>Mohmaed Samie</h3>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div><div class="col-12 col-md-6 col-lg-4">
            <div class="card">
              <div class="content">
                <i class="fas fa-quote-right"></i>
                <p>Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Similique Nihil Hic Veritatis,
                  Officiis Voluptatem Porro. Reprehenderit Nobis Corporis Voluptates Sequi Labore Laboriosam
                  Iste Aspernatur Hic Quaerat, Officia, Sunt Eligendi! Quisquam.
                </p>
              </div>
              <div class="img">
                <div class="out"><div class="in"></div></div>
                <img src="./images/team2.jpg" alt="">
              </div>
              <h3>Mohmaed Samie</h3>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="state" id="stats">
      <div class="container">
        <div class="header justify-content-center text-center">
          <h1>OUT<span> STATE</span></h1>
        </div>
        <div class="row justify-content-center">
          <div class="box text-center">
            <i class="far fa-user fa-2x fa-fw"></i>
            <span class="num" data-num="500">0</span>
            <span class="name">Client</span>
          </div><div class="box text-center">
            <i class="fas fa-globe-asia fa-2x fa-fw"></i>
            <span class="num" data-num="120">0</span>
            <span class="name">Counteries</span>
          </div><div class="box text-center">
            <i class="far fa-money-bill-alt fa-2x fa-fw"></i>
            <span class="num" data-num="364">0</span>
            <span class="name">Money</span>
          </div><div class="box text-center">
            <i class="far fa-user fa-2x fa-fw"></i>
            <span class="num" data-num="784">0</span>
            <span class="name">Client</span>
          </div>
        </div>
      </div>
    </section>

    <section class="contact" id="contact">
      <div class="container">
        <div class="header justify-content-center text-center">
          <h1><span>CONTACT</span>US</h1>
        </div>
        <div class="row reg">
          <div class="col-12 col-lg-6">
            <div class="contact-map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3418.330599196966!2d31.35587538538126!3d31.0448948775727!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f79e7f6abfea23%3A0xe9b3681bca592a1d!2z2YPZhNmK2Kkg2KfZhNi52YTZiNmFINis2KfZhdi52Kkg2KfZhNmF2YbYtdmI2LHYqQ!5e0!3m2!1sar!2seg!4v1616858150309!5m2!1sar!2seg" width="100%" height="360" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <form action="" class="text-center">
              <h1>GET IN TOUCH</h1>
              <div class="name">
                <label for=""><i class="fas fa-user"></i></label>
                <input type="text" placeholder="Name">
              </div>
              <div class="email">
                <label for=""><i class="fas fa-envelope"></i></label>
                <input type="email" placeholder="Email">
              </div>
              <div class="number">
                <label for=""><i class="fas fa-phone"></i></label>
                <input type="text" placeholder="Number">
              </div>
              <div class="btn">
                <input type="submit" value="Contact Us">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>


    <section class="vip-product" id="vip">
      <div class="container">
        <div class="header justify-content-center text-center">
          <h1>OUR<span> VIP PRODUCTS</span></h1>
        </div>
        <div class="row">
        <?php
                    
                    $Vip_products = getRows('vip_product');
                    foreach($Vip_products as $product){
                        echo '<div class="col-12 col-md-6 col-lg-4">';
                            echo '<div class="box">';
                                echo '<div class="icons justify-content-center">';
                                    echo '<span class="shoping" href="#"><i class="fas fa-shopping-cart"></i></span>';
                                    echo  '<form class="form-buy"  action="'.$_SERVER['PHP_SELF'].'"method="POST">';
                                        echo   '<input value='.$_SESSION['id']." name='userid' hidden>";
                                        echo   "<input value='" .$product['id']. "'name='productid' hidden>";
                                        echo   '<input class="add_cart" type="submit" name="buyvip" value="Buy Now" hidden>';
                                    echo  '</form>';
                                    echo    '<ul>
                                                <li><i class="fas fa-heart"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-search"></i></li>
                                            </ul>';
                                echo '</div>';
                                echo '<div class="img"><img src="./uploads/' . $product['photo'] .'" alt=""></div>';
                                echo '<div class="content text-center">';
                                    echo '<h3> ' . $product['name'] . ' </h3>';
                                    echo '<div class="star">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>';
                                    echo '<div class="price">';
                                        echo  '$'.$product['price_one'];
                                        echo ' <span>$ '.$product['price_two'].'</span>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                ?>
        </div>
      </div>
    </section>

<footer class="text-center">
  <ul>
    <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
    <li><a href=""><i class="fab fa-twitter"></i></a></li>
    <li><a href=""><i class="fab fa-instagram"></i></a></li>
    <li><a href=""><i class="fab fa-linkedin"></i></a></li>
  </ul>
  <hr>
  <h1>Created By<span> Mostafa Hesham</span> Frontend Developer</h1>
</footer>

<a class="moveUp" href="#">
  <i class="fas fa-long-arrow-alt-up"></i>
</a>

    <script src="js/jquery.js"></script>
    <script src="./js/bootstrap.bundle.js"></script>
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="js/main.js"></script>
</body>
</html>