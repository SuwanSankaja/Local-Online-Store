
<?php $this->setSiteTitle('Customer Orders'); ?>


<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<center>

  <br>
<h2 class="text-center red">Customer Orders</h2>
<br>
<style>
table, th, td {
  border: 1.5px solid black;
  border-collapse: collapse;
  
}
th, td {
  background-color: #96D4D4;
}

</style>
<table>
  <tr>
    <th>Order ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Username</th>
    <th>Email</th>
    <th>Phone Number</th>
    <th>Address 1</th>
    <th>Address 2</th>
    <th>City</th>
    <th>State</th>
    <th>Ordered Date</th>
    <th>Paid Date</th>
    <th>Bill Total</th>
  </tr>
  <?php foreach ($this->customerOrders as $customer) { ?>
  <tr>
    <td><?php echo $customer->order_id; ?></td>
    <td><?php echo $customer->first_name; ?></td>
    <td><?php echo $customer->last_name; ?></td>
    <td><?php echo $customer->username; ?></td>
    <td><?php echo $customer->email; ?></td>
    <td><?php echo $customer->phone_no; ?></td>
    <td><?php echo $customer->address1; ?></td>
    <td><?php echo $customer->address2; ?></td>
    <td><?php echo $customer->city; ?></td>
    <td><?php echo $customer->state; ?></td>
    <td><?php echo $customer->order_created_date; ?></td>
    <td><?php echo $customer->paid_on_date; ?></td>
    <td><?php echo $customer->bill_total; ?></td>
  </tr>
  <?php } ?>
</table>

</center>
<?php $this->end(); ?>