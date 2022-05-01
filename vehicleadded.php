<!DOCTYPE HTML>
<html>
<style>
  .err-msg {
    background-color: yellow;
    color: red;
    font-weight: bold;
  }

  .prompt-msg {
    background-color: lightgreen;
    color: black;
    font-weight: bold;
  }

  .good-msg {
    background-color: white;
    color: green;
    font-weight: bold;
    border: 2px solid black;
    border-radius: 25px;
    padding-left: 5px;
  }
</style>

<head>
  <title>Vehicle Added</title>
</head>

<body>
  <div>
    <a href="index.php">Home</a>
    <a href="addvehicle.php">Add another vehicle</a>
    <a href="getvehicleinfo.php">See List of Vehicle</a>
  </div>

  <?php
  require('mysqli_connect.php');

  if (isset($_POST['submit'])) {
    $data_missing = array();
    $data_invalid = array();

    //-- Validate id input:
    //-- . Is it a number?
    //-- . If it is a number, go to validate name
    if (empty($_POST['id'])) {
      $data_missing[] = 'id';
    } else {
      if (is_numeric(trim($_POST['id']))) {
        $id = trim($_POST['id']);
        $tid = trim($_POST['id']);
      } else {
        echo '<p class="err-msg">ID must be a number.</p>';
        $data_invalid[] = 'id';
      }
    }

    //-- Validate name input:
    //-- . Check if id already existed, if so is the name matched?
    //-- . If it is a new id, continue to add record to the table
    if (empty($_POST['name'])) {
      $data_missing[] = 'name';
    } else {
      $name = trim($_POST['name']);

      //-- Prepare statement to check for existing ID in TRANSFORMER table
      $query = "SELECT id, name FROM TRANSFORMER WHERE id = $id";

      $response = @mysqli_query($conn, $query);
      $result_rows = mysqli_num_rows($response);

      if ($result_rows == 1) {
        $result = mysqli_fetch_array($response);
        $id_existed = TRUE;
        if ($result['name'] !=  $name) {
          echo '<p class="err-msg">ID and name are not matched.</p>';
          $data_invalid[] = 'name';
        }
      }
    }

    if (empty($_POST['description'])) {
      $description = 'N/A';
    } else {
      $description = trim($_POST['description']);
    }

    //-- Validate vin input:
    //-- . Check vin's length
    //-- . Check if vin already existed, if so give error
    if (empty($_POST['vin'])) {
      $data_missing[] = 'vin';
    } else {
      $vin = trim($_POST['vin']);
      if (strlen($vin) != 5) {
        echo '<p class="err-msg">VIN must be exactly 5 characters, e.g sif13</p>';
        $data_invalid[] = 'vin';
      } else {
        //-- Prepare statement to check for existing VIN in VEHICLE table
        $query = "SELECT vin FROM VEHICLE WHERE vin = '$vin'";

        $response = @mysqli_query($conn, $query);
        $result_rows = mysqli_num_rows($response);

        if ($result_rows == 1) {
          $result = mysqli_fetch_array($response);
          echo '<p class="err-msg">ID ' . $result['vin'] . ' already existed.</p>';
        }
      }
    }

    if (empty($_POST['make'])) {
      $data_missing[] = 'make';
    } else {
      $make = trim($_POST['make']);
    }

    if (empty($_POST['year_make'])) {
      $data_missing[] = 'year_make';
    } else {
      if (is_numeric(trim($_POST['year_make']))) {
        $year_make = trim($_POST['year_make']);
      } else {
        echo '<p class="err-msg">year_make must be a number, e.g. 1990.</p>';
        $data_invalid[] = 'year_make';
      }

      if ($year_make <= 0 || $year_make > 9999) {
        echo '<p class="err-msg">year_make must be a number in range 1-9999</p>';
        $data_invalid[] = 'year_make';
      }
    }

    if (empty($_POST['registered_date'])) {
      $data_missing[] = 'registered_date';
    } else {
      $registered_date = trim($_POST['registered_date']);
    }

    //-- Validate vehicle type input:
    //-- . Assign 'NULL' to fields that is not related to the vehicle type
    //-- . Check if vin already existed, if so give error
    if (empty($_POST['vehicle_type'])) {
      $data_missing[] = 'vehicle_type';
    } else {
      $vehicle_type = trim($_POST['vehicle_type']);
    }

    switch ($vehicle_type) {
      case "MOTORBIKE":
        if (empty($_POST['type'])) {
          $data_missing[] = 'type';
        } else {
          $type = trim($_POST['type']);
        }

        if (empty($_POST['engine_size'])) {
          $data_missing[] = 'engine_size';
        } else {
          $engine_size = trim($_POST['engine_size']);
        }

        $body_style = NULL;
        $no_of_seat = NULL;
        $classification = NULL;
        $weight_limit = NULL;
        break;

      case "CAR":
        if (empty($_POST['body_style'])) {
          $data_missing[] = 'body_style';
        } else {
          $body_style = trim($_POST['body_style']);
        }

        if (empty($_POST['no_of_seat'])) {
          $data_missing[] = 'no_of_seat';
        } else {
          if (is_numeric(trim($_POST['no_of_seat']))) {
            $no_of_seat = trim($_POST['no_of_seat']);
          } else {
            echo '<p class="err-msg">no_of_seat must be a number</p>';
            $data_invalid[] = 'no_of_seat';
          }

          if ($no_of_seat <= 0 || $no_of_seat > 9) {
            echo '<p class="err-msg">no_of_seat must be a number in range 1-9</p>';
            $data_invalid[] = 'no_of_seat';
          }
        }

        $type = NULL;
        $engine_size = NULL;
        $classification = NULL;
        $weight_limit = NULL;
        break;

      case "TRUCK":
        if (empty($_POST['classification'])) {
          $data_missing[] = 'classification';
        } else {
          $classification = trim($_POST['classification']);
        }

        if (empty($_POST['weight_limit'])) {
          $data_missing[] = 'weight_limit';
        } else {
          if (is_numeric(trim($_POST['weight_limit']))) {
            $weight_limit = trim($_POST['weight_limit']);
          } else {
            echo '<p class="err-msg">weight_limit must be a number in range 0-999</p>';
            $data_invalid[] = 'weight_limit';
          }

          if ($weight_limit < 0 || $weight_limit > 999) {
            echo '<p class="err-msg">weight_limit must be a number in range 0-999</p>';
            $data_invalid[] = 'weight_limit';
          }
        }

        $type = NULL;
        $engine_size = NULL;
        $body_style = NULL;
        $no_of_seat = NULL;
        break;

      default:
        echo "Invalid vehicle type!";
    }

    if (empty($data_missing) && empty($data_invalid)) {
      // require('mysqli_connect.php');

      if (!$id_existed) {
        //-- Prepare statement & Insert record into TRANSFORMER table
        $query = "INSERT INTO TRANSFORMER (id, name, description) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($stmt, "iss", $id, $name, $description);
        mysqli_stmt_execute($stmt);

        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if ($affected_rows == 1) {
          echo '<p class="good-msg"> Transformer record has been entered.</p>';
          mysqli_stmt_close($stmt);
        } else {
          echo 'Error Occurred<br />';
          echo $mysqli->error;
          mysqli_stmt_close($stmt);
        }
      }

      //-- Prepare statement & Insert record into VEHICLE table
      $query = "INSERT INTO VEHICLE (vin, tid, make, year_make, registered_date, vehicle_type, type, engine_size, body_style, no_of_seat, classification,
          weight_limit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

      $stmt = mysqli_prepare($conn, $query);

      // i Integers
      // d Doubles
      // b Blobs
      // s Everything Else

      mysqli_stmt_bind_param(
        $stmt,
        "sisisssssisi",
        $vin,
        $tid,
        $make,
        $year_make,
        $registered_date,
        $vehicle_type,
        $type,
        $engine_size,
        $body_style,
        $no_of_seat,
        $classification,
        $weight_limit
      );

      mysqli_stmt_execute($stmt);

      $affected_rows = mysqli_stmt_affected_rows($stmt);

      if ($affected_rows == 1) {
        echo '<p class="good-msg">Vehicle record has been entered</p>';
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        echo '<p class="good-msg">Connection is closed.</p>';
      } else {
        echo 'Error Occurred<br />';
        echo $mysqli->error;
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        echo '<p class="good-msg">Connection is closed.</p>';
      }
    } else {
      if (!empty($data_missing)) {
        echo '<p class="prompt-msg">You need to enter the following data:</p>';

        foreach ($data_missing as $missing) {
          echo "$missing<br />";
        }
      }
    }
  }
  ?>
</body>

</html>