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
            $data[$row['category_name']]['cat_id'] = $row['cat_id'];
            $data[$row['category_name']][$row['item']]['item'] = $row['item'];
            $data[$row['category_name']][$row['item']]['category_id'] = $row['category_id'];
            $data[$row['category_name']][$row['item']]['id'] = $row['id'];
        }

    }
    
    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    return $data;
}


/**
*
* Remove item from DB function
*
*/

function deleteItemFromDb($id, $group) {
    include "./config/config.php";

    try {

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "DELETE FROM $group
                WHERE id=$id";

        $connection->exec($sql);
    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

/**
*
* Remove category and its items from DB function
*
*/

function deleteCatFromDb($id) {
    include "./config/config.php";

    try {

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "DELETE c, i FROM categories c
        LEFT JOIN items i
        ON c.id = i.category_id
        WHERE c.id = :id";

        $stmt = $connection->prepare($sql);     
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);   

        $stmt->execute();

    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}


/**
*
* Remove category and its items from DB function
*
*/

function editCatName($id, $newName) {
    include "./config/config.php";

    try {

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "UPDATE categories
                SET category_name=:new_name
                WHERE id=:id ";

        $stmt = $connection->prepare($sql);

        $stmt->bindParam(':new_name', $newName, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}


/**
*
* Receive clicked data from JS AJAX
*
*/

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input"));
  $decoded = json_decode($content, true);

  // If json_decode failed, the JSON is invalid.
  if(is_array($decoded)) {  
    $action = $decoded['data_action'];
    switch($action) {
        case 'delete_item': 
            deleteItemFromDb(intval($decoded['id']), $decoded['group']);
            break;
        case 'delete_category':
            deleteCatFromDb(intval($decoded['id']));
            break;
        case 'edit_category_name':
            editCatName(intval($decoded['id']), $decoded['new_name']);
            break;            
        }
    echo 'Data has been send, functions take over from here!';
    } else {
            // Send error back to user.
            echo 'JSON invalid';
    }    
}