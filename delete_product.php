<?php

include "includes/config.php";

if(!isset($_GET['id']))
{
    header("Location: products.php");
    exit();
}

$id = intval($_GET['id']);

if(isset($_POST['delete']))
{
    if(mysqli_query($conn,"DELETE FROM products WHERE product_id=$id"))
    {
        header("Location: products.php");
        exit();
    }
    else
    {
        echo "<p style='color:red;'>An error occurred. Please try again.</p>";
    }
}

$result=mysqli_query($conn,"SELECT * FROM products WHERE product_id=$id");

$product=mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>

<html>

<head>

<title>Delete Product</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<?php include "includes/nav.php"; ?>

<div class="container">

<h1>Delete Product</h1>

<h3 style="color:red;">

Are you sure you want to delete

<b><?php echo htmlspecialchars($product['name']); ?></b> ?

</h3>

<form method="POST">

<input
type="submit"
name="delete"
value="Yes, Delete Product">

<a href="products.php">

<button type="button">

Cancel

</button>

</a>

</form>

</div>

<?php include "includes/footer.php"; ?>

</body>

</html>