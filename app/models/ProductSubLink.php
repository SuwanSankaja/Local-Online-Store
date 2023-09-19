<?php
#[AllowDynamicProperties]

class productSubLink extends Model{
    public function __construct(){
        $table='product_sub_link';
        parent::__construct($table);
    }

    public function getProducts($sub_category_id){
        $array=[];
        $result=$this->find([
            'conditions'=>'sub_category_id=?',
            'bind' => [$sub_category_id]]);
        foreach ($result as $value) {
            $temp=$this->_db->find('product',[
                'conditions' => 'product_id=?',
                'bind' =>[$value->product_id]
            ]);
            $array[$value->product_id]=$temp;
        }
        return $array;

    }
}
    
