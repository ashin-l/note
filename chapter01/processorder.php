<!DOCTYPE html>
<?php
$document_root = $_SERVER['DOCUMENT_ROOT'];
$tireqty = (int)$_POST['tireqty'];
$tireqty = $tireqty>0 ? $tireqty : 0;
$oilqty = (int)$_POST['oilqty'];
$oilqty = $oilqty > 0 ? $oilqty : 0;
$sparkqty = (int)$_POST['sparkqty'];
$sparkqty = $sparkqty > 0 ? $sparkqty : 0;
$address = preg_replace('/\t|\R/', ' ', $_POST['address']);
$date = date('Y-m-d H:i');
//$find = $_POST['find'];
$totalqty = 0;
$totalqty = $tireqty + $oilqty + $sparkqty;
#echo "<p>Items ordered: " . $totalqty . "<br />";
$totalamount = 0.00;

define('TIREPRICE', 100);
define('OILPRICE', 10);
define('SPARKPRICE', 4);

$totalamount = $tireqty * TIREPRICE + $oilqty * OILPRICE + $sparkqty * SPARKPRICE;
#echo "Subtotal: $" . number_format($totalamount, 2) . "<br />";

$taxrate = 0.10;
$totalamount = $totalamount * (1+$taxrate);
#echo "Total including tax: $" . number_format($totalamount, 2) . "</p>";

?>
<html>
    <head>
        <title>Bob's Auto Parts - Order Results</title>
    </head>
    <body>
        <h1>Bob's Auto Parts</h1>
        <h2>Order Results</h2>
        <?php
//        echo '<p>';
//        switch($find) {
//            case "a" :
//            echo "Regular customer.";
//            break;
//            case "b" :
//            echo 'Customer referred by Tv advert.';
//            break;
//            case "c" :
//            echo 'Customer referred by phone directory';
//            break;
//            case "d" :
//            echo 'Customer referred by word of mouth.';
//            break;
//            default :
//            echo 'We do not know how this customer found us.';
//            break;
//        }
//        echo '</p>';
        echo '<p>Order processed at ';
        echo $date;
        echo '</p>';
        if ($totalqty == 0) {
            echo '<p style="color:red">You did not order anything on the previous page!</p><br />';
            exit;
        } else {
            echo '<p>Your order is as follows: </p>';
            echo htmlspecialchars($tireqty) . ' tires<br />';
            echo htmlspecialchars($oilqty) . ' bottles of oil<br />';
            echo htmlspecialchars($sparkqty) . ' spark plugs<br />';
        }
        $fp = fopen("$document_root/../orders/orders.txt", 'ab');
        $outputstring = $date . "\t" . $tireqty . " tires \t" . $oilqty . " oil\t"
                        . $sparkqty . " spark plugs\t\$" . $totalamount
                        . "\t" . $address . "\n";
        flock($fp, LOCK_EX);
        fwrite($fp, $outputstring, strlen($outputstring));
        flock($fp, LOCK_UN);
        fclose($fp);
        echo "<p>Order written!.</p>";
//        echo 'isset($tireqty): ' . isset($tireqty) . '<br />';
//        echo 'isset($nothere): ' . isset($nothere) . '<br />';
//        var_dump(isset($nothere));
//        echo '<br />';
//        var_dump(empty($tireqty));
//        echo '<br />';
//        echo 'empty($tireqty): ' . empty($tireqty) . '<br />';
//        echo 'empty($nothere): ' . empty($nothere) . '<br />';
        ?>
    </body>
</html>