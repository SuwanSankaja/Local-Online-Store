<?php include 'include/new_connection.php';
    
    $from =$_POST["from"];
    $to =$_POST["to"];
    
    $sql="SELECT product.product_name as product_name, SUM(cart_item.quantity) as sold_quantity
    FROM cart_item
    JOIN product_variant ON cart_item.product_variant_id = product_variant.product_variant_id
    JOIN product ON product_variant.product_id = product.product_id
    JOIN order_details ON cart_item.cart_id = order_details.cart_id
    WHERE order_details.order_created_date BETWEEN '$from' AND '$to'
    GROUP BY product.product_name
    ORDER BY sold_quantity DESC";
    
    $result = $new_connection->query($sql);

    if($result->num_rows>0){
        //echo "Having data";
        echo '<table border=1>';
        echo '<tr>
                <th>Product Name</th>
                <th>Quantity Sold</th>
        
              </tr>';
        while($row=$result->fetch_assoc()){
            echo '<tr>
                <td>'.$row['product_name'].'</td>
                <td>'.$row['sold_quantity'].'</td>
              </tr>';
        }
        echo '</table>';
    }
    else{
        echo "Empty Table";
    }

?>