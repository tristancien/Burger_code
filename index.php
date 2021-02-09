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
        <link rel="stylesheet" href="css/styles.css">
         <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
    </head>
    <body>
        <div class="container site">
            <h1 class="text-logo"><i class="fas fa-utensils"></i> BURGER CODE <span class="fas fa-utensils"></span></h1>
            
            
            <?php
            require 'admin/database.php';
            echo '<nav>
                <ul class="nav nav-pills">';
            $db = Database::connect();
            $statement = $db->query('SELECT * FROM categories');
            $categories = $statement->fetchAll();
            foreach($categories as $category)
            {
                if($category['id'] = '1')
                    echo '<li role="presentation" class="active"><a href="#1"' . $category['id'] . 'data-toggle="tab">' .$category['name']. '</a></li>';
                else
                    echo '<li role="presentation"><a href="#1"' . $category['id'] . 'data-toggle="tab">' .$category['name']. '</a></li>';
            }
            echo '</ul>
            </nav>';
            
            echo '<div class="tab-content">';
            
            foreach($categories as $category)
            {
                if($category['id'] == '1')
                    echo '<div class="tab-pane active" id="' . $category['id'] .'">';
                else
                   echo '<div class="tab-pane" id="' . $category['id'] .'">';
                echo '<div class="row">';
                $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
                $statement->execute(array($category['id']));
                
                while($item = $statement->fetch())
                {
                    echo '<div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img src="images/' . $item['image'] . '">
                                <div class="price">' . number_format($item['price'], 2, '.', '') .'€ </div>
                                <div class="caption">
                                    <h4>' . $item['name'] . '</h4>
                                    <p>' . $item['description'] . '</p>
                                    <a href="#" class="btn btn-order" role="button"><span class="fas fa-shopping-cart"></span> Commander</a>
                                </div>
                            </div>
                        </div>';
                }
                echo '</div>
                    </div>';
            }
            Database::disconnect();
            echo '</div>'
            ?>
            
        </div>
    </body>
</html>