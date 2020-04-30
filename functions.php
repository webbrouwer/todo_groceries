<?php 

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

