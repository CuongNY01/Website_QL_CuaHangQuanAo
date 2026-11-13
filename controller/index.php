<?php
session_start();
include_once "../model/config.php";
include_once "../model/danhmuc.php";
include_once "../model/sanpham.php";
include_once "../model/binhluan.php";
include_once "../model/user.php";
include_once "../model/login_submit.php";
include_once "../model/register_submit.php";

include "../view/header.php";

$act = $_GET['act'] ?? '';

switch ($act) {
    case 'cart':
        include "../view/cart.php";
        break;
    case 'sanpham':
        include "../view/sanpham.php";
        break;
    case 'login':
        include "../view/login.php";
        break;
    case 'register':
        include "../view/register.php";
        break;
    case 'suauser':
        include "../view/suauser.php";
        break;
    case 'seach':
        include "../model/seach.php";
        break;
    case 'chitiet':
    case 'chitietsp':
        include "../view/chitietsp.php";
        break;
    case 'baiviet':
        include "../view/baiviet.php";
        break;
    case 'about':
        include "../view/about.php";
        break;
    case 'contac':
        include "../view/contac.php";
        break;
    case 'thanhtoan':
        include "../view/thanhtoan.php";
        break;
    default:
        include "../view/home.php";
        break;
}

include "../view/footer.php";
?>
