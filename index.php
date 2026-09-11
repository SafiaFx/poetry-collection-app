<?php
// Shows works in the homepage and a form for submitting new work
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
<div class="heading">HALFPENNY POETRY</div>

<header class="header">
    <a href="index.php"><div class="filters">POEMS</div></a>
    <div class="filters-1">
        <a href="filter.php?id=poetry"><span class="filters">ABOUT</span></a>
        <a href="filter.php?id=music"><span class="filters">ART</span></a>
        <a href="filter.php?id=other"><span class="filters">OTHER</span></a>
    </div>
</header>

<?php

$db = new PDO('mysql:host=db; dbname=collector-app', 'root', 'password');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = $db->prepare('SELECT `id`, `name`, `type`,`about`, `image`, `verses`, `date` FROM `artist-works` WHERE COALESCE(`deleted`, 0) = 0;');
$query->execute();

$result = $query->fetchALL();

echo '<div class="contain">';

foreach ($result as $poem) {
    echo '<div class="container">' . '<a href=details.php?id=' . $poem['id'] . '>' . '<div class="image-description-container">' .

        '<img class="images" src="' .
        $poem['image'] . '">' . '<div class="description">' . '<div class="name">' .
        $poem['name'] . '</div>' . '<div class="type">' .
        $poem['type'] .
        '<br>' . '</div>' . '<div class="about">' .
        $poem['about'] . '<br>' . '</div>' . '<div class="date">' .
        $poem['date'] . '<br><hr>' . '</div>' . '</div>' .
        '</div>' . '</a>' . '</div>';
}

echo '<form method="post" action="add.php" enctype="multipart/form-data" class="container-form add">

<div class="form"><p class="h1">Submit new work</p>
<label for="name">Name of works:</label>
<input type="text" name="name" id="name" required maxlength="255"></div>


<div class="form">
<label for="image_file">Upload an image:</label>
<input type="file" name="image_file" id="image_file" accept="image/jpeg,image/png,image/webp,image/gif">



<div class="form">
<label for="image">Or image URL (optional):</label>
<input type="url" name="image" id="image"></div>

<div class="form">
<label for="type">Type of works:</label>
<input type="text" name="type" id="type"></div>


<div class="form">
<label for="about">About:</label>
<input type="text" name="about" id="about" required maxlength="255"></div>

<div class="form">
<label for="year">Year of production:</label>
<input type="number" name="year" id="year"></div>


<div class="form">
<label for="verse">Lyrics/poem:</label>

<textarea name="verse" id="verse" rows="12" placeholder="Write or paste your poem here..."></textarea></div>
<div class="form"><button class="submit">Submit</button></div>


</form>';

echo '</div>';


?>
</body>
</html>
