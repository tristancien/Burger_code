<?php
session_start();
if(!isset($_SESSION['email']))
{
  header("Location: login.php");  
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Burger Code</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width-device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/styles.css">
         <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
    </head>
    
    <body>
        <h1 class="text-logo"><i class="fas fa-utensils"></i> BURGER CODE <span class="fas fa-utensils"></span></h1>
        <div class="container admin">
            <div class="row">
                <h1><strong>Liste des items</strong>
                <a href="insert.php" class="btn btn-success btn-lg"><span class="fas fa-plus"></span> Ajouter</a></h1>
                
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Catégorie</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                        
                    <tbody>
                        
                        <?php 
                        require 'database.php';
                        $db = Database::connect();
                        $statement = $db->query('
                        SELECT items.id, items.name, items.description, items.price, categories.name AS category 
                        FROM items LEFT JOIN categories ON items.category = categories.id
                        ORDER BY items.id DESC');
                        
                        while($item = $statement->fetch())
                        {
                            echo '<tr>';
                            echo '<td>' . $item['name'] . '</td>';
                            echo '<td>' . $item['description'] . '</td>';
                            echo '<td>' . number_format((float)$item['price'],2, '.', '') . '€ </td>';
                            echo '<td>' . $item['category'] . '</td>';
                            echo '<td width=300>';
                                
                                echo '<a href="view.php?id='. $item['id'] . '" class="btn btn-default"><span class="fas fa-eye"></span> Voir</a>';
                                echo ' ';
                                echo '<a href="update.php?id='. $item['id'] . '" class="btn btn-primary"><span class="fas fa-pencil-alt"></span> Modifier</a>';
                            echo ' ';
                                echo '<a href="delete.php?id='. $item['id'] . '" class="btn btn-danger"><span class="fas fa-trash-alt"></span> Supprimer</a>';
                          echo  '</td>
                        </tr>';
                        }
                        Database::disconnect();
                        ?>
                        
                        
                        
                    </tbody>
                </table>
                
            </div>
        </div>
    </body>
</html>