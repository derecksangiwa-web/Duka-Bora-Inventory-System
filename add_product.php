<?php
include "includes/config.php";

$message = "";

if(isset($_POST['save']))
{
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $category = intval($_POST['category']);
    $supplier = intval($_POST['supplier']);

    if(
        empty($name) ||
        $price <= 0 ||
        $stock < 0 ||
        $category <= 0 ||
        $supplier <= 0
    )
    {
        $message = "<p style='color:red;'>Please enter valid data.</p>";
    }
    else
    {
        $sql = "INSERT INTO products
        (name,category_id,supplier_id,price,stock_qty)
        VALUES
        ('$name','$category','$supplier','$price','$stock')";
if(mysqli_query($conn,$sql))
{
    $message="<p style='color:green;'>Product added successfully.</p>";
}
else
{
    $message="<p style='color:red;'>An error occurred. Please try again.</p>";
}
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Product</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<?php include "includes/nav.php"; ?>

<div class="container">

<h1>Add Product</h1>

<?php echo $message; ?>

<form method="POST">

<label>Product Name</label>

<input
type="text"
name="name"
required>

<label>Price</label>

<input
type="number"
step="0.01"
name="price"
required>

<label>Stock Quantity</label>

<input
type="number"
name="stock"
required>

<label>Category</label>

<select name="category" required>

<option value="">Select Category</option>

<?php

$result=mysqli_query($conn,"SELECT * FROM categories");

while($row=mysqli_fetch_assoc($result))
{

echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";

}

?>

</select>

<label>Supplier</label>

<select name="supplier" required>

<option value="">Select Supplier</option>

<?php

$result=mysqli_query($conn,"SELECT * FROM suppliers");

while($row=mysqli_fetch_assoc($result))
{

echo "<option value='".$row['supplier_id']."'>".$row['supplier_name']."</option>";

}

?>

</select>

<input
type="submit"
name="save"
value="Add Product">

</form>

</div>

<?php include "includes/footer.php"; ?>

</body>

</html>