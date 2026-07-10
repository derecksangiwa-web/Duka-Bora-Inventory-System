<?php

include "includes/config.php";

?>

<!DOCTYPE html>

<html>

<head>

<title>Inventory Report</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<?php include "includes/nav.php"; ?>

<div class="container">

<h1>Inventory Report</h1>

<!-- Today's Sales -->

<h2>Total Sales Today</h2>

<?php

$today=mysqli_fetch_assoc(mysqli_query($conn,

"SELECT COUNT(*) AS total_today
FROM sales
WHERE DATE(sale_date)=CURDATE()"));

?>

<p><strong><?php echo $today['total_today']; ?></strong> sales recorded today.</p>

<hr>

<!-- Top 3 Best Selling Products -->

<h2>Top 3 Best Selling Products</h2>

<table>

<tr>

<th>Product</th>

<th>Total Quantity Sold</th>

</tr>

<?php

$sql="SELECT

products.name,

SUM(sales.qty_sold) AS total_qty

FROM sales

JOIN products

ON sales.product_id=products.product_id

GROUP BY products.product_id

ORDER BY total_qty DESC

LIMIT 3";

$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result))
{

echo "<tr>";

echo "<td>".$row['name']."</td>";

echo "<td>".$row['total_qty']."</td>";

echo "</tr>";

}

?>

</table>

<hr>

<!-- Low Stock Alert -->

<h2>Low Stock Alert</h2>

<table>

<tr>

<th>Product</th>

<th>Remaining Stock</th>

</tr>

<?php

$result=mysqli_query($conn,

"SELECT name,stock_qty
FROM products
WHERE stock_qty<5");

if(mysqli_num_rows($result)==0)
{

echo "<tr><td colspan='2'>No products are currently low on stock.</td></tr>";

}
else
{

while($row=mysqli_fetch_assoc($result))
{

echo "<tr>";

echo "<td>".$row['name']."</td>";

echo "<td>".$row['stock_qty']."</td>";

echo "</tr>";

}

}

?>

</table>

</div>

<?php include "includes/footer.php"; ?>

</body>

</html>