<?php
// Marks the confirmed work as deleted in the database, then redirects to the homepage.
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    exit('Use the confirmation form to delete a work.');
}
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$token = $_POST['token'] ?? '';
if (!$id || $id < 1 || !is_string($token) || !isset($_SESSION['delete_token']) || !hash_equals($_SESSION['delete_token'], $token)) {
    http_response_code(400);
    exit('Invalid delete request. Please open the confirmation page again.');
}
$db = new PDO('mysql:host=db; dbname=collector-app', 'root', 'password');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $db->prepare('UPDATE `artist-works` SET `deleted` = 1 WHERE `id` = :id');
$query->execute(['id' => $id]);
unset($_SESSION['delete_token']);
header('Location: index.php', true, 303);
exit;
