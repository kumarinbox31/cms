<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>HTML Sitemap</title>
</head>
<body>
    <h1>HTML Sitemap</h1>
    <ul>
        <?php foreach ($urls as $url): ?>
            <li><a href="<?= $url['loc'] ?>"><?= $url['label'] ?></a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
