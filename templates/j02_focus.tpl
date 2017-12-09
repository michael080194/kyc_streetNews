

<{if $op=="list_focus"}>
<div class="container">
    <h1 class="my-3 text-center">精選文章</h1>
    <div class="row">
      <{foreach from=$articles item=article}>
      <div class="col-sm-4">
        <a href="index.php?sn=<{$article.sn}>" style="text-decoration:none;">
          <div class="new-article top-shadow bottom-shadow">
            <{if file_exists($article.img1)}>
            <img src="<{$article.img}>" alt="<{$article.title}>" class="rounded cover">
            <{else}>
            <img src="https://picsum.photos/400/300?image=<{$article.sn}>" alt="<{$article.title}>" class="rounded cover">
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


