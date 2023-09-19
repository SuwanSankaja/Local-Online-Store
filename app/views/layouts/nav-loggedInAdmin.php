<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?= PROOT ?>">E-Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= PROOT ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= PROOT ?>/browsing">Products <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php
                        $home = new Home('Home', '');
                        $details = [];
                        $categoryItems = $home->CategoryModel->find();
                        foreach ($categoryItems as $value) {
                            $categoryId = $value->category_id;
                            $categoryName = $value->category_name;
                            $subCategoryItems = $home->SubCategoryModel->getSubCategories($categoryId);
                            $details[$categoryId] = [$categoryName, $subCategoryItems];
                        }
                        foreach ($details as $key => $value) { ?>
                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="dropdown" href="#"><?= $value[0] ?><br></a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($value[1] as $id => $val) { ?>
                                        <div class="sub1">
                                            <a class="dropdown-item sub" href=<?= PROOT . "Home/productDisplay/" . $val->sub_category_id ?>>
                                                <?= $val->sub_category_name ?><br>
                                            </a>
                                        </div>

                                    <?php } ?>
                                </ul>
                            </li><?php
                                } ?>
                    </ul>
                </li>

                <li class="form-action">
                    <div class="container">
                        <form class="form-inline my-2 my-lg-0">
                            <div class="row">
                                <div class="search-box col" style="padding-right: 5px;">
                                    <input id="search-field" autocomplete="off" class="form-control mr-sm-2" type="text" placeholder="Search for Products..">
                                    <div class="result"></div>
                                </div>
                                <div class="col align-items-start" style="padding-left: 0;">
                                    <button id="search-btn" class="btn btn-outline-warning my-2 my-sm-0" type="button">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn" href="<?= PROOT ?>cart/items" role="button">
                        <span class="material-icon"><i class="fa-solid fa-cart-shopping"></i></span>
                        <span class="icon-button__badge"><?php // require_once 'app/views/layouts/header.php';
                                                            $db = Db::getInstance();
                                                            $id = $_SESSION[Customer::currentLoggedInUser()->getSessionName()];

                                                            $rows = $db->call_procedure('view_cart', [$id]);
                                                            echo count($rows);
                                                            ?></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        $user_id = Customer::currentLoggedInUser()->customer_id;
                        $user = Db::getInstance()->query("SELECT * FROM customer WHERE customer_id = $user_id")->results()[0];
                        echo $user->first_name . " " . $user->last_name;
                        ?>
                    </a>
                    <div class="dropdown-menu list" aria-labelledby="navbarDropdown">
                        <a class="dropdown_item sub" href=<?= PROOT . "Account/signout" ?>>
                            Sign Out<br>
                        </a>
                        <a class="dropdown_item sub" href=<?= PROOT . "Inventory" ?>>
                            Inventory<br>
                        </a>
                        <a class="dropdown_item sub" href="<?= PROOT ?>reports" ?>>
                            Reports<br>
                        </a>


                    </div>
                </li>

            </ul>

        </div>
    </nav>

</div>