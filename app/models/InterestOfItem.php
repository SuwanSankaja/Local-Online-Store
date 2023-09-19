<?php
#[AllowDynamicProperties]
class InterestOfItem extends Model {

  private $db;

  public function __construct() {
    $this->db = Db::getInstance();
  }


  public function getInterestOfItem($id,$year) {

    /*SELECT MONTHNAME(order_created_date) as month, SUM(ci.quantity) as num_sales
    FROM `order` o
    JOIN cart_item ci ON o.cart_id = ci.cart_id
    JOIN product_variant pv ON ci.product_variant_id = pv.product_variant_id
    WHERE pv.product_id = {$id} AND YEAR(order_created_date) = {$year}
    GROUP BY MONTH(order_created_date) */
    //query for the following procedure
    
    $stmt = $this->db->query("CALL `monthly_sales`($id,$year)");

    //$stmt->execute(array(":year" => $year));
    return $stmt->results();
    //return $stmt->fetchAll();
  }

}