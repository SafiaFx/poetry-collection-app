<?php
// Saves a work submitted through the form to the database and displays the submission result.

session_start();

?>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>ARTIST WEBSITE</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Oswald:wght@200..700&display=swap"
          rel="stylesheet">
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

// Validate the submission before saving an image or creating a database record.
function rejectSubmission($message) {
    echo '<p class="text-1">' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p><p><a href="index.php">Back to collection</a></p></body></html>';
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    rejectSubmission('Please use the submission form on the homepage.');
}
function field($name) {
    return isset($_POST[$name]) && is_string($_POST[$name]) ? trim($_POST[$name]) : '';
}
$name = field('name');
$about = field('about');
$type = field('type');
$verse = field('verse');
$year = field('year') ?: null;
$image = field('image');
if ($name === '' || $about === '') {
    rejectSubmission('Please fill in Name of works and About. If you selected a large image, try one under 2 MB.');
}
if (strlen($name) > 255 || strlen($about) > 255 || strlen($type) > 255 || strlen($verse) > 65535) {
    rejectSubmission('One of the text fields is too long. Please shorten it and try again.');
}
if ($year !== null && (!ctype_digit($year) || (int)$year < 1901 || (int)$year > 2155)) {
    rejectSubmission('Please enter a year between 1901 and 2155, or leave it blank.');
}

// Keep uploaded images locally; check their contents rather than trusting the filename.
$uploadedPath = null;
$file = $_FILES['image_file'] ?? null;
if ($file !== null && (!isset($file['error']) || is_array($file['error']))) {
    rejectSubmission('Invalid image upload.');
}
if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
    if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] > 2 * 1024 * 1024) {
        rejectSubmission('The image could not be uploaded. Choose an image up to 2 MB.');
    }
    $formats = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/gif' => 'gif'];
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
    if (!isset($formats[$mime]) || @getimagesize($file['tmp_name']) === false) {
        rejectSubmission('Please choose a valid JPG, PNG, WebP or GIF image.');
    }
    $image = 'uploads/' . bin2hex(random_bytes(16)) . '.' . $formats[$mime];
    $uploadedPath = __DIR__ . '/' . $image;
    if (!move_uploaded_file($file['tmp_name'], $uploadedPath)) {
        rejectSubmission('The image could not be saved. Please try again.');
    }
} elseif ($image !== '' && (strlen($image) > 255 || !filter_var($image, FILTER_VALIDATE_URL) || !in_array(strtolower(parse_url($image, PHP_URL_SCHEME) ?? ''), ['http', 'https'], true))) {
    rejectSubmission('Please enter a valid HTTP or HTTPS image URL.');
}
if ($image === '') {
    $image = 'images/placeholder.svg';
}

// Save exactly one work; remove its uploaded file if the database save fails.
try {
    $db = new PDO('mysql:host=db; dbname=collector-app', 'root', 'password');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $db->prepare('INSERT INTO `artist-works` (`name`, `type`, `image`, `about`, `verses`, `date`) VALUES (:name, :type, :image, :about, :verse, :year)');
    $query->execute(compact('name', 'type', 'image', 'about', 'verse', 'year'));
} catch (PDOException $error) {
    if ($uploadedPath !== null) {
        unlink($uploadedPath);
    }
    error_log($error->getMessage());
    rejectSubmission('The work could not be saved. Please try again.');
}
function escape($text) {
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
}
echo '<div class="container"><div class="image-description-container">'
    . '<img class="images" src="' . escape($image) . '" alt="">'
    . '<div class="description"><div class="name">' . escape($name) . '</div>'
    . '<div class="type">' . escape($type) . '</div>'
    . '<div class="about">' . escape($about) . '</div>'
    . '<div class="date">' . escape($year) . '</div>'
    . '<div class="verse">' . escape($verse) . '</div></div></div></div>'
    . '<p class="text-1">Form submitted successfully</p><p><a href="index.php">Back to collection</a></p>';
?>
</body>
</html>
