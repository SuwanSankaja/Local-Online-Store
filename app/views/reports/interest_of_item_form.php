
<?php $this->setSiteTitle('Interest of an Item'); ?>


<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<center>
  <br>
  <h1> Interest of an item Report</h1>
  <br>
<form method="post" action="<?=PROOT?>reports/interest_of_item">
  <label><strong> Enter Product ID:</strong></label>
  <input type="number" min="1" name="id" placeholder="ID">
  <label><strong> Enter Year:</strong></label>
  <input type="number" min="2000" name="year" placeholder="year">

  <input type="submit" value="Search",name="Search">
</form>
<style>
table, th, td {
  border: 1.5px solid black;
  border-collapse: collapse;
}
th, td {
  background-color: peachpuff;
}

</style>
<br>
<table border="1px"> 
  
<?php
  $db = Db::getInstance();
  //SELECT product_id,product_name FROM product ORDER by product_id
  //query for the following view
  

  $products = $db->query('SELECT * FROM product ORDER by product_id')->results();

  echo '<table style="width: 30%; height: 100%">';
  echo '<tr border=2px>
        <th>Product ID</th>
        <th>Product Name</th>
        </tr>';
  foreach($products as $product) {
    echo '<tr>';
    echo "<td>$product->product_id</td>";
    echo "<td>$product->product_name</td>";
  
    echo "</tr>";
  }
?>
</table>
</center>
<br>
<div>
    <a href="index"><button style="width: 100px;margin-left: 50%">Back</button></a><div>

<?php $this->end(); ?>