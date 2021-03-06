<?php
/*-----------引入檔案區--------------*/
include_once "header.php";
$xoopsOption['template_main'] = "j02_focus.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";
/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', 0, 'int');
$table_name = $tbl=$xoopsDB->prefix("0_street_article");
try
{
   switch ($op) {
     default:
         if($sn){
             show_article($sn);
             $op='show_focus';
         }else{
             list_focus();
             $op='list_focus';
         }
         break;
    }
} catch (exception $e) {
    xoops_error($e->getMessage(), '錯誤訊息');
    // redirect_header($_SERVER['PHP_SELF'], 3, $e->getMessage());
}
$xoopsTpl->assign('isAdmin', $isAdmin);
$xoopsTpl->assign('op', $op);
// $xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
include_once XOOPS_ROOT_PATH . '/footer.php';

function list_focus(){
    global $xoopsTpl, $xoopsDB, $isAdmin , $table_name;

        $where="WHERE  `focus`='1' ";
        $sql="SELECT * FROM `{$table_name}` $where ORDER BY `update_time` DESC";
        $PageBar = getPageBar($sql, 10, 10);
        $bar     = $PageBar['bar'];
        $sql     = $PageBar['sql'];
        $total   = $PageBar['total'];
        $xoopsTpl->assign('bar', $bar);
        $xoopsTpl->assign('total', $total);

        //送至資料庫
        $result = $xoopsDB->query($sql) or web_error($sql);
                //取回資料
        $all = array();
        $i   = 0;
        $myts              = MyTextSanitizer::getInstance();
        while($article=$xoopsDB->fetchArray($result)){
            $all[$i] = $article;
            $all[$i]['title']   = $myts->htmlSpecialChars($article['title']);
            $all[$i]['content'] = $myts->displayTarea($article['content'], 1, 1, 1, 1, 0);
            $wkstr1  = mb_substr(strip_tags($article['content']), 0, 90);
            if (mb_strlen(strip_tags($article['content'])) > mb_strlen($wkstr1)) {
                $wkstr1 .= "<span style='color:red;font-size:0.6em;font-weight:900;'><詳全文></span>";
            }
            $all[$i]['summary'] = $wkstr1;
            $all['img']  = XOOPS_URL."/uploads/kyc_streetNews/cover/thumb/thumb_".$all['sn'].".png";
            $all['img1']  = "../../uploads/kyc_streetNews/cover/thumb/thumb_".$all['sn'].".png";
            $i++;
        }
        $xoopsTpl->assign('articles', $all);
}

