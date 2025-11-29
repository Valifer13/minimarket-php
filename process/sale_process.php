<?php
session_start();
define("ROOTPATH", $_SERVER["DOCUMENT_ROOT"] . "/minimarket");
include ROOTPATH . "/config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action         = $_POST["action"];
    $transaction_id = $_POST["transaction_id"];

    if ($action == "add-item") {
        $product_name = $_POST["product_name"];

        // Search product data
        $query = "SELECT products.*, vouchers.max_discount, vouchers.discount
        FROM products
        LEFT JOIN vouchers ON products.voucher_id = vouchers.id
        WHERE products.name = '$product_name'
        ";
        $product = mysqli_query($conn, $query)->fetch_assoc();

        $product_id         = $product["id"];
        $product_unit_price = $product["sell_price"];
        $qty                = $_POST["qty"];
        $sub_total          = $qty * $product_unit_price;

        // Get total of all previous product from the same transaction
        $query     = "SELECT SUM(sub_total) AS total FROM sale_items WHERE sale_id = $transaction_id";
        $sum_total = mysqli_query($conn, $query)->fetch_assoc()["total"];

        // Get discount total from transaction that already exist
        $query        = "SELECT SUM(sub_total * discount / 100) AS total_discount FROM sale_items WHERE sale_items.sale_id = $transaction_id";
        $sum_discount = mysqli_query($conn, $query)->fetch_assoc()['total_discount'];

        // Check if product has discount (voucher)
        if ($product['discount'] != null && $product['discount'] > 0) {
            $discount                 = $product['discount'];
            $total                    = ($sub_total - ($sub_total * $discount / 100)) + $sum_total - $sum_discount;

            // Audit
            // echo "This product has discount";
            // var_dump([
            //     "product"=> [
            //         "unit_price" => $product_unit_price,
            //         "discount"   => $discount,
            //         "qty"        => $qty,
            //         "sub_total"  => $sub_total
            //     ],
            //     "transaction" => [
            //         "sum_total"    => $sum_total,
            //         "sum_discount" => $sum_discount,
            //         "total"        => $total
            //     ],
            // ]);
            // die();
        } else {
            $discount                 = 0;
            $total                    = $sub_total + $sum_total - $sum_discount;

            // Audit
            // echo "This product has not discount";
            // var_dump([
            //     "product"=> [
            //         "unit_price" => $product_unit_price,
            //         "discount"   => $discount,
            //         "qty"        => $qty,
            //         "sub_total"  => $sub_total
            //     ],
            //     "transaction" => [
            //         "sum_total"    => $sum_total,
            //         "sum_discount" => $sum_discount,
            //         "total"        => $total
            //     ],
            // ]);
            // die();
        }

        // Check and add product data to a items table
        $product_existence = mysqli_query($conn, "SELECT EXISTS (SELECT 1 FROM sale_items WHERE sale_id = $transaction_id AND product_id = $product_id) AS IS_EXIST")->fetch_assoc();
        if ($product_existence['IS_EXIST'] == "1") {
            mysqli_query($conn, "UPDATE sale_items SET
                quantity = quantity + $qty,
                sub_total = sub_total + $sub_total
                WHERE sale_id = $transaction_id AND product_id = $product_id
            ");
        } else {
            mysqli_query($conn, "INSERT INTO sale_items (sale_id, product_id, quantity, price, discount, sub_total) VALUES ($transaction_id, $product_id, $qty, $product_unit_price, $discount, $sub_total)");
        }

        // Update total of product in transaction table
        mysqli_query($conn, "UPDATE sales SET total = $total WHERE sales.id = $transaction_id");

        // Reduce stock product at the product table
        mysqli_query($conn, "UPDATE products SET stock = stock - $qty WHERE products.id = $product_id");
    } else if ($action == "delete-item") {
        $product_id = $_POST["product_id"];

        $sale_product = mysqli_query($conn, "SELECT * FROM sale_items WHERE sale_id = $transaction_id AND product_id = $product_id")->fetch_assoc();

        $product_unit_price = $sale_product['price'];
        $product_qty        = $sale_product['quantity'];
        $product_sub_total  = $sale_product['sub_total'];

        // Delete selected items from sale_items
        $query = "DELETE FROM sale_items WHERE sale_id = $transaction_id AND product_id = $product_id";
        mysqli_query($conn, $query);

        // Reduce the price of sales
        mysqli_query($conn, "UPDATE sales SET total = total - $product_sub_total WHERE sales.id = $transaction_id");

        // Revert the stock product in product table
        mysqli_query($conn, "UPDATE products SET stock = stock + $product_qty WHERE products.id = $product_id");
    } else if ($action == "payment") {
        $payment_amount = $_POST['payment_amount'];
        $total = mysqli_query($conn, "SELECT total FROM sales WHERE id = $transaction_id")->fetch_assoc()['total'];

        if ($payment_amount < $total) {
            $_SESSION['payment_message']      = "Payment failed, due to lack of funds!";
            $_SESSION['payment_message_type'] = "failed";
        } else {
            mysqli_query($conn, "UPDATE sales SET status = 'PAID', cash = $payment_amount, cash_change = $payment_amount - $total WHERE sales.id = $transaction_id");
        }
    }

    header("Location: ../pages/sales/transaction_details.php?id=" . $transaction_id);
    exit;
}
?>
