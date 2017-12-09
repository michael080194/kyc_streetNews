<{$toolbar}>
<{if $op=="list_article"}>
  <h2>文章列表<small>（共 <{$total}> 篇文章）</small></h2>
  <table class="table table-bordered table-hover table-striped">
    <tr>
      <th>文章標題</th>
      <th>建立時間</th>
      <th>更新時間</th>
      <th>功能</th>
    </tr>
    <{foreach from=$articles item=article}>
      <tr>
        <td><a href="index.php?sn=<{$article.sn}>"><{$article.title}></a></td>
        <td><{$article.create_time}></td>
        <td><{$article.update_time}></td>
        <td>
          <{if $isAdmin}>
            <a href="j01_issue.php?sn=<{$article.sn}>" class="btn btn-warning btn-xs">編輯</a>
          <{/if}>

          <a href="index.php?sn=<{$article.sn}>" class="btn btn-info btn-xs" role="button">詳情</a>
          <{if $isAdmin}>
          <a href="javascript:delete_article(<{$article.sn}>)" class="btn btn-danger btn-xs">刪除</a>
          <{/if}>
        </td>
      </tr>
    <{/foreach}>
  </table>
  <{$bar}>
<{/if}>


<{if $op=="show_article"}>
  <h2><{$article.title}></h2>

  <div class="panel panel-primary">
    <div class="panel-body">
      <{$article.content}>
    </div>
  </div>
<{/if}>