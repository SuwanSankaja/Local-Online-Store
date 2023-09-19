<?php
#[AllowDynamicProperties]

class Cart extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);

        if (!isset($_SESSION['checkout'])) {
            $_SESSION['checkout'] = false;
            $_SESSION['payment'] = false;
            $_SESSION['successful'] = false;
        }
    }

    public function itemsAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['checkout'] = true;
            Router::redirect('cart/checkout');
        }

        if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
            Router::redirect('account/signin');
        }

        $this->view->setLayout('default');
        $this->view->render('cart/items');
    }

    public function checkoutAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['action'])) {
                $_SESSION['successful'] = true;
                $date = date('Y-m-d H-i-s');

                $db = Db::getInstance();
                $db->query("insert into payment values (null, '{$date}', {$_POST['total']})");
                $db->call_procedure('place_order', [
                    $_SESSION[Customer::currentLoggedInUser()->getSessionName()],
                    $_POST['date'],
                    'on_delivery'
                ]);
            } else {
                $_SESSION['payment'] = true;
                Router::redirect('cart/payment');
            }
        }

        if (!$_SESSION['checkout']) {
            header("HTTP/1.1 403 Unauthorized");
            exit;
        }

        $this->view->setLayout('default');
        $this->view->render('cart/checkout');
    }

    public function paymentAction()
    {
        if ($_POST) {
            $_SESSION['successful'] = true;
            Router::redirect('cart/successful');
        }

        if (!$_SESSION['payment']) {
            header("HTTP/1.1 403 Unauthorized");
            exit;
        }

        $this->view->setLayout('default');
        $this->view->render('cart/payment');
    }

    public function successfulAction()
    {
        if (!$_SESSION['successful']) {
            header("HTTP/1.1 403 Unauthorized");
            exit;
        }

        $_SESSION['checkout'] = false;
        $_SESSION['payment'] = false;
        $_SESSION['successful'] = false;

        $this->view->setLayout('default');
        $this->view->render('cart/successful');
        header("Refresh:5; url=" . PROOT);
    }

    public function removeAction()
    {
        $db = Db::getInstance();
        $id = $_POST['id'];
        $id = (int)substr($id, 6);

        $db->call_procedure('remove_item_from_cart', [$_SESSION[Customer::currentLoggedInUser()->getSessionName()], $id]);
    }

    public function on_deliveryAction()
    {
        $db = Db::getInstance();

    }
}