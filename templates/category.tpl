{extends file='layouts/main.tpl'}

{block name=content}
    <section class="hero">
        <h1 class="hero__title">{$category.title|escape}</h1>
        <p class="hero__subtitle">{$category.description|escape}</p>
    </section>

    <div class="category-toolbar">
        <div class="category-toolbar__sort">
            <span>Сортировка:</span>

            <a class="sort-link {if $sort == 'date'}is-active{/if}"
               href="/category.php?id={$category.id}&sort=date">
                По дате
            </a>

            <a class="sort-link {if $sort == 'views'}is-active{/if}"
               href="/category.php?id={$category.id}&sort=views">
                По просмотрам
            </a>
        </div>

        <div class="category-toolbar__count">
            {$totalPosts} статей
        </div>
    </div>

    {if $posts}
        <div class="posts">
            {foreach $posts as $post}
                <article class="post-card">
                    <div class="post-card__content">
                        <h2 class="post-card__title">
                            <a href="/article.php?id={$post.id}">{$post.title|escape}</a>
                        </h2>

                        <p class="post-card__description">{$post.description|escape}</p>
                    </div>

                    <div class="post-card__meta">
                        <span>{$post.views} просмотров</span>
                        <span>{$post.created_at}</span>
                    </div>
                </article>
            {/foreach}
        </div>

        {if $totalPages > 1}
            <nav class="pagination">
                {if $page > 1}
                    <a class="pagination__link"
                       href="/category.php?id={$category.id}&sort={$sort}&page={$page-1}">
                        ←
                    </a>
                {/if}

                {for $i = 1 to $totalPages}
                    {if $i == $page}
                        <span class="pagination__current">{$i}</span>
                    {else}
                        <a class="pagination__link"
                           href="/category.php?id={$category.id}&sort={$sort}&page={$i}">
                            {$i}
                        </a>
                    {/if}
                {/for}

                {if $page < $totalPages}
                    <a class="pagination__link"
                       href="/category.php?id={$category.id}&sort={$sort}&page={$page+1}">
                        →
                    </a>
                {/if}
            </nav>
        {/if}
    {else}
        <p>В этой категории пока нет статей.</p>
    {/if}
{/block}

