<?php
/*-----------引入檔案區--------------*/
include_once "header.php";
$xoopsOption['template_main'] = "j01_issue.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";
$row = check_user($_SESSION["xoopsUserId"]);
$_SESSION["username"] = $row['uname'];
$table_name = $tbl=$xoopsDB->prefix("0_street_article");
//顯示預設頁面內容
/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op   = system_CleanVars($_REQUEST, 'op', '', 'string');
$sn   = isset($_REQUEST['sn']) ? (int) $_REQUEST['sn'] : 0;

$error = '';
try
{
    switch ($op) {
        case 'insert':
            $sn = insert_article();
            header("location: index.php?sn={$sn}");
            break;
        case 'update':
            update_article($sn);
            header("location: index.php?sn={$sn}");
            exit;
        case "modify_article":
            list_topic();
            show_article($sn , "");
            $xoopsTpl->assign('op1' , "update");
            $xoopsTpl->assign('btn_cap' , "更新");
            break;
        case 'delete_article':
            delete_article($sn);
            header("location: index.php");
            exit;
        case "add_article":
            article_form();
            break;
        case 'add_focus':
            add_focus($sn);
            header("location: index.php?sn={$sn}");
            exit;
        case 'remove_focus':
            remove_focus($sn);
            header("location: index.php?sn={$sn}");
            exit;
        default:
            break;
    }
} catch (exception $e) {
    xoops_error($e->getMessage(), '錯誤訊息');
    // redirect_header($_SERVER['PHP_SELF'], 3, $e->getMessage());
}
/*-----------秀出結果區--------------*/
$page_title = "文章發佈";
$xoopsTpl->assign('op', $op);
$xoopsTpl->assign('error', $error);
$xoopsTpl->assign('isAdmin', $isAdmin);
$xoopsTpl->assign('page_title', $page_title);
$xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
include_once XOOPS_ROOT_PATH . '/footer.php';
/*************函數區**************/
function article_form(){
    global $xoopsTpl;
    list_topic();
    $data = array();
    $data['title'] ="";
    $data['sn'] = 0;
    $data['topic_sn'] = 0;
    $data['sort'] = 50;
    $data['focus'] = 0;
    gen_ckeditor("");
    $xoopsTpl->assign('article', $data);
    // $xoopsTpl->assign('topic', $data);
    $xoopsTpl->assign('op1' , "insert");
    $xoopsTpl->assign('btn_cap' , "新增");
}
//儲存文章
function insert_article(){
    global $xoopsDB;
    $title=clean_var('title',  '文章標題');
    $content=clean_var('content',  '文章內容');
    $username=clean_var('username',  '使用者');
    $topic_sn = clean_var('sel_topic_sn',  '文章類別');
    $sort = clean_var('sort',  '文章排列順序');
    $focus = $_POST['focus'];
    if ($focus == "on") {
       $focus = 1 ;
    }else{
       $focus = 0 ;
    }
    $tbl=$xoopsDB->prefix('0_street_article');
    $sql      = "INSERT INTO `$tbl` (`title`, `content`, `username`,`create_time`, `update_time`,`topic_sn`,`sort`,`focus`) VALUES ('{$title}', '{$content}','{$username}', NOW(), NOW(),'{$topic_sn}','{$sort}','{$focus}')";
    $xoopsDB->query($sql) or web_error($sql);
    //取得流水號
    $sn = $xoopsDB->getInsertId();
    upload_file_kyc($sn);
    return $sn;
}

//更新文章
function update_article($sn)
{
    // echo '<script type="text/javascript">alert("sn=' . $sn . '")</script>';
    global $xoopsDB , $table_name ;
    $title=clean_var('title',  '文章標題');
    $content=clean_var('content',  '文章內容');
    $username=clean_var('username',  '使用者');
    $topic_sn = clean_var('sel_topic_sn',  '文章類別');
    $sort = clean_var('sort',  '文章排列順序');
    $focus = clean_var('focus',  '');
    if ($focus == "on") {
       $focus = 1 ;
    }else{
       $focus = 0 ;
    }
    // echo '<script type="text/javascript">alert("focus=' . $_POST['focus'] . '")</script>';
    // die($sn);
    $sql = "update `$table_name` Set `title`='{$title}', `content`= '{$content}',`update_time`=NOW() ,`topic_sn` ='{$topic_sn}' ,`sort` ='{$sort}' ,`focus` ='{$focus} 'WHERE sn='{$sn}' ";

    $xoopsDB->queryF($sql) or web_error($sql);

    upload_file_kyc($sn);

    return $sn;
}

function delete_article($sn){
    global $xoopsDB , $table_name ;
    $sql = "DELETE FROM `$table_name` WHERE sn='{$sn}'";
    $xoopsDB->queryF($sql) or web_error($sql);
}


//將文章加入精選，focus欄位變為 1
function add_focus($sn){
    global $xoopsDB ;
    $tbl=$xoopsDB->prefix('0_street_article');
    $sql = "UPDATE `$tbl` SET `focus` = '1' WHERE `sn` ='{$sn}'";
    $xoopsDB->queryF($sql) or web_error($sql);
    return $sn;
}

//將文章移除精選，focus欄位變回 0
function remove_focus($sn){
    global $xoopsDB ;
    $tbl=$xoopsDB->prefix('0_street_article');
    $sql = "UPDATE `$tbl` SET `focus`='0' WHERE `sn`='{$sn}'";
    $xoopsDB->queryF($sql) or web_error($sql);

    return $sn;
}

