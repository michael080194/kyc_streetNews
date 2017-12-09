
  <{if $op=="list_article"}>
  <div class="container">
      <h1 class="my-3 text-center">最新文章</h1><{$bar}>
      <div class="row">
          <{foreach from=$articles item=article}>
          <div class="col-sm-4">
              <a href="index.php?sn=<{$article.sn}>" style="text-decoration:none;">
                  <div class="new-article top-shadow bottom-shadow">
                      <{if file_exists($article.img1)}>
                          <img src="<{$article.img}>" alt="<{$article.title}>" class="rounded cover">
                      <{else}>
                           <img src="https://picsum.photos/400/300?image=1" alt="<{$article.title}>" class="rounded cover">
                      <{/if}>
                      <div class="latest-post">
                          <h4><{$article.title}></h4>
                      </div>
                      <p><{$article.summary}></p>
                  </div>
              </a>
          </div>
          <{foreachelse}>
              <h1>尚無內容</h1>
          <{/foreach}>
      </div>
  </div>
  <{$bar}>
  <{/if}>


  <{if $op=="show_article"}>
     <{includeq file="$xoops_rootpath/modules/kyc_streetNews/templates/index_show_article.tpl"}>
  <{/if}>

