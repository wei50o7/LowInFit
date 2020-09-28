<?php
  session_start();
  if (!isset($_SESSION['roleId']) || !in_array($_SESSION['roleId'], array(1,2), true)) {
    header("Location: ../index.php");
    exit();
  }
 ?>
<!DOCTYPE html>
<html>
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

  </head>
  <body>
    <header>
      <?php
        include "../includes/header.php";
       ?>
    </header>
    <form class="searchbar-form" id="searchbar-form" action="?" method="post">
      <input type="text" name="searchorder" style="transform: translateY(61px);" value="" placeholder="Search by Cust Name" class="searchbar">
      <input type="submit" value=">>" style="transform: translateY(61px);" class="searchbar-submit">
    </form>
    <div class="container-wrapper">
      <?php
        include '../includes/staffheader.php';
        include '../includes/dbh.php'
      ?>
      <div class="table-wrapper">

        <div class="table-h1">
          <h1 style="color:#e83f77;font-family:"Poppins";font-size:20px">Past Order</h1>
          </div>
        <?php
        $output = '
           <table class="order-table">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Cust ID</th>
                <th>Cust First Name</th>
                <th>Meal Name</th>
                <th>Add On</th>
                <th>Add On Quantity</th>
                <th>Remarks</th>
                <th>Order Date</th>
                <th class=deliverydate>Delivery Date</th>
                <th>Cust Address</th>
                <th>Cust Phone Num</th>
                <th>Order Status</th>
                <th>Staff in Charge</th>
                <th></th>
                <th></th>
              </tr>
            </thead>';

        if(isset($_POST["searchorder"])){
          $searchpast = $_POST["searchorder"];

         $query2 = "SELECT orderfood.OrderID, orderfood.CustomerID, customer.FirstName, customer.Address, customer.Phone, meal.MealName, addonmenu.AddOnMenuName, addon.AddOnQuantity, orderfood.Remarks, orderfood.OrderDate, orderfood.DeliveryDate, orderfood.OrderStatus, staff.StaffFName FROM orderfood LEFT JOIN addon ON addon.OrderID = orderfood.OrderID JOIN customer ON customer.CustomerID = orderfood.CustomerID JOIN meal ON meal.MealID = orderfood.MealID LEFT JOIN addonmenu ON addonmenu.AddOnMenuID = addon.AddOnMenuID LEFT JOIN staff ON staff.StaffID = orderfood.StaffID WHERE (customer.FirstName LIKE '%".$searchpast."%') AND (orderfood.OrderStatus='OrderDelivered') ORDER BY orderfood.DeliveryDate DESC";
         $result2 = mysqli_query($conn, $query2) or die( mysqli_error($conn));
             echo $output;
             while($row2 = mysqli_fetch_array($result2))
             {
               echo "<tbody><tr>";
               echo "<td>";
               echo $row2['OrderID'];
               echo "</td>";
               echo "<td>";
               echo $row2['CustomerID'];
               echo "</td>";
               echo "<td class='ordermeal'>";
               echo $row2['FirstName'];
               echo "</td>";
               echo "<td class='ordermeal'>";
               echo $row2['MealName'];
               echo "</td>";
               echo "<td class='ordermeal'>";
               echo $row2['AddOnMenuName'];
               echo "</td>";
               echo "<td>";
               echo $row2['AddOnQuantity'];
               echo "</td>";
               echo "<td class='orderremarks'>";
               echo $row2['Remarks'];
               echo "</td>";
               echo "<td>";
               echo $row2['OrderDate'];
               echo "</td>";
               echo "<td>";
               echo $row2['DeliveryDate'];
               echo "</td>";
               echo "<td class='ordermeal'>";
               echo $row2['Address'];
               echo "</td>";
               echo "<td class='ordermeal'>";
               echo $row2['Phone'];
               echo "</td>";
               echo "<td class='orderstatus'>";
               echo $row2['OrderStatus'];
               echo "</td>";
               echo "<td class='orderstaffincharge'>";
               echo $row2['StaffFName'];
               echo "</td>";
               echo "<td><a href=\"../admin/editorder.php?orderid=";
               echo $row2['OrderID'];
               echo "\">Edit Order Status<br>/Staff In Charge</a></td>";
               echo "<td><a href=\"../includes/deleteorder.php?orderid=";
               echo $row2['OrderID'];
               echo "\" onClick=\"return confirm('Delete OrderID=";
               echo $row2['OrderID'];
               echo "?');\">Delete</a></td></tr></tbody>";
         }
       }
       else {
         $query2 = "SELECT orderfood.OrderID, orderfood.CustomerID, customer.FirstName, customer.Address, customer.Phone, meal.MealName, addonmenu.AddOnMenuName, addon.AddOnQuantity, orderfood.Remarks, orderfood.OrderDate, orderfood.DeliveryDate, orderfood.OrderStatus, staff.StaffFName FROM orderfood LEFT JOIN addon ON addon.OrderID = orderfood.OrderID JOIN customer ON customer.CustomerID = orderfood.CustomerID JOIN meal ON meal.MealID = orderfood.MealID LEFT JOIN addonmenu ON addonmenu.AddOnMenuID = addon.AddOnMenuID LEFT JOIN staff ON staff.StaffID = orderfood.StaffID WHERE (orderfood.OrderStatus='OrderDelivered') ORDER BY orderfood.DeliveryDate DESC";
         $result2 = mysqli_query($conn, $query2) or die( mysqli_error($conn));
             echo $output;
             while($row2 = mysqli_fetch_array($result2))
             {
               echo "<tbody><tr>";
               echo "<td>";
               echo $row2['OrderID'];
               echo "</td>";
               echo "<td>";
               echo $row2['CustomerID'];
               echo "</td>";
               echo "<td class='ordermeal'>";
               echo $row2['FirstName'];
               echo "</td>";
               echo "<td class='ordermeal'>";
               echo $row2['MealName'];
               echo "</td>";
               echo "<td class='ordermeal'>";
               echo $row2['AddOnMenuName'];
               echo "</td>";
               echo "<td>";
               echo $row2['AddOnQuantity'];
               echo "</td>";
               echo "<td class='orderremarks'>";
               echo $row2['Remarks'];
               echo "</td>";
               echo "<td>";
               echo $row2['OrderDate'];
               echo "</td>";
               echo "<td>";
               echo $row2['DeliveryDate'];
               echo "</td>";
               echo "<td class='ordermeal'>";
               echo $row2['Address'];
               echo "</td>";
               echo "<td class='ordermeal'>";
               echo $row2['Phone'];
               echo "</td>";
               echo "<td class='orderstatus'>";
               echo $row2['OrderStatus'];
               echo "</td>";
               echo "<td class='orderstaffincharge'>";
               echo $row2['StaffFName'];
               echo "</td>";
               echo "<td><a href=\"../admin/editorder.php?orderid=";
               echo $row2['OrderID'];
               echo "\">Edit Order Status<br>/Staff In Charge</a></td>";
               echo "<td><a href=\"../includes/deleteorder.php?orderid=";
               echo $row2['OrderID'];
               echo "\" onClick=\"return confirm('Delete OrderID=";
               echo $row2['OrderID'];
               echo "?');\">Delete</a></td></tr></tbody>";
         }

       }
        /*        <td><a href=../admin/editorder.php?orderid='.$row['OrderID'].'>Edit Order Status<br>/Staff In Charge</a></td>
                <td><a href="deleteorder.php?orderid='.$row['OrderID'].'" onClick="return confirm('Delete OrderID=$row['OrderID']?')">Delete</a></td>
        */
        ?>
          </table>

      </div>
    </div>
</body>
</html>
<!--<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"../includes/search.php",
   method:"POST",
   data:{search:txt},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>
