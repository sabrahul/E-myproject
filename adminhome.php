<?php
    include "adminadditionals/adminheader.php";
    if(isset($_POST['approve'])){
      $product=$_GET['id'];
     $addsql="INSERT INTO `adminproduct` (SELECT * FROM `product` where product_id='$product')";
     $resultsql=mysqli_query($conn,$addsql);
     if($resultsql){
         header("location: adminhome.php");
     }        
 }
     if(isset($_POST['delete'])){
        $product=$_GET['id'];
        $addsql="DELETE FROM `adminproduct` WHERE product_id='$product'";
        $resultsql=mysqli_query($conn,$addsql);
        if($resultsql){
            header("location: adminhome.php");
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
    <!-- <link rel="stylesheet" href="styles2.css" type="text/CSS"> -->
    <link rel="stylesheet" href="table.css" type="text/CSS">


</head>
<body>
<h2 style="margin-top: 11em; text-align:center;"> New Arrivals </h2>
  <table style="margin-top:2em;">
  <tr>
    <th>Sr no</th>
    <th>Product id</th>
    <th>Owner Id</th>
    <th>Product Name</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Size</th>
    <th>Category</th>
    <th>Added on</th>
    <th>Action</th>
    <th>Open details</th>
  </tr>
  <?php

  $s=1;
        $sql="SELECT * FROM `product` WHERE status='$s'";
        $result=mysqli_query($conn,$sql);
        if($result){
            $i=1; 
           while( $row=mysqli_fetch_assoc($result)){ 
             $productid=$row['product_id'];
             $image=$row['image'];
             $image1="".$image;  
                        ?>       
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row['product_id']; ?></td>
    <td><?php echo $row['userid']; ?></td>
    <td><?php echo $row['product_name']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td><?php echo $row['qty']; ?></td>
    <td><?php echo $row['size'] ?></td>
    <td><?php echo $row['category'] ?></td>
    <td> <?php echo $row['date'] ?></td>
    <td>
        <form method="post" action="?id=<?php echo $productid; ?>">
                <?php
                $existsql="Select * from adminproduct where product_id='$productid'";
                $res=mysqli_query($conn,$existsql);
                $numrows=mysqli_num_rows($res);
                if($numrows<=0){
                       ?> 
                    <button type="submit" name="approve" value="approve">Approve</button>
                    <?php 
                    }
                    else{
                        ?>
                        <button type="submit" name="delete" value="delete">Delete</button>
                    <?php }
                    ?>
        </form>
    </td>
    <td>
        <form method="post" action="productpage1.php?id=<?php echo $productid; ?>">
                <button type="submit" name="product" value="detail">Product Detail</button> 
        </form>
    </td>

  
  
  </tr>
  <?php $i++;}} ?> 
  </table>
         
         
         
         
         
          <?php

           // include "adminadditionals/admingrid.php";
            
        ?>
</body>