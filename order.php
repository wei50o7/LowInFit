<?php
  session_start();
  if (!isset($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
  } else if (isset($_SESSION['userId']) && !isset($_SESSION['customerId'])) {
    header("Location: knowmore.php");
    exit();
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <title></title>
  </head>

  <body>
    <?php
      include 'includes/dbh.php';
      include 'includes/header.php';

      //sql
      $cid = $_SESSION['customerId'];
      $sql = "SELECT * FROM customer INNER JOIN orderfood ON customer.CustomerID = orderfood.CustomerID  INNER JOIN meal on orderfood.MealID = meal.MealID where customer.CustomerID = '$cid';";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
      //sql2
      if (!empty($row)) {
      $sql5 = "SELECT * FROM orderfood INNER JOIN addon ON orderfood.orderID = addon.orderID  INNER JOIN addonmenu on addon.addonmenuID = addonmenu.addonmenuID where CustomerID = '$cid';";
      $result4 = mysqli_query($conn,$sql5);

      //note useedd
      $sql2 = 'SELECT * FROM addonmenu';
         echo '<div class="container-wrapper">
       <div class="info-container">
         <div class="address-container">
           <div class="address">
             <p>Address</p>
           </div>
           <div class="address-info">
             <p>'.$row["Address"].'</p>
           </div>
         </div>
         <div class="phone-container">
           <div class="phone">
             <p>Phone Number</p>
           </div>
           <div class="number">
             <p>'.$row["Phone"].'</p>
           </div>
         </div>
         </div>';

        $sql3 = "SELECT * FROM meal INNER JOIN orderfood ON meal.MealID = orderfood.MealID where CustomerID = $cid ORDER BY orderfood.OrderID ASC";
        $result2 = mysqli_query($conn,$sql3);
        while ($row2 = mysqli_fetch_array($result2)){
          echo '<div class="main-container">
            <div class="upperDiv">
              <div class="centerDiv">
                <p>' .$row2["OrderStatus"]. '</p>
                <p>' .$row2["DeliveryDate"]. '</p>
              </div>
            </div>
          <div class="left-container">
           <div class="product-img">
             <img src="'.$row2["MealPicture"].'" alt="">
           </div>
           <div class="cart-product-description">
             <div class="prod-title">
               <p>'.$row2["MealName"].'</p>
             </div>
             <p>'.$row2["Remarks"].'</p>
           </div>
           <div class="add-ons">';

           $z = $row2['OrderID'];
           $getAddOns = "SELECT addon.OrderID, addonmenu.AddOnMenuName, addon.AddOnQuantity FROM addon JOIN addonmenu ON addonmenu.AddOnMenuID = addon.AddOnMenuID WHERE OrderID = $z;";
           $resultAddOn = mysqli_query($conn, $getAddOns);
           if (mysqli_num_rows($resultAddOn) === 0) {
             echo 'There is nothing in here :(';
           } else {
             while ($numRows = mysqli_fetch_array($resultAddOn)){
             echo '
             <div class="addon">
               <div class="addon-left">
                 <p>'.$numRows["AddOnMenuName"].'</p>
               </div>
               <div class="addon-right">
                 <p>'.$numRows["AddOnQuantity"].'g</p>
               </div>
             </div>
             ';
           }
           }

         echo '</div>
         </div>
         <div class="right-container">
           <div class="prod-nutri">
             <table>
             <tr>
               <th>Calories</th>
               <th>'.$row2["TotalCalories"].'</th>
             </tr>
             <tr>
               <th>Carbohydrates</th>
               <th>'.$row2["TotalCarbohydrates"].'</th>
             </tr>
             <tr>
               <th>Protein</th>
               <th>'.$row2["TotalProtein"].'</th>
             </tr>
             <tr>
               <th>Fats</th>
               <th>'.$row2["TotalFats"].'</th>
             </tr>
           </table>
           </div>
           <div class="price">
             <p>Price : RM'.$row2["TotalOrderPrice"].'</p>
           </div>
         </div>
       </div>';
         }
         echo '</div>';
       } else {
         echo '<div class="main-empty-container"><img src="img/emptybox.png" class="empty-box"><div class="desc-empty"><p>No Orders Made Yet<br>Order Now!</p></div></div>';

       }
         include 'includes/footer.php';
         ?>

  </body>
</html>
