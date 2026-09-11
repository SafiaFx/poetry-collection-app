<?php
// Shows works from the selected category
?>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Oswald:wght@200..700&display=swap"
          rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
</head>
<body class="body">
<div class="heading">COLLECTION OF ARTIST WORKS</div>

<header class="header">
    <a href="index.php"><div class="filters">Home</div></a>
    <div class="filters-1">
        <a href="filter.php?id=poetry"><div class="filters">Poetry</div></a>
        <a href="filter.php?id=music"><div class="filters">Music</div></a>
        <a href="filter.php?id=other"><div class="filters">Other</div></a>
    </div>
</header>

<?php

$db = new PDO('mysql:host=db; dbname=collector-app', 'root', 'password');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$works = $_GET['id'] ?? 'poetry';

$query = $db->prepare('SELECT `id`, `name`, `type`,`about`, `image`, `verses`, `date` 
FROM `artist-works` WHERE `type` = :type AND COALESCE(`deleted`, 0) = 0');

$query->execute(['type' => $works]);
$result = $query->fetchALL();

foreach($result as $poem)
{echo '<div class="contain">';
    echo '<div class="container">' . '<a href=details.php?id=' . $poem['id'] . '>' . '<div class="image-description-container">' .
        '<img class="images" src="' .
        $poem['image'] . '">' . '<div class="description">' . '<div class="name">' .
        $poem['name'] . '</div>' . '<div class="type">' .
        $poem['type'] .
        '<br>' . '</div>' . '<div class="about">' .
        $poem['about'] . '<br>' . '</div>' . '<div class="date">' .
        $poem['date'] . '<br><hr>' . '</div>' . '</div>' .
        '</div>' . '</a>' . '</div>' . '</div>';
}
?>
</body>
</html>
