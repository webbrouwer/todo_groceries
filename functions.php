<?php 

/**
*
* Collect category_name_form and add input to categories table
*
*/

if(isset($_POST['category_name_form'])) {
    // Collect category name from form
    $category_name = htmlspecialchars($_POST['category_name'], ENT_QUOTES, 'utf-8');

    // Include for connection
    include "./config/config.php";

    try {

        $connection = new PDO($dsn, $username, $password, $options);

        $data = [
            'category_name' => $category_name
        ];

        $sql = "INSERT INTO categories (category_name) VALUES (:category_name)";

        $statement = $connection->prepare($sql);
        $statement->execute($data);

    }   
    
    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    header('location: ' . $homeUrl);
}



/**
*
* Collect item-name-input and add input to items table
*
*/

if(isset($_POST['item-name-input'])) {
    // Collect item input from form
    $item = htmlspecialchars($_POST['item'], ENT_QUOTES, 'utf-8');
    $category_id = htmlspecialchars($_POST['category_id'], ENT_QUOTES, 'utf-8');

    // Include for connection
    include "./config/config.php";

    try {

        $connection = new PDO($dsn, $username, $password, $options);

        $data = [
            'item' => $item,
            'category_id' => $category_id
        ];

        $sql = "INSERT INTO items (item, category_id) VALUES (:item, :category_id)";

        $statement = $connection->prepare($sql);
        $statement->execute($data);

    }   
    
    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    header('location: ' . $homeUrl);
}


/**
*
* Retrieve categories and items
*
* Source: https://stackoverflow.com/questions/36458593/sql-join-two-tables-to-give-multi-array-result
*
*/

function getAllCategoriesAndItems() {
    include "./config/config.php";

    $connection = new PDO($dsn, $username, $password, $options);
  
    try {

        $connection = new PDO($dsn, $username, $password, $options);
        
        $sql = "SELECT categories.id AS cat_id, categories.category_name, items.item, items.id, items.category_id
                FROM categories 
                LEFT JOIN items
                ON  categories.id = items.category_id
                ORDER BY categories.category_name, items.item";     

        $statement = $connection->prepare($sql);
        $statement->execute();
    
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);

        $data = array();

        foreach($items as $row){
            $data[$row['category_name']][$row['item']]['item'] = $row['item'];
            $data[$row['category_name']][$row['item']]['category_id'] = $row['category_id'];
            $data[$row['category_name']][$row['item']]['id'] = $row['id'];
            $data[$row['category_name']][$row['item']]['cat_id'] = $row['cat_id'];
        }        

    }
    
    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    return $data;
}


/**
*
* Remove from DB function
*
*/

function removeFromDb($id, $group) {
    include "./config/config.php";

    try {

        $connection = new PDO($dsn, $username, $password, $options);
    
        $sql = "DELETE FROM $group
                WHERE id=$id";
    
        $connection->exec($sql);
        echo $id . ' is removed from db';
    }
    
    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

/**
*
* Receive clicked list item from JS AJAX
*
*/

// @TODO: collect delete checkbox + delete table + edit table name from JS
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input"));
  $decoded = json_decode($content, true);
  

  //If json_decode failed, the JSON is invalid.
  if(is_array($decoded)) {
    removeFromDb(intval($decoded['id']), $decoded['group']);  
  } else {
    // Send error back to user.
    echo 'JSON invalid';
  }
}