<?php $this->setSiteTitle('Checkout'); ?>

<?php
$db = Db::getInstance();
$id = $_SESSION[Customer::currentLoggedInUser()->getSessionName()];

$total = 0;
$contacts = $db->query("select * from delivery_info where customer_id = $id;")->results();
$rows = $db->call_procedure('view_cart', [$id]);
$i = count($rows);
$items = ' ';


foreach ($rows as $row) {
    $items .= $row->product_name . ' x ' . $row->quantity . '<br> ';
    $total += $row->total;
}
?>

<?php
$date = date('Y-m-d');
$date = strtotime($date);

$city = $contacts[0]->city;
$city = strtolower($city);
$city = str_replace(' ', '', $city);
$city = str_replace('-', '', $city);

$main_cities = $db->query("select * from main_city;")->results();

$is_main_city = false;
foreach ($main_cities as $main_city) {
    $_city = $main_city->city_name;
    $_city = strtolower($_city);
    $_city = str_replace(' ', '', $_city);
    $_city = str_replace('-', '', $_city);

    if ($city == $_city) {
        $is_main_city = true;
        break;
    }
}

if ($is_main_city) {
    $date = strtotime("+5 day", $date);
} else {
    $date = strtotime("+7 day", $date);
}
?>

<?php $this->start('head'); ?>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout</title>

<link href="<?= PROOT ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?= PROOT ?>css/style.css" rel="stylesheet">

<script>
    $(document).ready(function () {
        $('#pay-btn').on('click', function () {
            $('#pay-error').text('Payments currently unavailable!');
        });

        $('#on-delivery').on('click', function () {
            $.ajax({
                type: 'post',
                url: '<?= PROOT ?>cart/checkout',
                data: {
                    action: 'on_delivery',
                    total: <?= $total ?>,
                    date: '<?= date('Y-m-d H-i-s', $date) ?>'
                },
                success: function (res) {
                    window.location.href = '<?= PROOT ?>cart/successful'
                },
                error: function (res) {
                    alert(res);
                }
            });
        });
    });
</script>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="container" style="margin-top: 100px">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div>
                                <p> Deliver
                                    to: <?php echo $contacts[0]->first_name ?> <?php echo $contacts[0]->last_name ?></p>
                                <p>    <?php echo $contacts[0]->address1 ?>
                                    , <?php if ($contacts[0]->address2) {
                                        echo $contacts[0]->address2 . ', ';
                                    } ?><?php echo $contacts[0]->city ?>
                                    , <?php echo $contacts[0]->state ?>, <?php echo $contacts[0]->postal_code ?><br>
                                    <?php echo $contacts[0]->phone_no ?></p>
                                <p style="color: #0a53be"> Bill to the same address</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body shadow">
                    <div class="row">
                        <div class="col">
                            <div class="row">

                                <div class="col">
                                    <p> Order summary: </p>
                                    <p> <?php echo $items ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p>Product Cost</p>
                        </div>
                        <div class="col">
                            <p class="text-end"><i class="fa fa-euro"></i><?php echo round($total, 2) ?></p>
                        </div>
                    </div>
                    <hr style="color: rgb(0,0,0);"/>
                    <div class="row">
                        <div class="col">
                            <p>Estimated delivery date</p>
                        </div>
                        <div class="col">
                            <p class="text-end"><i class="fa fa-euro"></i><?= date('Y-m-d', $date) ?></p>
                        </div>
                    </div>

                    <hr style="color: rgb(0,0,0);"/>



                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <p class="hidden">&nbsp;</p>
                            <button id="on-delivery" class="btn btn-outline-dark d-block w-100" type="submit">Cash on
                                delivery
                            </button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <p id="pay-error" class="hidden text-danger text-center" style="border-radius: 40px;">
                                &nbsp;</p>
                            <button id="pay-btn" class="btn btn-outline-dark d-block w-100" type="submit"
                                    style="background: #ffc720;border: none">Proceed to Pay
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $this->end(); ?>
