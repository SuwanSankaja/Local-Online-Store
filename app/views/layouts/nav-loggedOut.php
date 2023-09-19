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
                <li class="nav-item">
                    <a class="nav-link" href="<?= PROOT ?>browsing">Products</a>
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
                                    <button id="search-btn" class="btn btn-outline-warning my-2 my-sm-0" type="submit">
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
                    <a class="nav-link" href="<?= PROOT ?>cart/items"><i class="fa-solid fa-cart-shopping"></i></a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-light" href="<?= PROOT ?>account/signin" role="button">Sign In</a>

                </li>
                <li class="nav-item">
                    <a class="btn btn-light" href="<?= PROOT ?>account/signup" role="button">Sign Up</a>
                </li>

            </ul>

        </div>
    </nav>

</div>