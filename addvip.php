
<?php
include "./dp.php";
    if(isset($_POST["add"])){
        $name = $_POST["name"];
        $priceone = $_POST["priceone"];
        $pricetwo = $_POST["pricetwo"];

        $photo = rand(0, 100000000) . time() . "." . pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);

        move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $photo);

        $sql = "INSERT INTO Vip_product(`name`,`price_one`,`price_two`,`photo`) 
        VALUES('$name','$priceone','$pricetwo','$photo')";

        if(insert($sql)){
            header('location:vip.php');
        }
    }

?>



<form class="form-login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
        <h4 class="text-center">Add Vip product</h4>
        <input class="form-control" type="text" name="name" placeholder="Name Product" />
        <input class="form-control" type="text" name="priceone" placeholder="Price One" />
        <input class="form-control" type="text" name="pricetwo" placeholder="Price Two" />
        <input class="form-control" type="file" name="photo" placeholder="Photo Product" />
        <input class="btn btn-primary btn-block" type="submit" value="Add vip Product" name="add"/>
    </form>