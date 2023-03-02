<?php
session_start();
    // DELETE DATA
    include_once("../../database/config.php");
    if(isset($_GET['erase'])){
        $delete_product = $_GET['erase'];

        $Erase = mysqli_query($PDO, "DELETE FROM `products` WHERE pid = $delete_product");
        unlink('../../public/img/'.$Erase['image']);

        $Erase = mysqli_query($PDO, "DELETE FROM `cart` WHERE cid = $delete_product");

        $Erase = mysqli_query($PDO, "DELETE FROM `wishlist` WHERE wid = $delete_product");

        header("location: ./");
    }
?>
<?php
    // DISPLAY PRODUCT DATA VIA ID
    if (isset($_GET['more']) || $_POST['more']) {
        $product_ID = $_GET['more'];

        $fetch_arrays = mysqli_query($PDO, "SELECT * FROM `products` WHERE pid = '$product_ID'");
        
        while($Val = mysqli_fetch_array($fetch_arrays)){
            $pid = $Val['pid'];
            $new_name = $Val['P_name'];
            $page_title = $Val['P_name'];
            $new_SKU = $Val['P_Sku'];
            $new_price = $Val['P_price'];
            $new_category = $Val['P_category'];
            $new_image = $Val['P_image'];
            $new_details = $Val['P_detail'];
            $new_unit = $Val['P_unit'];
            $new_stock = $Val['P_qty'];
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
        <title>Admin | Online Market</title>
        <link rel="stylesheet" href="../../node_modules/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <div class="bg-info">
                <div class="container p-3">
                    <a href="./" class="btn btn-lg btn-warning" style="float:right;">Go Back</a>
                    <h1>Details of (<a class="text-danger" href="./action.php?more=<?=$pid?>"><?=$new_name?></a>)<i class="badge p-2 m-1 bg-danger">¢<?=$new_price?>.99</i></h1>
                </div>
            </div>
        </header>
        <main>
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3"></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-4"><img src="../../public/img/<?=$new_image?>" class="fluid img-fluid" alt="image"></div>
                        <div class="col col-md-8">
                            <h3> Datasheet</h3>
                            <form method="post">
                                <p class="card-text"><?=$new_details?>.</p>
                                <h3>Category: <i class="text-danger"><?=$new_category?></i></h3>
                                <div style="display:flex;flex-direction:row;" class="row">
                                    <!-- <div class="row">
                                        <button class="btn btn-danger" onclick="reduceSelection();" style="width:15%;"><i class="fa fa-minus-circle fa-lg"></i></button>
                                        <input style="margin-right:10px;margin-left:10px;width:20%;text-align:center;border:1px solid skyblue;" class="form-control" type="number" value="<?=$cart_value?>" id="user_cart_selection" name="user_cart_selection" id="">
                                        <button class="btn btn-success" onclick="addSelection();" style="width:15%;margin-right:10px;"><i class="fa fa-plus-circle fa-lg"></i></button>
                                        <a style="width:30%;" href="./checkout/index.php?checkoutID=<?=$pid?>" name="add_basket" class="text-decoration-none btn btn-sm btn-light btn-outline-primary">Add To Basket</a>
                                    </div>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <!-- Footer -->
    <div class="bg-info py-3">
        <footer class="container py-5">
            <div class="row">
                <div class="d-flex flex-column flex-sm-row justify-content-between py-4 border-top">
                <p>&copy; <?php echo date("Y"); ?> Angel Dev Team. All rights reserved.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
                </ul>
            </div>
        </footer>
    </div>
        <script src="../../node_modules/bootstrap/bootstrap.min.js"></script>
    </body>
</html>
