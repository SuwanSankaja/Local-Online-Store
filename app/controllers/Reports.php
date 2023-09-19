<?php

class Reports extends Controller {
    public QuarterlySales $QuarterlySalesModel;
    public MostSoldItems $MostSoldItemsModel;
    public MostSoldCats $MostSoldCatsModel;
    public InterestOfItem $InterestOfItemModel;
    public CustomerOrders $CustomerOrdersModel;
    

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->load_model('QuarterlySales');
        $this->load_model('MostSoldItems');
        $this->load_model('MostSoldCats');
        $this->load_model('InterestOfItem');
        $this->load_model('CustomerOrders');

        $this->view->setLayout('default');
        
      }
    public function indexAction(){
        $this->view->render('reports/index');
    }
    public function quarterly_salesAction() {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $year = $_POST['year'];
            $quarterlySales = $this->QuarterlySalesModel->getQuarterlySales($year);
            $this->view->quarterlySales = $quarterlySales;
            $this->view->render('reports/quarterly_sales_view');}
           else {
              $this->view->render('reports/quarterly_sales_form');
              
          }
    }
    

    public function most_sold_productsAction(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $from = $_POST['from'];
            $to = $_POST['to'];
            $mostSoldItems = $this->MostSoldItemsModel->getMostSoldItems($from,$to);
            $this->view->mostSoldItems = $mostSoldItems;
            $this->view->render('reports/most_sold_items_view');}
           else {
              $this->view->render('reports/most_sold_items_form');
              
          }
    }
    public function most_sold_catsAction(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $year = $_POST['year'];
            $mostSoldCats = $this->MostSoldCatsModel->getMostSoldCat($year);
            $this->view->mostSoldCats = $mostSoldCats;
            $this->view->render('reports/most_sold_cats_view');}
           else {
              $this->view->render('reports/most_sold_cats_form');
              
          }
    }
    public function interest_of_itemAction(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];

            $year = $_POST['year'];
            $interesOfItem = $this->InterestOfItemModel->getInterestOfItem($id,$year);
            $this->view->interesOfItem = $interesOfItem;
            $this->view->render('reports/interest_of_item_view');}
           else {
              $this->view->render('reports/interest_of_item_form');
              
          }
    }
    public function customer_ordersAction(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];
            $customerOrders = $this->CustomerOrdersModel->getCustomerOrders($id);
            $this->view->customerOrders = $customerOrders;
            $this->view->render('reports/customer_orders_view');}
           else {
              $this->view->render('reports/customer_orders_form');
              
          }
}}
