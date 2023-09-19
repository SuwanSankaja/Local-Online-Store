<?php $this->setSiteTitle('Inventory'); ?>

<?php $this->start('head'); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

<?php $this->end(); ?>


<?php $this->start('body'); ?>
    <section class="h-100" style="background-color:#eee; height:200%">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <h4></h4>
                    <h4 class="text-center ">Item Inventory</h4>
<div>
    <?php foreach ($this->details as $key => $value) { ?>

        <div>
            <div style="margin-left: 150px;font-size: 20px;color: #4f5050">
                <?= $value[0] ?>
            </div>



                <?php foreach ($value[1] as $x => $y) {?>
                    <div class="card rounded-3 mb-4 " style="width: 75%;margin: auto;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)">
                        <div class="card-body p-4">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-2 col-lg-2 col-xl-3">
                    <?php foreach ($y as $id => $val) { ?>



                                    <?= $val->variant_name  ?>: <i style="font-weight: lighter;font-style: normal"><?= $val->variant_val_name  ?> </i><br>
                    <?php } ?>
                                </div>
                                <div

                                <div class="col-md-2 col-lg-2 col-xl-4" >

                                    Price :<i style="font-weight: lighter;font-style: normal"> Rs. <?php echo $y[0]->price ?></i><br>
                                    Remain quantity :<i style="font-weight: lighter;font-style: normal"><?php echo $y[0]->quantity ?></i><br>
                                    SKU :<i style="font-weight: lighter;font-style: normal"><?php echo $y[0]->SKU ?></i>
                                </div>

                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>
        </div>
    <?php } ?>

</div>

    </section>
<?php $this->end(); ?>