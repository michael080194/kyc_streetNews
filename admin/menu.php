<?php
$adminmenu = array();

$i                      = 1;
$adminmenu[$i]['title'] = _MI_TAD_ADMIN_HOME;
$adminmenu[$i]['link']  = 'admin/index.php';
$adminmenu[$i]['desc']  = _MI_TAD_ADMIN_HOME_DESC;
$adminmenu[$i]['icon']  = 'images/admin/home.png';

$i++;
$adminmenu[$i]['title'] = _MI_STREETNEWS_ADMENU1;
$adminmenu[$i]['link']  = "admin/main.php";
$adminmenu[$i]['desc']  = _MI_STREETNEWS_ADMENU1_DESC;
$adminmenu[$i]['icon']  = 'images/admin/phone.png';


$i++;
$adminmenu[$i]['title'] = _MI_STREETNEWS_ADMENU2;
$adminmenu[$i]['link']  = "admin/main2.php";
$adminmenu[$i]['desc']  = _MI_STREETNEWS_ADMENU2_DESC;
$adminmenu[$i]['icon']  = 'images/admin/list.png';

$i++;
$adminmenu[$i]['title'] = _MI_TAD_ADMIN_ABOUT;
$adminmenu[$i]['link']  = 'admin/about.php';
$adminmenu[$i]['desc']  = _MI_TAD_ADMIN_ABOUT_DESC;
$adminmenu[$i]['icon']  = 'images/admin/about.png';
