<?php require_once('include/connection.php');?>
<!DOCTYPE html>
<html>
<head>
    <title> Quarterly Sales </title>
    <style>
        table ,th,td{ border: 2px solid black;width: 500px;}
        .btn{width: 10%; height: 5%;font-size: 22px;padding: 0px;}
    </style>
</head>

<body>
    <center>
    <h2>Quartery Sales Report</h2>
    <div class="container">
    <form action="" method="POST">
        <table>
            <tr>
                <td> Enter the year (yyyy) : </td>
                <td><input type="text" name="year" placeholder="Enter Year To search"/></td>
            </tr>
        </table>
        <center><input type="submit" name="search" value="Search Data"></center>
    </form>
    <table>
            <tr>
                <th> Quarter </th>
                <th> Sales </th>


            </tr><br>
            <?php
            if(isset($_POST['search'])){

                
                $year=$_POST['year'];
                $query = "SELECT QUARTER(order_created_date) as quarter,SUM(bill_total) as quarterly_sales
                FROM order_details
                JOIN payment on `order_details`.payment_id = `payment`.payment_id
                WHERE YEAR(order_details.order_created_date) = '2022' AND payment.paid_on_date is NOT Null
                GROUP BY quarter
                ORDER BY quarter";
                $result_set=mysqli_query($connection,$query);
                while($row = mysqli_fetch_array($result_set)){
                    ?>
                    <tr>    
                        <td> <?php echo $row ["quarter"]; ?></td>
                        <td> <?php echo $row ["quarterly_sales"]; ?></td>


                    </tr>
                    <?php

                }
                

            
        }
        
        ?>

    </table> 
    </div>
</center>
</body>
</html>


<?php mysqli_close($connection);?>