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
    <link rel="stylesheet" href="./style/style.css?v=1">

    <link rel="shortcut icon" type="image/png" href="./favicon.png"/>
    <link rel="apple-touch-icon" href="./icons/apple-touch-icon.png">
</head>
<body>
    <div class="site-wrapper">
        <div class="container">
            <div class="todo-box">
                <h1>Boodschappen</h1>

                <?php $data = getAllCategoriesAndItems();

                foreach($data as $category => $items) {  ?>
                    
                    <div class="todo-cat">

                        <h2 id="js-list-title_<?php echo htmlspecialchars($items['cat_id']); ?>" class="inline"><?php echo htmlspecialchars($category); ?></h2>
                        <img
                            src="./icons/edit.png"
                            alt="edit-icon"
                            width="32px"
                            height="32px"
                            class="edit js-edit"
                            data-group="categories"
                            data-id="<?php echo htmlspecialchars($items['cat_id']); ?>"
                        >
                        <img 
                            src="./icons/delete.png"
                            alt="delete-icon"
                            width="32px"
                            height="32px"
                            class="delete js-delete"
                            data-group="categories"
                            data-id="<?php echo htmlspecialchars($items['cat_id']); ?>"
                        >

                        <?php foreach($items as $item) {

                        // if item id (items) exists display item checkbox
                            if(!empty($item['id'])) { ?>

                                <input type="checkbox" id="<?php echo htmlspecialchars($item['id']); ?>" />
                                <label 
                                    class="checkboxLabel"
                                    data-group="items"
                                    data-id="<?php echo htmlspecialchars($item['id']); ?>"
                                    for="<?php echo htmlspecialchars($item['id']); ?>"
                                ><?php echo htmlspecialchars($item['item']); ?></label>

                            <?php } // endif ?>

                        <?php } // end foreach $items ?>

                        <form id="item-name-input_<?php echo $items['cat_id']; ?>" action="./functions.php" method="POST">
                            <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($items['cat_id']); ?>">
                            <input type="text" name="item" id="item" placeholder="Toevoegen..."> <button form="item-name-input_<?php echo htmlspecialchars($items['cat_id']); ?>" name="item-name-input" type="submit">Voeg toe</button> 
                        </form>

                    </div> <!-- /todo-cat -->

                <?php } // end foreach $data ?>

                <span id="js-add-category" class="add-category">Voeg categorie toe</span>

                <div id="category-name-input" class="hide">
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
<script src="./js/main.js?v=1"></script>
</body>
</html>