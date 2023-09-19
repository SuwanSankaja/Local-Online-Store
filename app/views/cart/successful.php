<?php $this->setSiteTitle('Successful'); ?>
<?php $this->start('head'); ?>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= PROOT ?>css/custom.css?v=<?= time() ?>">
<?php $this->end(); ?>
    <style>
        body {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }
    </style>
<?php $this->start('body'); ?>
    <div class="card">
        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <i class="checkmark">✓</i>
        </div>
        <h1>Success</h1>
        <p>We received your purchase request;<br/> we'll be in touch shortly!</p>
        <h6>Redirect in 5s...</h6>
    </div>

<?php $this->end(); ?>