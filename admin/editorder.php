<?php
  session_start();
  if (!isset($_SESSION['roleId']) || !in_array($_SESSION['roleId'], array(1,2), true)) {
    header("Location: ../index.php");
    exit();
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>LowInFit ADMIN</title>
    <link rel="stylesheet" href="../css/leftnavbar.css">
    <link rel="stylesheet" href="../css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <title>Edit Menu</title>
  </head>
  <body>
    <header>
      <?php
        include "../includes/header.php";
       ?>
    </header>
    <div class="container-wrapper">
      <?php
        include '../includes/staffheader.php';
      ?>
      <?php
        include ("../includes/dbh.php");
        $id = intval ($_GET['orderid']); //Get the id from URL
        $result = mysqli_query ($conn,"SELECT * FROM orderfood WHERE OrderID=$id");
        while ($row = mysqli_fetch_array($result))
        {
        ?>
        <form action="../includes/editorder.php" method="post">
        <table style="width: 100%" class="menu-table">
          <thead>
          <tr>
            <td style="width: 156px">OrderStatus:</td>
            <td><input name="orderstatus" type="radio" value="OrderReceived" <?php if ($row['OrderStatus']=='OrderReceived') {
              echo "checked";}?>><label for="orderreceived">OrderReceived</label></td>
            <tr>
              <td></td>
              <td><input name="orderstatus" type="radio" value="OrderPreparing" <?php if ($row['OrderStatus']=='OrderPreparing') {
                echo "checked";}?>><label for="orderpreparing">OrderPreparing</label></td>
              <tr>
                <td></td>
                <td><input name="orderstatus" type="radio" value="OrderOnDelivering" <?php if ($row['OrderStatus']=='OrderOnDelivering') {
                  echo "checked";}?>><label for="orderdelivering">OrderOnDelivering</label></td>
                  <tr>
                    <td></td>
                    <td><input name="orderstatus" type="radio" value="OrderDelivered" <?php if ($row['OrderStatus']=='OrderDelivered') {
                      echo "checked";}?>><label for="orderdelivered">OrderDelivered</label></td>
                  </tr>
              </tr>
            </tr>
          </tr>
          <tr>
            <td style="width: 156px">StaffInCharge:</td>
            <td>
            <select name ="staffid">
              <option value="">--Select Your StaffID--</option>
              <?php
              $query = "SELECT * FROM staff";
              $resultQuery = mysqli_query($conn,$query);
              while ($row2 = mysqli_fetch_array($resultQuery))
              {
                $staffdrop = $row2['StaffID'];
                echo "<option value ='$staffdrop'>$staffdrop</option>";
              }
               ?>
            <!--<td><input name="staffid" type="text" value="<?php //echo $row['StaffID'] ?>"></td>-->
            </select>

            </td>
          </tr>
          <tr>
            <td><input name="btnSubmit" type="submit" value="Submit"><br></td>
            <td><input type="button" value="Back" onclick="history.back()"></td>
          </tr>
        </thead>
        </table>
        <input type="hidden" name="orderid" value="<?php echo $row['OrderID'] ?>">
        </form>
        <?php
};
mysqli_close($conn);
?>

  </body>
</html>
