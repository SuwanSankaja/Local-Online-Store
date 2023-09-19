<?php $this->setSiteTitle('Home'); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


</div>
<div class="row home-bar">

    <div class="col-md-5 index-welcome">
        <br>
        <p class="welcome capital">welcome</p><br>
        <p class="welcome to">to</p><br>
        <p class="welcome capital">e-shop</p>
    </div>
    <div class="col-md-7 home-img">
        <br><br>
        <img class="img" src="<?= PROOT ?>images/img1.png">
    </div>
</div>

<?php $this->end(); ?>