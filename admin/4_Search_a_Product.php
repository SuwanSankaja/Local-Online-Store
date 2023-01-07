<?php require_once('include/connection.php');?>

<?php
    $query="SELECT product_id,product_name
    FROM product
    ORDER by product_id";

    $result_set= mysqli_query($connection,$query);

    if ($result_set){
        //checking how many records in query
        //echo mysqli_num_rows($result_set);
        $table = '<table>';
        $table .= '<tr><th>ID</th><th>Product Name</th></tr>';
        while($record = mysqli_fetch_assoc($result_set)){
            $table .='<tr>';
            $table .= '<td>'.$record['product_id'] .'</td>';
            $table .= '<td>'.$record['product_name'] .'</td>';
            $table .='</tr>';
        
        }
        $table .='</table>';
    }
?>
<?php mysqli_close($connection);?>








<!DOCTYPE html>
<html>
<head>
    <title> Interest Of an Item </title>
    <style>
        table {border-collapse: collapse;}
        td,th{border: 1px solid black ;padding: 5px;}
    </style>
</head>

<body>
    <h2>Interest of an Item over time</h2>
    <h3>Enter Product ID</h3>
    <form action="4_product_search.php" method="post">
        <input type="text" name="id" placeholder="Enter ID">
        <input type="submit" value="Search">

    </form>

    <?php echo $table; ?>
</body>
</html>