<!-- search.php -->

<?php
// Assuming you have a products array or a database connection

if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];

    // Perform the search query based on the provided search term

    // Example using an array of products
    $results = [];
    foreach ($products as $product) {
        if (stripos($product['name'], $searchTerm) !== false) {
            $results[] = $product;
        }
    }

    // Generate the search results HTML
    if (!empty($results)) {
        foreach ($results as $result) {
            echo '<p>' . $result['name'] . '</p>';
        }
    } else {
        echo 'No results found.';
    }
}
?>
