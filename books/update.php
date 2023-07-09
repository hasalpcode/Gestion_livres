<?php session_start();
    include_once('./../config/mysql.php');
    include_once('./../config/user.php');
    include_once('./../variables.php');

$getData = $_GET;

if (!isset($getData['id']) && is_numeric($getData['id']))
{
	echo('Il faut un identifiant du livre pour le modifier.');
    return;
}	

$retrievebookstatement = $mysqlClient->prepare('SELECT * FROM books WHERE id = :id');
$retrievebookstatement->execute([
    'id' => $getData['id'],
]);

$book = $retrievebookstatement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion livres</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

    <?php include_once('./../header.php'); ?>   
        <h4 style="margin:auto;text-align:center">Mettre à jour</h4>
        <div class="card">
        <form action="<?php echo($rootUrl . 'books/post_update.php'); ?>"class="form_create" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Identifiant livre</label>
                <input type="text" readonly class="form-control" id="id" name="id" aria-describedby="title-help" value="<?php echo($book['id']); ?>">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Titre du livre</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title-help" value="<?php echo($book['title']); ?>">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Author du livre</label>
                <input type="text" class="form-control" id="author" name="author" value="<?php echo($book['author']); ?>" aria-describedby="title-help">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Author du livre</label>
                <select name="statut" id="" class="form-control">
                    <option value="disponible">Disponible</option>
                    <option value="en pret">En pret</option>
                </select>
                <!-- <input type="text" class="form-control" id="author" name="author" aria-describedby="title-help"> -->
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Date edition</label>
                <input type="date" class="form-control" id="date_edition" value="<?php echo($book['date_edition']); ?>" name="date_edition" aria-describedby="title-help">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form> 
        </div>
        
       
        <br />
    </div>

    <?php include_once($rootPath.'/footer.php'); ?>
</body>
</html>