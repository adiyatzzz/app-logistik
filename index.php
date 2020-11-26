<?php
include('class/init.php');
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Warehouse</title>
</head>

<body>

    <!-- Outer Wrapper -->
    <div class="outer-wrapper h-100 w-100 d-flex align-items-start flex-column">
        <!-- Navbar -->
        <header class="container p-0">
            <nav class="navbar navbar-expand-lg navbar-light nav-border nav-bg">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item <?= (!isset($_GET["p"])) ? "active" : "" ?>">
                            <a class="nav-link text-dark" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?= (isset($_GET["p"]) && $_GET["p"] == "user") ? "active" : "" ?>">
                            <a class="nav-link text-dark" href="?p=user">User</a>
                        </li>
                        <li class="nav-item <?= (isset($_GET["p"]) && $_GET["p"] == "item") ? "active" : "" ?>">
                            <a class="nav-link text-dark" href="?p=item">Item</a>
                        </li>
                        <li class="nav-item <?= (isset($_GET["p"]) && $_GET["p"] == "warehouse") ? "active" : "" ?>">
                            <a class="nav-link text-dark" href="?p=warehouse">Warehouse</a>
                        </li>
                        <li class="nav-item <?= (isset($_GET["p"]) && $_GET["p"] == "storage") ? "active" : "" ?>">
                            <a class="nav-link text-dark" href="#">Storage</a>
                        </li>
                        <li class="nav-item <?= (isset($_GET["p"]) && $_GET["p"] == "report") ? "active" : "" ?>">
                            <a class="nav-link text-dark" href="#">Report</a>
                        </li>

                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <div class="search-wrapper">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search.." id="datatableSearch">
                            <button type="button" class="search-icon btn">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="proses.php?act=logout" class="nav-link text-dark">logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- CONTENT -->
        <?php
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
            switch ($page) {
                case 'user':
                    require_once 'template/user.php';
                    break;
                case 'item':
                    require_once 'template/item.php';
                    break;
                case 'edit_item':
                    require_once 'template/edit_item.php';
                    break;
                case 'warehouse':
                    require_once 'template/warehouse.php';
                    break;
                case 'edit_warehouse':
                    require_once 'template/edit_warehouse.php';
                    break;              

                default:
                    require_once 'template/404.php';
                    break;
            }
        } else {
            require_once 'template/home.php';
        }
        ?>

        <!-- FOOTER -->
        <footer class="mt-auto">
            <div class="container footer-bg">
                <p class="text-light m-0">&copy;Muhammad Adiyat 2020. All Rights Reserved</p>
            </div>
        </footer>
    </div>


    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="assets/datatables/datatables.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/myscript.js"></script>
</body>

</html>
