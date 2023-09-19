
<?php $this->setSiteTitle('Quarterly Sales'); ?>


<?php $this->start('head'); ?>


<?php $this->end(); ?>

<?php $this->start('body'); ?>
<center>
  <br>

<h2 class="text-center red">Quarterly Sales</h2>
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
    <td align="center"><strong>Quarter</strong></td>
    <td align="center"><strong>Quarterly Sales</strong></td>
  </tr>
  <?php foreach ($this->quarterlySales as $sales) { ?>
  <tr>
    <td align="center"><?php echo $sales->quarter; ?></td>
    <td align="center"><?php echo $sales->quarterly_sales; ?></td>
  </tr>
  <?php } ?>
</table>

</center>
<?php $this->end(); ?>