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

                <span id="js-add-category" class="add-category">Voeg categorie toe</span>

                <div id="category-name-input" class="hidden">
                    <form id="category_name_form" action="./functions.php" method="POST">
                        <input type="text" name="category_name" id="category_name" placeholder="Nieuwe categorie..."> <button form="category_name_form" name="category_name_form" type="submit">Voeg toe</button>
                    </form>
                </div>

                <?php 
                
                $data = getAllCategoriesAndItems();

                // echo '<pre>';
                // var_dump($data);
                // echo '</pre>';
                // exit;

                foreach($data as $category => $items){

                    echo $category.'<br>';
                
                    foreach($items as $item){
                        echo '    <> '.$item['item'].'<br>';
                    }

                    ?>

                    <form id="item-name-input" action="./functions.php" method="POST">
                        <input type="hidden" name="category_id" value="<?php echo $item['category_id']; ?>">
                        <input type="text" name="item" id="item" placeholder="Toevoegen..."> <button form="item-name-input" name="item-name-input" type="submit">Voeg toe</button>
                    </form>

                    <?php

                    
                }   
                
                ?>
                </pre>

                <?php $listNames = getAllTableNames(); ?>
            
                <h2 id="js-list-title" class="inline"><?php echo $listNames[0]; ?></h2> <span id="js-edit" class="edit">Edit</span>
                <form id="form-1" action="./functions.php" method="POST">
                    <?php foreach (listGroceries('groente_fruit') as $item) { ?>
                        <p>
                            <input type="checkbox" id="<?php echo $item['id']; ?>" />
                            <label 
                                class="checkboxLabel"
                                data-cat="groente_fruit"
                                data-id="<?php echo $item['id']; ?>"
                                for="<?php echo $item['id']; ?>"
                            >
                                <?php echo $item['item']; ?>
                            </label>
                        </p>   
                    <?php } ?>
                    <div class="list"></div>
                    <input type="hidden" name="category" value="groente_fruit">
                    <input type="text" name="item" id="item" placeholder="Toevoegen..."> <button form="form-1" name="form-1" type="submit">Voeg toe</button>
                </form>

                <h2><?php echo $listNames[1]; ?></h2>
                <form id="form-2" action="./functions.php" method="POST">
                    <?php foreach (listGroceries('vleeswaren_beleg') as $item) { ?>
                        <p>
                            <input type="checkbox" id="<?php echo $item['id']; ?>" />
                            <label 
                                class="checkboxLabel"
                                data-cat="vleeswaren_beleg"
                                data-id="<?php echo $item['id']; ?>"
                                for="<?php echo $item['id']; ?>"
                            >
                                <?php echo $item['item']; ?>
                            </label>
                        </p>   
                    <?php } ?>
                    <div class="list2"></div> 
                    <input type="hidden" name="category" value="vleeswaren_beleg">
                    <input type="text" name="item" id="item" placeholder="Toevoegen..."> <button form="form-2" name="form-1" type="submit">Voeg toe</button>
                </form>

                <h2><?php echo $listNames[2]; ?></h2>
                <form id="form-3" action="" method="POST">
                    <?php foreach (listGroceries('huishouden') as $item) { ?>
                        <p>
                            <input type="checkbox" id="<?php echo $item['id']; ?>" />
                            <label 
                                class="checkboxLabel"
                                data-cat="huishouden"
                                data-id="<?php echo $item['id']; ?>"
                                for="<?php echo $item['id']; ?>"
                            >
                                <?php echo $item['item']; ?>
                            </label>
                        </p>   
                    <?php } ?>                      
                    <div class="list3"></div>  
                    <input type="hidden" name="category" value="huishouden">
                    <input type="text" name="item" id="item" placeholder="Toevoegen..."> <button form="form-3" name="form-1" type="submit">Voeg toe</button>
                </form>
                
                <h2><?php echo $listNames[3]; ?></h2>
                <form id="form-4" action="" method="POST">
                    <?php foreach (listGroceries('overig') as $item) { ?>
                        <p>
                            <input type="checkbox" id="<?php echo $item['id']; ?>" />
                            <label 
                                class="checkboxLabel"
                                data-cat="overig"
                                data-id="<?php echo $item['id']; ?>"
                                for="<?php echo $item['id']; ?>"
                            >
                                <?php echo $item['item']; ?>
                            </label>
                        </p>   
                    <?php } ?>                     
                    <div class="list4"></div>
                    <input type="hidden" name="category" value="overig">
                    <input type="text" name="item" id="item" placeholder="Toevoegen..."> <button form="form-4" name="form-1" type="submit">Voeg toe</button>
                </form>                
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