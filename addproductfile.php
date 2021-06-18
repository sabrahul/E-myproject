require('additionals/header.php');
$userid='';
$name='';
$price='';
$qty='';
$image='';
$short_desc	='';
$description	='';
$category='';
$target_gender='';
$msg='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($conn,$_GET['id']);
	$res=mysqli_query($conn,"select * from product where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$userid=$row['userid'];
		$name=$row['product_name'];
		$price=$row['price'];
		$short_desc=$row['short_desc'];
		$description=$row['description'];
        $category=$row['category'];
		$target_gender=$row['target_gender'];
	}else{
		header('location:product.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$userid=get_safe_value($conn,$_POST['userid']);
	$name=get_safe_value($conn,$_POST['product_name']);
	$price=get_safe_value($conn,$_POST['price']);
	$short_desc=get_safe_value($conn,$_POST['short_desc']);
	$description=get_safe_value($conn,$_POST['description']);	
    $target_gender=get_safe_value($conn,$_POST['target_gender']);	
	$category=get_safe_value($conn,$_POST['category']);	
	$res=mysqli_query($conn,"select * from product where product_name='$name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Product already exist";
			}
		}else{
			$msg="Product already exist";
		}
	}
	
	
	if($_GET['id']==0){
		if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
			$msg="Please select only png,jpg and jpeg image formate";
		}
	}else{
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg="Please select only png,jpg and jpeg image formate";
			}
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],productimages.$image);
				$update_sql="update product set userid='$userid',name='$name',price='$price',short_desc='$short_desc',description='$description',image='$image' where id='$id'";
			}else{
				$update_sql="update product set userid='$userid',name='$name',price='$price',qty='$qty',short_desc='$short_desc',description='$description' where id='$id'";
			}
			mysqli_query($conn,$update_sql);
		}else{
			$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],productimages.$image);
			mysqli_query($conn,"insert into product(userid,name,price,qty,short_desc,description,status,image) values('$userid','$name','$mrp','$price','$qty','$short_desc','$description','1','$image')");
		}
		header('location:product.php');
		die();
	}
}
