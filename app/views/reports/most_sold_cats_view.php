
<?php $this->setSiteTitle('Most Sold Categories'); ?>


<?php $this->start('head'); ?>


<?php $this->end(); ?>

<?php $this->start('body'); ?>
<center>

  <br>

<h2 class="text-center red">Most Sold Categories</h2>
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
<table style="width: 50%; height: 120%">
  <tr>
    <td align="center"><strong> Categories</strong></td>
    <td align="center"><strong> Sold Amount</strong></td>
  </tr>
  <?php foreach ($this->mostSoldCats as $row) { ?>
  <tr>
    <td align="center"><?php echo $row->category_name; ?></td>
    <td align="center"><?php echo $row->sold_quantity; ?></td>
 
  </tr>
  <?php } ?>
</table>
</center>


<?php $this->end(); ?>
