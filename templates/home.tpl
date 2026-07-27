{extends file='layouts/main.tpl'}

{block name=content}

<div class="hero">
    <h1 class="hero__title">Project Blog</h1>
    <p class="hero__subtitle">
        Последние статьи по PHP, MySQL, Git и Docker.
    </p>
</div>

{foreach $categories as $category}

<section class="category">

    <div class="category__header">
        <div>
            <h2 class="category__title">
                {$category.title|escape|upper}
            </h2>

            {if $category.description}
                <p class="category__description">
                    {$category.description|escape}
                </p>
            {/if}
        </div>

        <a href="?route=category&id={$category.id}" class="mag-section__more">
            View All
        </a>
    </div>

    <div class="category-toolbar">

        <div class="category-toolbar__sort">

            <span>Сортировка:</span>

            <a href="?sort=date"
               class="sort-link {if $sort == 'date'}is-active{/if}">
                По дате
            </a>

            <a href="?sort=views"
               class="sort-link {if $sort == 'views'}is-active{/if}">
                По просмотрам
            </a>

        </div>

        <div class="category-toolbar__count">
            {$category.posts|@count} статей
        </div>

    </div>

    <div class="posts">

        {foreach $category.posts as $post}

        <article class="post-card">

            <img
                class="post-card__image"
                src="https://picsum.photos/seed/{$post.id}/600/360"
                alt="{$post.title|escape}"
            >

            <h3 class="post-card__title">
                {$post.title|escape}
            </h3>

            <div class="post-card__date">
                {$post.created_at}
            </div>

            <p class="post-card__description">
                {$post.description|escape}
            </p>

            <a href="?route=article&id={$post.id}" class="post-card__link">
                Continue Reading
            </a>

        </article>

        {/foreach}

    </div>

</section>

{/foreach}

{/block}