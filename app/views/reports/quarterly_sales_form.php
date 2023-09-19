
<?php $this->setSiteTitle('Quarterly Sales'); ?>


<?php $this->start('head'); ?>
<style>
table, th, td {
  border: 1px solid white;
  border-collapse: collapse;
}
th, td {
  background-color: #96D4D4; align-self: auto;
}
</style>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<center>

  <br>
  <h1> Quarterly Sales Report</h1>
  <br>
<form method="post" action="<?=PROOT?>reports/quarterly_sales">
  <label><strong> Enter year:</strong></label>
  <input type="number" name="year" min="2000" max="2100" required placeholder="year">

  <input type="submit" value="Search",name="Search">
</form>
<br>

</center>

    <br>
    <div>
        <a href="index"><button style="width: 100px;margin-left: 50%">Back</button></a><div>

<?php $this->end(); ?>