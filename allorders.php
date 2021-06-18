<?php 
include "adminadditionals/adminheader.php"; 
$uid=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>
    <link rel="stylesheet" href="styles2.css" type="text/CSS">
    <link rel="stylesheet" href="table.css" type="text/CSS">


</head>
<body>
<h2 style="margin-left:2em;margin-top: 11em;"> Orders of user no. <?php echo $uid;?> </h2>
<?php
    $sql="SELECT * FROM `orders` where userid ='$uid' ORDER BY id DESC";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)){ ?>

        <table style="margin-top: 2em; margin-left: 1em;">
        <tr>
        <th>Sr no.</th>
        <th>Product id</th>
        <th>product Name</th>
        <th>size</th>
        <th>order date and time</th>

        </tr>
        <?php 
    // $sql="SELECT * FROM `orders` where userid ='$uid' ORDER BY id DESC";
    // $result=mysqli_query($conn,$sql);
    // if(mysqli_num_rows($result)){
    while($row=mysqli_fetch_assoc($result)){
        $i=1;
        ?>
        <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['product_id']; ?></td>
        <td><?php echo $row['product_name']; ?></td>
        <td><?php echo $row['size']; ?></td>
        <td><?php echo $row['date']; ?></td>
        </tr>
   <?php  $i++;}}
   else{
       echo "There are no orders from this Client";
   }

?>
    
</body>
</html>