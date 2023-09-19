
<?php $this->setSiteTitle('Most Sold Categories'); ?>


<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<center>
  <br>
  <h1>Most Sold Categories Report</h1>
  <br>
<form method="post" action="<?=PROOT?>reports/most_sold_cats">
<label><strong> Enter year:</strong></label>
  <input type="number" name="year" min="2000" max="2100" required placeholder="year">

  <input type="submit" value="Search",name="Search">
</form>
<br>
<table> 

</table>
</center>

    <br>
    <div>
        <a href="index"><button style="width: 100px;margin-left: 50%">Back</button></a><div>
<?php $this->end(); ?>