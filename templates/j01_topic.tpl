<{* debug *}>
<script src="<{$xoops_url}>/modules/tadtools/ckeditor/ckeditor.js"></script>
<div class="row">
    <div class="loding  col-sm-2 ml-sm-auto mr-sm-auto">
        <img src="images/ajax-loader2.gif" style="display: none" />
    </div>
</div>
<h2 class="my-1 text-center"><{$page_title}></h2>
<{if $op=="list_topic"}>
    <table  id = "myTable"  class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="info">
                <th>縮圖</th>
                <th>類別編號</th>
                <th>類別或專題名稱</th>
                <th>種類</th>
                <th>說明</th>
                <th>專題狀態</th>
                <th><a href="j01_topic.php?op=add_topic" class="btn btn-primary">新增</a></th>
            </tr>
        </thead>
        <tbody>
            <{foreach from=$all item=topic}>
            <tr>
                <td>
                <{if file_exists($topic.img1)}>
                    <img src="<{$topic.img}>" alt="<{$topic.title}>" class="rounded cover img-responsive"  style="width:80px;">
                <{else}>
                <{if $topic.topic_type == "主題"}>
                <img src="" alt="未建圖片" class="rounded cover img-responsive"  style="width:80px;">
                <{/if}>
                <{/if}>
                </td>
                <td>
                    <{$topic.topic_sn}>
                </td>
                <td><{$topic.topic_title}></td>
                <td><{$topic.topic_type}></td>
                <td><{$topic.topic_description}></td>
                <td>
                    <{if $topic.topic_status != ""}>
                     <{  $topic_status[$topic.topic_status]  }>
                    <{/if}>
                </td>
                <{if isset($smarty.session.username) }>
                <td>
                    <a href="j01_topic.php?op=modify_topic&sn=<{$topic.topic_sn}>" class="btn btn-warning">編輯</a>
                    <a href="javascript:void(0)" class="del1 btn btn-danger" sn="<{$topic.topic_sn}>" sn-msg="<{$topic.topic_title}>">刪除</a>
                </td>
                <{else}>
                <td colspan=3></td>
                <{/if}>

            </tr>
            <{foreachelse}>
            <tr>
                <td colspan=7>暫無資料</td>
            </tr>
            <{/foreach}>

        </tbody>
    </table>
<{/if}>

<{if $op=="add_topic" || $op=="modify_topic" }>
    <form action="j01_topic.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="topic_title" class="col-form-label sr-only">類別或主題名稱</label>
            <input type="text" class="form-control validate[required]"
            name="topic_title" id="topic_title" placeholder="類別或主題名稱"
             value="<{$topic.topic_title}>">
        </div>

        <div class="form-group">請擇一
            <select name="topic_type">
             <{if $topic.topic_type=="類別" }>
　               <option value="類別" selected="selected">類別</option>
                 <option value="主題" >主題</option>
             <{else}>
                <option value="類別">類別</option>
                <option value="主題" selected="selected">主題</option>
             <{/if}>
            </select>
        </div>

        <div class="form-group">
          <label class="control-label" for="topic_description">專題說明</label>
          <div class="topic_description">
            <{$editor}>
          </div>
        </div>
        <div class="row">
        <div class="form-group  col-sm-4">主題狀態:
            <input type="radio" id="topic_status1" name="topic_status" value="0"
             <{if $topic.topic_status=='0'}>checked<{/if}>>
            <label for="topic_status1">開始投稿</label>
            <input type="radio" id="topic_status2" name="topic_status" value="1"
             <{if $topic.topic_status=='1'}>checked<{/if}>>
            <label for="topic_status2">當期</label>
            <input type="radio" id="topic_status3" name="topic_status" value="2"
             <{if $topic.topic_status=='2'}>checked<{/if}>>
            <label for="topic_status3">一般</label>
            <input type="radio" id="topic_status4" name="topic_status" value="3"
             <{if $topic.topic_status=='3'}>checked<{/if}>>
            <label for="topic_status4">關閉</label>
        </div>
        <div class="form-group  col-sm-6">
            <label for="pic" class="col-form-label sr-only">封面圖</label>
            <input type="file" class="form-control" name="pic" id="pic" placeholder="請上傳一張封面圖">
        </div>
        <div class="text-center col-sm-1">
            <input type="hidden" name="op" value="<{$op1}>">
            <{if $btn_cap == '更新'}>
            <input type="hidden" name="sn" value="<{$topic.topic_sn}>">
            <{/if}>
            <input type="hidden" name="username" value="<{$smarty.session.username}>">
            <button type="submit" class="btn btn-primary"><{$btn_cap}></button>
        </div>
        </div>
    </form>
<{/if}>

<script src="<{$xoops_url}>/modules/kyc_streetNews/class/bootbox.min.js"></script>
<script>
    // CKEDITOR.replace('topic_description');
    $( document ).ready(function() {
        var sn = "";
        var obj1 = "";
        $('#myTable .del1').on('click', function() {
            sn = $(this).attr("sn");
            var snmsg = $(this).attr("sn-msg");
            obj1 = $(this).parents('tr');
            bootbox.confirm({
                message: "你確定要刪除<br>" + snmsg + "<br>此類別(專題)?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if(result){
                        update_data();
                    }
                }
            });
        });

        function update_data() {
            $.ajax({ //调用jquery的ajax方法
                type: "POST",
                url: "j01_topic.php",
                data: "op=delete_topic&sn=" + sn,
                success: function (msg) {
                },
                error: function (jqXHR, exception) {
                    return "連線錯誤";
                },
                beforeSend: function () {
                    $(".loding img").css("display", "block");
                },
                complete: function () {
                    $(".loding img").css("display", "none");
                    obj1.remove();
                }
            });
        }
    });
</script>