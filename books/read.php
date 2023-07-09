<?php
session_start();

include_once('./../config/mysql.php');
include_once('./../config/user.php');
include_once('./../variables.php');

$getData = $_GET;



// Exécuter la requête SQL
$sql = "SELECT * FROM books";
$result = $mysqlClient->query($sql);

// Vérifier si des résultats ont été obtenus
if ($result->rowCount() > 0) {
    // Parcourir les résultats et afficher les données
   
    
} else {
    echo "Aucun élément trouvé.";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion-livres<?php echo($recipe['title']); ?></title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
    <?php include_once($rootPath.'/header.php'); ?>
    <!-- <button class="btn add btn-success "><a class="text-light"  href="books/create.php">Ajout</a></button> -->
    <div class="row table">
        <div class="col">
        <form class="d-flex" action="<?php echo($rootUrl .'books/search.php'); ?>"   method="GET">
        <input class="form-control me-2" name="search" type="search" placeholder="Id, titre" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
        </div>
        <div class="col">
            <button class="btn add btn-success "><a class="text-light"  data-bs-toggle="modal" data-bs-target="#exampleModal">Ajout</a></button>
        </div>
    </div>
    
    <?php  
        
        if ($result->rowCount() > 0) {
            echo '<table class="table table-striped">';
            
            echo '<thead class="bg-info text-light"><tr><th>ID</th><th>Titre</th><th>Auteur</th><th>Date edition</th><th>Statut</th><th>Action</th></tr></thead>';
            echo '<tbody>';

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . $row["title"] . '</td>';
                echo '<td>' . $row["author"] . '</td>';
                echo '<td>' . $row["date_edition"] . '</td>';
                echo '<td>' . $row["statut"] . '</td>';
                echo '<td>
                    <a href="/p4c6/books/update.php?id='.$row["id"].'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    &nbsp;&nbsp;
                    <a href="/p4c6/books/post_delete.php?id='.$row["id"].'" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ?\')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi text-danger bi-trash" viewBox="0 0 16 16"> 
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                    </svg>
                    </a>
              </td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo "Aucun élément trouvé.";
        }
    ?>
    </div>

       
 <!-- Modal ajout livre -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter un livre</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="<?php echo($rootUrl . 'books/post_create.php'); ?>" class="form_create"  method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Titre du livre</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title-help">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Author du livre</label>
                <input type="text" class="form-control" id="author" name="author" aria-describedby="title-help">
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
                <input type="date" class="form-control" id="date_edition" name="date_edition" aria-describedby="title-help">
            </div>
            <button  type="submit" class="btn btn-primary" style="margin:auto">Envoyer</button>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- fin form add book -->

    <?php include_once($rootPath.'/footer.php'); ?>
</body>
</html>
