<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duka Bora Inventory System</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "includes/nav.php"; ?>

<div class="container">

    <h1>Welcome to Duka Bora Inventory System</h1>

    <p>
        This system helps shop owners manage products,
        suppliers, sales and inventory efficiently.
    </p>

    <div class="cards">

        <div class="card">
            <h2>📦 Products</h2>
            <p>View all available products.</p>

            <a href="products.php">
                <button>Open</button>
            </a>

        </div>

        <div class="card">
            <h2>➕ Add Product</h2>

            <p>Add new products into the inventory.</p>

            <a href="add_product.php">
                <button>Open</button>
            </a>

        </div>

        <div class="card">

            <h2>💰 Record Sale</h2>

            <p>Record customer purchases.</p>

            <a href="record_sale.php">
                <button>Open</button>
            </a>

        </div>

        <div class="card">

            <h2>📄 Sales History</h2>

            <p>View previous sales.</p>

            <a href="sales_history.php">
                <button>Open</button>
            </a>

        </div>

        <div class="card">

            <h2>📊 Reports</h2>

            <p>View inventory reports.</p>

            <a href="report.php">
                <button>Open</button>
            </a>

        </div>

    </div>

</div>

<?php include "includes/footer.php"; ?>

</body>
</html>