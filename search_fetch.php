<?php
include('database.php');

if (isset($_POST["action"])) {

  $query = "SELECT * FROM fyp_vendors WHERE status = 'Approved'";

  if (isset($_POST["jenis_produk"])) {
    $jenis_produk_filter = implode("','", $_POST["jenis_produk"]);
    $query .= " AND jenis_produk IN('" . $jenis_produk_filter . "')";
  }

  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $total_row = $statement->rowCount();
  $output = '';

  if ($total_row > 0) {
    $counter = 0;
    foreach ($result as $row) {
      $output .= '
        <div class="col-sm-4 col-lg-3 col-md-3 mb-4">
          <div class="card h-100">
            <div style="height: 15rem;">
              <img src="images/' . $row['image'] . '" alt="" class="img-fluid">
            </div>
            <div class="card-body">
              <p align="center"><strong><a href="searchproduct.php?vendor_id=' . $row['vendor_id'] . '">' . $row['nama_syarikat'] . '</a></strong></p>
              <p style="text-align:center;" class="text-danger">' . $row['jenis_produk'] . '</p>
              <p>Location: ' . $row['alamat'] . '<br />
              
            </div>
            <center>
              <a href="searchproduct.php?name=' . $row['vendor_id'] . '" class="btn btn-primary btn-pill">Book</a>
            </center>
          </div>
        </div>';

      $counter++;
      if ($counter % 4 == 0) {
        $output .= '</div><div class="row">'; // Close the previous row and start a new row after every 4 products
      }
    }
    $output .= '</div>'; // Close the final row container
  } else {
    $output = '<h3>No Data Found</h3>';
  }

  echo $output;
}
?>
