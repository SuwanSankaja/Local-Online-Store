<?php

class Account extends Controller
{
    public Customer $CustomerModel;

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->load_model('Customer');
    }

    public function signinAction()
    {
        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
            Router::redirect('');
        }

        $validation = new Validate();
        if ($_POST) {
            $validation->check($_POST, [
                'username' => [
                    'display' => 'Username',
                    'required' => true,
                    'min' => 6,
                    'max' => 150,
                ],
                'password' => [
                    'display' => 'Password',
                    'required' => true,
                    'min' => 6,
                    'max' => 150,
                ]
            ]);
            if ($validation->passed()) {
                $user = $this->CustomerModel->findByUsername($_POST['username']);

                if ($user->username) {
                    if (password_verify(Input::get('password'), $user->password)) {
                        $remember = isset($_POST['rememberMe']) && Input::get('rememberMe');
                        $user->setId($user->customer_id);
                        $user->signin($remember);

                        Router::redirect('');
                    } else {
                        $validation->addError("Invalid password.");
                    }
                } else {
                    $validation->addError("Invalid username.");
                }

            }
        }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->setLayout('account');
        $this->view->render('account/signin');
    }

    public function signupAction()
    {
        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
            Router::redirect('');
        }

        $validation = new Validate();

        if ($_POST) {
            $validation->check($_POST, [
                'first_name' => [
                    'display' => 'First Name',
                    'required' => true,
                    'min' => 2,
                    'max' => 50,
                ],
                'last_name' => [
                    'display' => 'Last Name',
                    'required' => true,
                    'min' => 2,
                    'max' => 50,
                ],
                'username' => [
                    'display' => 'Username',
                    'required' => true,
                    'unique' => 'customer',
                    'min' => 6,
                    'max' => 150
                ],
                'email' => [
                    'display' => 'Email',
                    'required' => true,
                    'unique' => 'customer',
                    'max' => 150,
                    'valid_email' => true
                ],
                'password' => [
                    'display' => 'Password',
                    'required' => true,
                    'min' => 6
                ],
                'al1' => [
                    'display' => 'Address Line 1',
                    'required' => true,
                    'min' => 6,
                    'max' => 150
                ],
                'al2' => [
                    'display' => 'Address Line 2',
                    'required' => false,
                    'min' => 6,
                    'max' => 150
                ],
                'city' => [
                    'display' => 'City',
                    'required' => true,
                    'min' => 2,
                    'max' => 50
                ],
                'state' => [
                    'display' => 'State',
                    'required' => true,
                    'min' => 2,
                    'max' => 50
                ],
                'postal' => [
                    'display' => 'Postal code',
                    'required' => true,
                    'min' => 2,
                    'max' => 50,
                    'numeric' => true
                ],
                'phone' => [
                    'display' => 'Phone',
                    'required' => true,
                    'min' => 2,
                    'max' => 50,
                    'phone' => true
                ]
            ]);
            if ($validation->passed()) {
                $db = DB::getInstance();

                $db->call_procedure('insert_customer', [
                    'first_name' => Input::get('first_name'),
                    'last_name' => Input::get('last_name'),
                    'username' => Input::get('username'),
                    'email' => Input::get('email'),
                    'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
                    'al1' => Input::get('al1'),
                    'al2' => Input::get('al2'),
                    'city' => Input::get('city'),
                    'state' => Input::get('state'),
                    'postal' => Input::get('postal'),
                    'phone' => Input::get('phone')
                ]);

                Router::redirect('account/signin');
            }
        }

        $this->view->displayErrors = $validation->displayErrors();
        $this->view->setLayout('account');
        $this->view->render('account/signup');
    }

    public function signoutAction()
    {
        if (Customer::currentLoggedInUser()) {
            Customer::currentLoggedInUser()->logout();
        }

        Router::redirect('');
    }
}