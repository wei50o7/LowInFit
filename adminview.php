<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>LowInFit ADMIN</title>
    <link rel="stylesheet" href="css/leftnavbar.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <header>
      <?php
        include "includes/header.php";
       ?>
    </header>
    <div class="table-container">
      <h1 style="color:pink;font-family:"Poppins";font-size:20px">Current Order</h1>
      <table class="order-table">
        <thead>
          <tr>
            <th>OrderID</th>
            <th>CustomerID</th>
            <th>Customer Name</th>
            <th>Meal Name</th>
            <th>Add-On</th>
            <th>Add-On Quantity</th>
            <th>Order Status</th>
            <th>Delivery Date</th>
            <th>Staff in Charge</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>001</td>
            <td>Gary</td>
            <td>Low as  </td>
            <td>Garylowas @ u.com</td>
            <td>69</td>
            <td>dsa</td>
            <td>bdf</td>
            <td>gs</td>
            <td>dsa f</td>
          </tr>
          <tr>
            <td>002</td>
            <td>Gary</td>
            <td>Low as  </td>
            <td>Garylowas @ u.com</td>
            <td>69</td>
            <td>dsa</td>
            <td>bdf</td>
            <td>gs</td>
            <td>dsa f</td>
          </tr>
          <tr>
            <td>003</td>
            <td>Gary</td>
            <td>Low as  </td>
            <td>Garylowas @ u.com</td>
            <td>69</td>
            <td>dsa</td>
            <td>bdf</td>
            <td>gs</td>
            <td>dsa f</td>
          </tr>
        </tbody>
      </table>
      <h1 style="color:pink;font-family:"Poppins";font-size:20px">Done Order</h1>

      <table class="order-table">
        <thead>
          <tr>
            <th>OrderID</th>
            <th>CustomerID</th>
            <th>Customer Name</th>
            <th>Meal Name</th>
            <th>Add-On</th>
            <th>Add-On Quantity</th>
            <th>Order Status</th>
            <th>Delivery Date</th>
            <th>Staff in Charge</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>001</td>
            <td>Gary</td>
            <td>Low as  </td>
            <td>Garylowas @ u.com</td>
            <td>69</td>
            <td>dsa</td>
            <td>bdf</td>
            <td>gs</td>
            <td>dsa f</td>
          </tr>
          <tr>
            <td>002</td>
            <td>Gary</td>
            <td>Low as  </td>
            <td>Garylowas @ u.com</td>
            <td>69</td>
            <td>dsa</td>
            <td>bdf</td>
            <td>gs</td>
            <td>dsa f</td>
          </tr>
          <tr>
            <td>003</td>
            <td>Gary</td>
            <td>Low as  </td>
            <td>Garylowas @ u.com</td>
            <td>69</td>
            <td>dsa</td>
            <td>bdf</td>
            <td>gs</td>
            <td>dsa f</td>
          </tr>
        </tbody>
      </table>

    </div>

    <?php
      include 'includes/staffheader.php';
     ?>

  </body>
</html>
