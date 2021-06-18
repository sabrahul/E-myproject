<?php
    include "additionals/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>On My Mart</title>
    <link rel="stylesheet" href="rule1.css" type="text/CSS">
    <link rel="stylesheet" href="styles.css" type="text/CSS">
</head>
<hr> </hr>
<ul class="dropmenu">
<h3>Select a category</h3> 
<form action="productpage.php" method="post">
   <li class="dropdown">
        <a class="dropbtn">Fashion</a>
        <div class="dropdown-content">
            <a href="productpage.php?cat=<?php echo "men"?>">Men</a>
            <a href="productpage.php?cat=<?php echo "women"?>" >Women</a>
        </div>
    </li>
    <li class="dropdown">
        <a class="dropbtn">Mobile</a>
        <div class="dropdown-content">
                <a href="productpage.php?cat=<?php echo "samsung"?>">Samsung</a>
                <a href="productpage.php?cat=<?php echo "oppo"?>">Oppo</a>
                <a href="productpage.php?cat=<?php echo "xiomi"?>">Xiomi</a>
        </div>
    </li>
    <li class="dropdown">
        <a class="dropbtn">Electrical Appliances</a>
        <div class="dropdown-content">
            <a href="productpage.php?cat=<?php echo "refrigerator"?>">Refrigerator</a>
            <a href="productpage.php?cat=<?php echo "television"?>">Television</a>
            <a href="productpage.php?cat=<?php echo "washing machine"?>">Washing Machine</a>
        </div>
    </li>
    <li class="dropdown">
        <a class="dropbtn">Books</a>
        <div class="dropdown-content">
            <a href="productpage.php?cat=<?php echo "education"?>">Education</a>
            <a href="productpage.php?cat=<?php echo "biographies"?>">Biographies</a>
            <a href="productpage.php?cat=<?php echo "novels"?>">Novels</a>
        </div>
    </li>
    </form>
</ul>      
</body>
</html>