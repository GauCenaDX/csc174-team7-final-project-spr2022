<html>
<style>
  .note {
    background-color: yellow;
    color: red;
    font-weight: bold;
  }

</style>

<body>
  <a href="index.php">Home</a>
  <a href="getvehicleinfo.php">See List of Vehicle</a>

  <form action="vehicleadded.php" method="post">
    <p class="note">All * fields must have a value.</p>
    <h2>Add a Transformer</h2>

    <table width:100%>
      <tr>
        <td>ID:</td>
        <td><input type="text" name="id" size="30" value="" /><a style="color:red;">*</a></td>
      </tr>
      <tr>
        <td>Name:</td>
        <td><input type="text" name="name" size="30" value="" /><a style="color:red;">*</a></td>
      </tr>
      <tr>
        <td>Description:</td>
        <td><input type="text" name="description" size="100" value="" /></td>
      </tr>
    </table>

    <h2>Add a Vehicle for this Transformer</h2>

    <table width:100%>
      <tr>
        <td>Vin:</td>
        <td><input type="text" name="vin" size="5" value="" /><a style="color:red;">*</a></td>
      </tr>
      <tr>
        <td>Make:</td>
        <td><input type="text" name="make" size="30" value="" /><a style="color:red;">*</a></td>
      </tr>
      <tr>
        <td>Year Make:</td>
        <td><input type="text" name="year_make" size="4" value="" /><a style="color:red;">*</a></td>
      </tr>
      <tr>
        <td>Registered date:</td>
        <td><input type="date" name="registered_date" size="30" value="" /><a style="color:red;">*</a></td>
      </tr>
      <tr>
        <td><label for="vehicle_type">Vehicle type:</label></td>
        <td><select id="vehicle_type" name="vehicle_type">
              <option value="MOTORBIKE">MOTORBIKE</option>
              <option value="CAR">CAR</option>
              <option value="TRUCK">TRUCK</option>
            </select><a style="color:red;">*</a>
        </td>
      </tr>
      <tr>
        <td>Type (MOTORBIKE only):</td>
        <td><input type="text" name="type" size="30" value="" /></td>
      </tr>
      <tr>
        <td>Engine size (MOTORBIKE only):</td>
        <td><input type="text" name="engine_size" size="30" value="" /></td>
      </tr>

      <tr>
        <td>Body style (CAR only):</td>
        <td><input type="text" name="body_style" size="30" value="" /></td>
      </tr>
      <tr>
        <td>No. of seat (CAR only):</td>
        <td><input type="text" name="no_of_seat" size="1" value="" /></td>
      </tr>

      <tr>
        <td>Classification (TRUCK only):</td>
        <td><input type="text" name="classification" size="30" value="" /></td>
      </tr>
      <tr>
        <td>Weight limit (TRUCK only):</td>
        <td><input type="text" name="weight_limit" size="3" value="" /></td>
      </tr>
    </table>

    <p>
      <input type="submit" name="submit" value="Send" />
    </p>
  </form>
</body>

</html>