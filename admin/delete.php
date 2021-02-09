<?php 
session_start();
if(!isset($_SESSION['email']))
{
  header("Location: login.php");  
}
require "database.php";

if(!empty($_GET['id']))
{
    $id = checkInput($_GET['id']);
}
if(!empty($_POST))
{
    $id = checkInput($_GET['id']);
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM items WHERE id = ?");
    $statement->execute(array($id));
    Database::disconnect();
    header("Location: index.php")
}
function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
                 <h1><strong>Supprimer un item</strong></h1>
                <br>
                <form class="form" action="delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">    
                <p class="alert alert-warning">Etes-vous sûr de vouloir supprimer ?</p>
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning">Oui</button>
                    <a class="btn btn-primary" href="index.php">Non</a>
                </div>                     
              </form>
            </div>
        </div>
    </body>
</html>