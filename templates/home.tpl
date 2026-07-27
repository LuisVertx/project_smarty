{extends file='layouts/main.tpl'}

{block name=content}
    {foreach $categories as $category}
        <section class="category">
            <div class="category__header">
                <div>
                    <h2 class="category__title">{$category.title|escape|upper}</h2>
                </div>

                <a class="btn" href="/category.php?id={$category.id}">
                    View All
                </a>
            </div>

            <div class="posts">
                {foreach $category.posts as $post}
                    <article class="post-card">
                        <a href="/article.php?id={$post.id}">
                            <img
                                class="post-card__image"
                                src="https://picsum.photos/seed/post-{$post.id}/600/360"
                                alt="{$post.title|escape}"
                            >
                        </a>

                        <h3 class="post-card__title">
                            <a href="/article.php?id={$post.id}">
                                {$post.title|escape}
                            </a>
                        </h3>

                        <div class="post-card__date">{$post.created_at}</div>

                        <p class="post-card__description">
                            {$post.description|escape}
                        </p>

                        <a class="post-card__link" href="/article.php?id={$post.id}">
                            Continue Reading
                        </a>
                    </article>
                {/foreach}
            </div>
        </section>
    {/foreach}
{/block}