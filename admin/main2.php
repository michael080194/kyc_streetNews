<?php
/*-----------引入檔案區--------------*/
include_once("../xoops_version.php");
$a1 = $modversion['templates'][1]['file'] ;
$xoopsOption['template_main'] = "kyc_signup_adm_main.tpl";
include_once "header.php";
include_once "../function.php";

$op     = isset($_REQUEST['op']) ? htmlspecialchars($_REQUEST['op'], ENT_QUOTES) : '';
$sql_op = isset($_REQUEST['sql_op']) ? htmlspecialchars($_REQUEST['sql_op'], ENT_QUOTES) : '';
$g2p = isset($_REQUEST['g2p']) ? intval($_REQUEST['g2p']) : 1; // 查詢時頁次控制
$error = $content = '';
/*-----------function區--------------*/

//顯示預設頁面內容
function show_content()
{
    global $xoopsDB, $xoopsUser , $xoopsTpl;
    $tbl=$xoopsDB->prefix('0_street_phone');
    $sql = "SELECT * FROM `{$tbl}`";

    // getPageBar($sql, $xoopsModuleConfig['display_amount'], 10);
    // $bar     = $PageBar['bar'];
    // $sql     = $PageBar['sql'];
    // $total   = $PageBar['total'];

    $result  = $xoopsDB->query($sql);

    if (!$result) {
        web_error($sql);
    }
    $users = array();
    while ($values = $result->fetch_assoc()) {
        $users[] = $values;
    }

    $xoopsTpl->assign('users', $users);
    // $xoopsTpl->assign('bar', $bar);
    // $xoopsTpl->assign('every_page', _EVERY_PAGE);
    // $xoopsTpl->assign('total', $total);

}
/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
try
{
  switch ($op) {
     default:
         show_content();
         break;
  }
} catch (exception $e) {
    xoops_error($e->getMessage(), '錯誤訊息');
    // redirect_header($_SERVER['PHP_SELF'], 3, $e->getMessage());
}

include_once 'footer.php';
