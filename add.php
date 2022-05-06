
<?php
include "./dp.php";
    if(isset($_POST["add"])){
        $name = $_POST["name"];
        $price = $_POST["price"] . "$";
        $type = $_POST["type"];

        $photo = rand(0, 100000000) . time() . "." . pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);

        move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $photo);

        $sql = "INSERT INTO all_products(`name_product`,`price`,`type`,`photo`) 
        VALUES('$name','$price','$type','$photo')";

        if(insert($sql)){
            header('location:all.php');
        }
    }

?>



<form class="form-login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
        <h4 class="text-center">Add product</h4>
        <input class="form-control" type="text" name="name" placeholder="Name Product" />
        <input class="form-control" type="text" name="price" placeholder="Price Product" />
        <input class="form-control" type="text" name="type" placeholder="Tybe Product" />
        <input class="form-control" type="file" name="photo" placeholder="Photo Product" />
        <input class="btn btn-primary btn-block" type="submit" value="Add Product" name="add"/>
    </form>