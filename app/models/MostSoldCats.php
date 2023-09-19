<?php


class MostSoldCats extends Model {

  private $db;

  public function __construct() {
    $this->db = Db::getInstance();
  }

  public function getMostSoldCat($year) {
    
    /*SELECT category.category_name as category_name, SUM(cart_item.quantity) as sold_quantity
    FROM cart_item
    JOIN product_variant ON cart_item.product_variant_id = product_variant.product_variant_id
    JOIN product ON product_variant.product_id = product.product_id
    JOIN `order` ON cart_item.cart_id = `order`.cart_id
    JOIN product_sub_link ON product.product_id=product_sub_link.product_id
    JOIN sub_category ON product_sub_link.sub_category_id=sub_category.sub_category_id
    JOIN category ON sub_category.category_id=category.category_id
      WHERE YEAR(`order`.`order_created_date`)={$year}
    GROUP BY category.category_id
    ORDER BY sold_quantity DESC*/
    //Query for the given procedure
    
    $stmt = $this->db->query("CALL `most_sold_cat`($year)");
    //$stmt->execute(array(":from" => $from, ":to"=> $to));
    return $stmt->results();
    //return $stmt->fetchAll();
  }

}
