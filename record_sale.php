<?php

include "includes/config.php";

$message = "";

if(isset($_POST['record']))
{
    $product_id = intval($_POST['product']);
    $qty = intval($_POST['qty']);

    if($product_id <= 0 || $qty <= 0)
    {
        $message = "<p style='color:red;'>Please enter valid data.</p>";
    }
    else
    {
        // Get product details
        $product = mysqli_query($conn,
        "SELECT * FROM products WHERE product_id='$product_id'");

        $row = mysqli_fetch_assoc($product);

        $stock = $row['stock_qty'];
        $price = $row['price'];

        if($qty > $stock)
        {
            $message = "<p style='color:red;'>
            Not enough stock available.
            </p>";
        }
        else
        {
            $total = $qty * $price;

            // Save sale
            mysqli_query($conn,
            "INSERT INTO sales(product_id,qty_sold,total_price)
            VALUES('$product_id','$qty','$total')");

            // Reduce stock
            $newStock = $stock - $qty;

            mysqli_query($conn,
            "UPDATE products
            SET stock_qty='$newStock'
            WHERE product_id='$product_id'");

           header("Location: sales_history.php?success=1");
exit();
        }
    }
}

?>

<!DOCTYPE html>

<html>

<head>

<title>Record Sale</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<?php include "includes/nav.php"; ?>

<div class="container">

<h1>Record Sale</h1>

<?php echo $message; ?>

<form method="POST">

<label>Select Product</label>

<select name="product" required>

<option value="">Choose Product</option>

<?php

$result = mysqli_query($conn,
"SELECT * FROM products ORDER BY name");

while($row = mysqli_fetch_assoc($result))
{
echo "<option value='".$row['product_id']."'>"
.$row['name'].
" (Stock: ".$row['stock_qty'].")</option>";
}

?>

</select>

<label>Quantity Sold</label>

<input
type="number"
name="qty"
min="1"
required>

<input
type="submit"
name="record"
value="Record Sale">

</form>

</div>

<?php include "includes/footer.php"; ?>

</body>

</html>