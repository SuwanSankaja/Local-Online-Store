<?php
#[AllowDynamicProperties]
class QuarterlySales extends Model {

  private $db;

  public function __construct() {
    $this->db = Db::getInstance();
  }

  public function getQuarterlySales($year) {
    
   /*SELECT QUARTER(order_created_date) as quarter,SUM(bill_total) as quarterly_sales
    FROM `order`
    JOIN `payment` on `order`.payment_id = `payment`.payment_id
    WHERE YEAR(`order`.order_created_date) = {$year} AND `payment`.paid_on_date is NOT Null
    GROUP BY quarter
    ORDER BY quarter*/
    //query for the given procedure
    
    $stmt = $this->db->query("CALL `quarterly_sales`($year)");
    //$stmt->execute(array(":year" => $year));
    return $stmt->results();
    //return $stmt->fetchAll();
  }

}

