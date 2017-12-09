<?php
/*-----------引入檔案區--------------*/
include_once "header.php";
$xoopsOption['template_main'] = "j02_knowledge.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";
/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', 0, 'int');

$searchTitle = system_CleanVars($_REQUEST, 'searchTitle', '', 'string');
$searchBdate = system_CleanVars($_REQUEST, 'searchBdate', '', 'string');
$searchEdate = system_CleanVars($_REQUEST, 'searchEdate', '', 'string');
$table_name = $tbl=$xoopsDB->prefix("0_street_article");
try
{
   switch ($op) {
     default:
         if ($sn) {
             show_article($sn);
             $op = 'show_class';
         } else {
             $op = "list_class";
             list_class($searchTitle, $searchBdate, $searchEdate);
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

function list_class($searchTitle = "", $searchBdate = "", $searchEdate = ""){
    global $xoopsTpl, $xoopsDB, $isAdmin , $table_name;

        $where = "WHERE  `topic_sn`='2' ";
        if ($searchTitle != "") {
            $where .= "and  `title` Like '%$searchTitle%' ";
        }

        if ($searchBdate != "") {
            $where .= "and  `create_time` >= '$searchBdate' ";
        }

        if ($searchEdate != "") {
            $temDate = $searchEdate . " 23:59:59";
            $where .= "and  `create_time` <= '$temDate' ";
        }

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
            // 從資料庫 日期欄位 抓出來 內容為 2017-12-04 05:49:29
            $wk1                    = strtotime($all[$i]['create_time']); //
            $weekDayNum             = date('w', $wk1); // 得到數字的星期幾 如 1
            $weekday                = '週' . ['日', '一', '二', '三', '四', '五', '六'][$weekDayNum]; // 轉換成中文
            $wkdate                 = date('Y.m.d', $wk1); // 得到 2017.12.04
            $all[$i]['create_time'] = $wkdate . "(" . $weekday . ")";
            $all[$i]['img']  = XOOPS_URL."/uploads/kyc_streetNews/cover/thumb/thumb_".$all[$i]['sn'].".png";
            $all[$i]['img1']  = "../../uploads/kyc_streetNews/cover/thumb/thumb_".$all[$i]['sn'].".png";
            $i++;
        }
// print_r($all);die();
        $search          = array();
        $search['title'] = $searchTitle;
        $search['bdate'] = $searchBdate;
        $search['edate'] = $searchEdate;

        $xoopsTpl->assign('articles', $all);
        $xoopsTpl->assign('search', $search);
}
