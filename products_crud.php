<?php
include_once 'database.php';

if (empty($_SESSION)) {
  session_start();
}

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Insert
if (isset($_POST['create'])) {

  try {

    $stmt = $conn->prepare("INSERT INTO fyp_items(item_id, item_name, category, image, added_at, stock, owner) VALUES(:item_id, :item_name, :category, :image, :added_at, :stock, :owner)");

    $stmt->bindParam(':item_id', $item_id, PDO::PARAM_STR);
    $stmt->bindParam(':item_name', $item_name, PDO::PARAM_STR);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->bindParam(':image', $image, PDO::PARAM_STR);
    $stmt->bindParam(':added_at', $added_at, PDO::PARAM_STR);
    $stmt->bindParam(':stock', $stock, PDO::PARAM_STR);
    $stmt->bindParam(':owner', $owner, PDO::PARAM_STR);

    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $category = $_POST['category'];
    
    $path = "images";
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
    
    $image = $filename;
    $added_at = $_POST['added_at'];
    $stock = $_POST['stock'];
    $owner = $_POST['owner'];

    $stmt->execute();
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

// Update
if (isset($_POST['update'])) {

  try {

    $stmt = $conn->prepare("UPDATE fyp_items SET
      item_id = :item_id, item_name = :item_name, category = :category, image = :image, stock = :stock
      WHERE item_id = :oldsid");

    $stmt->bindParam(':item_id', $item_id, PDO::PARAM_STR);
    $stmt->bindParam(':item_name', $item_name, PDO::PARAM_STR);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->bindParam(':image', $image, PDO::PARAM_STR);
    $stmt->bindParam(':stock', $stock, PDO::PARAM_STR);
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);

    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $category = $_POST['category'];
    
    if (!empty($_FILES['image']['tmp_name'])) {
      $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
      $filename = time().'.'.$image_ext;

      move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);

      $image = $filename;
    }

    $stock = $_POST['stock'];
    $oldsid = $_POST['oldsid'];

    $stmt->execute();

    header("Location: products.php");
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

// Delete
if (isset($_GET['delete'])) {

  try {
 
    $stmt = $conn->prepare("DELETE FROM fyp_items where item_id = :item_id");
   
    $stmt->bindParam(':item_id', $item_id, PDO::PARAM_STR);
       
    $item_id = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}


//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM fyp_items where item_id = :item_id");
   
    $stmt->bindParam(':item_id', $item_id, PDO::PARAM_STR);
       
    $item_id = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
  $conn = null;
 
?>
