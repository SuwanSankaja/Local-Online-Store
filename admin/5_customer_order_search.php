<?php include 'include/new_connection.php';
    
    $id =$_POST["id"];
    $sql="SELECT order_details.order_id,customer.first_name,customer.last_name,customer.username,customer.email,customer_phone.phone_no,customer_address.address1,customer_address.address2,customer_address.city,customer_address.state,order_details.order_created_date,payment.paid_on_date,payment.bill_total
    FROM order_details
    JOIN customer
    ON order_details.customer_id=customer.customer_id
    JOIN customer_address
    ON order_details.address_id=customer_address.address_id
    JOIN customer_phone
    ON order_details.phone_no_id=customer_phone.phone_no_id
    JOIN payment
    ON order_details.payment_id=payment.payment_id
    WHERE order_details.customer_id=$id";
    
    $result = $new_connection->query($sql);

    if($result->num_rows>0){
        //echo "Having data";
        echo '<table border=1>';
        echo '<tr>
                <th>Order ID</th>
                <th>Customer First Name</th>
                <th>Customer Last Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Mobile No</th>
                <th>Address 1</th>
                <th>Address 2</th>
                <th>City</th>
                <th>State</th>
                <th>Ordered Date</th>
                <th>Paid Date</th>
                <th>Bill Total</th>
        
              </tr>';
        while($row=$result->fetch_assoc()){
            echo '<tr>
                <td>'.$row['order_id'].'</td>
                <td>'.$row['first_name'].'</td>
                <td>'.$row['last_name'].'</td>
                <td>'.$row['username'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['phone_no'].'</td>
                <td>'.$row['address1'].'</td>
                <td>'.$row['address2'].'</td>
                <td>'.$row['city'].'</td>
                <td>'.$row['state'].'</td>
                <td>'.$row['order_created_date'].'</td>
                <td>'.$row['paid_on_date'].'</td>
                <td>'.$row['bill_total'].'</td>
              </tr>';
        }
        echo '</table>';
    }
    else{
        echo "Empty Table";
    }

?>