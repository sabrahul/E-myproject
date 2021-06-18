<?php
     include "additionals/header.php";
    //include "categories.php";

    $msg="";
    $username=$_SESSION['ADMIN_USERNAME'];
    $sql="SELECT userid FROM `admin_users` WHERE username='$username'";
    $result=mysqli_query($conn,$sql);
    if($result){
        $row=mysqli_fetch_assoc($result);
        $userid=$row['userid'];
    }
    else{
         $msg="QUERY 1 FALED";
    }
    if(isset($_POST['incqty'])){
        $product=$_GET['id'];
        $inc=get_safe_value($conn,$_POST['inc']);
        $sql8="SELECT * FROM `product` WHERE product_id='$product'";
        $result8=mysqli_query($conn,$sql8);
        if($result8){
            $num=mysqli_fetch_assoc($result8);
            $qty=$num['qty'];
            $qtyn=$qty+$inc;
            $addsql="UPDATE `product` SET `qty`='$qtyn' WHERE product_id='$product'";
            $rest=mysqli_query($conn,$addsql);
            if($rest){
            header("location: addproduct.php");
        }}
    }
    if(isset($_POST['deactive'])){
        $product=$_GET['id'];
        $addsql="UPDATE `product` SET `status`='0' WHERE product_id='$product'";
        $resultsql=mysqli_query($conn,$addsql);
        if($resultsql){
            header("location: addproduct.php");
        }
    }
    if(isset($_POST['active'])){
        $product=$_GET['id'];
        $addsql="UPDATE `product` SET `status`='1' WHERE product_id='$product'";
        $resultsql=mysqli_query($conn,$addsql);
        if($resultsql){
            header("location: addproduct.php");
        }
    } 
    if(isset($_POST['delete'])){
        $product=$_GET['id'];
        $addsql="DELETE FROM `product` WHERE product_id='$product'";
        $resultsql=mysqli_query($conn,$addsql);
        if($resultsql){
            header("location: addproduct.php");
        }
 }       
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles1.css" type="text/CSS">
</head>
<body>
    <hr> </hr>
    <div class="item-container">
        <div class="add-container">
            <h2> Your Products </h2>
		    <a href="addform.php">Add New Product </a>
        </div>
    </div>
    <?php
        $sql="SELECT * FROM `product` WHERE userid='$userid' ORDER BY id DESC";
        $result=mysqli_query($conn,$sql);
        if($result){
           while( $row=mysqli_fetch_assoc($result)){ 
               $productid=$row['product_id'];
             ?>
            <div class='product'>
            <div class='itemimg'>
            <img src='<?php echo $row['image']; ?>' style='width:100%; height:100%;'>
            </div>
            <div class='item2'>

            <h3>Product ID: <?php echo $row['product_id']; ?></h3>
            <h4>Product Name: <?php echo $row['product_name']; ?></h4>


            </div>
            <div class='item3'>
               <h4 style="height: fit-content; margin-bottom: 3px;"> Rs.<?php echo $row['price']; ?></h4>
                Quantity Added:<?php echo  $row['qty']; ?><br>
                Size available:<?php echo $row['size']; ?>
            </div>
            <div class='item4'>
            <form action="?id=<?php echo $productid ?>" method="post">                
                <button type='submit' name='delete'>Delete</button>
                <?php 
                    $myquery="SELECT status from `product` where product_id='$productid'";
                    $myresult=mysqli_query($conn,$myquery);
                    if($myresult)
                    {
                        $num=mysqli_fetch_assoc($myresult);
                        $status=$num['status'];
                        if($status=='1'){
                ?>
                <button type='submit' name='deactive'>Deactivate</button>
                Increase Quantity: <input type='number' name='inc'/>
                <button type='submit' name='incqty'>Submit</button>
                <?php 
                        }
                        else{
                            ?>
                            <button type='submit' name='active'>Activate</button>

            <?php }}
                ?>
         </form>
         </div>
        </div>
       <?php 
    }}
    else{
        echo "there is a problem with database sorry";
    }
         
         ?>        
</body>
</html>