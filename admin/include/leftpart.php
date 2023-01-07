<div id="leftpart">
        <h3> Reports</h3>
        <ul style="list-style: none;">
                <li><a href="index.php?quarterly_sales_report">Quaterly Sales Report </a></li>      <!--by giving a year --->
                <li><a href="index.php?most_sold_items">Most Sold items </a></li>              <!--by giving 2 dates --->
                <li><a href="index.php?most_sold_category">Most Ordered Category </a></li>      <!--category with most orders --->
                <li><a href="index.php?Search_a_Product">Time of Interest</a></li>            <!--by searching by name--->
                <li><a href="index.php?customer_orders">Customer - order report  </a></li>   <!--by giving 2 dates --->
        </ul>
</div> <!-- end of left part -->



<?php
        if(isset($_GET['quarterly_sales_report'])){
                include("1_quarterly_sales.php");}

        if(isset($_GET['most_sold_items'])){
                include("2_most_sold_items.php");}

        if(isset($_GET['most_sold_category'])){
                include("3_most_sold_cat.php");}
                
        if(isset($_GET['Search_a_Product'])){
                include("4_Search_a_Product.php");}

        if(isset($_GET['customer_orders'])){
                include("5_customer_orders.php");}
?>