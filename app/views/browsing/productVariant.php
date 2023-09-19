<?php $this->setSiteTitle('Variants'); ?>

<?php $this->start('head'); ?>

<style>
    .product-img {
        display: flex;
        justify-content: center;
        height: 200px;
        object-fit: contain;
    }

    .card {
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        font-weight: 500;
    }

    .card-img-top {
        padding: 20px;

        width: 100%;
        height: 200px;
        object-fit: contain;
    }

    .msg {
        display: flex;
        justify-content: center;
    }

    #my_model {
        width: 100%;
        height: 40px;

    }

    #model1 {
        width: 600px;
        height: 40px;
        border: 1px solid #333;
        box-sizing: border-box;
        text-align: center;
        background: green;
        color: white;
        padding: 5px;
    }

    /*// making modal center*/
    #model2 {
        width: 100%;
        height: 40px;
        box-sizing: border-box;
        text-align: center;
        background: red;
        color: white;
        padding: 5px;

        /*// hide for the first time */

    }

    #show_time {
        font-size: 0px;
    }

    .varDiv {
        display: none;
    }

    .product-img {
        float: center;
    }

    .row2 {
        padding-top: 30px;
    }

    .product-name {
        padding-left: 30px;
    }

    .card1 {
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        position: fixed;
        top: 50%;
        left: 40%;
    }
</style>
<?php $this->end(); ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#variants').on('change', function() {
            var demovalue = $(this).val();
            $("div.varDiv").hide();
            $("#" + demovalue).show();
        });
    });
</script>


<?php $this->start('body'); ?>





<div class="row">
    <div class=" col-md-8 header-bar p-0">
        <p class="header line1">Best Of All </p>
        <p class="header line2">At Your Fingertip Now</p>
    </div>
    <div class=" col-md-4 header-bar">
        <img class=" right banner " src="<?= PROOT ?>/images/banner.jpg">
    </div>

</div>
<?php if (isset($_SESSION['msg'])) {
    if ($_SESSION['msg'] == "Item added to the cart") {
        $model = 'model1';
    } else {
        $model = 'model2';
    }
?>
    <div class="msg">
        <div id="my_modal">
            <div id=<?= $model ?>>
                <span id="show_time"></span>
                <?= $_SESSION['msg'] ?>
            </div>
        </div>

    </div>

<?php Session::delete('msg');
} ?><div>
    <div class="row row2">
        <div class="col-md-2.5">
            <h3 class="product-name"><?= $this->product->product_name ?></h3><br>
        </div>
        <div class="col-md-9.5  select-option">
            <select name="variants" id="variants" onchange="func()">
                <option>Select Option</option>
                <?php foreach ($this->variant_display as $key => $value) { ?>
                    <option value=<?= $key ?>>
                        <?= $value ?>
                    </option>
                <?php } ?>
            </select><br><br>
        </div>
    </div>

    <div class="product-img">
        <img class="center " src="<?= PROOT . $this->product->product_img ?>">
    </div><br>
    <?php foreach ($this->details as $key => $value) { ?>
        <div id=<?= $key ?> class="varDiv">
            <?php if ($value[0]->quantity == 0) { ?>
                <div class='card1'>
                    <div class="card-body">
                        <h3>No items left from the selected variant </h3>
                    </div>
                </div>
            <?php } else { ?>
                <div class="pruduct-dis">
                    <div class='card border-warning mb-3 ml-10 mr-10 product-card'>
                        <div class="row">
                            <div class="col-md-4">
                                <img class="card-img-top" src='<?= PROOT . $value[0]->product_variant_img ?>'><br>
                            </div>
                            <div class="col-md-8 card-body">
                                <br>
                                <?php foreach ($value as $x => $y) { ?>
                                    <?= $y->variant_name . ' : ' . $y->variant_val_name ?><br>
                                <?php } ?>
                                <?= 'weight : ' . $value[0]->weight ?><br>
                                <?= 'Price : Rs.' . $value[0]->price ?><br>
                                <?= 'Available quantity : ' . $value[0]->quantity ?><br><br>
                                <form class="add-cart" action=<?= PROOT . "CartItemController/addItem" ?> method="post">
                                    <label for=Quantity> Quantity </label>
                                    <input type="hidden" name="variant_id" value=<?= $key ?>>
                                    <input type="number" min="1" oninput="validity.valid||(value='');" step="1" name=<?= $key ?>>
                                    <button class="btn btn-warning" type="submit">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            <?php } ?>
        </div>
    <?php } ?>
</div>

<script>
    var my_modal = document.getElementById('my_modal');
    var span_tag = document.getElementById('show_time');
    var countdown_call = '';
    var time_count = 0;

    function showModal() {
        my_modal.style.display = "block";
        // countdown after show
        countdown_call = setInterval(updateTime, 1000); // call for every 1s
    }
    // now show automatically after 1s
    // working
    setTimeout(showModal, 1000) // 1000ms


    // now close 
    function closeModal() {
        my_modal.style.display = "none";
    }
    // setTimeout(closeModal,3000) // 1000ms
    // no need

    // now countdown time
    function updateTime() {
        time_count++;
        span_tag.innerHTML = time_count;
        if (time_count == 5) {
            clearInterval(countdown_call);
            closeModal();
        }

    }
</script>
<?php $this->end(); ?>