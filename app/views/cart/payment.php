<?php $this->setSiteTitle('header'); ?>

<?php $this->start('head'); ?>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div id="wrapper">
    <div class="row">
        <div class="col-xs-5">
            <div id="cards">
                <img src="http://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Visa-icon.png">
                <img src="http://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Master-Card-icon.png">
            </div><!--#cards end-->
            <div class="form-check">
                <label class="form-check-label" for='card'>
                    <input id="card" class="form-check-input" type="checkbox" value="">
                    Pay with credit card
                </label>
            </div>
        </div><!--col-xs-5 end-->
        <div class="col-xs-5">
            <div id="cards">
                <img src="http://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Paypal-icon.png">
            </div><!--#cards end-->
            <div class="form-check">
                <label class="form-check-label" for='paypal'>
                    <input id="paypal" class="form-check-input" type="checkbox" value="">Pay with PayPal
                </label>
            </div>
        </div><!--col-xs-5 end-->
    </div><!--row end-->
    <div class="row">
        <div class="col-xs-5">
            <i class="fa fa fa-user"></i>
            <label for="cardholder">Cardholder's Name</label>
            <input type="text" id="cardholder">
        </div><!--col-xs-5-->
        <div class="col-xs-5">
            <i class="fa fa-credit-card-alt"></i>
            <label for="cardnumber">Card Number</label>
            <input type="text" id="cardnumber">
        </div><!--col-xs-5-->
    </div><!--row end-->
    <div>  </div>
    <footer>
        <button class="btn">Back</button>
        <button class="btn">Next Step</button>
    </footer>
</div><!--wrapper end-->
<?php $this->end(); ?>
