<?php
#[AllowDynamicProperties]

class Product extends Model{
    public function __construct(){
        $table='product';
        parent::__construct($table);
    }
    
    public function getProduct($product_id){
        return $this->findFirst([
            'conditions' => 'product_id=?',
            'bind' => [$product_id]
        ] );
    }
}