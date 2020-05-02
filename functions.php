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
        
        echo 'success, go to bed :-)!';

    }   
    
    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    // header('location: ' . $homeUrl);
}


/**
*
* Get categories
*
*/

function getAllCategories() {
    include "./config/config.php";

    try {

        $connection = new PDO($dsn, $username, $password, $options);
    
        $sql = "SELECT * 
                FROM categories";
    
        $statement = $connection->prepare($sql);
        $statement->execute();
    
        $items = $statement->fetchAll();
    }
    
    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    return $items;
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
    
        $sql = "SELECT categories.category_name, items.category_id, items.item 
                FROM categories 
                INNER JOIN items
                ON items.category_id = categories.id
                ORDER BY categories.category_name, items.item";
    
        $statement = $connection->prepare($sql);
        $statement->execute();
    
        // $items = $statement->fetchAll();   
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);

        $data = array();

        foreach($items as $row){
            $data[$row['category_name']][$row['item']]['item'] = $row['item'];
            $data[$row['category_name']][$row['item']]['category_id'] = $row['category_id'];
        }        

    }
    
    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    return $data;
}




/**
*
* List Groceries
*
*/
 
function listGroceries($cat) {
    include "./config/config.php";

    try {

        $connection = new PDO($dsn, $username, $password, $options);
    
        $sql = "SELECT * 
                FROM $cat";
    
        $statement = $connection->prepare($sql);
        $statement->execute();
    
        $items = $statement->fetchAll();
    }
    
    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    return $items;
}

// require for DB connection swa
require "./config/config.php";


/**
*
* Create list data form 1
*
*/

if(isset($_POST['form-1'])) {
    $item = htmlspecialchars($_POST['item'], ENT_QUOTES, 'utf-8');
    $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'utf-8');

    try {
        $connection = new PDO($dsn, $username, $password, $options);
        // insert new user code here

        $new_item = array(
            "item" => $item
        );
        
        // $sql = "INSERT INTO groente_fruit (item) values (:item)";
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "$category",
            implode(", ", array_keys($new_item)),
            ":" . implode(", :", array_keys($new_item))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_item);   
    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    header('location: ' . $homeUrl);
}

/**
*
* Create list data form 2
*
*/

if(isset($_POST['form-2'])) {
    $item = htmlspecialchars($_POST['item'], ENT_QUOTES, 'utf-8');
    $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'utf-8');

    try {
        $connection = new PDO($dsn, $username, $password, $options);
        // insert new user code here

        $new_item = array(
            "item" => $item
        );
        
        // $sql = "INSERT INTO groente_fruit (item) values (:item)";
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "$category",
            implode(", ", array_keys($new_item)),
            ":" . implode(", :", array_keys($new_item))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_item);   
    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    header('location: ' . $homeUrl);   
}

/**
*
* Create list data form 3
*
*/

if(isset($_POST['form-3'])) {
    $item = htmlspecialchars($_POST['item'], ENT_QUOTES, 'utf-8');
    $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'utf-8');

    try {
        $connection = new PDO($dsn, $username, $password, $options);
        // insert new user code here

        $new_item = array(
            "item" => $item
        );
        
        // $sql = "INSERT INTO groente_fruit (item) values (:item)";
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "$category",
            implode(", ", array_keys($new_item)),
            ":" . implode(", :", array_keys($new_item))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_item);   
    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    header('location: ' . $homeUrl);   
}

/**
*
* Create list data form 4
*
*/

if(isset($_POST['form-4'])) {
    $item = htmlspecialchars($_POST['item'], ENT_QUOTES, 'utf-8');
    $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'utf-8');

    try {
        $connection = new PDO($dsn, $username, $password, $options);
        // insert new user code here

        $new_item = array(
            "item" => $item
        );
        
        // $sql = "INSERT INTO groente_fruit (item) values (:item)";
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "$category",
            implode(", ", array_keys($new_item)),
            ":" . implode(", :", array_keys($new_item))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_item);   
    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    header('location: ' . $homeUrl);   
}

/**
*
* Remove from DB function
*
*/

function removeFromDb($id, $cat) {
    include "./config/config.php";

    try {

        $connection = new PDO($dsn, $username, $password, $options);
    
        $sql = "DELETE FROM $cat
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
* Receive clicked list item
*
*/

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input"));
  $decoded = json_decode($content, true);
  

  //If json_decode failed, the JSON is invalid.
  if(is_array($decoded)) {
    removeFromDb(intval($decoded['id']), $decoded['cat']);  
  } else {
    // Send error back to user.
    echo 'JSON invalid';
  }
}


function getAllTableNames() {
    include "./config/config.php";

    $connection = new PDO($dsn, $username, $password, $options);
    
    //Our SQL statement, which will select a list of tables from the current MySQL database.
    $sql = "SHOW TABLES";
    
    //Prepare our SQL statement,
    $statement = $connection->prepare($sql);
    
    //Execute the statement.
    $statement->execute();
    
    //Fetch the rows from our statement.
    $tables = $statement->fetchAll(PDO::FETCH_NUM);

    // Loop through our table names.
    foreach($tables as $table) {
        //Print the table name out onto the page.
        $listNames[] = $table[0];
    }

    return $listNames;
}