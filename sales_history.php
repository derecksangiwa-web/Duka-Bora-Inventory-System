<?php

include "includes/config.php";

?>

<!DOCTYPE html>

<html>

<head>

<title>Sales History</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<?php include "includes/nav.php"; ?>
<?php
if(isset($_GET['success']))
{
    echo "<p style='color:green;'>Sale recorded successfully.</p>";
}
?>

<div class="container">

<h1>Sales History</h1>

<table>

<tr>

<th>Sale ID</th>

<th>Product</th>

<th>Quantity Sold</th>

<th>Total Price (TZS)</th>

<th>Sale Date</th>

</tr>

<?php

$sql="SELECT

sales.sale_id,
products.name,
sales.qty_sold,
sales.total_price,
sales.sale_date

FROM sales

JOIN products

ON sales.product_id=products.product_id

ORDER BY sales.sale_date DESC";

$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result))
{

echo "<tr>";

echo "<td>".$row['sale_id']."</td>";

echo "<td>".$row['name']."</td>";

echo "<td>".$row['qty_sold']."</td>";

echo "<td>".$row['total_price']."</td>";

echo "<td>".$row['sale_date']."</td>";

echo "</tr>";

}

?>

</table>

</div>

<?php include "includes/footer.php"; ?>

</body>

</html>