
<?php $this->setSiteTitle('Customer Orders'); ?>


<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<center>

  <br>
    <h1> Customer Orders Report</h1>

  <br>
<form method="post" action="<?=PROOT?>reports/customer_orders">
  <label><strong> Enter User ID:</strong></label>
  <input type="number" name="id" min="1" required placeholder="ID">
  <input type="submit" value="Search",name="Search">
    </form><style>

table, th, td {
  border: 1.5px solid black;
  border-collapse: collapse;
}
th, td {
  background-color: peachpuff;
}

</style>
<br>
<table> 
  
<?php
  $db = Db::getInstance();
  /*SELECT customer.customer_id as customer_id,first_name,last_name,username,email,address1,address2,city,postal_code,phone_no
  FROM customer
  JOIN customer_address
  ON customer.customer_id=customer_address.customer_id
  JOIN customer_phone
  ON customer.customer_id=customer_phone.customer_id; */
  //query for the following view
  
  $customers = $db->query('SELECT * FROM `customer_details`')->results();
  echo '<table style="width: 70%; height: 50%">';
  echo '<tr border=2px>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Address 1</th>
        <th>Address 2</th>
        <th>City</th>
        <th>Postal Code</th>
        <th>Phone no</th>
        </tr>';
  foreach($customers as $customer) {
    echo '<tr>';
    echo "<td>$customer->customer_id</td>";
    echo "<td>$customer->first_name</td>";
    echo "<td>$customer->last_name</td>";
    echo "<td>$customer->username</td>";
    echo "<td>$customer->email</td>";
    echo "<td>$customer->address1</td>";
    echo "<td>$customer->address2</td>";
    echo "<td>$customer->city</td>";
    echo "<td>$customer->postal_code</td>";
    echo "<td>$customer->phone_no</td>";
    echo "</tr>";
  }
?>
</table>
</center>
    <br>
    <div>
        <a href="index"><button style="width: 100px;margin-left: 50%">Back</button></a><div>

<?php $this->end(); ?>