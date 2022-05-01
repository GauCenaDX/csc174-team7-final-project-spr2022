<!DOCTYPE HTML>
<html>
<style>
  table {
    border-bottom: 1px solid #ddd;
    margin-bottom: 2rem;
  }

  th, td {
    border-bottom: 1px solid #ddd;
  }
</style>

<head>
  <title>Get Vehicle Info</title>
</head>

<body>
  <div>
    <a href="index.php">Home</a>
    <a href="addvehicle.php">Add another vehicle</a>
  </div>

  <div>
    <?php
    // Get a connection for the database
    require('mysqli_connect.php');

    //-------------------------------------
    // Query info from TRANSFORMER table
    //-------------------------------------

    $query = "SELECT * FROM TRANSFORMER";

    // Get a response from the database by sending the connection
    // and the query
    $response = @mysqli_query($conn, $query);
    // If the query executed properly proceed
    if ($response) {
      echo '<h1> TRANSFORMERS </h1>';
      echo '<table style="width:100%" align="left" cellspacing="5" cellpadding="8">

        <tr>
          <th align="left"><b>ID</b></th>
          <th align="left"><b>Name</b></th>
          <th align="left"><b>Description</b></th>
        </tr>';

      // mysqli_fetch_array return a row of data from the query
      // until no further data is available
      while ($row = mysqli_fetch_array($response)) {
        echo '<tr><td align="left">' .
          $row['id'] . '</td><td align="left">' .
          $row['name'] . '</td><td align="left">' .
          $row['description'] . '</td>' . '</tr>';
      }

      echo '</table>';
    } else {
      echo "Cannot execute query<br />";
      echo $query;

      echo mysqli_error($conn);
    }

    //-------------------------------------
    // Query info from VEHICLE table
    //-------------------------------------

    $query = "SELECT * FROM VEHICLE";

    // Get a response from the database by sending the connection
    // and the query
    $response = @mysqli_query($conn, $query);

    // If the query executed properly proceed
    if ($response) {
      echo '<h1> VEHICLES </h1>';
      echo '<table style="width:100%" align="left" cellspacing="5" cellpadding="8">

        <tr>
          <th align="left"><b>Vin</b></th>
          <th align="left"><b>TID</b></th>
          <th align="left"><b>Make</b></th>
          <th align="left"><b>Year Make</b></th>
          <th align="left"><b>Registered Date</b></th>
          <th align="left"><b>Vehicle Type</b></th>
          <th align="left"><b>Type</b></th>
          <th align="left"><b>Engine Size</b></th>
          <th align="left"><b>Body Style</b></th>
          <th align="left"><b>No. of seat</b></th>
          <th align="left"><b>Classification</b></th>
          <th align="left"><b>Weight limit</b></th>
        </tr>';

      while ($row = mysqli_fetch_array($response)) {
        echo '<tr><td align="left">' .
          $row['vin'] . '</td><td align="left">' .
          $row['tid'] . '</td><td align="left">' .
          $row['make'] . '</td><td align="left">' .
          $row['year_make'] . '</td><td align="left">' .
          $row['registered_date'] . '</td><td align="left">' .
          $row['vehicle_type'] . '</td><td align="left">' .
          $row['type'] . '</td><td align="left">' .
          $row['engine_size'] . '</td><td align="left">' .
          $row['body_style'] . '</td><td align="left">' .
          $row['no_of_seat'] . '</td><td align="left">' .
          $row['classification'] . '</td><td align="left">' .
          $row['weight_limit'] . '</td>';
        echo '</tr>';
      }

      echo '</table>';
    } else {
      echo "Cannot execute query<br />";
      echo $query;

      echo mysqli_error($conn);
    }

    // Close connection to the database
    mysqli_close($conn);
    ?>
  </div>
</body>

</html>