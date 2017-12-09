<div class="container-fluid">
  <{$content}>
   <{if isset($users) }>
    <h2>查詢筆數<small>（共 <{$total}> 筆）</small></h2>
    <table class="table table-bordered table-hover table-striped">
      <thead>
        <tr>
          <th>公司別</th>
          <th>廠別</th>
          <th>手機序號</th>
          <th>手機啟用</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
          <{foreach from=$users item=user}>
            <tr>
              <td> <{$user.comp_id}> </td>
              <td> <{$user.fact_id}> </td>
              <td> <{$user.big_serial}> </td>
              <td> <{$user.big_enable}> </td>
              <td>
                 <a href="user.php?op=user_form&id={$user.id}" class="btn btn-warning btn-xs">編輯</a>
                 <a href="javascript:delete_user({$user.id})" class="btn btn-danger btn-xs">刪除</a>
              </td>
            </tr>
          <{/foreach}>
      </tbody>
    </table>
  <{/if}>
</div>
