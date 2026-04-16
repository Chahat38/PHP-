 <?php
echo "<pre>"; 

function calculateTotal($items, $tax = 0.05){
    $total = 0;

    foreach($items as $price){
        if($price > 0){
            $total += $price;
        } else {
            echo "Invalid item price encountered: Rs $price. Skipping...\n";
        }
    }

    $discount = 0;

    if ($total >= 100 && $total < 200) {
        $discount = 0.05 * $total;
    } elseif ($total >= 200 && $total < 300) {
        $discount = 0.1 * $total;
    }

    // XOR condition
    $discount += ($total == 150 XOR $total == 250) ? 0.05 * $total : 0;

    $finalTotal = ($total - $discount) + ($total * $tax);

    return [
        'subtotal' => $total,
        'discount' => $discount,
        'tax' => $total * $tax,
        'finalTotal' => $finalTotal
    ];
}

function orderTypeMessage($type){
    switch(strtolower($type)) {
        case 'dine-in':
            return "You chose Dine-in.";
        case 'takeaway':
            return "You chose Takeaway.";
        case 'delivery':
            return "You chose Delivery.";
        default:
            return "Invalid order type!";
    }
}

$orders = [
    ['customer'=>'Ali','items'=>[80,60,50],'orderType'=>'Dine-in'],
    ['customer'=>'Ahmed','items'=>[10,20],'orderType'=>'Delivery'],
    ['customer'=>'Sara','items'=>[120,90,60],'orderType'=>'Takeaway'],
    ['customer'=>'Khan','items'=>[30,-10,20],'orderType'=>'Dine-in']
];

foreach ($orders as $order) {
    echo "-----------------------------\n";
    echo "Customer: " . $order['customer'] . "\n";

    $totals = calculateTotal($order['items']);

    echo "Subtotal: Rs " . number_format($totals['subtotal'],2) . "\n";
    echo "Discount: Rs " . number_format($totals['discount'],2) . "\n";
    echo "Tax: Rs " . number_format($totals['tax'],2) . "\n";
    echo "Final Total: Rs " . number_format($totals['finalTotal'],2) . "\n";

    echo orderTypeMessage($order['orderType']) . "\n";

    echo (!($totals['finalTotal'] > 200)) 
        ? "Thank you for your order!\n" 
        : "Congratulations! Special offer!\n";

    echo (!($totals['subtotal'] >= 50)) 
        ? "Add more items for discount!\n" 
        : "Order processed successfully!\n";

    echo "-----------------------------\n\n";
}

echo "</pre>";
?>
