<?php
#[AllowDynamicProperties]

class Browsing extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->load_model('Category');
        $this->load_model('SubCategory');
        $this->load_model('ProductSubLink');
        $this->load_model('ProductVariant');
        $this->load_model('Product');
        $this->view->setLayout('default1');
    }

    public function indexAction()
    {
        $details = [];
        $categoryItems = $this->CategoryModel->find();
        foreach ($categoryItems as $value) {
            $categoryId = $value->category_id;
            $categoryName = $value->category_name;
            $subCategoryItems = $this->SubCategoryModel->getSubCategories($categoryId);
            $details[$categoryId] = [$categoryName, $subCategoryItems];
        }

        $this->view->details = $details;
        $this->view->render('browsing/browsing');
    }

    public function productDisplayAction($sub_category_id)
    {
        $details = $this->ProductSubLinkModel->getProducts($sub_category_id);
        $this->view->details = $details;
        $this->view->render('browsing/product');
    }

    public function variantDisplayAction($product_id)
    {
        Session::set('product_id', $product_id);
        $product = $this->ProductModel->getProduct($product_id);
        $details = $this->ProductVariantModel->getsubProductItems($product_id);
        $variant_display = [];
        foreach ($details as $key => $value) {
            $temp = [];
            foreach ($value as $id => $val) {
                $temp[] =  $val->variant_name . " : " . $val->variant_val_name;
            }
            $variant_display[$key] = join(" , ", $temp);
        }

        $this->view->product = $product;
        $this->view->details = $details;
        $this->view->variant_display = $variant_display;
        $this->view->render('browsing/productVariant');
    }
}
