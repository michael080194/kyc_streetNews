<?php
/*-----------引入檔案區--------------*/
include_once "header.php";
$xoopsOption['template_main'] = "j01_topic.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";
$row = check_user($_SESSION["xoopsUserId"]);
$_SESSION["username"] = $row['uname'];
//顯示預設頁面內容
/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op   = system_CleanVars($_REQUEST, 'op', '', 'string');
$sn   = isset($_REQUEST['sn']) ? (int) $_REQUEST['sn'] : 0;

$error = '';

try
{
    switch ($op) {
        case 'add_topic':
            topic_form();
            break;
        case 'insert':
            $sn = insert_topic();
            header("location: j01_topic.php");
            exit;
        case 'update':
            update_topic($sn);
            header("location: j01_topic.php");
            exit;

        case 'modify_topic':
            //修改類別
            show_topic($sn);
            break;
        case 'delete_topic':
            //刪除類別
            delete_topic($sn);
            echo "sucess";
            exit;
        //預設動作
        default:
            $op = "list_topic";
            list_topic(); //$action_id
            break;
    }
} catch (exception $e) {
    xoops_error($e->getMessage(), '錯誤訊息');
    // redirect_header($_SERVER['PHP_SELF'], 3, $e->getMessage());
}
/*-----------秀出結果區--------------*/
$page_title = "專題設定";
$xoopsTpl->assign('op', $op);
$xoopsTpl->assign('error', $error);
$xoopsTpl->assign('isAdmin', $isAdmin);
$xoopsTpl->assign('page_title', $page_title);
$xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
include_once XOOPS_ROOT_PATH . '/footer.php';
/*************函數區**************/
function topic_form(){
    global $xoopsTpl;
    $data = array();
    $data['topic_title'] ="";
    $data['topic_description'] ="";
    $data['topic_type'] ="主題";
    $data['topic_status'] ="2";
    gen_ckeditor("");
    $xoopsTpl->assign('topic', $data);
    $xoopsTpl->assign('op1' , "insert");
    $xoopsTpl->assign('btn_cap' , "新增");
}

//儲存類別
function insert_topic()
{
    global $xoopsDB;
    $topic_title=clean_var('topic_title',  '類別(專題)名稱');
    $topic_type=clean_var('topic_type',  '類別(專題)名稱');
    $topic_description = $_POST['topic_description'];
    if ($topic_type == "類別") {
        $topic_description="";
    } else {
    // $topic_description=clean_var('topic_description',  '專題說明');
    }
    $topic_status      = $_POST['topic_status'];

    if ($topic_type == "類別") {
        $topic_status = '';
    }
    $tbl=$xoopsDB->prefix('0_street_topic');
    $sql = "INSERT INTO `$tbl` (`topic_title`, `topic_type`, `topic_description`, `topic_status`, `username`) VALUES ('{$topic_title}', '{$topic_type}', '{$topic_description}', '{$topic_status}' ,'{$_SESSION['username']}')";
    $xoopsDB->query($sql) or web_error($sql);
    $sn = $xoopsDB->getInsertId();
    upload_file_topic($sn);
    return $sn;
}
//刪除類別
function delete_topic($sn)
{
    global $xoopsDB;
    $tbl=$xoopsDB->prefix('0_street_topic');
    $sql = "DELETE FROM `$tbl` WHERE topic_sn='{$sn}'";
    $xoopsDB->query($sql) or web_error($sql);
}

//更新類別
function update_topic($sn)
{
    global $xoopsDB;
    $topic_title=clean_var('topic_title',  '類別(專題)名稱');
    $topic_type=clean_var('topic_type',  '類別(專題)名稱');
    $topic_description = $_POST['topic_description'];
    if ($topic_type == "類別") {
        // $topic_description="";
    } else {
    // $topic_description=clean_var('topic_description',  '專題說明');
    }
    $topic_status      = $_POST['topic_status'];

    if ($topic_type == "類別") {
        $topic_status = '';
    }

    $tbl=$xoopsDB->prefix('0_street_topic');
    $sql = "UPDATE `$tbl` SET `topic_title`='{$topic_title}', `topic_type`='{$topic_type}', `topic_description`='{$topic_description}',`topic_status`='{$topic_status}'  WHERE `topic_sn`='{$sn}' ";

    $xoopsDB->query($sql) or web_error($sql);
    upload_file_topic($sn);
}

//讀出單一類別
function show_topic($sn)
{
    global $xoopsDB, $xoopsTpl,$xoopsModule;
    require_once XOOPS_ROOT_PATH."/modules/kyc_streetNews/class/HTMLPurifier/HTMLPurifier.auto.php";
    $config   = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $tbl=$xoopsDB->prefix('0_street_topic');
    $sql  = "SELECT * FROM `{$tbl}` WHERE `topic_sn`='$sn'";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $data                      = $result->fetch_assoc();
    $data['topic_description'] = $purifier->purify($data['topic_description']);
    gen_ckeditor($data['topic_description']);
    $xoopsTpl->assign('topic', $data);
    $xoopsTpl->assign('op1' , "update");
    $xoopsTpl->assign('btn_cap' , "更新");
}

// function list_topic()
// {
//     global $xoopsDB, $xoopsTpl;
//     $tbl=$xoopsDB->prefix('0_street_topic');
//     $sql    = "SELECT * FROM `{$tbl}` ORDER BY `topic_sn` ";
//     $result = $xoopsDB->query($sql) or web_error($sql);
//     $all    = [];
//     $i      = 0;
//     while ($data = $xoopsDB->fetchArray($result)) {
//         $all[$i] = $data;
//         $i++;
//     }

//     list_topic_status();
//     $xoopsTpl->assign('all', $all);

// }
// //讀出所有TOPIC_status
// function list_topic_status()
// {
//     global $xoopsTpl;
//     //狀態值增刪記得修改TABLE值
//     $status = ['開始投稿', '當期', '一般', '關閉'];
//     $xoopsTpl->assign('topic_status', $status);

// }
