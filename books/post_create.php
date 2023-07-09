<?php
session_start();

include_once('./../config/mysql.php');
include_once('./../config/user.php');
include_once('./../variables.php');

$postData = $_POST;

if (
    !isset($postData['title']) 
    || !isset($postData['author'])
    )
{
	echo('Il faut un remplir tous les champs.');
    return;
}	

$title = $postData['title'];
$author = $postData['author'];
$date_edition = $postData['date_edition'];
$statut = $postData['statut'];


$insertRecipe = $mysqlClient->prepare('INSERT INTO books(title, author,statut, date_edition) VALUES (:title, :author,:statut, :date_edition)');
$insertRecipe->execute([
    'title' => $title,
    'author' => $author,
    'date_edition' => $date_edition,
    'statut' => $statut,
]);

$mysqlClient = null;
header('Location: '.$rootUrl.'home.php');

?>


