<?php
//引入TadTools的函式庫
if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/tad_function.php")) {
    redirect_header("http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50", 3, _TAD_NEED_TADTOOLS);
}
include_once XOOPS_ROOT_PATH . "/modules/tadtools/tad_function.php";

//其他自訂的共同的函數
//其他自訂的共同的函數
function clean_var($var = '', $title = '', $filter = '')
{
    $myts = MyTextSanitizer::getInstance();
    $var  = $myts->addSlashes($_REQUEST[$var]);

    if ($var == "" and !empty($title)) {
        throw new Exception("{$title}為必填！");
    }

    if ($filter) {
        $var = filter_var($var, $filter);
        if (!$var) {
            throw new Exception("不合法的{$title}");
        }
    }
    return $var;
}
################################
# 檢查帳號、密碼是否正確
# 正確返回 uid
# 不正確返回 空
#################################
function check_user($uid=""){
  global $xoopsDB;
  if(!$uid)return;
  $sql="select *
        from ".$xoopsDB->prefix("users")."
        where uid = '{$uid}' ";//die($sql);
  $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());
  $row = $xoopsDB->fetchArray($result);
  return $row;
}
function list_topic(){
    global $xoopsDB, $xoopsTpl;
    $tbl=$xoopsDB->prefix('0_street_topic');
    $sql    = "SELECT * FROM `$tbl` ORDER BY `topic_sn` ";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $all    = array();
    $i      = 0;
    while ($data = $xoopsDB->fetchArray($result)) {
        $all[$i] = $data;
        $all[$i]['img']  = XOOPS_URL."/uploads/kyc_streetNews/topic/thumb/thumb_".$all[$i]['topic_sn'].".png";
        $all[$i]['img1']  = "../../uploads/kyc_streetNews/topic/thumb/thumb_".$all[$i]['topic_sn'].".png";
        $i++;
    }

    $status = ['開始投稿', '當期', '一般', '關閉'];
    $xoopsTpl->assign('topic_status', $status);
    $xoopsTpl->assign('all', $all);
}
function upload_file_kyc($sn){
    global $xoopsDB,$xoopsUser;
    if (isset($_FILES)) {
        $coverPath="../../uploads/kyc_streetNews/cover/";
        $thumbPath="../../uploads/kyc_streetNews/cover/thumb/";
        require_once XOOPS_ROOT_PATH."/modules/tadtools/upload/class.upload.php";
        $foo = new Upload($_FILES['pic']);
        if ($foo->uploaded) {
            $foo->file_new_name_body = 'cover_' . $sn;
            $foo->image_resize       = true;
            $foo->image_convert      = png;
            $foo->image_x            = 1200;
            $foo->image_ratio_y      = true;
            $foo->Process($coverPath);
            if ($foo->processed) {
                $foo->file_new_name_body = 'thumb_' . $sn;
                $foo->image_resize       = true;
                $foo->image_convert      = png;
                $foo->image_x            = 400;
                $foo->image_ratio_y      = true;
                $foo->Process($thumbPath);
            }
        }
    }

}
function upload_file_topic($sn){
    global $xoopsDB,$xoopsUser;
    if (isset($_FILES)) {
        $coverPath="../../uploads/kyc_streetNews/topic/";
        $thumbPath="../../uploads/kyc_streetNews/topic/thumb/";
        require_once XOOPS_ROOT_PATH."/modules/tadtools/upload/class.upload.php";
        $foo = new Upload($_FILES['pic']);
        if ($foo->uploaded) {
            $foo->file_new_name_body = 'cover_' . $sn;
            $foo->image_resize       = true;
            $foo->image_convert      = png;
            $foo->image_x            = 1200;
            $foo->image_ratio_y      = true;
            $foo->Process($coverPath);
            if ($foo->processed) {
                $foo->file_new_name_body = 'thumb_' . $sn;
                $foo->image_resize       = true;
                $foo->image_convert      = png;
                $foo->image_x            = 400;
                $foo->image_ratio_y      = true;
                $foo->Process($thumbPath);
            }
        }
    }

}
#####################################################################################
#  建立目錄
#####################################################################################
if (!function_exists("mk_dir")) {
  function mk_dir($dir = "") {
    #若無目錄名稱秀出警告訊息
    if (empty($dir)) {
      return;
    }

    #若目錄不存在的話建立目錄
    if (!is_dir($dir)) {
      umask(000);
      //若建立失敗秀出警告訊息
      mkdir($dir, 0777);
    }
  }
}
//顯示預設頁面內容
function show_article($sn , $have_next=""){
     global $xoopsTpl, $xoopsDB;
     require_once XOOPS_ROOT_PATH."/modules/kyc_streetNews/class/HTMLPurifier/HTMLPurifier.auto.php";
     $config   = HTMLPurifier_Config::createDefault();
     $purifier = new HTMLPurifier($config);

     $tbl=$xoopsDB->prefix('0_street_article');

     $sql="SELECT * FROM `{$tbl}` WHERE `sn` = '{$sn}'";
     //送至資料庫
     $result = $xoopsDB->query($sql) or web_error($sql);
     //取回資料
     $article=$xoopsDB->fetchArray($result);
     $myts              = MyTextSanitizer::getInstance();
     $article['title']   = $myts->htmlSpecialChars($article['title']);
     $article['topic_sn']   = $myts->htmlSpecialChars($article['topic_sn']);
     $article['sort']   = $myts->htmlSpecialChars($article['sort']);
     $article['sn']   = $myts->htmlSpecialChars($article['sn']);
     $article['focus']   = $article['focus'];
     // $article['content'] = $myts->displayTarea($article['content'], 1, 1, 1, 1, 0);
     $article['content'] = $purifier->purify($article['content']);
     gen_ckeditor($article['content']);
     $xoopsTpl->assign('article', $article);

     if($have_next != ""){
         //上一筆
         $sql = "SELECT * FROM `{$tbl}` WHERE `update_time` > '{$article['update_time']}' ORDER BY `update_time` LIMIT 0,1";
         $result = $xoopsDB->query($sql) or web_error($sql);
         $previous = $xoopsDB->fetchArray($result);
         $previous['title'] = mb_substr($previous['title'], 0, 16) . '...';
         $xoopsTpl->assign('previous', $previous);

         //下一筆
         $sql = "SELECT * FROM `{$tbl}` WHERE `update_time` < '{$article['update_time']}' ORDER BY `update_time` DESC LIMIT 0,1";
         $result = $xoopsDB->query($sql) or web_error($sql);
         $next = $xoopsDB->fetchArray($result);
         $next['title'] = mb_substr($next['title'], 0, 16) . '...';
         $xoopsTpl->assign('next', $next);
     }

}
function gen_ckeditor($content){
    global $xoopsTpl;
    // $topic_description="";
    require_once XOOPS_ROOT_PATH."/modules/tadtools/ck.php";
    $fck=new CKEditor("kyc_streetNews","content",$content);
    $fck->setHeight(350);
    $editor=$fck->render();
    $xoopsTpl->assign('editor' , $editor);
}
