<?php
include "includes/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Products</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<?php include "includes/nav.php"; ?>

<div class="container">

<h1>Products</h1>
<?php

if(isset($_COOKIE['last_product']))
{
    echo "<p><strong>Last Viewed Product:</strong> "
    . htmlspecialchars($_COOKIE['last_product'])
    . "</p>";
}

?>

<table>

<tr>

<th>ID</th>

<th>Product Name</th>

<th>Category</th>

<th>Supplier</th>

<th>Price (TZS)</th>

<th>Stock</th>

<th>Status</th>

<th>Action</th>

</tr>

<?php

$sql = "SELECT
products.product_id,
products.name,
categories.category_name,
suppliers.supplier_name,
products.price,
products.stock_qty

FROM products

JOIN categories
ON products.category_id = categories.category_id
JOIN suppliers
ON products.supplier_id = suppliers.supplier_id

ORDER BY products.product_id ASC";

$result = mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result))
{

echo "<tr>";

echo "<td>".$row['product_id']."</td>";

echo "<td>".$row['name']."</td>";

echo "<td>".$row['category_name']."</td>";

echo "<td>".$row['supplier_name']."</td>";

echo "<td>".$row['price']."</td>";

echo "<td>".$row['stock_qty']."</td>";

if($row['stock_qty']>=10)
{
echo "<td><span class='in-stock'>In Stock</span></td>";
}
elseif($row['stock_qty']>0)
{
echo "<td><span class='low-stock'>Low Stock</span></td>";
}
else
{
echo "<td><span class='out-stock'>Out of Stock</span></td>";
}

echo "<td>

<a href='edit_product.php?id=".$row['product_id']."'>
<button>Edit</button>
</a>

<a href='delete_product.php?id=".$row['product_id']."'>
<button>Delete</button>
</a>

</td>";

echo "</tr>";

}

?>

</table>

</div>

<?php include "includes/footer.php"; ?>

</body>

</html>