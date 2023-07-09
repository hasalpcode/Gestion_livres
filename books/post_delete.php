<?php
session_start();

include_once('./../config/mysql.php');
include_once('./../config/user.php');
include_once('./../variables.php');

$postData = $_GET;
if (!isset($postData['id']))
{
	echo('Il faut un identifiant valide pour supprimer une recette.');
    return;
}


$id = $postData['id'];

    
    $deletebookstatement = $mysqlClient->prepare('DELETE FROM books WHERE id = :id');
        $deletebookstatement->execute([
    'id' => $id,
]);



$mysqlClient = null;

header('Location: '.$rootUrl.'home.php');
?>
