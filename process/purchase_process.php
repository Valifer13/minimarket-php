<?php
session_start();
define("ROOTPATH", $_SERVER["DOCUMENT_ROOT"] . "/minimarket");
include ROOTPATH . "/config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    $transaction_id = $_POST["transaction_id"];

    if ($action == "add-item") {
        $product_name = $_POST["product_name"];

        // Search product data
        $query = "SELECT *
        FROM products
        WHERE products.name = '$product_name'
        ";
        $product = mysqli_query($conn, $query)->fetch_assoc();

        $product_id = $product["id"];
        $product_unit_price = $product["sell_price"];
        $qty = $_POST["qty"];
        $sub_total = $qty * $product_unit_price;

        // Get total of all previous product from the same transaction
        $query = "SELECT SUM(sub_total) AS total FROM purchase_items WHERE purchase_id = $transaction_id";
        $sum_total = mysqli_query($conn, $query)->fetch_assoc()["total"];

        $total = $sub_total + $sum_total;

        // Add product data to a items table
        mysqli_query($conn, "INSERT INTO purchase_items (purchase_id, product_id, quantity, price, discount, sub_total) VALUES ($transaction_id, $product_id, $qty, $product_unit_price, 0, $sub_total)");

        // Update total of product in transaction table
        mysqli_query($conn, "UPDATE purchases SET total = $total WHERE purchases.id = $transaction_id");

        // Add stock product at the product table
        mysqli_query($conn, "UPDATE products SET stock = stock + $qty WHERE products.id = $product_id");
    } else if ($action == "delete-item") {
        $product_id = $_POST["product_id"];

        $purchase_product = mysqli_query($conn, "SELECT * FROM purchase_items WHERE purchase_id = $transaction_id AND product_id = $product_id")->fetch_assoc();

        $product_unit_price = $purchase_product['price'];
        $product_qty = $purchase_product['quantity'];
        $product_sub_total = $purchase_product['sub_total'];

        // Delete selected items from purchase_items
        $query = "DELETE FROM purchase_items WHERE purchase_id = $transaction_id AND product_id = $product_id";
        mysqli_query($conn, $query);

        // Reduce the price of purchase
        mysqli_query($conn, "UPDATE purchases SET total = total - $product_sub_total WHERE purchases.id = $transaction_id");

        // Revert the stock product in product table
        mysqli_query($conn, "UPDATE products SET stock = stock - $product_qty WHERE products.id = $product_id");
    } else if ($action == "payment") {
        $payment_amount = $_POST['payment_amount'];
        $total = mysqli_query($conn, "SELECT total FROM purchases WHERE id = $transaction_id")->fetch_assoc()['total'];

        if ($payment_amount < $total) {
            $_SESSION['payment_message'] = "Payment failed, due to lack of funds!";
            $_SESSION['payment_message_type'] = "failed";
        } else {
            mysqli_query($conn, "UPDATE purchases SET status = 'PAID', cash = $payment_amount, cash_change = $payment_amount - $total WHERE purchases.id = $transaction_id");
        }
    }

    header("Location: ../pages/purchases/transaction_details.php?id=" . $transaction_id);
    exit;
}
