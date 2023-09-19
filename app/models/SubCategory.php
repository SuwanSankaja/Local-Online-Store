<?php
#[AllowDynamicProperties]

class SubCategory extends Model{
    public function __construct(){
        $table='sub_category';
        parent::__construct($table);
    }

    public function getSubCategories($category_id){
        $result=$this->find([
            'conditions'=>'category_id=?',
            'bind' => [$category_id]]);
        return $result;
    }

}