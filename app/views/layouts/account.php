<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $this->siteTitle(); ?></title>

    <?= $this->content('head'); ?>

    <link rel='stylesheet' href="<?= PROOT ?>css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">

    <script src="<?= PROOT ?>js/jquery-2.2.4.min.js" charset="utf-8"></script>
    <script src="<?= PROOT ?>js/bootstrap.min.js" charset="utf-8"></script>
</head>

<body style="background: rgb(239,239,239); font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
<?= $this->content('body') ?>
</body>

</html>
