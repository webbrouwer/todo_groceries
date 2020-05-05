<?php
// Silky smooth functions
include "./functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amy & Mickey's Boodschappen</title>
    <link rel="stylesheet" href="./style/style.css">

    <link rel="shortcut icon" type="image/png" href="./favicon.png"/>   
</head>
<body>
    <div class="site-wrapper">
        <div class="container">
            <div class="todo-box">
                <h1>Boodschappen</h1>

                <?php 
                
                $data = getAllCategoriesAndItems();

                foreach($data as $category => $items) { ?>

                    <?php //echo '<pre>'; ?>
                    <?php //var_dump($items['']['cat_id']); ?>

                    <h2 id="js-list-title" class="inline"><?php echo $category; ?></h2> 
                    <span id="js-edit" class="edit">Edit</span>
                    <span
                        id="js-delete"
                        class="delete"
                        data-id="<?php echo $items['']['cat_id']; ?>"
                    >
                        Delete
                    </span> 

                    <?php foreach($items as $item) { 
                        if(!empty($item['id'])) { ?>
                            <input type="checkbox" id="<?php echo $item['id']; ?>" />
                            <label 
                                class="checkboxLabel"
                                data-group="items"
                                data-id="<?php echo $item['id']; ?>"
                                for="<?php echo $item['id']; ?>"
                            >
                                <?php echo $item['item']; ?>
                            </label>
                        <?php } // endif ?>
                    <?php } // end foreach ?>

                    <form id="item-name-input_<?php echo $item['cat_id']; ?>" action="./functions.php" method="POST">
                        <input type="hidden" name="category_id" value="<?php echo $item['cat_id']; ?>">
                        <input type="text" name="item" id="item" placeholder="Toevoegen..."> <button form="item-name-input_<?php echo $item['cat_id']; ?>" name="item-name-input" type="submit">Voeg toe</button> 
                    </form>

                <?php } ?>

                <span id="js-add-category" class="add-category">Voeg categorie toe</span>

                <div id="category-name-input" class="hidden">
                    <form id="category_name_form" action="./functions.php" method="POST">
                        <input type="text" name="category_name" id="category_name" placeholder="Nieuwe categorie..."> <button form="category_name_form" name="category_name_form" type="submit">Voeg toe</button>
                    </form>
                </div>

            </div>
        </div>
        <img class="firework" src="./img/firework.png" alt="">
        <div class="circle"></div>
        <footer>
            <span>Website gemaakt door Amy & Mickey</span>
        </footer>         
    </div>    
<script src="./js/main.js"></script>
</body>
</html>