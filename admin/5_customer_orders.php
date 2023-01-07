<?php require_once('include/connection.php');?>
<?php
    $query="SELECT customer.customer_id as customer_id,first_name,last_name,username,email,address1,address2,city,postal_code,phone_no
    FROM customer
    JOIN customer_address
    ON customer.customer_id=customer_address.customer_id
    JOIN customer_phone
    ON customer.customer_id=customer_phone.customer_id";

    $result_set= mysqli_query($connection,$query);

    if ($result_set){

        //checking how many records in query
        //echo mysqli_num_rows($result_set);
        $table = '<table>';
        $table .= '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Username</th><th>Email</th><th>Address 1</th><th>Address 2</th><th>City</th><th>Postal code</th><th>Phone Number</th></tr>';
        while($record = mysqli_fetch_assoc($result_set)){
            $table .='<tr>';
            $table .= '<td>'.$record['customer_id'] .'</td>';
            $table .= '<td>'.$record['first_name'] .'</td>';
            $table .= '<td>'.$record['last_name'] .'</td>';
            $table .= '<td>'.$record['username'] .'</td>';
            $table .= '<td>'.$record['email'] .'</td>';
            $table .= '<td>'.$record['address1'] .'</td>';
            $table .= '<td>'.$record['address2'] .'</td>';
            $table .= '<td>'.$record['city'] .'</td>';
            $table .= '<td>'.$record['postal_code'] .'</td>';
            $table .= '<td>'.$record['phone_no'] .'</td>';
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
    <h2>Customer Order Report</h2>
    <h3>Enter User ID</h3>
    <form action="5_customer_order_search.php" method="post">
        <input type="text" name="id" placeholder="Enter ID">
        <input type="submit" value="Search">

    </form>

    <?php echo $table; ?>
</body>
</html>
