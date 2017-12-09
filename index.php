<?php
/*-----------引入檔案區--------------*/
include_once "header.php";
$xoopsOption['template_main'] = "index.tpl";
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
             show_article($sn , "have_next");
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
//顯示預設頁面內容
function list_article(){
    global $xoopsTpl, $xoopsDB, $isAdmin,$xoopsUser , $xoopsModule;
        $tbl=$xoopsDB->prefix('0_street_article');
        $where=$isAdmin?'':"WHERE  '1=1'";
        $sql="SELECT * FROM `{$tbl}` ORDER BY `update_time` DESC";
        $PageBar = getPageBar($sql, 10, 10);
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
            $article['img']  = XOOPS_URL."/uploads/kyc_streetNews/cover/thumb/thumb_".$article['sn'].".png";
            $article['img1']  = "../../uploads/kyc_streetNews/cover/thumb/thumb_".$article['sn'].".png";
            $article['sn']   = $myts->htmlSpecialChars($article['sn']);

            $article['title']   = $myts->htmlSpecialChars($article['title']);
            $article['content'] = $myts->displayTarea($article['content'], 1, 1, 1, 1, 0);
            $wkstr1  = mb_substr(strip_tags($article['content']), 0, 90);
            if (mb_strlen(strip_tags($article['content'])) > mb_strlen($wkstr1)) {
                $wkstr1 .= "<span style='color:red;font-size:0.6em;font-weight:900;'><<更多.......>></span>";
            }
            $article['summary'] = $wkstr1;
            $articles[]=$article;
        }
        // print_r($articles);die();
        $xoopsTpl->assign('articles', $articles);
}

