<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel='stylesheet' href="<?= PROOT ?>css/custom1.css?v=<?php echo time(); ?>" media="screen" title="no title" charset="utf-8">
    <link rel='stylesheet' href="<?= PROOT ?>css/custom1.css?v=<?php echo time(); ?>" media="screen" title="no title" charset="utf-8">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="<?= PROOT ?>js/jquery-2.2.4.min.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <?= $this->content('head'); ?>
    <style>
        /* Formatting search box */

        .result {
            position: absolute;
            z-index: 999;
            top: 100%;
            left: 0;
        }

        .result {
            width: 100%;
            box-sizing: border-box;
        }

        /* Formatting result items */
        .result p {
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
        }

        .result p:hover {
            background: #f2f2f2;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.search-box input[type="text"]').on("keyup input", function() {
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("<?= PROOT ?>/home/search", {
                        term: inputVal
                    }).done(function(data) {
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });

            $(document).on("click", ".result p", function() {
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parents(".search-box").find('input[type="text"]').attr('url', $(this).attr('id'));
                $(this).parent(".result").empty();
            });

            $('#search-btn').on('click', function() {
                var url = $('.search-box input[type="text"]').attr('url');
                url = url.substring(7, url.length);
                if (url) {
                    window.location.assign("<?= PROOT ?>browsing/variantDisplay/" + url);
                }
            });
        });
    </script>
    <noscript>
        <meta http-equiv="refresh" content="0;url='<?= PROOT ?>browsing/variantDisplay/'" />
    </noscript>
</head>

<body>
    <?php
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
        if (!isset($_SESSION[CURRENT_USER_SESSION_NAME]) or $_SESSION[CURRENT_USER_SESSION_NAME] != '1') {
            require_once "app/views/layouts/nav-loggedIn.php";
        } else {
            require_once "app/views/layouts/nav-loggedInAdmin.php";
        }
    } else {
        require_once "app/views/layouts/nav-loggedOut.php";
    }
    ?>
    <?= $this->content('body'); ?>
</body>

</html>