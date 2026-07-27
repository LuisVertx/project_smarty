{extends file="layouts/main.tpl"}

{block name=content}

<h2>Главная страница</h2>

{foreach $categories as $category}

<div class="category">

    <h3>{$category.title}</h3>

    <p>{$category.description}</p>

    <div class="posts">

        {foreach $category.posts as $post}

            <div class="post">

                <h4>{$post.title}</h4>

                <p>{$post.description}</p>

            </div>

        {/foreach}

    </div>

    <a href="/category.php?id={$category.id}">
        Все статьи →
    </a>

    <hr>

</div>

{/foreach}

{/block}