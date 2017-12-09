<?php
$modversion = array();

//---模組基本資訊---//
$modversion['name']        = "巷談集";
$modversion['version']     = 1.00;
$modversion['description'] = "以台南社大師生為主體寫作者的《巷集談-街道新聞》，秉持公民素人發聲 、開放以及非營利的宗旨，除希望培力更多公民記者、自由寫手之外，更希望以關注台南市未來城鄉永續發展過程中，保障公民參與審議的權利為精神，成為台南市公民傳播媒體的草根平台。";
$modversion['author']      = 'Michael';
$modversion['credits']     = '相關有功人員';
$modversion['help']        = 'page=help';
$modversion['license']     = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image']       = 'images/logo.png';
$modversion['dirname']     = basename(dirname(__FILE__));

//---模組狀態資訊---//
$modversion['release_date']        = '2017/08/08';
$modversion['module_website_url']  = 'http://模組官網網址';
$modversion['module_website_name'] = "巷談集";
$modversion['module_status']       = 'release';
$modversion['author_website_url']  = 'http://作者網站網址';
$modversion['author_website_name'] = "michael 教材網";
$modversion['min_php']             = 5.2;
$modversion['min_xoops']           = '2.5';
$modversion['min_tadtools']        = '1.20';

//---paypal資訊---//
$modversion['paypal']                  = array();
$modversion['paypal']['business']      = '作者@的Email';
$modversion['paypal']['item_name']     = 'Donation : ' . '贊助對象名稱';
$modversion['paypal']['amount']        = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---後台使用系統選單---//
$modversion['system_menu'] = 1;

//---模組資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
//$modversion['tables'][0] = '';

//---後台管理介面設定---//
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu']  = 'admin/menu.php';

//---前台主選單設定---//
$modversion['hasMain'] = 1;
//$modversion['sub'][1]['name'] = '';
//$modversion['sub'][1]['url'] = '';

//---模組自動功能---//
$modversion['onInstall']   = "include/onInstall.php";
$modversion['onUpdate']    = "include/onUpdate.php";
$modversion['onUninstall'] = "include/onUninstall.php";

//---樣板設定---//
$modversion['templates']                    = array();
$i                                          = 1;
$modversion['templates'][$i]['file']        = 'kyc_car_adm_main.tpl';
$modversion['templates'][$i]['description'] = '後台管理頁樣板';

$i++;
$modversion['templates'][$i]['file']        = 'index.tpl';
$modversion['templates'][$i]['description'] = '模組首頁樣板';

// $i++;
// $modversion['templates'][$i]['file']        = 'index_show_article.tpl';
// $modversion['templates'][$i]['description'] = '顯示單筆文章';

$i++;
$modversion['templates'][$i]['file']        = 'index_user.tpl';
$modversion['templates'][$i]['description'] = '使用者登錄';

$i++;
$modversion['templates'][$i]['file']        = 'j01_issue.tpl';
$modversion['templates'][$i]['description'] = '發佈文章';

$i++;
$modversion['templates'][$i]['file']        = 'j01_topic.tpl';
$modversion['templates'][$i]['description'] = '專題設定';

$i++;
$modversion['templates'][$i]['file']        = 'j01_picked.tpl';
$modversion['templates'][$i]['description'] = '精選管理';

$i++;
$modversion['templates'][$i]['file']        = 'j02_focus.tpl';
$modversion['templates'][$i]['description'] = '精選文章';

$i++;
$modversion['templates'][$i]['file']        = 'j02_point.tpl';
$modversion['templates'][$i]['description'] = '市景觀點';

$i++;
$modversion['templates'][$i]['file']        = 'j02_knowledge.tpl';
$modversion['templates'][$i]['description'] = '私房知識塾';

$i++;
$modversion['templates'][$i]['file']        = 'j02_list_article.tpl';
$modversion['templates'][$i]['description'] = '文章列表';

//---偏好設定---//
$modversion['config'] = array();
//$i=0;
//$modversion['config'][$i]['name']    = '偏好設定名稱（英文）';
//$modversion['config'][$i]['title']    = '偏好設定標題（常數）';
//$modversion['config'][$i]['description']    = '偏好設定說明（常數）';
//$modversion['config'][$i]['formtype']    = '輸入表單類型';
//$modversion['config'][$i]['valuetype']    = '輸入值類型';
//$modversion['config'][$i]['default']    = 預設值;
//
//$i++;

//---搜尋---//
//$modversion['hasSearch'] = 1;
//$modversion['search']['file'] = "include/search.php";
//$modversion['search']['func'] = "搜尋函數名稱";

//---區塊設定---//
//$modversion['blocks'] = array();
//$i=1;
//$modversion['blocks'][$i]['file'] = "區塊檔.php";
//$modversion['blocks'][$i]['name'] = 區塊名稱（常數）;
//$modversion['blocks'][$i]['description'] = 區塊說明（常數）;
//$modversion['blocks'][$i]['show_func'] = "執行區塊函數名稱";
//$modversion['blocks'][$i]['template'] = "區塊樣板.tpl";
//$modversion['blocks'][$i]['edit_func'] = "編輯區塊函數名稱";
//$modversion['blocks'][$i]['options'] = "設定值1|設定值2";
//
//$i++;

//---評論---//
//$modversion['hasComments'] = 1;
//$modversion['comments']['pageName'] = '單一頁面.php';
//$modversion['comments']['itemName'] = '主編號';

//---通知---//
//$modversion['hasNotification'] = 1;
