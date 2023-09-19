<?php
#[AllowDynamicProperties]

class CartItem extends Model{
    public function __construct(){
        $table='cart_item';
        parent::__construct($table);
    }

    public function getEmptyCart($currentUserId){
        $sql= 'select getEmptyCartId(?) AS CartId;';
        $values=[$currentUserId];
        return $this->query($sql, $values)->results()[0]->CartId;
    }

    public function getCartProducts($currentUserId,$cartid,$variant_id){
        return $this->findFirst([
            'conditions'=>'customer_id=? and cart_id=? and product_variant_id=?',
            'bind'=>[$currentUserId,$cartid,$variant_id]
        ]);
    }

    public function updateQuantity($currentUserId,$cartid,$variant_id,$quantity){
        $sql = "update cart_item set quantity=? where customer_id=? and cart_id=? and product_variant_id=?";
        $values = [$quantity,$currentUserId,$cartid,$variant_id];

        if (!$this->query($sql, $values)->error()) {
            return true;
        }
        return false;
    }
}