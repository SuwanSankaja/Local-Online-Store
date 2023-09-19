
<?php $this->setSiteTitle('Most Sold Products'); ?>


<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<center>

  <br>
 <h1> Most Sold Products Report</h1>
 <br>
<form method="post" action="<?=PROOT?>reports/most_sold_products">
  <label><strong> Enter Dates: </strong></label>

  <input type="date" name="from">
  <input type="date" name="to" >
  <input type="submit" value="Search",name="Search">
</form>
<br>
<table>

</center>

<br>
<div>
    <a href="index"><button style="width: 100px;margin-left: 50%">Back</button></a><div>

<?php $this->end(); ?>
