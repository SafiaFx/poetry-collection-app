<?php
// Asks the user to confirm deletion; Yes goes to delete.php and No returns to the homepage
ob_start();

session_start();

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
$poemId2 = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$query = $db->prepare('SELECT `name` FROM `artist-works` WHERE `id` = :id AND COALESCE(`deleted`, 0) = 0');
$query->execute(['id' => $poemId2]);
$poem = $query->fetch(PDO::FETCH_ASSOC);
if (!$poem) {
    http_response_code(404);
    exit('Work not found.');
}
$_SESSION['delete_token'] = bin2hex(random_bytes(32));

echo '<p class="text-2">Are you sure you want to delete “' . htmlspecialchars($poem['name'] ?? '', ENT_QUOTES, 'UTF-8') . '”?</p>'
    . '<div class="buttons"><form method="post" action="delete.php">'
    . '<input type="hidden" name="id" value="' . $poemId2 . '">'
    . '<input type="hidden" name="token" value="' . $_SESSION['delete_token'] . '">'
    . '<button class="submit" type="submit">Yes</button></form>'
    . '<a href="index.php" class="submit">No</a></div>';
?>
</body>
</html>
