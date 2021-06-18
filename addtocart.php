<?php
include "categories.php";
$msg="";
$username=$_SESSION['ADMIN_USERNAME'];
$sql="SELECT userid FROM `admin_users` WHERE username='$username'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$userid=$row['userid'];

       if(isset($_POST['delete'])){
        $product=$_GET['pid'];
        $addsql="DELETE FROM `addtocart` WHERE product_id='$product' and userid='$userid'";
        $resustsql=mysqli_query($conn,$addsql);
        if($result){
            header("location: addtocart.php");
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>On My Mart</title>
    <link rel="stylesheet" href="styles.css" type="text/CSS">
    <link rel="stylesheet" href="rule1.css" type="text/CSS">
</head>
<body>
<h2 style="margin-left: 12em;"> Your Cart </h2>

<?php 

          $qusql="SELECT * FROM `addtocart` WHERE userid='$userid'";
        $res=mysqli_query($conn,$qusql);
        if($res){
            if(mysqli_num_rows($res)>0){
            while($num=mysqli_fetch_assoc($res)){ 
                $productid=$num['product_id'];
             ?>     
            <div class="flex-container">
                <div class="flex-item1"><img src="<?php echo $num['image'];?>" style="width: 100%; height: 100%; border-radius: 12px;"></img>
            </div>
            <div class="flex-item2">
                <h5 style="color: #808080;">Product Name: <?php echo $num['product_name']; ?><br>
                MRP: <?php echo $num['price']; ?>
                </h5>
                <?php
                $quer="SELECT * FROM `orders` WHERE product_id='$productid'";
                $resultq=mysqli_query($conn,$quer);
                $count=mysqli_num_rows($resultq);
                if($count<=0)
                {
                    $querysql="SELECT * FROM `product` WHERE product_id='$productid'";
                    $resultsql=mysqli_query($conn,$querysql);
                    $run=mysqli_fetch_assoc($resultsql);
                    $status=$run['status'];
                    if($status=="1"){
                    ?>
                <form method="post" action="orderproduct.php?id=<?php echo $productid; ?>">
                      <button type="submit" name="buy" style="width: 100px; height: 38px; font-size: 15px;">Buy</button> 
                </form>                                 
                <?php }
                else{
                    echo "out of stock";
                }}
                
                ?>
                <form method="post" action="?pid=<?php echo $productid; ?>">

                <button style="width: 100px; height: 38px; font-size: 15px;" type="submit" name="delete"> Delete from Cart</button>
            </form>
            <form action="product.php?id=<?php echo $productid ?>" method="post">
                <button type="submit" name="product" value="detail" style="width: 100px; height: 38px; font-size: 15px;">Product Detail</button>
            </form>
            </div>
        </div>
        <?php   
        }}
        else{
            ?>
            <h2 style="margin-left: 15em; color: red;">There are no Products in your Wishlist</h2>
<?php 
        }        }    
          ?> 
    
    
</body>
</html>