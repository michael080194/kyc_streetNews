<{* debug *}>
<!--<script src="<{$xoops_url}>/ckeditor/ckeditor.js"></script> -->
<h2 class="my-1 text-center"><{$page_title}></h2>
<form action="j01_issue.php" method="post" enctype="multipart/form-data" class="my-4" id="myform">
    <div class="form-group">類別/主題，請擇一
        <select name="sel_topic_sn">
    　      <{foreach from=$all item=topic}>
              <option value=<{$topic.topic_sn}>
                <{if $topic.topic_sn==$article.topic_sn}>
                     selected="selected"
                <{/if}>>
                <{$topic.topic_type}>-<{$topic.topic_title}>
              </option>
            <{foreachelse}>
                <option value="">請建立類別</option>
            <{/foreach}>
        </select>
    </div>
    <div class="form-group">
        <label for="title" class="col-form-label sr-only">文章標題</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="請輸入文章標題"  value="<{$article.title}>">
    </div>

    <div class="form-group">
      <label class="control-label" for="content">文章內容</label>
      <div class="controls">
        <{$editor}>
      </div>
    </div>

    <div class="row">
    <div class="form-group  col-sm-2">
        <label for="sort" class="col-form-label sr-only">文章排序</label>
        <input type="number" class="form-control" name="sort" id="sort" placeholder="文章排序數字"  value="<{$article.sort}>">
    </div>

    <div class="form-group  col-sm-2">
        <input type="checkbox" name="focus" id="focus"
        <{if $article.focus == 1}>
        checked="checked"
        <{/if}>
        >文章精選
    </div>

    <div class="form-group  col-sm-6">
        <label for="pic" class="col-form-label sr-only">封面圖</label>
        <input type="file" class="form-control" name="pic" id="pic" placeholder="請上傳一張封面圖">
    </div>
    <div class="text-center  col-sm-1">
        <input type="hidden" name="sn" value="<{$article.sn}>">
        <input type="hidden" name="op" value="<{$op1}>">
        <input type="hidden" name="username" value="<{$smarty.session.username}>">
        <button type="submit" class="btn btn-primary"><{$btn_cap}></button>
    </div>
    </div>
</form>

<script>

</script>