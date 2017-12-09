<?php
//載入XOOPS主設定檔（必要）
include_once "../../mainfile.php";
//載入自訂的共同函數檔
include_once "function.php";
//載入工具選單設定檔（亦可將 interface_menu.php 的內容複製到此檔下方，並刪除 interface_menu.php）
include_once "interface_menu.php";
$op     = isset($_REQUEST['op']) ? htmlspecialchars($_REQUEST['op'], ENT_QUOTES) : '';
// $sql_op = isset($_REQUEST['sql_op']) ? htmlspecialchars($_REQUEST['sql_op'], ENT_QUOTES) : '';
// $g2p = isset($_REQUEST['g2p']) ? intval($_REQUEST['g2p']) : 1; // 查詢時頁次控制
// $error = $content = '';
