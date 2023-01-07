<?php require_once('include/connection.php');?>
<?php
    $query="SELECT category.category_name as category_name, SUM(cart_item.quantity) as sold_quantity
    FROM cart_item
    JOIN product_variant ON cart_item.product_variant_id = product_variant.product_variant_id
    JOIN product ON product_variant.product_id = product.product_id
    JOIN order_details ON cart_item.cart_id = order_details.cart_id
    JOIN product_sub_link ON product.product_id=product_sub_link.product_id
    JOIN sub_category ON product_sub_link.sub_category_id=sub_category.sub_category_id
    JOIN category ON sub_category.category_id=category.category_id
    GROUP BY category.category_id
    ORDER BY sold_quantity DESC";

    $result_set= mysqli_query($connection,$query);

    if ($result_set){

        //checking how many records in query
        //echo mysqli_num_rows($result_set);
        $table = '<table>';
        $table .= '<tr><th>Category Name</th><th>Sold Quantity</th></tr>';
        while($record = mysqli_fetch_assoc($result_set)){
            $table .='<tr>';
            $table .= '<td>'.$record['category_name'] .'</td>';
            $table .= '<td>'.$record['sold_quantity'] .'</td>';
            
            $table .='</tr>';
        
        }
        $table .='</table>';
    }
?>
<?php mysqli_close($connection);?>


<!DOCTYPE html>
<html>
<head>
    <title> Customer Orders </title>
    <style>
        table {border-collapse: collapse;}
        td,th{border: 1px solid black ;padding: 5px;}
    </style>
</head>

<body>
    <h2>Most Ordered Category</h2>

    <?php echo $table; ?>
</body>
</html>
