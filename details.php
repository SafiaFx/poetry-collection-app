<?php
// Shows the full details and verses of a selected work, with an option to delete
ob_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>ARTIST WEBSITE</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="stylesheet.css">
    <script src="https://kit.fontawesome.com/a767a9281d.js" crossorigin="anonymous"></script>
</head>
<body class="body">

<header class="header">
    <a href="index.php"><div class="filters">Home</div></a>
    <a href="filter.php?id=poetry"><div class="filters">Poetry</div></a>
    <a href="filter.php?id=music"><div class="filters">Music</div></a>
    <a href="filter.php?id=other"><div class="filters">Other</div></a>
</header>
<?php

$db = new PDO('mysql:host=db; dbname=collector-app', 'root', 'password');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$poemId1 = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$query = $db->prepare('SELECT `id`, `name`, `type`,`about`, `image`, `verses`, `date` 
FROM `artist-works` WHERE `id` = :id AND COALESCE(`deleted`, 0) = 0');
$query->execute(['id' => $poemId1]);

$poem = $query->fetch();
if (!$poem) {
    http_response_code(404);
    exit('Work not found.');
}

echo '<div class="contain-1">';

echo '<div class="container-1">'.
    '<div class="image-description-container-1">' .
    '<img class="images-1" src="' . $poem['image'] . '">' .
    '<div class="description-1">' . '<div class="name">' . $poem['name'] . '</div>' .
    '<div class="about">' . $poem['about'] . '<br>' . '</div>' .

    '<div class="date">' . $poem['date'] . '<a href=delete1.php?id=' . $poemId1. ' >'.'<i class="fa-solid fa-trash bin"></i>'.'</a>' .'<br><hr>' . '</div>' .
    '<div class="verse">' . htmlspecialchars($poem['verses'] ?? '', ENT_QUOTES, 'UTF-8') . '<br><hr>' . '</div>' .
    '</div>' . '</div>' . '</div>' . '</div>';
?>
</body>
</html>
