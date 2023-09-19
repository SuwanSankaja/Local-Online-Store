<?php

class CartItemController extends Controller {

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->load_model('ProductVariant');
        $this->load_model('CartItem');
        $this->view->setLayout('default');
    }

    public function addItemAction(){
        if(!$_SESSION[CURRENT_USER_SESSION_NAME]){
            Session::set('current_position', 'Browsing/variantDisplay/'.Session::get('product_id'));
            Router::redirect("Account/signin");
        }
        $productVariant=$this->ProductVariantModel->findFirst([
            'conditions' => 'product_variant_id=?',
            'bind' => [$_POST['variant_id']]
        ]);
        $currentQuantity = $productVariant->quantity;
        $customerQuantity = $_POST[$_POST['variant_id']];
        $cartId = $this->CartItemModel->getEmptyCart($_SESSION[CURRENT_USER_SESSION_NAME]);
        $cartProduct = $this->CartItemModel->getCartProducts($_SESSION[CURRENT_USER_SESSION_NAME], $cartId, $_POST['variant_id']);
        if ($cartProduct->cart_id){
            $updatedQuantity = $cartProduct->quantity + $customerQuantity;
            if ($currentQuantity>=$updatedQuantity){
                $this->CartItemModel->updateQuantity($_SESSION[CURRENT_USER_SESSION_NAME]
                ,$cartId,$_POST['variant_id'],(string)$updatedQuantity);
                $_SESSION['msg'] = "Item added to the cart";
                Router::redirect("Browsing/variantDisplay/".Session::get("product_id"));
            }else{
                $_SESSION['msg'] = "Not enough quantity available";
                Router::redirect("Browsing/variantDisplay/".Session::get("product_id"));
            }
        }else {
            if ($currentQuantity>=$customerQuantity) {
                $this->CartItemModel->insert([
                    'customer_id' => $_SESSION[CURRENT_USER_SESSION_NAME],
                    'cart_id' => $cartId,
                    'product_variant_id' => $_POST['variant_id'],
                    'quantity' => $customerQuantity
                ]);
                $_SESSION['msg'] = "Item added to the cart";
                Router::redirect("Browsing/variantDisplay/".Session::get("product_id"));
            }else {
                $_SESSION['msg'] = "Not enough quantity available";
                Router::redirect("Browsing/variantDisplay/".Session::get("product_id"));
            }
        }

    }
}