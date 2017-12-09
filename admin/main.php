<?php
// require_once '../../../include/cp_header.php';
// include_once 'header.php';
// include_once XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar("dirname") . "/class/admin.php";
/*-----------引入檔案區--------------*/
include_once("../xoops_version.php");
// echo '<script type="text/javascript">alert("a1=' . $a1 . '")</script>';
$xoopsOption['template_main'] = "kyc_signup_adm_main.tpl";
include_once "header.php";
include_once "../function.php";

/*-----------function區--------------*/

//顯示預設頁面內容
function show_content()
{
    global $xoopsTpl;
    include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
    $val['comp_id'] = "";
    $val['fact_id'] = "";
    $val['big_serial'] = "";
    $val['big_enable'] = "0";
    $form = new XoopsThemeForm('手機註冊','myForm', 'main.php', 'post', true , '摘要(手機新增)');

    $Text=new XoopsFormText('公司別', 'comp_id', 255 , 255 , $val['comp_id']);
    $form->addElement($Text, true);
    $Text=new XoopsFormText('廠別', 'fact_id', 255 , 255 , $val['fact_id']);
    $form->addElement($Text, true);
    $Text=new XoopsFormText('手機序號', 'big_serial', 255 , 255 , $val['big_serial']);
    $form->addElement($Text);


    $form->addElement(new XoopsFormRadioYN('是否啟用', 'big_enable', $val['list_topicbig_enable']), true);
    $Tray=new XoopsFormElementTray('', '&nbsp;', 'name');
    $Tray->addElement(new XoopsFormHidden('op', 'insert_phone'));
    $Tray->addElement(new XoopsFormButton('', 'name', '送出', 'submit'));
    $Tray->addElement(new XoopsFormButton('', 'name', '清除', 'reset'));
    $form->addElement($Tray);

    $phone_form=$form->render();
    $xoopsTpl->assign('content', $phone_form);
}

function insert_phone(){
    global $xoopsDB, $xoopsUser;
    // data filter
    $comp_id=clean_var('comp_id',  '公司別');
    $fact_id=clean_var('fact_id' , '廠別');
    $big_serial=clean_var('big_serial');
    $big_enable=clean_var('big_enable', '是否啟用');
    //寫SQL
    $tbl=$xoopsDB->prefix('0_street_phone');
    $sql = "INSERT INTO `$tbl`
    ( `comp_id`, `fact_id`, `big_serial`,  `big_enable`)
    VALUES ('{$comp_id}', '{$fact_id}', '{$big_serial}',  '{$big_enable}')";

    //送至資料庫
    $xoopsDB->query($sql) or web_error($sql);
    //取得流水號
    $id = $xoopsDB->getInsertId();
    return $id;


}
/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
try
{
  switch ($op) {
     case "insert_phone":
     $id = insert_phone();
     // header("location:../index.php?id=".$id);
     header("location:{$_SERVER['PHP_SELF']}");
     exit;

     default:
         show_content();
         break;
  }
} catch (exception $e) {
    xoops_error($e->getMessage(), '錯誤訊息');
    // redirect_header($_SERVER['PHP_SELF'], 3, $e->getMessage());
}

include_once 'footer.php';
