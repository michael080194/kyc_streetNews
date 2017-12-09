<?php

function xoops_module_install_kyc_car(&$module) {
  mk_dir(XOOPS_ROOT_PATH."/uploads/kyc_streetNews");
  mk_dir(XOOPS_ROOT_PATH."/uploads/kyc_streetNews/topic");
  mk_dir(XOOPS_ROOT_PATH."/uploads/kyc_streetNews/topic/thumb");
  mk_dir(XOOPS_ROOT_PATH."/uploads/kyc_streetNews/cover");
  mk_dir(XOOPS_ROOT_PATH."/uploads/kyc_streetNews/cover/thumb");
  return true;
}

//建立目錄
function mk_dir($dir=""){
  //若無目錄名稱秀出警告訊息
  if(empty($dir))return;
  //若目錄不存在的話建立目錄
  if (!is_dir($dir)) {
  umask(000);
  //若建立失敗秀出警告訊息
  mkdir($dir, 0777);
  }
}

?>
