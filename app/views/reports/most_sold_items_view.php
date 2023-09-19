
<?php $this->setSiteTitle('Most Sold Products'); ?>


<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<center>

  <br>

<h2 class="text-center red">Most Sold Products</h2>
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
<table style="width: 50%; height: 100%">
  <tr>
    <td align="center"><strong> Product</strong></td>
    <td align="center"><strong> Quantity Sold</strong></td>
  </tr>
  <?php foreach ($this->mostSoldItems as $row) { ?>
  <tr>
    <td align="center"><?php echo $row->product_name; ?></td>
    <td align="center"><?php echo $row->sold_quantity; ?></td>
  </tr>
  <?php } ?>
</table>

</center>
<?php $this->end(); ?>