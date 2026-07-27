<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$pageTitle|default:'Blog'}</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header class="header">
        <div class="container header__inner">
            <a class="logo" href="/project/public/">{$siteName|escape}</a>
        </div>
    </header>

    <main class="container">
        {block name=content}{/block}
    </main>
</body>
</html>