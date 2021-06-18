<?php
    include "additionals/header.php";
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
    if(isset($_POST['submit'])){
		$product_id=get_safe_value($conn,$_POST['product_id']);
        $product_name=get_safe_value($conn,$_POST['product_name']);
		$price=get_safe_value($conn,$_POST['price']);
        $quantity=get_safe_value($conn,$_POST['qty']);

		$short_desc=get_safe_value($conn,$_POST['short_desc']);
		$description=get_safe_value($conn,$_POST['description']);
		$category=get_safe_value($conn,$_POST['category']);
        
        $target_gender=get_safe_value($conn,$_POST['target_gender']);
		$status=get_safe_value($conn,$_POST['status']);
        $filename=($_FILES['my_image']['name']);
        if(isset($_POST['boxes'])){
            $t1=implode(',', $_POST['boxes']);
        $existsql="SELECT * FROM `product` WHERE product_id = '$product_id'";
        $result=mysqli_query($conn,$existsql);
		$numrows=mysqli_num_rows($result);
        if($numrows<=0){
            $price=$price+(0.1*$price);
            $filename = $_FILES["my_image"]["name"];
            $tempname = $_FILES["my_image"]["tmp_name"];
            $filesize = $_FILES["my_image"]["size"];
            $error = $_FILES["my_image"]["error"];          
            if ($error === 0) {
                if ($filesize > 12500000) {
                    $msg = "Sorry, your file is too large.";
                    header("Location: home.php?error=$msg");
                }else {
                    $img_ex = pathinfo($filename, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
        
                    $allowed_exs = array("jpg", "jpeg", "png"); 
        
                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                        $img_upload_path = 'productimages/'.$new_img_name;
                        move_uploaded_file($tempname, $img_upload_path);
//$sql="INSERT INTO `product` ( `product_name`, `price`,  `short_desc`, `desription`, `status`, `product_id`, `category`, `target_gender`,`my_image`) 
  //                      VALUES ('$product_name', '$price', '$short_desc', '$description', '$status', '$product_id', '$category', '$target_gender','$filename')";
                        $sql="INSERT INTO `ecom`.`product` (`userid`, `product_id`, `product_name`, `price`,`qty`, `short_desc`, `desription`, `target_gender`, `category`, `status`, `image`,`size`) 
                        VALUES ('$userid', '$product_id', '$product_name', '$price', '$quantity','$short_desc', '$description', '$target_gender', '$category', '$status', '$img_upload_path','$t1')";  
                        $result=mysqli_query($conn,$sql);
                        if($result){		                    
                            $msg = "Image uploaded successfully";
                            header("location: addproduct.php");
                        }
                        else{
                            $msg = "Failed to upload image";
                        }
                    }
                    else{
                    
                        $msg="This type of file is not allowed";
                    }
                }
            }
            else{
                    $msg="unknown error occured";;
            }            
        }
        else{
                $msg="This product already exists";
        }
    }}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product form</title>
    <link rel="stylesheet" href="styles1.css" type="text/CSS">
    <link rel="stylesheet" href="addform.css" type="text/CSS">
    <link rel="stylesheet" href="image.css" type="text/CSS">

</head>
<body>
<hr> </hr>
    <div class="form-container">
		<form action="" method="post" id="form" enctype="multipart/form-data">
			<h3 style="margin-top: 20px; margin-bottom: 20px;">Add Product</h3>
			
			<div class="container">
				<input type="text" name="product_id" placeholder="Enter Product ID" required/>
			</div>
			
			<div class="container">
				<input type="text" name="product_name" placeholder="Enter Product Name" required/>
			</div>

			<div class="container">
				<input type="text" name="price" placeholder="Selling Price" required/>
			</div>

            <div class="container">
				<input type="number" name="qty" placeholder="Quantity you have" required/>
			</div>

            <div class="container">
				<input style="height: 4em;" type="text" name="short_desc" placeholder="Enter a Short Description" required/>
			</div>
            <div class="container">
				<input  style="height: 10em;" type="text" name="description" placeholder="Enter a Long Description" required/>
			</div>
            <div style="display: inline-flex;">
                <h2 style="color:#11cf4d; margin-left: -3em; margin-top: 50px;"> Select category of product: </h2>
                <select name="category" style="margin-left: 3em; margin-top: 50px; color: #11cf4d;"required>
                    <optgroup label="Fashion"> 
                        <option value="men">Men
                        <option value="women">Women
                    </optgroup>
                    <optgroup label="Mobile"> 
                        <option value="samsung">Samsung
                        <option value="oppo">oppo
                        <option value="xiomi">Xiomi
                    </optgroup>
                    <optgroup label="Electrical Appliances"> 
                        <option value="refrigerator">Refrigerator
                        <option value="television">Television
                        <option value="washing machine">Washing Machine
                    </optgroup>
                    <optgroup label="Books"> 
                        <option value="novels">Novels
                        <option value="biograpphies">Biographies
                        <option value="education">Education
                    </optgroup>
                </select>
           </div>
           <div style="color: #11cf4d; display: inline-block; margin-top: 20px;">
           <h2 style="margin-left: -2.8em; "> Check Sizes you have: </h2>               
            <label class="container" >Medium
            <input type="checkbox"name="boxes[]" value="m" >
            </label><br>
            <label class="container">Large
            <input type="checkbox" name="boxes[]" value="l">
            </label><br>
            <label class="container">Extra Large
            <input type="checkbox" name="boxes[]" value="el">
            </label> 
            </div><br>
             <div style="color: #11cf4d; display: inline-block; margin-top: 20px;">
               <h2 style="margin-left: -2.8em; "> Select your Target Gender: </h2>               
                 <input type="radio" name="target_gender" value="male" required>Male</input>
                <input type="radio" name="target_gender" value="female" required>Female</input>
            </div>
            <div style="color: #11cf4d;" >
               <h2 style="margin-left: -3em;"> Status of Product: </h2>
                <input type="radio" name="status" value="0" required>Not available Now</input>
                <input type="radio" name="status" value="1" required>Available</input>
            </div>
            <div style="color: #11cf4d; margin-top: 30px;">
               <h2 style="margin-left: -3em;"> Choose a image: </h2><input type="file" name="my_image" />
            </div>
            <div class="errormsg"><?php echo $msg?></div>
            <input class="container" style="margin-top: 35px; margin-left: 0em; " type="submit" name="submit" value="Submit"/>
        </form>
    </div>
    

</body>
</html>