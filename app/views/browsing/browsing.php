<?php $this->setSiteTitle('Product Catagories'); ?>

<?php $this->start('head'); ?>
<style>
    a:link {

        text-decoration: none !important;
        cursor: pointer;
    }

    .card-title {
        text-align: center;
        color: black;
        font-size: 18px;
    }


    .sub-cat-img {
        padding-top: 10px;
        object-fit: contain;

    }

    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 80%;
        height: 100px;
    }

    .card {
        border-radius: 1em;
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);

    }

    .card-body {
        height: 50px;
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

    <hr>
    <div>
        <?php foreach ($this->details as $key => $value) { ?>
            <div>
                <div class="category-name">
                    <h4><?= $value[0] ?> >>></h4>
                </div> <br><br>
                <div class="row logo">
                    <?php foreach ($value[1] as $id => $val) { ?>
                        <div class="col-md-2 sub-cat">
                            <div class="card mb-3">
                                <a href=<?= PROOT . "Browsing/productDisplay/" . $val->sub_category_id ?>>
                                    <img class="sub-cat-img center" src='<?= PROOT . $val->sub_category_img ?>'>
                                </a>
                                <div class="card-body">
                                    <a class="sub" href=<?= PROOT . "Browsing/productDisplay/" . $val->sub_category_id ?>>
                                        <p class="card-title"><?= $val->sub_category_name ?></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?> <br>
                    <hr>
                </div>
            </div>
        <?php } ?>

        <?php $this->end(); ?>