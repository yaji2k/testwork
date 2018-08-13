<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <p>Всего товаров: <?= count($array['products']); ?></p>
        <ul>
            <?php foreach ($array['groups'] as $value): ?>
                <li>
                    <a href="?group=<?= $value['id']; ?>"><?= $value['name']; ?></a> 
                    <span>(<?= $value['count']; ?>)</span>
                </li>
            <?php endforeach; ?>
        </ul>   
        <ol>
            <?php foreach ($array['products'] as $value): ?>
                <li>
                    <?= $value['name']; ?>
                </li>
            <?php endforeach; ?>
        </ol>
    </body>
</html>
