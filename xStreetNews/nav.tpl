<nav class="navbar navbar-default navbar-static-bottom" role="navigation" style="background-color:#dbefff;">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <a accesskey="U" href="#xoops_theme_nav_key" title="上方導覽工具列" id="xoops_theme_nav_key" style="color: transparent; font-size: 10px;">:::</a>
        <ul class="nav navbar-nav" id="main-menu-left">
            <li><a href="<{$xoops_url}>/index.php" style="color:#3b3b3b">回首頁</a></li>
        <{if $xoops_isuser}>
          <li>
           <a class="dropdown-toggle" data-toggle="dropdown"  href="" target="_self">
           <i class="fa "></i> 維修管理  <span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="<{$xoops_url}>/modules/kyc_car/j01_inq_car.php?op=inq_car" target="_self"> <i class="fa "></i>車籍查詢</a></li>
                <li><a href="<{$xoops_url}>/modules/kyc_car/j05_trans_data" target="_self"> <i class="fa "></i>轉入資料</a></li>

                  <li><a href="index_1.php?op=inq_mstock" target="_self">
                  <i class="fa "></i>零件查詢</a></li>

                  <li><a  href="index_1.php?op=trans_data" target="_self">
                  <i class="fa "></i>轉入資料</a></li>
                  <{if $xoops_isadmin}>
                    <li><a  href="index_1.php?op=trans_data" target="_self">
                    <i class="fa "></i>系統管理</a></li>
                  <{/if}>
                  <li><a  href="<{$xoops_url}>/user.php?op=logout" target="_self">
                  <i class="fa "></i>登出</a></li>
               </ul>
           </li>
         <{else}>
         <li>
           <a class="dropdown-toggle" data-toggle="dropdown"  href="" target="_self">
           <i class="fa "></i> 登入  <span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="<{$xoops_url}>/modules/kyc_car/index_user.php" target="_self"> <i class="fa "></i>登入</a></li>
               </ul>
           </li>
         <{/if}>
</nav>
