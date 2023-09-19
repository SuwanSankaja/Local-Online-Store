<?php
#[AllowDynamicProperties]

class Category extends Model{
    public function __construct(){
        $table='category';
        parent::__construct($table);
    }


    
}