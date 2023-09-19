
<?php $this->setSiteTitle('Interest of an Item'); ?>


<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<center>

  <br>
<h2 class="text-center red">Interest of an Item Over Time</h2>

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
    <td align="center"><strong> Month</strong></td>
    <td align="center"><strong> Quantity Sold</strong></td>
  </tr>
  <?php foreach ($this->interesOfItem as $row) { ?>
  <tr>
    <td align="center"><?php echo $row->month; ?></td>
    <td align="center"><?php echo $row->num_sales; ?></td>
  </tr>
  <?php } ?>
</table>

</center>
<?php $this->end(); ?>