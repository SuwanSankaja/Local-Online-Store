<?php
#[AllowDynamicProperties]
class MostSoldItems extends Model {

  private $db;

  public function __construct() {
    $this->db = Db::getInstance();
  }

  public function getMostSoldItems($from,$to) {
    $stmt = $this->db->query("SELECT product.product_name as product_name, SUM(cart_item.quantity) as sold_quantity
      FROM cart_item
      JOIN product_variant ON cart_item.product_variant_id = product_variant.product_variant_id
      JOIN product ON product_variant.product_id = product.product_id
      JOIN `order` ON cart_item.cart_id = `order`.cart_id
      WHERE (`order`.order_created_date) BETWEEN '$from' AND '$to'
      GROUP BY product.product_name
      ORDER BY sold_quantity DESC");
    //$stmt->execute(array(":from" => $from, ":to"=> $to));
    return $stmt->results();
    //return $stmt->fetchAll();
  }

}
