<?php
#[AllowDynamicProperties]

class ProductVariant extends Model
{
    public function __construct()
    {
        $table = 'product_variant';
        parent::__construct($table);
    }

    public function getVariants($productId)
    {
        $array = [];
        $result = $this->find([
            'conditions' => 'product_id=?',
            'bind' => [$productId]
        ]);
        foreach ($result as $value) {
            $temp = $this->_db->find('product_details', [
                'conditions' => 'product_variant_id=?',
                'bind' => [$value->product_variant_id]
            ]);

            $array[$value->product_variant_id] = $temp;
        }
        if (!$result) {
            return [];
        }
        return $array;
    }

    public function getSubProductItems($product_id)
    {
        $array = [];
        $result = $this->find([
            'conditions' => 'product_id=?',
            'bind' => [$product_id]
        ]);
        foreach ($result as $value) {
            $temp = $this->_db->find('product_variant_details', [
                'conditions' => 'product_variant_id=?',
                'bind' => [$value->product_variant_id]
            ]);

            $array[$value->product_variant_id] = $temp;
        }
        if (!$result) {
            return [];
        }
        return $array;
    }
}
