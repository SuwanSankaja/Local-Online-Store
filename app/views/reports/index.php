
<?php $this->setSiteTitle('Reports'); ?>

<?php $this->start('head'); ?>
<style>
    a:link {
        color: greenyellow;
        background-color: transparent;
        text-decoration: none;
    }
    a:visited {
        color: black;
        background-color: transparent;
        text-decoration: none;
    }
    a:active {
        color: black;
        background-color: transparent;
    }
</style>

<?php $this->end(); ?>

<?php $this->start('body'); ?>
<center>
    <br>
    <a href="index"style="text-decoration: none"><h1 class="text-center red">Reports</h1></a>
    <br>
    <h2><a href="quarterly_sales"style="text-decoration: none">1.Quarterly Sales Report</a></h2>
    <h2><a href="most_sold_products"style="text-decoration: none">2.Most Sold Products Report </a></h2>
    <h2><a href="most_sold_cats"style="text-decoration: none">3.Most Sold Categories Report</a></h2>
    <h2><a href="interest_of_item"style="text-decoration: none">4.Interest of an Item Report</a></h2>
    <h2><a href="customer_orders"style="text-decoration: none">5.Customer Orders Report</a></h2>
</center>
<?php $this->end(); ?>

<style>
    body{
        font-family: 'Open Sans', sans-serif;
    }

    section{
        float:left;
        width:100%;
        background: #fff;  /* fallback for old browsers */
        padding:30px 0;
    }
    h1{float:left; width:100%; color:#232323; margin-bottom:30px; font-size: 14px;}
    h1 span{font-family: 'Libre Baskerville', serif; display:block; font-size:45px; text-transform:none; margin-bottom:20px; margin-top:30px; font-weight:700}
    h1 a{color:#131313; font-weight:bold;}

    .profile-card-5{
        margin-top:20px;
    }
    .profile-card-5 .btn{
        border-radius:2px;
        text-transform:uppercase;
        font-size:12px;
        padding:7px 20px;
    }

    .profile-card-5 .card-img-block img{
        border-radius:5px;
        box-shadow:0 0 10px rgba(0,0,0,0.63);
    }
    .profile-card-5 h5{
        color:#4E5E30;
        font-weight:600;
    }
    .profile-card-5 p{
        font-size:14px;
        font-weight:300;
    }
    .profile-card-5 .btn-primary{
        background-color:#4E5E30;
        border-color:#4E5E30;
    }


</style>
</style>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


<section style="background-color: #eee">
    <h1 class="text-center red">Sales Reports</h1>
    <div class="container">
        <div class="row">

            <div class="col-md-4 mt-4">
                <div class="card profile-card-5">
                    <div class="card-img-block">
                        <a href="<?= PROOT ?>reports/customer_orders" target="_blank">
                            <img class="card-img-top" src="https://media.istockphoto.com/id/1223930609/vector/audit-report-or-research-of-sales-financial-data-vector-flat-cartoon-icon-tax-analyze-on.jpg?s=612x612&w=0&k=20&c=4Cc7l2nSGLkdC19faNJNTSG4C_KWh_ybZLPgO0JY0pc=" alt="Card image cap" style="width: 91%;height:200px;margin: 0 0 0 15px;position: relative;top: -20px;"></a>
                        <div class="card-body pt-0">
                            <h5 class="card-title">Customer Order</h5>
                            <p class="card-text">Contains orders of each customer with respective time period</p>


                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4">
                <div class="card profile-card-5">
                    <div class="card-img-block">
                        <a href="<?= PROOT ?>reports/interest_of_item" target="_blank">
                            <img class="card-img-top" src="https://www.shutterstock.com/image-illustration/chart-rising-interest-rates-percentages-600w-2115606887.jpg" alt="Card image cap" style="width: 91%;height:200px;margin: 0 0 0 15px;position: relative;top: -20px" ></a>
                        <div class="card-body pt-0">
                            <h5 class="card-title">Most Interested</h5>
                            <p class="card-text">Contains items with most interest in a certain time period</p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4">
                <div class="card profile-card-5">
                    <div class="card-img-block">
                        <a href="<?= PROOT ?>reports/most_sold_products" target="_blank">
                            <img class="card-img-top" src="https://www.newbreedrevenue.com/hubfs/reporting.png" alt="Card image cap" style="width: 91%;height:200px;margin: 0 0 0 15px;position: relative;top: -20px" ></a>
                        <div class="card-body pt-0">
                            <h5 class="card-title">Most sold Items</h5>
                            <p class="card-text">Contains Items which recorded most sales during a certain period</p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4" style="align-items: center;margin-left:20%">
                <div class="card profile-card-5">
                    <div class="card-img-block">
                        <a href="reports/most_sold_cats" target="_blank">
                            <img class="card-img-top" src="https://cdn-icons-png.flaticon.com/512/8161/8161879.png" alt="Card image cap"style="width: 91%;height:200px;margin: 0 0 0 15px;position: relative;top: -20px" ></a>
                        <div class="card-body pt-0">
                            <h5 class="card-title">Most sold Categories</h5>
                            <p class="card-text">Contains categories which recorded most sales </p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4" style="align-items: flex-end; margin-left:fill">
                <div class="card profile-card-5">
                    <div class="card-img-block">
                        <a href="reports/quarterly_sales" target="_blank">
                            <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJ1T1k6dVsccZlQEBISUeHo8TNZZajUmBF5Q&usqp=CAU" alt="Card image cap" style="width: 91%;height:200px;margin: 0 0 0 15px;position: relative;top: -20px"></a>
                        <div class="card-body pt-0">
                            <h5 class="card-title">Quarterly Sales</h5>
                            <p class="card-text">Contains Sales of requested quarter</p>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
<?php $this->end();