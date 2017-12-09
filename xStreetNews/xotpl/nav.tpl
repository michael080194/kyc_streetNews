
<!-- <{debug}> -->
<!-- <{assign var="m_path"  value="/modules/kyc_streetNews/"}> -->
<!-- <{$xoops_url}><{$m_path}> -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
          <img alt="Brand" src="images/logo_nav.png" class="img-fluid">
      </a>
    <!-- </div> -->
    <ul class="nav navbar-nav">
      <li class="active"><a href="<{$xoops_url}><{$m_path}>index.php">首頁</a></li>
      <li><a href="j02_focus.php">精選文章</a></li>
      <li><a href="index.php">街巷故事</a></li>
      <li><a href="#">市井觀點</a></li>
      <li><a href="j02_knowledge.php">私房知識塾</a></li>
    </ul>

    <form action="search.php" method="GET" class="navbar-form navbar-left">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>

    <ul class="nav navbar-nav navbar-right">
      <{if $xoops_isadmin}>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">管理介面<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="j01_issue.php?op=add_article">發布文章</a></li>
          <li><a href="j01_picked.php">精選管理</a></li>
          <li><a href="j01_topic.php">專題設定</a></li>
          <li><a href="<{$xoops_url}>/modules/kyc_streetNews/admin/index.php">後台管理</a></li>
          <li><a href="<{$xoops_url}>/admin.php">XOOPS</a></li>
        </ul>
      </li>
      <{/if}>
      <{if $xoops_isuser}>
      <li><a href="<{$xoops_url}>/user.php?op=logout"><span class="glyphicon glyphicon-log-in"></span>登出</a></li>
      <{else}>
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> 註冊</a></li>
      <li><a href="<{$xoops_url}>/modules/kyc_streetNews/index_user.php"><span class="glyphicon glyphicon-log-in"></span>登入</a></li>
      <{/if}>

    </ul>

  </div>
</nav>
