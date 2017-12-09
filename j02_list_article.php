<?php
/*-----------引入檔案區--------------*/
include_once "header.php";
$xoopsOption['template_main'] = "j02_list_article.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', 0, 'int');
try
{
   switch ($op) {
     default:
         if($sn){
             show_article($sn);
             $op='show_article';
         }else{
             list_article();
             $op='list_article';
         }
         break;
    }
} catch (exception $e) {
    xoops_error($e->getMessage(), '錯誤訊息');
    // redirect_header($_SERVER['PHP_SELF'], 3, $e->getMessage());
}
/*-----------秀出結果區--------------*/
$xoopsTpl->assign('isAdmin', $isAdmin);
$xoopsTpl->assign('op', $op);
// $xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
include_once XOOPS_ROOT_PATH . '/footer.php';
/*-----------function區--------------*/

function list_article(){
    global $xoopsTpl, $xoopsDB, $isAdmin;
        $tbl=$xoopsDB->prefix('article');
        $where=$isAdmin?'':"WHERE  '1'";
        $sql="SELECT * FROM `{$tbl}` $where ORDER BY `update_time` DESC";

        $PageBar = getPageBar($sql, 2, 10);
        $bar     = $PageBar['bar'];
        $sql     = $PageBar['sql'];
        $total   = $PageBar['total'];
        $xoopsTpl->assign('bar', $bar);
        $xoopsTpl->assign('total', $total);

        //送至資料庫
        $result = $xoopsDB->query($sql) or web_error($sql);
                //取回資料
        $articles=[];
        $myts              = MyTextSanitizer::getInstance();
        while($article=$xoopsDB->fetchArray($result)){
            $article['title']   = $myts->htmlSpecialChars($article['title']);
            $article['content'] = $myts->displayTarea($article['content'], 1, 1, 1, 1, 0);
            $articles[]=$article;
        }
        // print_r($articles) ; die();
        $xoopsTpl->assign('articles', $articles);
        include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
        $sweet_alert = new sweet_alert();
        $sweet_alert->render("delete_article", "index.php?op=delete_article&sn=", 'sn');
}

//顯示預設頁面內容
function show_article($sn){
     global $xoopsTpl, $xoopsDB;

     $tbl=$xoopsDB->prefix('article');

     $sql="SELECT * FROM `{$tbl}` WHERE `sn` = '{$sn}'";
     //送至資料庫
     $result = $xoopsDB->query($sql) or web_error($sql);
     //取回資料
     $article=$xoopsDB->fetchArray($result);
     $myts              = MyTextSanitizer::getInstance();
     $article['title']   = $myts->htmlSpecialChars($article['title']);
     $article['content'] = $myts->displayTarea($article['content'], 1, 1, 1, 1, 0);
     $xoopsTpl->assign('article', $article);

}
