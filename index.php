<?php 
// @TODO: add automated production process via git: https://www.diffuse.nl/blog/how-to-set-up-git-for-automated-deployments

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
            
                <h2>Groente & Fruit</h2>
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
                    <input type="text" name="item" id="item" placeholder="Toevoegen..."> <input form="form-1" name="form-1" type="submit" value="Voeg toe">
                </form>

                <h2>Vleeswaren & Beleg</h2>
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
                    <input type="text" name="item" id="item" placeholder="Toevoegen..."> <input form="form-2" name="form-2" type="submit" value="Voeg toe">
                </form>

                <h2>Huishouden</h2>
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
                    <input type="text" name="item" id="item" placeholder="Toevoegen..."> <input form="form-3" name="form-3" type="submit" value="Voeg toe">
                </form>
                
                <h2>Overig</h2>
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
                    <input type="text" name="item" id="item" placeholder="Toevoegen..."> <input form="form-4" name="form-4" type="submit" value="Voeg toe">
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