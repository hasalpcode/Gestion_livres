<?php
session_start();

include_once('./../config/mysql.php');
include_once('./../config/user.php');
include_once('./../variables.php');

$postData = $_POST;

if (
    !isset($postData['id'])
    || !isset($postData['title']) 
    || !isset($postData['author'])
    )
{
	echo('Il manque des informations pour permettre l\'édition du formulaire.');
    return;
}	


$id = $_POST['id'];
$title = $_POST['title'];
$author = $_POST['author'];
$date_edition = $_POST['date_edition'];
$statut = $postData['statut'];

$updatebook = $mysqlClient->prepare('UPDATE books SET title = :title, author = :author,statut = :statut, date_edition = :date_edition WHERE id = :id');
$updatebook->bindParam(':title', $title);
$updatebook->bindParam(':author', $author);
$updatebook->bindParam(':date_edition', $date_edition);
$updatebook->bindParam(':id', $id);
$updatebook->bindParam(':statut', $statut);
$updatebook->execute();
$mysqlClient = null;
header('Location: '.$rootUrl.'home.php');
?>


