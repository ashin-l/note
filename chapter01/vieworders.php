<?php
$document_root = $_SERVER['DOCUMENT_ROOT'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Bob's Auto Parts - Order Results</title>
    </head>
    <body>
        <h1>Bob's Auto Parts</h1>
        <h2>Customer Orders</h2>
        <?php
        $fp = fopen("$document_root/../orders/orders.txt", 'rb');
        flock($fp, LOCK_SH);
        while (!feof($fp)) {
            $order = fgets($fp);
            echo htmlspecialchars($order) . "<br />";
        }
        flock($fp, LOCK_UN);
        fclose($fp);
        ?>
    </body>
</html>