{extends file='layouts/main.tpl'}

{block name=content}
    <article class="article">
        {if $primaryCategory}
            <a class="back-link" href="/category.php?id={$primaryCategory.id}">
                ← {$primaryCategory.title|escape}
            </a>
        {/if}

        <h1 class="article__title">{$post.title|escape}</h1>

        <div class="article__meta">
            <span>{$post.views} просмотров</span>
            <span>{$post.created_at}</span>
        </div>

        {if $categories}
            <div class="article__tags">
                {foreach $categories as $category}
                    <a class="tag" href="/category.php?id={$category.id}">
                        {$category.title|escape}
                    </a>
                {/foreach}
            </div>
        {/if}

        {if $post.image}
            <img
                class="article__image"
                src="/images/{$post.image|escape}"
                alt="{$post.title|escape}"
            >
        {/if}

        <div class="article__content">
            {$post.content|escape|nl2br}
        </div>
    </article>

    {if $relatedPosts}
        <section class="related">
            <h2 class="section-title">Похожие статьи</h2>

            <div class="posts">
                {foreach $relatedPosts as $relatedPost}
                    <article class="post-card">
                        <div class="post-card__content">
                            <h3 class="post-card__title">
                                <a href="/article.php?id={$relatedPost.id}">
                                    {$relatedPost.title|escape}
                                </a>
                            </h3>

                            <p class="post-card__description">
                                {$relatedPost.description|escape}
                            </p>
                        </div>

                        <div class="post-card__meta">
                            <span>{$relatedPost.views} просмотров</span>
                            <span>{$relatedPost.created_at}</span>
                        </div>
                    </article>
                {/foreach}
            </div>
        </section>
    {/if}
{/block}