<?php $this->setSiteTitle('Products'); ?>

<?php $this->start('head'); ?>
<style>
    .card {
        border-radius: 1em;
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);

    }

    .product-display {
        padding-top: 40px;
        padding-left: 50px;
    }

    a:link {
        color: black;
        text-decoration: none !important;
        cursor: pointer;
    }

    .card1 {
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        position: fixed;
        top: 50%;
        left: 40%;
    }
</style>

<?php $this->end(); ?>


<?php $this->start('body'); ?>

<div>
    <div class="row">
        <div class=" col-md-8 header-bar">
            <p class="header line1">Best Of All </p>
            <p class="header line2">At Your Fingertip Now</p>
        </div>
        <div class=" col-md-4 header-bar">
            <img class=" right banner " src="<?= PROOT ?>/images/banner.jpg">
        </div>

    </div>


    <?php if (!count($this->details)) { ?>
        <div class='card1'>
            <div class="card-body">
                <h3> No products are available </h3>
            </div>
        </div>

    <?php } else { ?>
        <div class="row product-display">
            <?php foreach ($this->details as $value) { ?>
                <div class='col-md-3'>
                    <div class='card border-warning mb-3'>
                        <a href=<?= PROOT . 'browsing/variantDisplay/' . $value[0]->product_id ?>>
                            <img class="card-img-top1" src='<?= PROOT . $value[0]->product_img ?>'></a>
                        <div class="card-body">
                            <a class="link1" href=<?= PROOT . 'browsing/variantDisplay/' . $value[0]->product_id ?>>
                                <h5 class="card-title"><?= $value[0]->product_name ?></h5>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<?php $this->end(); ?>