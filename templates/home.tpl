{extends file='layouts/main.tpl'}

{block name=content}
    <section class="hero">
        <h1 class="hero__title">Блог</h1>
        <p class="hero__subtitle">Категории и последние статьи</p>
    </section>

    {foreach $categories as $category}
        <section class="category">
            <div class="category__header">
                <div>
                    <h2 class="category__title">{$category.title|escape}</h2>
                    <p class="category__description">{$category.description|escape}</p>
                </div>

                <a class="btn" href="/project/public/category.php?id={$category.id}">Все статьи</a>
            </div>

            <div class="posts">
                {foreach $category.posts as $post}
                    <article class="post-card">
                        <div class="post-card__content">
                            <h3 class="post-card__title">
                                <a href="/project/public/article.php?id={$post.id}">{$post.title|escape}</a>
                            </h3>

                            <p class="post-card__description">{$post.description|escape}</p>
                        </div>

                        <div class="post-card__meta">
                            <span>{$post.views} просмотров</span>
                            <span>{$post.created_at}</span>
                        </div>
                    </article>
                {/foreach}
            </div>
        </section>
    {foreachelse}
        <p>Пока нет категорий со статьями.</p>
    {/foreach}
{/block}