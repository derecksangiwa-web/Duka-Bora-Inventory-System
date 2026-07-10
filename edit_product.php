<?php
include "includes/config.php";

$message = "";

if(!isset($_GET['id']))
{
    header("Location: products.php");
    exit();
}

$id = intval($_GET['id']);

$result = mysqli_query($conn,"SELECT * FROM products WHERE product_id=$id");

if(mysqli_num_rows($result)==0)
{
    header("Location: products.php");
    exit();
}

$product = mysqli_fetch_assoc($result);     
setcookie(
    "last_product",
    $product['name'],
    time() + (86400 * 30),
    "/"
);                   
                         
if(isset($_POST['update']))
{
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $category = intval($_POST['category']);
    $supplier = intval($_POST['supplier']);

    if(
        empty($name) ||
        $price<=0 ||
        $stock<0
    )
    {
        $message="<p style='color:red;'>Please enter valid data.</p>";
    }
    else
    {
        $sql="UPDATE products SET

        name='$name',
        category_id='$category',
        supplier_id='$supplier',
        price='$price',
        stock_qty='$stock'

        WHERE product_id=$id";

        if(mysqli_query($conn,$sql))
        {
            $message="<p style='color:green;'>Product updated successfully.</p>";

            $result=mysqli_query($conn,"SELECT * FROM products WHERE product_id=$id");
            $product=mysqli_fetch_assoc($result);
        }
        else
        {
            $message="<p style='color:red;'>Unable to update product.Please try again.</p>";
        }
    }
}
?>

<!DOCTYPE html>

<html>

<head>

<title>Edit Product</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<?php include "includes/nav.php"; ?>

<div class="container">

<h1>Edit Product</h1>

<?php echo $message; ?>

<form method="POST">

<label>Product Name</label>

<input
type="text"
name="name"
value="<?php echo htmlspecialchars($product['name']); ?>"
required>

<label>Price</label>

<input
type="number"
step="0.01"
name="price"
value="<?php echo $product['price']; ?>"
required>

<label>Stock Quantity</label>

<input
type="number"
name="stock"
value="<?php echo $product['stock_qty']; ?>"
required>

<label>Category</label>

<select name="category">

<?php

$categories=mysqli_query($conn,"SELECT * FROM categories");

while($row=mysqli_fetch_assoc($categories))
{

$selected="";

if($row['category_id']==$product['category_id'])
{
    $selected="selected";
}

echo "<option value='".$row['category_id']."' $selected>".$row['category_name']."</option>";

}

?>

</select>

<label>Supplier</label>

<select name="supplier">

<?php

$suppliers=mysqli_query($conn,"SELECT * FROM suppliers");

while($row=mysqli_fetch_assoc($suppliers))
{

$selected="";

if($row['supplier_id']==$product['supplier_id'])
{
    $selected="selected";
}

echo "<option value='".$row['supplier_id']."' $selected>".$row['supplier_name']."</option>";

}

?>

</select>

<input
type="submit"
name="update"
value="Update Product">

</form>

</div>

<?php include "includes/footer.php"; ?>

</body>

</html>