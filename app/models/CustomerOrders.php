<?php
#[AllowDynamicProperties]
class CustomerOrders extends Model {

  private $db;

  public function __construct() {
    $this->db = Db::getInstance();
  }

  public function getCustomerOrders($id) {
    /*SELECT `order`.order_id,customer.first_name,customer.last_name,customer.username,customer.email,customer_phone.phone_no,customer_address.address1,customer_address.address2,customer_address.city,customer_address.state,`order`.order_created_date,payment.paid_on_date,payment.bill_total
    FROM `order`
    JOIN customer
    ON `order`.customer_id=customer.customer_id
    JOIN customer_address
    ON `order`.address_id=customer_address.address_id
    JOIN customer_phone
    ON `order`.phone_no_id=customer_phone.phone_no_id
    JOIN payment
    ON `order`.payment_id=payment.payment_id
    WHERE `order`.customer_id={$id} */
    //query for the following procedure
    $stmt = $this->db->query("CALL `customer_orders`($id)");
    //$stmt->execute(array(":year" => $year));
    return $stmt->results();
    //return $stmt->fetchAll();
  }

}